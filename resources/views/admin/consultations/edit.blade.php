@extends('layouts.admin')

@section('title', 'Edit Consultation - iWellCare')
@section('page-title', 'Edit Consultation')
@section('page-subtitle', 'Update consultation details')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div></div>
            <a href="{{ route('admin.consultations.show', $consultation) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Consultation
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <form action="{{ route('admin.consultations.update', $consultation) }}" method="POST" id="consultationForm">
            @csrf
            @method('PUT')
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Consultation Details</h2>
                <p class="text-sm text-gray-600">Update the consultation information</p>
            </div>

            <div class="p-6 space-y-6">
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

                <!-- Patient and Doctor Selection -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Patient Selection -->
                <div>
                        <label for="patient_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Patient <span class="text-red-500">*</span>
                        </label>
                        <select name="patient_id" id="patient_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('patient_id') border-red-500 @enderror"
                                required>
                            <option value="">Select Patient</option>
                            @foreach($patients ?? [] as $patientOption)
                                @if(is_object($patientOption) && $patientOption && is_object($patientOption->user) && $patientOption->user)
                                    <option value="{{ $patientOption->id ?? '' }}" {{ (string) old('patient_id', $selectedPatientId ?? '') === (string) ($patientOption->id ?? '') ? 'selected' : '' }}>
                                        {{ $patientOption->user->first_name ?? '' }} {{ $patientOption->user->last_name ?? '' }} - {{ $patientOption->user->email ?? 'No Email' }}
                                    </option>
                                @endif
                            @endforeach
                    </select>
                        @error('patient_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                </div>
                
                    <!-- Doctor Selection -->
                <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Doctor <span class="text-red-500">*</span>
                        </label>
                        <select name="doctor_id" id="doctor_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('doctor_id') border-red-500 @enderror"
                                required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors ?? [] as $doctor)
                                @if(is_object($doctor) && $doctor && is_object($doctor->user) && $doctor->user)
                                    <option value="{{ $doctor->user_id ?? '' }}" {{ (string) old('doctor_id', $selectedDoctorId ?? '') === (string) ($doctor->user_id ?? '') ? 'selected' : '' }}>
                                        Dr. {{ $doctor->user->first_name ?? '' }} {{ $doctor->user->last_name ?? '' }} - {{ $doctor->specialization ?? 'General' }}
                                    </option>
                                @endif
                            @endforeach
                    </select>
                        @error('doctor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                </div>
                </div>
                
                <!-- Chief Complaint -->
                <div>
                    <label for="chief_complaint" class="block text-sm font-medium text-gray-700 mb-2">
                        Chief Complaint <span class="text-red-500">*</span>
                    </label>
                    <textarea name="chief_complaint" id="chief_complaint" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('chief_complaint') border-red-500 @enderror"
                              placeholder="Enter the patient's main complaint or reason for visit..." required>{{ old('chief_complaint', $consultation->chief_complaint) }}</textarea>
                    @error('chief_complaint')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Present Illness -->
                <div>
                    <label for="present_illness" class="block text-sm font-medium text-gray-700 mb-2">
                        Present Illness
                    </label>
                    <textarea name="present_illness" id="present_illness" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('present_illness') border-red-500 @enderror"
                              placeholder="Describe the history and progression of the current illness...">{{ old('present_illness', $consultation->present_illness) }}</textarea>
                    @error('present_illness')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Past Medical History -->
                <div>
                    <label for="past_medical_history" class="block text-sm font-medium text-gray-700 mb-2">
                        Past Medical History
                    </label>
                    <textarea name="past_medical_history" id="past_medical_history" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('past_medical_history') border-red-500 @enderror"
                              placeholder="Relevant past medical conditions, surgeries, etc...">{{ old('past_medical_history', $consultation->past_medical_history) }}</textarea>
                    @error('past_medical_history')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Current Medications -->
                <div>
                    <label for="medications" class="block text-sm font-medium text-gray-700 mb-2">
                        Current Medications
                    </label>
                    <textarea name="medications" id="medications" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('medications') border-red-500 @enderror"
                              placeholder="List current medications and dosages...">{{ old('medications', $consultation->medications) }}</textarea>
                    @error('medications')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Allergies -->
                <div>
                    <label for="allergies" class="block text-sm font-medium text-gray-700 mb-2">
                        Allergies
                    </label>
                    <textarea name="allergies" id="allergies" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('allergies') border-red-500 @enderror"
                              placeholder="List any known allergies...">{{ old('allergies', $consultation->allergies) }}</textarea>
                    @error('allergies')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.consultations.show', $consultation) }}" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Update Consultation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
