<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * Display the invoice creation form
     */
    public function create(): View
    {
        return view('invoices.create');
    }

    /**
     * Store a new invoice
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'invoice_no' => 'required|string|max:255|unique:invoices',
            'date_issued' => 'required|date',
            'article' => 'required|string|max:255',
            'unit_cost' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'medication_fee' => 'nullable|numeric|min:0',
            'other_fees' => 'nullable|numeric|min:0',
            'total_sales' => 'required|numeric|min:0',
            'less_sc' => 'nullable|numeric|min:0',
            'net_of_sc' => 'nullable|numeric|min:0',
            'withholding' => 'nullable|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
            'status' => 'nullable|in:paid,unpaid,pending',
        ]);

        $invoice = Invoice::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Invoice created successfully',
            'invoice' => $invoice,
        ]);
    }

    /**
     * Display the specified invoice
     */
    public function show(string $id): View
    {
        $invoice = Invoice::with(['patient.user', 'appointment'])->findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Display the invoice edit form
     */
    public function edit(string $id): View
    {
        $invoice = Invoice::with(['patient.user', 'appointment'])->findOrFail($id);

        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified invoice
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $invoice = Invoice::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'invoice_no' => 'required|string|max:255|unique:invoices,invoice_no,' . $id,
            'date_issued' => 'required|date',
            'article' => 'required|string|max:255',
            'unit_cost' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'medication_fee' => 'nullable|numeric|min:0',
            'other_fees' => 'nullable|numeric|min:0',
            'total_sales' => 'required|numeric|min:0',
            'less_sc' => 'nullable|numeric|min:0',
            'net_of_sc' => 'nullable|numeric|min:0',
            'withholding' => 'nullable|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
            'status' => 'nullable|in:paid,unpaid,pending',
        ]);

        $invoice->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Invoice updated successfully',
            'invoice' => $invoice->fresh(),
        ]);
    }

    /**
     * Remove the specified invoice
     */
    public function destroy(string $id): JsonResponse
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json([
            'success' => true,
            'message' => 'Invoice deleted successfully',
        ]);
    }

    /**
     * Generate PDF for the invoice
     */
    public function generatePdf(string $id): JsonResponse
    {
        $invoice = Invoice::findOrFail($id);

        // Here you would typically generate PDF using a library like DomPDF or TCPDF
        // For now, we'll just return success with the invoice data

        return response()->json([
            'success' => true,
            'message' => 'PDF generated successfully',
            'downloadUrl' => '/invoices/'.$id.'/download-pdf',
            'invoice' => $invoice,
        ]);
    }

    /**
     * Download the generated PDF
     */
    public function downloadPdf(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        // Here you would typically return the PDF file using response()->download()
        // For now, we'll just return a JSON response indicating the functionality

        return response()->json([
            'success' => true,
            'message' => 'PDF download would be implemented here',
            'invoice_id' => $id,
        ]);
    }
}
