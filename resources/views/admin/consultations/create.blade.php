@extends('layouts.admin')

@section('title', 'Create Consultation - iWellCare')
@section('page-title', 'Create New Consultation')
@section('page-subtitle', 'Start a new patient consultation')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Create New Consultation</h1>
                <p class="mt-2 text-gray-600">Start a consultation with a patient</p>
            </div>
            <a href="{{ route('admin.consultations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Consultations
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <form action="{{ route('admin.consultations.store') }}" method="POST" id="consultationForm">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Consultation Details</h2>
                <p class="text-sm text-gray-600">Fill in the consultation information</p>
            </div>

            <div class="p-6 space-y-6">
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
                            @foreach($patients ?? [] as $patient)
                                @if(is_object($patient) && $patient && is_object($patient->user) && $patient->user)
                                    <option value="{{ $patient->id ?? '' }}" {{ (string) old('patient_id', $selectedPatientId ?? '') === (string) ($patient->id ?? '') ? 'selected' : '' }}>
                                        {{ $patient->user->first_name ?? '' }} {{ $patient->user->last_name ?? '' }} - {{ $patient->user->email ?? 'No Email' }}
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
                              placeholder="Enter the patient's main complaint or reason for visit..." required>{{ old('chief_complaint') }}</textarea>
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
                              placeholder="Describe the history and progression of the current illness...">{{ old('present_illness') }}</textarea>
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
                              placeholder="Relevant past medical conditions, surgeries, etc...">{{ old('past_medical_history') }}</textarea>
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
                              placeholder="List current medications and dosages...">{{ old('medications') }}</textarea>
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
                              placeholder="List any known allergies...">{{ old('allergies') }}</textarea>
                    @error('allergies')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Clinical Measurements -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Clinical Measurements</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Blood Pressure -->
                        <div>
                            <label for="blood_pressure" class="block text-sm font-medium text-gray-700 mb-2">
                                Blood Pressure
                            </label>
                            <input type="text" name="blood_pressure" id="blood_pressure"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="120/80 mmHg" value="{{ old('blood_pressure') }}">
                        </div>

                        <!-- Heart Rate -->
                        <div>
                            <label for="heart_rate" class="block text-sm font-medium text-gray-700 mb-2">
                                Heart Rate
                            </label>
                            <input type="text" name="heart_rate" id="heart_rate"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="72 bpm" value="{{ old('heart_rate') }}">
                        </div>

                        <!-- Temperature -->
                        <div>
                            <label for="temperature" class="block text-sm font-medium text-gray-700 mb-2">
                                Temperature
                            </label>
                            <input type="text" name="temperature" id="temperature"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="98.6°F" value="{{ old('temperature') }}">
                        </div>

                        <!-- Respiratory Rate -->
                        <div>
                            <label for="respiratory_rate" class="block text-sm font-medium text-gray-700 mb-2">
                                Respiratory Rate
                            </label>
                            <input type="text" name="respiratory_rate" id="respiratory_rate"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="16/min" value="{{ old('respiratory_rate') }}">
                        </div>

                        <!-- Height -->
                        <div>
                            <label for="height" class="block text-sm font-medium text-gray-700 mb-2">
                                Height
                            </label>
                            <input type="text" name="height" id="height"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="170 cm" value="{{ old('height') }}">
                        </div>

                        <!-- Weight -->
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">
                                Weight
                            </label>
                            <input type="text" name="weight" id="weight"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="70 kg" value="{{ old('weight') }}">
                        </div>

                        <!-- BMI -->
                        <div class="md:col-span-2 lg:col-span-1">
                            <label for="bmi" class="block text-sm font-medium text-gray-700 mb-2">
                                BMI (Auto-calculated)
                            </label>
                            <input type="text" name="bmi" id="bmi"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50"
                                   placeholder="24.2" readonly value="{{ old('bmi') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.consultations.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-stethoscope mr-2"></i>Create Consultation
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate BMI when height and weight are entered
    const heightInput = document.getElementById('height');
    const weightInput = document.getElementById('weight');
    const bmiInput = document.getElementById('bmi');

    function calculateBMI() {
        const height = parseFloat(heightInput.value);
        const weight = parseFloat(weightInput.value);

        if (height && weight && height > 0) {
            const heightInMeters = height / 100; // Convert cm to meters
            const bmi = weight / (heightInMeters * heightInMeters);
            bmiInput.value = bmi.toFixed(1);
        } else {
            bmiInput.value = '';
        }
    }

    heightInput.addEventListener('input', calculateBMI);
    weightInput.addEventListener('input', calculateBMI);

    // Auto-fetch patient data when patient is selected
    const patientSelect = document.getElementById('patient_id');
    patientSelect.addEventListener('change', function() {
        const patientId = this.value;
        if (patientId) {
            fetchPatientData(patientId);
        } else {
            clearPatientData();
        }
    });

    // Fetch patient data via AJAX
    function fetchPatientData(patientId) {
        fetch(`/admin/consultations/fetch-patient-data?patient_id=${patientId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.patient) {
                populatePatientData(data.patient);
            }
        })
        .catch(error => {
            console.error('Error fetching patient data:', error);
        });
    }

    // Populate form fields with patient data
    function populatePatientData(patient) {
        if (patient.past_medical_history) {
            document.getElementById('past_medical_history').value = patient.past_medical_history;
        }
        if (patient.medications) {
            document.getElementById('medications').value = patient.medications;
        }
        if (patient.allergies) {
            document.getElementById('allergies').value = patient.allergies;
        }
    }

    // Clear patient data
    function clearPatientData() {
        document.getElementById('past_medical_history').value = '';
        document.getElementById('medications').value = '';
        document.getElementById('allergies').value = '';
    }

    // Fetch patients by date when consultation date changes
    const consultationDateInput = document.getElementById('consultation_date');
    if (consultationDateInput) {
        consultationDateInput.addEventListener('change', function() {
            const date = this.value;
            if (date) {
                fetchPatientsByDate(date);
            } else {
                // Clear patient dropdown if no date selected
                const patientSelect = document.getElementById('patient_id');
                if (patientSelect) {
                    patientSelect.innerHTML = '<option value="">Select Patient</option>';
                }
            }
        });
    }

    // Fetch patients with confirmed appointments for a specific date
    function fetchPatientsByDate(date) {
        const patientSelect = document.getElementById('patient_id');
        const currentSelectedValue = patientSelect.value;
        
        // Show loading state
        patientSelect.innerHTML = '<option value="">Loading patients...</option>';
        patientSelect.disabled = true;

        fetch(`/admin/consultations/fetch-patients-by-date?date=${date}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            patientSelect.disabled = false;
            
            if (data.success && data.patients) {
                // Clear and populate patient dropdown
                patientSelect.innerHTML = '<option value="">Select Patient</option>';
                
                data.patients.forEach(patient => {
                    const option = document.createElement('option');
                    option.value = patient.id;
                    option.textContent = patient.text;
                    patientSelect.appendChild(option);
                });

                // Try to restore previously selected patient if it exists in the new list
                if (currentSelectedValue) {
                    const option = patientSelect.querySelector(`option[value="${currentSelectedValue}"]`);
                    if (option) {
                        patientSelect.value = currentSelectedValue;
                    }
                }
            } else {
                patientSelect.innerHTML = '<option value="">No patients found for this date</option>';
            }
        })
        .catch(error => {
            console.error('Error fetching patients by date:', error);
            patientSelect.disabled = false;
            patientSelect.innerHTML = '<option value="">Error loading patients</option>';
        });
    }
});
</script>
@endpush
@endsection