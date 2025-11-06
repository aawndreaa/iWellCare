<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of patients.
     */
    public function index()
    {
        $query = Patient::with(['user', 'appointments']);

        // Apply filters
        if (request('filter') === 'archived') {
            $query->onlyTrashed(); // Show archived patients
        }

        // Apply search filter
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('contact', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('first_name', 'like', '%' . $search . '%')
                               ->orWhere('last_name', 'like', '%' . $search . '%')
                               ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Apply status filter
        if (request('status')) {
            if (request('status') === 'active') {
                $query->where('is_active', true);
            } elseif (request('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Apply gender filter
        if (request('gender')) {
            $query->where('gender', request('gender'));
        }

        // Apply age group filter
        if (request('age_group')) {
            switch (request('age_group')) {
                case 'child':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 0 AND 12');
                    break;
                case 'teen':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 13 AND 19');
                    break;
                case 'adult':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN 20 AND 64');
                    break;
                case 'senior':
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 65');
                    break;
            }
        }

        $patients = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get archived count for display
        $archivedCount = Patient::onlyTrashed()->count();

        // Get statistics for admin dashboard
        $activeCount = Patient::where('is_active', true)->count();
        $newThisMonth = Patient::where('created_at', '>=', now()->startOfMonth())->count();
        $recentAppointments = \App\Models\Appointment::where('created_at', '>=', now()->subDays(7))->count();

        // Return admin view if route starts with admin
        $viewName = request()->routeIs('admin.*') ? 'admin.patients.index' : 'doctor.patients.index';
        return view($viewName, compact('patients', 'archivedCount', 'activeCount', 'newThisMonth', 'recentAppointments'));
    }

    /**
     * Display the specified patient.
     */
    public function show(Patient $patient)
    {
        $patient->load(['user', 'appointments.doctor', 'consultations.doctor']);

        return view('doctor.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified patient.
     */
    public function edit(Patient $patient)
    {
        return view('doctor.patients.edit', compact('patient'));
    }

    /**
     * Update the specified patient in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string|max:500',
        ]);

        // Update patient information directly
        $patient->update([
            'full_name' => $request->full_name,
            'first_name' => $request->first_name ?: explode(' ', $request->full_name)[0] ?? '',
            'last_name' => $request->last_name ?: (explode(' ', $request->full_name)[1] ?? ''),
            'email' => $request->email,
            'contact' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        // If patient has a user relationship, update it too
        if ($patient->user) {
            $patient->user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }

        return redirect()->route('doctor.patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    /**
     * Archive the specified patient.
     */
    public function destroy(Patient $patient)
    {
        try {
            // Start transaction
            \DB::beginTransaction();

            // Archive patient record (soft delete)
            $patient->delete();

            // Archive user account if it exists
            if ($patient->user) {
                $patient->user->delete();
            }

            // Commit transaction
            \DB::commit();

            // Log the archiving
            \Log::info('Patient archived', [
                'patient_id' => $patient->id,
                'patient_name' => $patient->full_name,
                'archived_by' => auth()->user()->full_name,
                'archived_at' => now(),
            ]);

            // Return JSON for AJAX, redirect for browser
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Patient archived successfully',
                ]);
            }

            $redirectRoute = request()->routeIs('admin.*') ? 'admin.patients.index' : 'doctor.patients.index';
            return redirect()->route($redirectRoute)->with('success', 'Patient archived successfully.');

        } catch (\Exception $e) {
            // Rollback transaction on error
            \DB::rollback();

            \Log::error('Error archiving patient', [
                'patient_id' => $patient->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error archiving patient: '.$e->getMessage(),
                ], 500);
            }

            $redirectRoute = request()->routeIs('admin.*') ? 'admin.patients.index' : 'doctor.patients.index';
            return redirect()->route($redirectRoute)->with('error', 'Error archiving patient: '.$e->getMessage());
        }
    }

    /**
     * Show patient history.
     */
    public function history(Patient $patient)
    {
        $patient->load([
            'appointments.doctor',
            'consultations.doctor',
            'prescriptions.doctor',
            'medicalRecords.doctor',
        ]);

        return view('doctor.patients.history', compact('patient'));
    }

    /**
     * Restore a soft deleted patient.
     */
    public function restore($id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);
        $patient->restore();

        // Restore user account if it exists
        if ($patient->user) {
            $patient->user->restore();
        }

        return redirect()->route('doctor.patients.index', ['filter' => 'archived'])
            ->with('success', 'Patient restored successfully.');
    }
}
