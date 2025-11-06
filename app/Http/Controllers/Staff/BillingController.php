<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['patient', 'appointment'])
            ->where('is_archived', false)
            ->paginate(10);

        return view('staff.invoice.index', compact('invoices'));
    }

    public function create()
    {
        $patients = Patient::all();
        $appointments = Appointment::with('patient')->get();

        return view('staff.invoice.create', compact('patients', 'appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'consultation_fee' => 'required|numeric|min:0',
            'medication_fee' => 'nullable|numeric|min:0',
            'laboratory_fee' => 'nullable|numeric|min:0',
            'other_fees' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'less_sc' => 'nullable|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
            'payment_date' => 'required|date',
        ]);

        // Calculate total sales
        $total_sales = $request->consultation_fee +
                      ($request->medication_fee ?? 0) +
                      ($request->laboratory_fee ?? 0) +
                      ($request->other_fees ?? 0);

        // Calculate discount amount from percentage
        $discount_percentage = $request->discount_percentage ?? 0;
        $discount = $total_sales * ($discount_percentage / 100);
        
        // Use manually entered discount amount if provided (for backward compatibility)
        if ($request->has('less_sc') && $request->less_sc > 0) {
            $discount = $request->less_sc;
        }

        // Calculate net of discount
        $net_of_sc = $total_sales - $discount;

        // Calculate total amount (grand total)
        $total_amount = $net_of_sc;

        // Generate invoice number (yearly sequence: INV-YYYY-XXXX)
        $year = now()->format('Y');
        $lastInvoice = Invoice::where('invoice_no', 'like', "INV-{$year}-%")
            ->orderBy('invoice_no', 'desc')
            ->first();
        if ($lastInvoice && isset($lastInvoice->invoice_no)) {
            $lastNumber = intval(substr($lastInvoice->invoice_no, -4));
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }
        $invoiceNo = "INV-{$year}-{$nextNumber}";

        Invoice::create([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'invoice_no' => $invoiceNo,
            'date_issued' => now()->toDateString(),
            'invoice_type' => 'medical_service',
            'article' => 'Medical services (consultation/medication/lab/other)',
            'unit_cost' => $total_amount,
            'quantity' => 1,
            'consultation_fee' => $request->consultation_fee,
            'medication_fee' => $request->medication_fee ?? 0,
            'laboratory_fee' => $request->laboratory_fee ?? 0,
            'other_fees' => $request->other_fees ?? 0,
            // sales summary
            'total_sales' => $total_sales,
            'less_sc' => $discount,
            'net_of_sc' => $net_of_sc,
            'withholding' => 0,
            'total_amount' => $total_amount,
            'amount' => $total_amount, // Keep for backward compatibility
            'grand_total' => $total_amount,
            'status' => $request->status,
            'payment_date' => $request->payment_date,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('staff.billing.index')->with('success', 'Invoice created successfully.');
    }

    public function generatePdf(Request $request, $id)
    {
        $invoice = Invoice::with(['patient', 'appointment'])->findOrFail($id);

        // Generate invoice number (you can customize this logic)
        $invoiceNumber = 'INV-'.str_pad($invoice->id, 6, '0', STR_PAD_LEFT);

        $pdf = Pdf::loadView('staff.invoice.invoice-pdf', [
            'billing' => $invoice,
            'invoiceNumber' => $invoiceNumber,
            'date' => now()->format('M d, Y'),
        ]);

        // Set page size to 1/4 of letter size (4.25" x 5.5")
        $pdf->setPaper([0, 0, 306, 396], 'portrait'); // 306 x 396 points = 4.25" x 5.5"

        // Set PDF options for better character encoding
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);

        // If called with stream/print/preview flag, open in browser for printing
        if ($request->has('stream') || $request->has('print') || $request->has('preview')) {
            return $pdf->stream('invoice-'.$invoiceNumber.'.pdf');
        }

        return $pdf->download('invoice-'.$invoiceNumber.'.pdf');
    }

    public function markAsPaid($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update([
            'status' => 'paid',
            'payment_date' => now(),
        ]);

        return redirect()->route('staff.billing.index')->with('success', 'Invoice marked as paid successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update(['is_archived' => true]);

        return redirect()->route('staff.billing.index')->with('success', 'Invoice archived successfully.');
    }
}
