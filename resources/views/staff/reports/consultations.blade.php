@extends('layouts.staff')

@section('title', 'Consultation Report - iWellCare')
@section('page-title', 'Consultation Report')
@section('page-subtitle', 'Consultation statistics and analysis')

@push('styles')
<style>
@media print {
    .no-print {
        display: none !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
        break-inside: avoid;
    }
    body {
        font-size: 12px !important;
        line-height: 1.4 !important;
    }
    .grid {
        display: block !important;
    }
    .grid-cols-1, .md\\:grid-cols-2, .lg\\:grid-cols-4 {
        display: block !important;
    }
    .gap-6 > *, .gap-8 > * {
        margin-bottom: 20px !important;
    }
    table {
        font-size: 11px !important;
        width: 100% !important;
    }
    th, td {
        padding: 6px !important;
        border: 1px solid #ddd !important;
    }
    .page-break {
        page-break-before: always;
    }
    .print-header {
        text-align: center;
        border-bottom: 2px solid #007bff;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }
    .print-header h1 {
        color: #007bff;
        margin: 0;
        font-size: 24px;
    }
    .pagination, .px-6.py-4.border-t.border-gray-200 {
        display: none !important;
    }
}
</style>
@endpush

@section('content')
@if(request('print'))
<div class="print-header">
    <h1>Consultation Report</h1>
    <p><strong>Period:</strong> {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
    <p><strong>Generated:</strong> {{ \Carbon\Carbon::now()->format('F d, Y \a\t g:i A') }}</p>
    <p><strong>iWellCare Healthcare System</strong></p>
</div>
@else
<!-- Header Actions -->
<div class="flex justify-between items-center mb-8 no-print">
    <div>
        <h3 class="text-lg font-semibold text-gray-900">Consultation Analysis Report</h3>
        <p class="text-gray-600">Comprehensive consultation statistics and insights</p>
    </div>
    <a href="{{ route('staff.reports.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i>Back to Reports
    </a>
</div>
@endif

@if(!request('print'))
<!-- Date Range Selector -->
<div class="card mb-8 no-print">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-xl font-bold text-gray-900">Select Date Range</h3>
        <p class="text-gray-600 text-sm">Choose the date range for your consultation analysis</p>
    </div>
    <div class="p-6">
        <form method="GET" action="{{ route('staff.reports.consultations') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                <input type="date"
                       class="form-input w-full"
                       id="date_from"
                       name="date_from"
                       value="{{ $startDate }}">
            </div>
            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                <input type="date"
                       class="form-input w-full"
                       id="date_to"
                       name="date_to"
                       value="{{ $endDate }}">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="form-input w-full" id="status" name="status">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="btn-primary w-full">
                    <i class="fas fa-search mr-2"></i>Generate Report
                </button>
            </div>
            <div class="flex items-end">
                <a href="{{ route('staff.reports.consultations') }}" class="btn-secondary w-full">
                    <i class="fas fa-refresh mr-2"></i>Reset
                </a>
            </div>
        </form>
    </div>
</div>
@endif

<!-- Consultation Statistics -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card p-6" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Total Consultations</p>
                <p class="text-white text-3xl font-bold">{{ $consultationStats['total'] }}</p>
                <p class="text-blue-100 text-xs">In Date Range</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-stethoscope text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Completed</p>
                <p class="text-white text-3xl font-bold">{{ $consultationStats['completed'] }}</p>
                <p class="text-blue-100 text-xs">Successfully Done</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">In Progress</p>
                <p class="text-white text-3xl font-bold">{{ $consultationStats['in_progress'] }}</p>
                <p class="text-blue-100 text-xs">Currently Active</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="card p-6" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Pending</p>
                <p class="text-white text-3xl font-bold">{{ $consultationStats['pending'] }}</p>
                <p class="text-blue-100 text-xs">Awaiting</p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-hourglass-half text-white text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Consultations Table -->
<div class="card">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-xl font-bold text-gray-900">Consultations List ({{ $consultations->total() }} total)</h3>
        <p class="text-gray-600 text-sm">Detailed consultation information and records</p>
    </div>
    <div class="p-6">
        @if($consultations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnosis</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($consultations as $consultation)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $consultation->consultation_date->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $consultation->consultation_date->format('g:i A') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $consultation->patient->first_name ?? 'N/A' }} {{ $consultation->patient->last_name ?? '' }}
                                    </div>
                                    <div class="text-sm text-gray-500">ID: #{{ $consultation->patient->id ?? 'N/A' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $consultation->doctor->first_name ?? 'N/A' }} {{ $consultation->doctor->last_name ?? '' }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $consultation->doctor->role ?? 'N/A' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $consultation->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $consultation->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $consultation->status === 'pending' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $consultation->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $consultation->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    @if($consultation->diagnosis)
                                        {{ Str::limit($consultation->diagnosis, 50) }}
                                    @else
                                        <span class="text-gray-500">No diagnosis</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($consultations->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing {{ $consultations->firstItem() ?? 0 }} to {{ $consultations->lastItem() ?? 0 }} of {{ $consultations->total() }} results
                        </div>
                        <div class="flex space-x-2">
                            {{ $consultations->links() }}
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <i class="fas fa-stethoscope text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Consultations Found</h3>
                <p class="text-gray-600">No consultations found for the selected date range</p>
            </div>
        @endif
    </div>
</div>

@if(!request('print'))
<!-- Export Options -->
<div class="card mt-8 no-print">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-xl font-bold text-gray-900">Export Options</h3>
        <p class="text-gray-600 text-sm">Download or share your consultation report</p>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button type="button"
                    class="flex flex-col items-center p-4 border-2 border-blue-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-all duration-200"
                    onclick="exportReport('consultation')">
                <i class="fas fa-file-pdf text-2xl text-blue-600 mb-2"></i>
                <span class="font-semibold text-gray-900">Export PDF</span>
                <span class="text-sm text-gray-600">Complete Report</span>
            </button>

            <a href="{{ route('staff.reports.consultations', array_merge(request()->all(), ['print' => 1])) }}" target="_blank"
               class="flex flex-col items-center p-4 border-2 border-purple-200 rounded-lg hover:border-purple-300 hover:bg-purple-50 transition-all duration-200">
                <i class="fas fa-print text-2xl text-purple-600 mb-2"></i>
                <span class="font-semibold text-gray-900">Print Report</span>
                <span class="text-sm text-gray-600">Print to Paper</span>
            </a>

            <button type="button"
                    class="flex flex-col items-center p-4 border-2 border-orange-200 rounded-lg hover:border-orange-300 hover:bg-orange-50 transition-all duration-200"
                    onclick="exportReport('consultation_summary')">
                <i class="fas fa-chart-bar text-2xl text-orange-600 mb-2"></i>
                <span class="font-semibold text-gray-900">Summary Report</span>
                <span class="text-sm text-gray-600">Analytics Only</span>
            </button>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script src="{{ asset('assets/js/modal-utils.js') }}"></script>
<script>
@if(request('print'))
window.addEventListener('load', function() {
    setTimeout(function() {
        window.print();
    }, 500);
});
@endif

function exportReport(type) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const startDate = document.getElementById('date_from').value;
    const endDate = document.getElementById('date_to').value;
    const status = document.getElementById('status').value;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/staff/reports/export';
    form.target = '_blank';

    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    const typeInput = document.createElement('input');
    typeInput.type = 'hidden';
    typeInput.name = 'type';
    typeInput.value = type;
    form.appendChild(typeInput);

    const startDateInput = document.createElement('input');
    startDateInput.type = 'hidden';
    startDateInput.name = 'start_date';
    startDateInput.value = startDate;
    form.appendChild(startDateInput);

    const endDateInput = document.createElement('input');
    endDateInput.type = 'hidden';
    endDateInput.name = 'end_date';
    endDateInput.value = endDate;
    form.appendChild(endDateInput);

    if (status) {
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        form.appendChild(statusInput);
    }

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

</script>
@endpush
