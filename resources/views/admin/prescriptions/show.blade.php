@extends('layouts.admin')
@section('title', 'Prescription Details - iWellCare')
@section('page-title', 'Prescription Details')
@section('page-subtitle', 'View prescription information and medications')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-blue-50/30 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 shadow-xl">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                            <i class="fas fa-prescription text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Prescription Details</h1>
                            <p class="text-sm text-gray-600 mt-0.5">Prescription #{{ $prescription->prescription_number ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.prescriptions.edit', $prescription->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-purple-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.prescriptions.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Prescription Details -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Prescription Information -->
                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50/50 rounded-xl p-5 border border-purple-200 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fas fa-clipboard-list text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Prescription Information</h3>
                                    <p class="text-xs text-gray-600">Prescription details and status</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Prescription Number</label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $prescription->prescription_number ?? 'N/A' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Prescribed Date</label>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ $prescription->prescription_date ? \Carbon\Carbon::parse($prescription->prescription_date)->format('M d, Y') : 'N/A' }}
                                    </p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                    <div class="mt-1">
                                        @if($prescription->status === 'active')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1.5"></i> Active
                                            </span>
                                        @elseif($prescription->status === 'completed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                                <i class="fas fa-clipboard-check mr-1.5"></i> Completed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1.5"></i> Cancelled
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($prescription->valid_until)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Valid Until</label>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($prescription->valid_until)->format('M d, Y') }}
                                    </p>
                                </div>
                                @endif
                            </div>

                            @if($prescription->notes)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-comment text-purple-600 mr-1"></i>Notes
                                </label>
                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                    <p class="text-gray-900 whitespace-pre-line">{{ $prescription->notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Medications Section -->
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50/50 rounded-xl p-5 border border-indigo-200 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fas fa-pills text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Medications</h3>
                                    <p class="text-xs text-gray-600">{{ $prescription->medications->count() }} medication(s)</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                @forelse($prescription->medications as $medication)
                                    <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                                        <div class="flex items-center justify-between mb-3">
                                            <h4 class="text-base font-semibold text-gray-900">{{ $medication->medication_name }}</h4>
                                            @if($medication->quantity)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Qty: {{ $medication->quantity }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1">Dosage</label>
                                                <p class="text-sm font-medium text-gray-900">{{ $medication->dosage ?? 'N/A' }}</p>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1">Frequency</label>
                                                <p class="text-sm font-medium text-gray-900">{{ $medication->frequency ?? 'N/A' }}</p>
                                            </div>
                                            
                                            @if($medication->duration)
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1">Duration</label>
                                                <p class="text-sm font-medium text-gray-900">{{ $medication->duration }}</p>
                                            </div>
                                            @endif
                                            
                                            @if($medication->instructions)
                                            <div class="md:col-span-2">
                                                <label class="block text-xs font-medium text-gray-500 mb-1">Instructions</label>
                                                <p class="text-sm text-gray-900 whitespace-pre-line">{{ $medication->instructions }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-gray-400">
                                        <i class="fas fa-pills text-4xl mb-2"></i>
                                        <p>No medications found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Patient & Doctor Information Sidebar -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Patient Information -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50/50 rounded-xl p-5 border border-green-200 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Patient</h3>
                                    <p class="text-xs text-gray-600">Patient information</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center mb-4 pb-4 border-b border-gray-200">
                                @php
                                    $patientName = $prescription->patient->first_name ?? 'N';
                                    $patientLastName = $prescription->patient->last_name ?? 'A';
                                    $patientEmail = $prescription->patient->email ?? 'N/A';
                                @endphp
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-md mr-3">
                                    {{ strtoupper(substr($patientName, 0, 1)) }}{{ strtoupper(substr($patientLastName, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900">
                                        {{ $patientName }} {{ $patientLastName }}
                                    </h4>
                                    <p class="text-xs text-gray-500">{{ $patientEmail }}</p>
                                </div>
                            </div>
                            
                            <div class="space-y-2 text-sm">
                                @if($prescription->patient)
                                    <div>
                                        <span class="text-gray-500">Phone:</span>
                                        <span class="font-medium text-gray-900 ml-2">{{ $prescription->patient->phone_number ?? 'N/A' }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Doctor Information -->
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50/50 rounded-xl p-5 border border-blue-200 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fas fa-user-md text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Doctor</h3>
                                    <p class="text-xs text-gray-600">Prescribing doctor</p>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <div>
                                    <p class="text-base font-semibold text-gray-900">
                                        Dr. {{ $prescription->doctor->user->first_name ?? '' }} {{ $prescription->doctor->user->last_name ?? '' }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $prescription->doctor->specialization ?? 'General' }}</p>
                                </div>
                                @if($prescription->doctor->user->email)
                                    <div class="text-sm">
                                        <span class="text-gray-500">Email:</span>
                                        <span class="text-gray-900 ml-2">{{ $prescription->doctor->user->email }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

