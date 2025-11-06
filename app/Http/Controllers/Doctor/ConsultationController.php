<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Base query
        if ($user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.')) {
            $query = Consultation::with(['patient.user', 'appointment', 'doctor']);
        } else {
            $doctor = $user->doctor;

            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            $query = Consultation::where('doctor_id', $doctor->user_id)
                ->with(['patient.user', 'appointment']);
        }

        // Apply search filter
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('chief_complaint', 'like', '%' . $search . '%')
                  ->orWhere('present_illness', 'like', '%' . $search . '%')
                  ->orWhereHas('patient', function($patientQuery) use ($search) {
                      $patientQuery->where('full_name', 'like', '%' . $search . '%')
                                   ->orWhereHas('user', function($userQuery) use ($search) {
                                       $userQuery->where('first_name', 'like', '%' . $search . '%')
                                                ->orWhere('last_name', 'like', '%' . $search . '%')
                                                ->orWhere('email', 'like', '%' . $search . '%');
                                   });
                  });
            });
        }

        // Apply status filter
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Calculate statistics before pagination
        $totalConsultations = $query->count();
        $completedCount = (clone $query)->where('status', 'completed')->count();
        $inProgressCount = (clone $query)->where('status', 'in_progress')->count();
        $todayCount = (clone $query)->where('consultation_date', today())->count();

        $consultations = $query->orderBy('consultation_date', 'desc')
            ->paginate(10);

        return view('admin.consultations.index', compact('consultations', 'totalConsultations', 'completedCount', 'inProgressCount', 'todayCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        $consultationDate = $request->get('consultation_date', date('Y-m-d'));

        // Admin users can see all patients and doctors
        if ($user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.')) {
            // Filter patients by confirmed appointments on the selected date
            $patients = Patient::whereHas('appointments', function ($query) use ($consultationDate) {
                $query->where('status', 'confirmed')
                      ->whereDate('appointment_date', $consultationDate);
            })->with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->get();

            $doctors = Doctor::with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->get();

            // Set default doctor to "Dr. Augustus Caesar Butch B. Bigornia"
            $defaultDoctor = Doctor::whereHas('user', function ($query) {
                $query->where('first_name', 'Augustus Caesar Butch B.')
                      ->where('last_name', 'Bigornia');
            })->first();

            $selectedDoctorId = $defaultDoctor ? $defaultDoctor->id : null;
        } else {
            $doctor = $user->doctor;

            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Get patients who have confirmed appointments with this doctor on the selected date
            $patients = Patient::whereHas('appointments', function ($query) use ($doctor, $consultationDate) {
                $query->where('doctor_id', $doctor->user_id)
                      ->where('status', 'confirmed')
                      ->whereDate('appointment_date', $consultationDate);
            })->with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->get();

            // For doctors, only show themselves as the doctor option
            $doctors = Doctor::where('id', $doctor->id)->with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->get();
            $selectedDoctorId = $doctor->id;
        }

        // Get the selected patient ID from the request
        $selectedPatientId = $request->get('patient_id');

        return view('admin.consultations.create', compact('patients', 'doctors', 'selectedPatientId', 'selectedDoctorId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'consultation_date' => 'nullable|date',
            'chief_complaint' => 'required|string',
            'present_illness' => 'nullable|string',
            'past_medical_history' => 'nullable|string',
            'medications' => 'nullable|string',
            'allergies' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'heart_rate' => 'nullable|string',
            'temperature' => 'nullable|string',
            'respiratory_rate' => 'nullable|string',
            'height' => 'nullable|string',
            'weight' => 'nullable|string',
            'bmi' => 'nullable|string',
        ]);

        // For non-admin users, verify they can only create consultations for themselves
        if (! ($user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.'))) {
            $doctor = $user->doctor;

            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Ensure the selected doctor is the current user
            if ($request->doctor_id != $doctor->id) {
                return back()->withErrors(['doctor_id' => 'You can only create consultations for yourself.']);
            }

            // Verify the patient has an appointment with this doctor
            $hasAppointment = Appointment::where('patient_id', $request->patient_id)
                ->where('doctor_id', $doctor->user_id)
                ->exists();

            if (! $hasAppointment) {
                return back()->withErrors(['patient_id' => 'You can only create consultations for patients who have appointments with you.']);
            }

            $doctorId = $doctor->user_id;
        } else {
            // For admin, get the doctor_id from the selected doctor
            $selectedDoctor = Doctor::find($request->doctor_id);
            if (! $selectedDoctor) {
                return back()->withErrors(['doctor_id' => 'Selected doctor not found.']);
            }
            $doctorId = $selectedDoctor->user_id;
        }

        // Prepare vital signs data
        $clinicalMeasurements = [];
        if ($request->filled('blood_pressure')) {
            $clinicalMeasurements['blood_pressure'] = $request->blood_pressure;
        }
        if ($request->filled('heart_rate')) {
            $clinicalMeasurements['heart_rate'] = $request->heart_rate;
        }
        if ($request->filled('temperature')) {
            $clinicalMeasurements['temperature'] = $request->temperature;
        }
        if ($request->filled('respiratory_rate')) {
            $clinicalMeasurements['respiratory_rate'] = $request->respiratory_rate;
        }
        if ($request->filled('height')) {
            $clinicalMeasurements['height'] = $request->height;
        }
        if ($request->filled('weight')) {
            $clinicalMeasurements['weight'] = $request->weight;
        }
        if ($request->filled('bmi')) {
            $clinicalMeasurements['bmi'] = $request->bmi;
        }

        // Determine status based on request
        $status = $request->get('status', 'in_progress');

        $consultation = Consultation::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $doctorId,
            'consultation_date' => $request->consultation_date ?? now()->toDateString(),
            'consultation_time' => now(),
            'chief_complaint' => $request->chief_complaint,
            'present_illness' => $request->present_illness,
            'past_medical_history' => $request->past_medical_history,
            'medications' => $request->medications,
            'allergies' => $request->allergies,
            'clinical_measurements' => ! empty($clinicalMeasurements) ? json_encode($clinicalMeasurements) : null,
            'status' => $status,
            'created_by' => auth()->id(),
        ]);

        // Handle AJAX requests for draft saving
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $status === 'draft' ? 'Draft saved successfully!' : 'Consultation created successfully!',
                'consultation_id' => $consultation->id,
            ]);
        }

        return redirect()->route('doctor.consultations.show', $consultation)->with('success', 'Consultation created successfully. You can now add diagnosis and treatment plan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        $user = auth()->user();

        // Admin users can view any consultation
        if ($user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.')) {
            $consultation->load(['patient.user', 'patient.appointments', 'patient.consultations', 'appointment', 'doctor']);
            $patient = $consultation->patient;
            return view('admin.consultations.show', compact('consultation', 'patient'));
        }

        // For doctors, ensure they can only view their own consultations
        $doctor = $user->doctor;
        if (! $doctor) {
            return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
        }

        // Ensure the consultation belongs to the authenticated doctor
        if ($consultation->doctor_id !== $doctor->user_id) {
            abort(403, 'Unauthorized access.');
        }

        $consultation->load(['patient.user', 'patient.appointments', 'patient.consultations', 'appointment', 'doctor']);
        $patient = $consultation->patient;

        return view('admin.consultations.show', compact('consultation', 'patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        $user = auth()->user();
        $consultationDate = $consultation->consultation_date ? Carbon::parse($consultation->consultation_date)->format('Y-m-d') : date('Y-m-d');

        // Load consultation relationships
        $consultation->load('patient.user');

        // Admin users can edit any consultation
        if ($user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.')) {
            // Get patients with confirmed appointments on the consultation date
            $patients = Patient::whereHas('appointments', function ($query) use ($consultationDate) {
                $query->where('status', 'confirmed')
                      ->whereDate('appointment_date', $consultationDate);
            })->with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->get();

            $doctors = Doctor::with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->get();

            $selectedPatientId = $consultation->patient_id;
            $selectedDoctorId = $consultation->doctor_id;
            $patient = $consultation->patient;

            return view('admin.consultations.edit', compact('consultation', 'patients', 'doctors', 'selectedPatientId', 'selectedDoctorId', 'patient'));
        }

        // For doctors, ensure they can only edit their own consultations
        $doctor = $user->doctor;
        if (! $doctor) {
            return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
        }

        // Ensure the consultation belongs to the authenticated doctor
        if ($consultation->doctor_id !== $doctor->user_id) {
            abort(403, 'Unauthorized access.');
        }

        $patients = Patient::whereHas('appointments', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->user_id);
        })->with('user')->whereHas('user')->get();

        // For doctors, only show themselves as the doctor option
        $doctors = Doctor::where('id', $doctor->id)->with('user')->whereHas('user', function ($query) {
            $query->whereNull('deleted_at');
        })->get();

        $selectedPatientId = $consultation->patient_id;
        $selectedDoctorId = $consultation->doctor_id;
        $patient = $consultation->patient;

        return view('admin.consultations.edit', compact('consultation', 'patients', 'doctors', 'selectedPatientId', 'selectedDoctorId', 'patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {
        $user = auth()->user();
        
        // Admin users can update any consultation
        $isAdmin = $user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.');

        if (!$isAdmin) {
            $doctor = $user->doctor;
            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Ensure the consultation belongs to the authenticated doctor
            if ($consultation->doctor_id !== $doctor->user_id) {
                abort(403, 'Unauthorized access.');
            }
        }

        $validationRules = [
            'patient_id' => 'required|exists:patients,id',
            'consultation_date' => 'nullable|date',
            'chief_complaint' => 'required|string',
            'present_illness' => 'nullable|string',
            'past_medical_history' => 'nullable|string',
            'medications' => 'nullable|string',
            'allergies' => 'nullable|string',
        ];

        if ($isAdmin) {
            $validationRules['doctor_id'] = 'required|exists:users,id';
        }

        $request->validate($validationRules);

        $updateData = [
            'patient_id' => $request->patient_id,
            'consultation_date' => $request->consultation_date ?? now()->toDateString(),
            'chief_complaint' => $request->chief_complaint,
            'present_illness' => $request->present_illness,
            'past_medical_history' => $request->past_medical_history,
            'medications' => $request->medications,
            'allergies' => $request->allergies,
        ];

        if ($isAdmin) {
            $updateData['doctor_id'] = $request->doctor_id;
        } else {
            $updateData['doctor_id'] = $doctor->user_id;
        }

        $consultation->update($updateData);

        return redirect()->route('admin.consultations.index')->with('success', 'Consultation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        $user = auth()->user();

        // Admin users can delete any consultation
        $isAdmin = $user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.');

        if (!$isAdmin) {
            $doctor = $user->doctor;
            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Ensure the consultation belongs to the authenticated doctor
            if ($consultation->doctor_id !== $doctor->user_id) {
                abort(403, 'Unauthorized access.');
            }
        }

        $consultation->delete();

        return redirect()->route('admin.consultations.index')->with('success', 'Consultation deleted successfully.');
    }

    /**
     * Show physical examination form
     */
    public function physicalExam(Consultation $consultation)
    {
        $user = auth()->user();

        // Admin users can access any consultation
        $isAdmin = $user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.');

        if (!$isAdmin) {
            $doctor = $user->doctor;
            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Ensure the consultation belongs to the authenticated doctor
            if ($consultation->doctor_id !== $doctor->user_id) {
                abort(403, 'Unauthorized access.');
            }
        }

        return view('admin.consultations.physical-exam', compact('consultation'));
    }

    /**
     * Store physical examination
     */
    public function storePhysicalExam(Request $request, Consultation $consultation)
    {
        $user = auth()->user();

        // Admin users can update any consultation
        $isAdmin = $user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.');

        if (!$isAdmin) {
            $doctor = $user->doctor;
            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Ensure the consultation belongs to the authenticated doctor
            if ($consultation->doctor_id !== $doctor->user_id) {
                abort(403, 'Unauthorized access.');
            }
        }

        $request->validate([
            'blood_pressure' => 'required|string',
            'heart_rate' => 'required|string',
            'temperature' => 'required|string',
            'respiratory_rate' => 'required|string',
            'height' => 'nullable|string',
            'weight' => 'nullable|string',
            'bmi' => 'nullable|string',
            'general_appearance' => 'nullable|string',
            'head_neck' => 'nullable|string',
            'chest_lungs' => 'nullable|string',
            'cardiovascular' => 'nullable|string',
            'abdomen' => 'nullable|string',
            'extremities' => 'nullable|string',
            'neurological' => 'nullable|string',
        ]);

        $consultation->update([
            'vital_signs' => json_encode([
                'blood_pressure' => $request->blood_pressure,
                'heart_rate' => $request->heart_rate,
                'temperature' => $request->temperature,
                'respiratory_rate' => $request->respiratory_rate,
                'height' => $request->height,
                'weight' => $request->weight,
                'bmi' => $request->bmi,
            ]),
            'physical_examination' => json_encode([
                'general_appearance' => $request->general_appearance,
                'head_neck' => $request->head_neck,
                'chest_lungs' => $request->chest_lungs,
                'cardiovascular' => $request->cardiovascular,
                'abdomen' => $request->abdomen,
                'extremities' => $request->extremities,
                'neurological' => $request->neurological,
            ]),
        ]);

        return redirect()->route('doctor.consultations.show', $consultation)->with('success', 'Physical examination saved successfully.');
    }

    /**
     * Show diagnosis form
     */
    public function diagnosis(Consultation $consultation)
    {
        $user = auth()->user();

        // Admin users can access any consultation
        $isAdmin = $user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.');

        if (!$isAdmin) {
            $doctor = $user->doctor;
            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Ensure the consultation belongs to the authenticated doctor
            if ($consultation->doctor_id !== $doctor->user_id) {
                abort(403, 'Unauthorized access.');
            }
        }

        return view('admin.consultations.diagnosis', compact('consultation'));
    }

    /**
     * Store diagnosis
     */
    public function storeDiagnosis(Request $request, Consultation $consultation)
    {
        $user = auth()->user();

        // Admin users can update any consultation
        $isAdmin = $user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.');

        if (!$isAdmin) {
            $doctor = $user->doctor;
            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Ensure the consultation belongs to the authenticated doctor
            if ($consultation->doctor_id !== $doctor->user_id) {
                abort(403, 'Unauthorized access.');
            }
        }

        $request->validate([
            'diagnosis' => 'required|string',
            'treatment_plan' => 'required|string',
            'prescription' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $consultation->update([
            'diagnosis' => $request->diagnosis,
            'treatment_plan' => $request->treatment_plan,
            'prescription' => $request->prescription,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.consultations.show', $consultation)->with('success', 'Diagnosis saved successfully.');
    }

    /**
     * Complete consultation
     */
    public function complete(Consultation $consultation)
    {
        $user = auth()->user();

        // Admin users can complete any consultation
        $isAdmin = $user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.');

        if (!$isAdmin) {
            $doctor = $user->doctor;
            if (! $doctor) {
                return redirect()->route('admin.dashboard')->with('error', 'Doctor profile not found. Please contact administrator.');
            }

            // Ensure the consultation belongs to the authenticated doctor
            if ($consultation->doctor_id !== $doctor->user_id) {
                abort(403, 'Unauthorized access.');
            }
        }

        $consultation->update(['status' => 'completed']);

        return redirect()->route('admin.consultations.index')->with('success', 'Consultation marked as completed.');
    }

    /**
     * Fetch patient data for AJAX request
     */
    public function fetchPatientData(Request $request)
    {
        $user = auth()->user();

        // Admin users can fetch any patient
        if ($user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.')) {
            $patient = Patient::with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->find($request->patient_id);
        } else {
            $doctor = $user->doctor;

            if (! $doctor) {
                return response()->json(['error' => 'Doctor profile not found'], 403);
            }

            $patient = Patient::whereHas('appointments', function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->user_id);
            })->with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->find($request->patient_id);
        }

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        return response()->json(['success' => true, 'patient' => $patient]);
    }

    /**
     * Fetch patients with confirmed appointments for a specific date.
     */
    public function fetchPatientsByDate(Request $request)
    {
        $user = auth()->user();
        $date = $request->get('date', date('Y-m-d'));

        if (!$date) {
            return response()->json(['success' => false, 'message' => 'Date is required'], 400);
        }

        // Admin users can see all patients
        if ($user->role === 'admin' || $user->username === 'admin_doctor' || str_starts_with(request()->route()->getName(), 'admin.')) {
            $patients = Patient::whereHas('appointments', function ($query) use ($date) {
                $query->where('status', 'confirmed')
                      ->whereDate('appointment_date', $date);
            })->with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->get();
        } else {
            $doctor = $user->doctor;

            if (! $doctor) {
                return response()->json(['success' => false, 'message' => 'Doctor profile not found'], 403);
            }

            // Get patients who have confirmed appointments with this doctor on the selected date
            $patients = Patient::whereHas('appointments', function ($query) use ($doctor, $date) {
                $query->where('doctor_id', $doctor->user_id)
                      ->where('status', 'confirmed')
                      ->whereDate('appointment_date', $date);
            })->with('user')->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })->get();
        }

        // Format patients for the select dropdown
        $formattedPatients = $patients->filter(function ($patient) {
            return isset($patient->user) && $patient->user;
        })->map(function ($patient) {
            $user = $patient->user;
            return [
                'id' => $patient->id,
                'text' => ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') . ' - ' . ($user->email ?? 'No Email'),
                'first_name' => $user->first_name ?? '',
                'last_name' => $user->last_name ?? '',
                'email' => $user->email ?? 'No Email',
            ];
        })->values();

        return response()->json(['success' => true, 'patients' => $formattedPatients]);
    }
}
