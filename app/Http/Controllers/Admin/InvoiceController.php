<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['patient', 'appointment'])->paginate(10);

        return view('admin.invoice.index', compact('invoices'));
    }

    public function create()
    {
        // Working hours: 9:00 AM to 5:00 PM (09:00:00 to 17:00:00)
        $workingHoursStart = '09:00:00';
        $workingHoursEnd = '17:00:00';

        // Get patients who have appointments within working hours
        $patients = Patient::whereHas('appointments', function ($query) use ($workingHoursStart, $workingHoursEnd) {
            $query->whereTime('appointment_time', '>=', $workingHoursStart)
                  ->whereTime('appointment_time', '<=', $workingHoursEnd)
                  ->whereIn('status', ['confirmed', 'completed']);
        })->with('user')->get();

        // Get appointments within working hours
        $appointments = Appointment::with('patient')
            ->whereTime('appointment_time', '>=', $workingHoursStart)
            ->whereTime('appointment_time', '<=', $workingHoursEnd)
            ->whereIn('status', ['confirmed', 'completed'])
            ->get();

        // Get default doctor (Dr. Augustus Caesar Butch B. Bigornia)
        $defaultDoctor = Doctor::whereHas('user', function ($query) {
            $query->where('first_name', 'Augustus Caesar Butch B.')
                  ->where('last_name', 'Bigornia');
        })->with('user')->first();

        // Fallback to any active doctor if default not found
        if (!$defaultDoctor) {
            $defaultDoctor = Doctor::with('user')->where('status', 'active')->first();
        }

        return view('admin.invoice.create', compact('patients', 'appointments', 'defaultDoctor'));
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

        // Generate invoice number
        $year = date('Y');
        $lastInvoice = Invoice::where('invoice_no', 'like', "INV-{$year}-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastInvoice) {
            $lastNumber = intval(substr($lastInvoice->invoice_no, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $invoiceNo = sprintf('INV-%s-%04d', $year, $newNumber);

        Invoice::create([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'invoice_no' => $invoiceNo,
            'date_issued' => now()->toDateString(),
            'invoice_type' => 'medical_service',
            'article' => 'Medical Services',
            'unit_cost' => $total_sales,
            'quantity' => 1,
            'amount' => $total_amount,
            'consultation_fee' => $request->consultation_fee,
            'medication_fee' => $request->medication_fee ?? 0,
            'laboratory_fee' => $request->laboratory_fee ?? 0,
            'other_fees' => $request->other_fees ?? 0,
            'total_sales' => $total_sales,
            'less_sc' => $discount,
            'net_of_sc' => $net_of_sc,
            'withholding' => 0,
            'grand_total' => $total_amount,
            'status' => $request->status,
            'payment_date' => $request->payment_date,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice created successfully.');
    }

    public function generatePdf(Request $request, $id)
    {
        $invoice = Invoice::with(['patient', 'appointment'])->findOrFail($id);

        // Use the stored invoice number
        $invoiceNumber = $invoice->invoice_no ?? 'INV-'.str_pad($invoice->id, 6, '0', STR_PAD_LEFT);

        $pdf = Pdf::loadView('admin.invoice.invoice-pdf', [
            'invoice' => $invoice,
            'invoiceNumber' => $invoiceNumber,
            'date' => now()->format('M d, Y'),
        ]);

        // Set page size for half letter bond paper (8.5" x 6.5")
        $pdf->setPaper([0, 0, 612, 468], 'portrait'); // 612 x 468 points = 8.5" x 6.5"

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

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice marked as paid successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice deleted successfully.');
    }
}
