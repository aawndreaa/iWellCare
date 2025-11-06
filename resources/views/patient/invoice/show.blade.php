@extends('layouts.patient')

@section('title', 'Invoice Details - iWellCare')
@section('page-title', 'Invoice Details')
@section('page-subtitle', 'View detailed invoice information')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-blue-50/30 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('patient.invoice.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fas fa-arrow-left mr-2"></i>Back to Invoices
            </a>
        </div>

        <!-- Invoice Preview Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-xl p-6 mb-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-file-invoice-dollar text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Invoice #{{ $invoice->invoice_no ?? 'N/A' }}</h3>
                    <p class="text-gray-600 text-sm mt-1">Issued: {{ $invoice->date_issued ? $invoice->date_issued->format('M d, Y') : 'N/A' }}</p>
                </div>
                <div class="ml-auto text-right">
                    <div class="text-3xl font-bold text-blue-600">₱{{ number_format($invoice->grand_total ?? $invoice->amount ?? 0, 2) }}</div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold mt-2
                        @if($invoice->status === 'paid') bg-green-100 text-green-700 border border-green-200
                        @elseif($invoice->status === 'unpaid') bg-red-100 text-red-700 border border-red-200
                        @else bg-yellow-100 text-yellow-700 border border-yellow-200 @endif">
                        {{ ucfirst($invoice->status ?? 'pending') }}
                    </span>
                </div>
            </div>

            <!-- Invoice Preview -->
            <div class="bg-white rounded-lg p-4 border-2 border-gray-200 shadow-inner">
                <div class="text-center mb-4" style="font-family: Arial, sans-serif; font-size: 11px; line-height: 1.2;">
                    <h5 style="font-size: 13px; margin: 0; font-weight: bold;">ADULT WELLNESS CLINIC & MEDICAL LABORATORY</h5>
                    <p style="margin: 2px 0; font-size: 10px;">40 Capitulacion St., Zone 2, Pob. (Consillman), 2800 Bangued (Capital), Abra</p>
                    <p style="margin: 2px 0; font-size: 10px;">AUGUSTUS CAESAR BUTCH B. BIGORNIA - Prop. | Non-VAT Reg. TIN: 248-390-356-00000</p>
                    <h6 style="margin: 4px 0; font-size: 12px; text-decoration: underline; font-weight: bold;">SERVICE INVOICE</h6>
                    <p style="margin: 2px 0;">
                        <strong>No.</strong> {{ $invoice->invoice_no ?? 'N/A' }} &nbsp;&nbsp;&nbsp; 
                        <strong>Date:</strong> {{ $invoice->date_issued ? $invoice->date_issued->format('M d, Y') : date('M d, Y') }}
                    </p>
                </div>

                <table style="width: 100%; font-size: 11px; margin-bottom: 5px;">
                    <tr>
                        <td style="padding: 2px 4px;">
                            <strong>Sold To:</strong> 
                            @if($invoice->patient && $invoice->patient->user)
                                {{ $invoice->patient->user->first_name ?? '' }} {{ $invoice->patient->user->last_name ?? '' }}
                            @elseif($invoice->patient)
                                {{ $invoice->patient->first_name ?? '' }} {{ $invoice->patient->last_name ?? '' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="padding: 2px 4px;"><strong>TIN:</strong> <span></span></td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 4px;">
                            <strong>Address:</strong> 
                            @if($invoice->patient && $invoice->patient->user)
                                {{ $invoice->patient->user->street_address ?? '' }}, {{ $invoice->patient->user->city ?? '' }}
                            @elseif($invoice->patient)
                                {{ $invoice->patient->address ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="padding: 2px 4px;"><strong>ID No.:</strong> {{ $invoice->patient->patient_id ?? 'N/A' }}</td>
                    </tr>
                </table>

                <table style="width: 100%; border-collapse: collapse; margin-top: 4px; font-size: 11px;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #000; padding: 4px; background-color: #f2f2f2; width: 10%;">Qty</th>
                            <th style="border: 1px solid #000; padding: 4px; background-color: #f2f2f2; width: 50%;">Articles</th>
                            <th style="border: 1px solid #000; padding: 4px; background-color: #f2f2f2; width: 20%;">Unit Cost</th>
                            <th style="border: 1px solid #000; padding: 4px; background-color: #f2f2f2; width: 20%;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #000; padding: 4px;">1</td>
                            <td style="border: 1px solid #000; padding: 4px;">Consultation Fee</td>
                            <td style="border: 1px solid #000; padding: 4px;">₱{{ number_format($invoice->consultation_fee ?? 0, 2) }}</td>
                            <td style="border: 1px solid #000; padding: 4px;">₱{{ number_format($invoice->consultation_fee ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 4px;">1</td>
                            <td style="border: 1px solid #000; padding: 4px;">Medication Fee</td>
                            <td style="border: 1px solid #000; padding: 4px;">₱{{ number_format($invoice->medication_fee ?? 0, 2) }}</td>
                            <td style="border: 1px solid #000; padding: 4px;">₱{{ number_format($invoice->medication_fee ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 4px;">1</td>
                            <td style="border: 1px solid #000; padding: 4px;">Laboratory Fee</td>
                            <td style="border: 1px solid #000; padding: 4px;">₱{{ number_format($invoice->laboratory_fee ?? 0, 2) }}</td>
                            <td style="border: 1px solid #000; padding: 4px;">₱{{ number_format($invoice->laboratory_fee ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 4px;">1</td>
                            <td style="border: 1px solid #000; padding: 4px;">Other Fees</td>
                            <td style="border: 1px solid #000; padding: 4px;">₱{{ number_format($invoice->other_fees ?? 0, 2) }}</td>
                            <td style="border: 1px solid #000; padding: 4px;">₱{{ number_format($invoice->other_fees ?? 0, 2) }}</td>
                        </tr>
                    </tbody>
                </table>

                @php
                    // Calculate total sales from all fees
                    $consultationFee = $invoice->consultation_fee ?? 0;
                    $medicationFee = $invoice->medication_fee ?? 0;
                    $laboratoryFee = $invoice->laboratory_fee ?? 0;
                    $otherFees = $invoice->other_fees ?? 0;
                    $totalSales = $consultationFee + $medicationFee + $laboratoryFee + $otherFees;
                    
                    // If total_sales is stored, use it (more accurate)
                    if ($invoice->total_sales && $invoice->total_sales > 0) {
                        $totalSales = $invoice->total_sales;
                    }
                    
                    $discount = $invoice->less_sc ?? 0;
                    $totalDue = $totalSales - $discount;
                    $withholding = $invoice->withholding ?? 0;
                    $totalAmountDue = ($invoice->grand_total ?? $invoice->amount ?? $totalDue) - $withholding;
                @endphp

                <table style="width: 45%; float: right; margin-top: 5px; font-size: 11px;">
                    <tr><td>Total Sales</td><td style="text-align: right;">₱{{ number_format($totalSales, 2) }}</td></tr>
                    <tr><td>Less: SC/PWD/NAAC/SP Disc.</td><td style="text-align: right;">₱{{ number_format($discount, 2) }}</td></tr>
                    <tr><td><strong>Total Due</strong></td><td style="text-align: right;"><strong>₱{{ number_format($totalDue, 2) }}</strong></td></tr>
                    <tr><td>Less: Withholding</td><td style="text-align: right;">₱{{ number_format($withholding, 2) }}</td></tr>
                    <tr><td><strong>Total Amount Due</strong></td><td style="text-align: right;"><strong>₱{{ number_format($totalAmountDue, 2) }}</strong></td></tr>
                </table>

                <div style="clear: both;"></div>

                <div style="font-size: 11px; margin-top: 6px;">
                    <strong>Payment Method:</strong><br>
                    <input type="checkbox" {{ $invoice->payment_method === 'cash' || $invoice->status === 'paid' ? 'checked' : '' }} disabled> Cash
                    <input type="checkbox" {{ $invoice->payment_method === 'check' ? 'checked' : '' }} disabled> Check
                    <input type="checkbox" {{ $invoice->payment_method === 'credit' || ($invoice->status === 'unpaid' && !$invoice->payment_method) ? 'checked' : '' }} disabled> Credit
                </div>

                <div style="text-align: right; margin-top: 15px; font-size: 10px;">
                    _______________________________<br>
                    <em>
                        @if($invoice->createdBy)
                            @if($invoice->createdBy->role === 'doctor')
                                Dr. {{ $invoice->createdBy->first_name ?? '' }} {{ $invoice->createdBy->last_name ?? '' }}
                            @else
                                {{ $invoice->createdBy->first_name ?? '' }} {{ $invoice->createdBy->last_name ?? '' }}
                            @endif
                        @else
                            Dr. Augustus Caesar Butch B. Bigornia
                        @endif
                    </em><br>
                    <em>Cashier / Authorized Representative</em>
                </div>

                <div style="font-size: 9px; margin-top: 8px;">
                    <p>Sale(s) Subject to PT. Exempt Sales<br>
                    OCN: 007AU20240000001188 | DATE OF ATP: May 14, 2024</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-end gap-4">
            @if($invoice->status === 'unpaid')
            <a href="{{ route('patient.invoice.download', $invoice) }}" class="inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fas fa-download mr-2"></i>Download Invoice
            </a>
            <button class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <i class="fas fa-credit-card mr-2"></i>Pay Now
            </button>
            @else
            <a href="{{ route('patient.invoice.download', $invoice) }}" class="inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fas fa-download mr-2"></i>Download Receipt
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
