<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Prescription;

class PrescriptionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            // If patient record doesn't exist, create it
            $patient = \App\Models\Patient::create([
                'user_id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'contact' => $user->phone_number,
                'email' => $user->email,
                'address' => $user->street_address,
                'date_of_birth' => $user->date_of_birth ?? '1990-01-01',
                'gender' => $user->gender ?? 'other',
                'blood_type' => 'O+',
                'emergency_contact' => 'Emergency Contact',
                'emergency_contact_phone' => $user->phone_number,
                'medical_history' => 'No significant medical history',
                'allergies' => 'None known',
                'current_medications' => 'None',
                'insurance_provider' => 'Health Insurance Co.',
                'insurance_number' => 'INS'.rand(100000000, 999999999),
                'is_active' => true,
            ]);
        }

        $prescriptions = Prescription::where('patient_id', $patient->id)
            ->with(['doctor', 'medications'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('patient.prescriptions.index', compact('prescriptions'));
    }

    public function show(Prescription $prescription)
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            abort(403, 'Patient record not found.');
        }

        // Ensure the prescription belongs to the authenticated patient
        if ($prescription->patient_id !== $patient->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('patient.prescriptions.show', compact('prescription'));
    }
}
