<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Service Invoice</title>
    <style>
        @page {
            size: 8.5in 5.5in;
            margin: 0;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 6px;
            line-height: 1.0;
            margin: 0;
            padding: 0.15in;
            width: 8.5in;
            height: 5.5in;
            page-break-inside: avoid;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .clinic-info {
            width: 65%;
        }
        .clinic-name {
            font-size: 8px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .clinic-address {
            font-size: 6px;
            margin-bottom: 2px;
            line-height: 1.1;
        }
        .proprietor {
            font-size: 6px;
            margin-bottom: 2px;
        }
        .tin-info {
            font-size: 6px;
            margin-bottom: 2px;
        }
        .invoice-details {
            width: 32%;
            text-align: right;
        }
        .invoice-title {
            font-size: 8px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .invoice-number {
            font-size: 7px;
            font-weight: bold;
            color: #d32f2f;
            margin-bottom: 2px;
        }
        .field-row {
            display: flex;
            margin-bottom: 2px;
        }
        .field-label {
            width: 55px;
            font-weight: bold;
            font-size: 6px;
        }
        .field-value {
            flex: 1;
            border-bottom: 1px solid #000;
            min-height: 5px;
            font-size: 6px;
            padding: 1px 0;
        }
        .customer-section {
            margin-bottom: 3px;
        }
        .customer-title {
            font-weight: bold;
            margin-bottom: 2px;
            font-size: 7px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
            table-layout: fixed;
        }
        .items-table th {
            border: 1px solid #000;
            padding: 2px;
            text-align: center;
            font-weight: bold;
            background-color: #f5f5f5;
            font-size: 6px;
            word-wrap: break-word;
        }
        .items-table td {
            border: 1px solid #000;
            padding: 2px;
            text-align: center;
            height: 8px;
            font-size: 6px;
            word-wrap: break-word;
            overflow: hidden;
        }
        .qty-col { width: 15%; }
        .articles-col { width: 40%; }
        .unit-col { width: 22%; }
        .amount-col { width: 23%; }
        .footer-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        .payment-methods {
            width: 48%;
        }
        .payment-title {
            font-weight: bold;
            margin-bottom: 2px;
            font-size: 7px;
        }
        .checkbox-item {
            margin-bottom: 2px;
            font-size: 6px;
        }
        .checkbox-item input[type="checkbox"] {
            margin-right: 2px;
            transform: scale(0.8);
        }
        .check-details {
            margin-top: 2px;
        }
        .check-row {
            display: flex;
            margin-bottom: 2px;
        }
        .check-label {
            width: 55px;
            font-size: 6px;
        }
        .check-value {
            flex: 1;
            border-bottom: 1px solid #000;
            min-height: 4px;
            font-size: 6px;
            padding: 1px 0;
        }
        .summary-section {
            width: 48%;
        }
        .summary-title {
            font-weight: bold;
            margin-bottom: 2px;
            font-size: 7px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .summary-label {
            font-weight: bold;
            font-size: 6px;
        }
        .summary-value {
            border-bottom: 1px solid #000;
            min-width: 50px;
            text-align: right;
            font-size: 6px;
            padding: 1px 0;
        }
        .total-row {
            font-weight: bold;
            font-size: 8px;
        }
        .signature-section {
            margin-top: 3px;
            text-align: center;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            width: 80px;
            margin: 0 auto 2px;
        }
        .tax-info {
            margin-top: 2px;
            text-align: center;
            font-size: 5px;
        }
        .printer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
            font-size: 3px;
            table-layout: fixed;
        }
        .printer-table th,
        .printer-table td {
            border: 1px solid #000;
            padding: 1px;
            text-align: center;
            word-wrap: break-word;
        }
        .printer-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        /* Ensure content fits on one page */
        body {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="clinic-info">
            <div class="clinic-name">ADULT WELLNESS CLINIC & MEDICAL LABORATORY</div>
            <div class="clinic-address">40 Capitulacion St., Zone 2, Pob. (Consiliman), 2500 Bangued (Capital), Abra, Philippines</div>
            <div class="proprietor">AUGUSTUS CAESAR BUTCH B. BIGORNIA - Prop.</div>
            <div class="tin-info">Non-VAT Reg. TIN: 248-390-356-00000</div>
        </div>
        <div class="invoice-details">
            <div class="invoice-title">SERVICE INVOICE</div>
            <div class="invoice-number">No. {{ $invoiceNumber ?? $invoice->id }}</div>
            <div class="field-row">
                <div class="field-label">DATE:</div>
                <div class="field-value">{{ $date }}</div>
            </div>
        </div>
    </div>

    <!-- Customer Information -->
    <div class="customer-section">
        <div class="customer-title">SOLD TO:</div>
        <div class="field-row">
            <div class="field-label">NAME:</div>
            <div class="field-value">{{ $invoice->patient->first_name }} {{ $invoice->patient->last_name }}</div>
        </div>
        <div class="customer-title">ADDRESS:</div>
        <div class="field-row">
            <div class="field-label"></div>
            <div class="field-value">{{ $invoice->patient->address ?? 'N/A' }}</div>
        </div>
        <div class="customer-title">TIN:</div>
        <div class="field-row">
            <div class="field-label"></div>
            <div class="field-value"></div>
        </div>
        <div class="customer-title">SC/PWD/PNSTM/Solo Parent ID No.:</div>
        <div class="field-row">
            <div class="field-label"></div>
            <div class="field-value"></div>
        </div>
        <div class="customer-title">SIGNATURE:</div>
        <div class="field-row">
            <div class="field-label"></div>
            <div class="field-value"></div>
        </div>
    </div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th class="qty-col">QTY</th>
                <th class="articles-col">ARTICLES</th>
                <th class="unit-col">UNIT COST</th>
                <th class="amount-col">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
                $items = [];

                // Add consultation fee if exists
                if ($invoice->consultation_fee > 0) {
                    $items[] = [
                        'qty' => 1,
                        'description' => 'Medical Consultation',
                        'unit_cost' => $invoice->consultation_fee,
                        'amount' => $invoice->consultation_fee
                    ];
                    $totalAmount += $invoice->consultation_fee;
                }

                // Add medication fee if exists
                if ($invoice->medication_fee > 0) {
                    $items[] = [
                        'qty' => 1,
                        'description' => 'Medication',
                        'unit_cost' => $invoice->medication_fee,
                        'amount' => $invoice->medication_fee
                    ];
                    $totalAmount += $invoice->medication_fee;
                }

                // Add laboratory fee if exists
                if ($invoice->laboratory_fee > 0) {
                    $items[] = [
                        'qty' => 1,
                        'description' => 'Laboratory Test',
                        'unit_cost' => $invoice->laboratory_fee,
                        'amount' => $invoice->laboratory_fee
                    ];
                    $totalAmount += $invoice->laboratory_fee;
                }

                // Add other fees if exists
                if ($invoice->other_fees > 0) {
                    $items[] = [
                        'qty' => 1,
                        'description' => 'Other Services',
                        'unit_cost' => $invoice->other_fees,
                        'amount' => $invoice->other_fees
                    ];
                    $totalAmount += $invoice->other_fees;
                }

                // If no specific fees, use the total amount
                if (empty($items)) {
                    $items[] = [
                        'qty' => 1,
                        'description' => 'Medical Service',
                        'unit_cost' => $invoice->amount,
                        'amount' => $invoice->amount
                    ];
                    $totalAmount = $invoice->amount;
                }
            @endphp

            @foreach($items as $item)
            <tr>
                <td>{{ $item['qty'] }}</td>
                <td style="text-align: left; padding-left: 3px;">{{ $item['description'] }}</td>
                <td>₱{{ number_format($item['unit_cost'], 2) }}</td>
                <td>₱{{ number_format($item['amount'], 2) }}</td>
            </tr>
            @endforeach

            @for($i = count($items); $i < 8; $i++)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endfor
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer-section">
        <div class="payment-methods">
            <div class="payment-title">Cash Check Credit</div>
            <div class="checkbox-item">
                <input type="checkbox" {{ $invoice->status === 'paid' ? 'checked' : '' }}> Cash
            </div>
            <div class="checkbox-item">
                <input type="checkbox"> Check
            </div>
            <div class="checkbox-item">
                <input type="checkbox"> Credit
            </div>
            <div class="check-details">
                <div class="check-row">
                    <div class="check-label">BANK:</div>
                    <div class="check-value">_________</div>
                </div>
                <div class="check-row">
                    <div class="check-label">Check No.:</div>
                    <div class="check-value">_________</div>
                </div>
                <div class="check-row">
                    <div class="check-label">Date:</div>
                    <div class="check-value">_________</div>
                </div>
            </div>
        </div>
        <div class="summary-section">
            <div class="summary-row">
                <div class="summary-label">TOTAL SALES</div>
                <div class="summary-value">₱{{ number_format($totalAmount, 2) }}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">LESS: SC/PWD/NAAC/SP DISC.</div>
                <div class="summary-value">₱0.00</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">TOTAL DUE:</div>
                <div class="summary-value">₱{{ number_format($totalAmount, 2) }}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">LESS: WITHHOLDING</div>
                <div class="summary-value">₱0.00</div>
            </div>
            <div class="summary-row total-row">
                <div class="summary-label">TOTAL AMOUNT DUE :</div>
                <div class="summary-value">₱{{ number_format($totalAmount, 2) }}</div>
            </div>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-line">____________________</div>
        <div>Cashier/Authorize Representative</div>
    </div>

    <!-- Tax Information -->
    <div class="tax-info">
        SALE/S SUBJ. TO PT. EXEMPT SALES
    </div>

    <!-- Printer Information Table -->
    <table class="printer-table">
        <thead>
            <tr>
                <th>PJ No.</th>
                <th>NO OF BOOKLETS</th>
                <th>NO OF SETS PER BOOKLETS</th>
                <th>NO OF COPIES PER SET</th>
                <th>SERIAL NO. FROM</th>
                <th>SERIAL NO. TO</th>
                <th>OCN</th>
                <th>DATE OF ATP</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>40 Bkls</td>
                <td>50</td>
                <td>2x</td>
                <td>000501</td>
                <td>002500</td>
                <td>007AJ20240000001188</td>
                <td>MAY 14, 2024</td>
            </tr>
        </tbody>
    </table>
</body>
</html>