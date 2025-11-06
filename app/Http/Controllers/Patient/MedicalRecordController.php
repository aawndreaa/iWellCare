<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;

class MedicalRecordController extends Controller
{
    public function index()
    {
        // Restrict access to patients only for their own medical records
        if (auth()->user()->role !== 'patient') {
            abort(403, 'Access denied. Medical records are restricted to patients only.');
        }

        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            // If patient record doesn't exist, create it
            $patient = Patient::create([
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

        $medicalRecords = MedicalRecord::where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('patient.medical-records.index', compact('medicalRecords'));
    }

    public function show(MedicalRecord $record)
    {
        // Restrict access to patients only for their own medical records
        if (auth()->user()->role !== 'patient') {
            abort(403, 'Access denied. Medical records are restricted to patients only.');
        }

        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            abort(403, 'Patient record not found.');
        }

        // Ensure the record belongs to the authenticated patient
        if ($record->patient_id !== $patient->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('patient.medical-records.show', compact('record'));
    }
}
