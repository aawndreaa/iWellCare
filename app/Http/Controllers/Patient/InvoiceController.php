<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
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

        $invoices = Invoice::where('patient_id', $patient->id)
            ->with(['appointment', 'patient'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('patient.invoice.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            abort(403, 'Patient record not found.');
        }

        // Ensure the invoice belongs to the authenticated patient
        if ($invoice->patient_id !== $patient->id) {
            abort(403, 'Unauthorized access.');
        }

        // Load relationships
        $invoice->load(['patient.user', 'appointment', 'createdBy']);

        return view('patient.invoice.show', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            abort(403, 'Patient record not found.');
        }

        // Ensure the invoice belongs to the authenticated patient
        if ($invoice->patient_id !== $patient->id) {
            abort(403, 'Unauthorized access.');
        }

        // Prepare clinic details (to mirror printed invoice format)
        $invoiceNumber = 'INV-'.str_pad($invoice->id, 6, '0', STR_PAD_LEFT);
        $viewData = [
            'billing' => $invoice->load(['patient', 'appointment']),
            'invoiceNumber' => $invoiceNumber,
            'clinicName' => 'ADULT WELLNESS CLINIC & MEDICAL LABORATORY',
            'clinicAddress' => '40 Capitulacion St., Zone 2, Pab. (Consiliman), 2800 Bangued (Capital), Abra, Philippines',
            'proprietor' => 'AUGUSTUS CAESAR BUTCH B. BIGORNIA - Prop.',
            'tin' => '248-390-356-00000',
            'date' => now()->format('M d, Y'),
        ];

        // Generate PDF using the same layout as staff invoice
        $pdf = Pdf::loadView('staff.invoice.invoice-pdf', $viewData);

        // Download the PDF with a filename
        return $pdf->download('invoice-'.$invoiceNumber.'.pdf');
    }
}
