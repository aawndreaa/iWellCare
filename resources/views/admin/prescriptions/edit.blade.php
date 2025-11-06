@extends('layouts.admin')
@section('title', 'Edit Prescription - iWellCare')
@section('page-title', 'Edit Prescription')
@section('page-subtitle', 'Update prescription information')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-blue-50/30 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="card p-4 md:p-6 bg-white rounded-xl border border-gray-200 shadow-xl">

        <form action="{{ route('admin.prescriptions.update', $prescription->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-lg mb-6 flex items-start gap-3 shadow-md">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl mt-0.5"></i>
                    <div>
                        <h4 class="font-semibold mb-2">Please fix the following errors:</h4>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Patient and Doctor Information Section -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50/50 rounded-xl p-4 md:p-5 border border-green-200 shadow-sm mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-800">Patient & Doctor Information</h4>
                        <p class="text-xs text-gray-600">Select patient and prescribing doctor</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Patient Selection -->
                    <div>
                        <label class="block text-gray-700 font-semibold text-sm mb-2">
                            <i class="fas fa-user-circle text-green-600 mr-1"></i>Patient <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                            <select name="patient_id" id="patient_id" required class="form-input w-full pl-10 pr-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('patient_id') border-red-500 ring-red-500 @enderror">
                                <option value="">Select Patient</option>
                                @foreach($patients ?? [] as $patient)
                                    @php
                                        $patientRecordId = $patientRecord->id ?? null;
                                        $selected = old('patient_id', $patientRecordId) == $patient->id;
                                    @endphp
                                    @if($patient && $patient->user)
                                        <option value="{{ $patient->id }}" {{ $selected ? 'selected' : '' }}>
                                            {{ $patient->user->first_name ?? $patient->first_name ?? '' }} {{ $patient->user->last_name ?? $patient->last_name ?? '' }} ({{ $patient->user->email ?? $patient->email ?? 'No email' }})
                                        </option>
                                    @elseif($patient)
                                        <option value="{{ $patient->id }}" {{ $selected ? 'selected' : '' }}>
                                            {{ $patient->first_name ?? '' }} {{ $patient->last_name ?? '' }} ({{ $patient->email ?? 'No email' }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @error('patient_id')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Doctor Selection -->
                    <div>
                        <label class="block text-gray-700 font-semibold text-sm mb-2">
                            <i class="fas fa-user-md text-blue-600 mr-1"></i>Doctor <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-user-md absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                            <select name="doctor_id" id="doctor_id" required class="form-input w-full pl-10 pr-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('doctor_id') border-red-500 ring-red-500 @enderror">
                                <option value="">Select Doctor</option>
                                @foreach($doctors ?? [] as $doctor)
                                    @if($doctor && $doctor->user)
                                        <option value="{{ $doctor->id }}" {{ old('doctor_id', $prescription->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                            Dr. {{ $doctor->user->first_name ?? '' }} {{ $doctor->user->last_name ?? '' }} ({{ $doctor->specialization ?? 'General' }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @error('doctor_id')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Medications Section -->
            <div class="bg-gradient-to-br from-indigo-50 to-purple-50/50 rounded-xl p-4 md:p-5 border border-indigo-200 shadow-sm mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                            <i class="fas fa-pills text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Medications</h4>
                            <p class="text-xs text-gray-600">Add medications to the prescription</p>
                        </div>
                    </div>
                    <button type="button" id="add-medication" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>Add Medication
                    </button>
                </div>

                <!-- Medications Container -->
                <div id="medications-container" class="space-y-4">
                    @forelse($prescription->medications ?? [] as $index => $medication)
                        <div class="medication-entry bg-white rounded-lg p-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-semibold text-gray-700">Medication #{{ $index + 1 }}</h4>
                                <button type="button" class="remove-medication text-red-600 hover:text-red-800 transition-colors" style="{{ count($prescription->medications ?? []) <= 1 ? 'display: none;' : '' }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Medication Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="medications[{{ $index }}][medication_name]" value="{{ old('medications.' . $index . '.medication_name', $medication->medication_name) }}" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., Amoxicillin">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Dosage <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="medications[{{ $index }}][dosage]" value="{{ old('medications.' . $index . '.dosage', $medication->dosage) }}" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 500mg">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Frequency <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="medications[{{ $index }}][frequency]" value="{{ old('medications.' . $index . '.frequency', $medication->frequency) }}" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., Twice daily">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Duration
                                    </label>
                                    <input type="text" name="medications[{{ $index }}][duration]" value="{{ old('medications.' . $index . '.duration', $medication->duration) }}" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 7 days">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Quantity
                                    </label>
                                    <input type="number" name="medications[{{ $index }}][quantity]" value="{{ old('medications.' . $index . '.quantity', $medication->quantity) }}" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 30">
                                </div>
                                
                                <div class="md:col-span-2 lg:col-span-1">
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Instructions
                                    </label>
                                    <textarea name="medications[{{ $index }}][instructions]" rows="2" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="Special instructions...">{{ old('medications.' . $index . '.instructions', $medication->instructions) }}</textarea>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="medication-entry bg-white rounded-lg p-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-semibold text-gray-700">Medication #1</h4>
                                <button type="button" class="remove-medication text-red-600 hover:text-red-800 transition-colors" style="display: none;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Medication Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="medications[0][medication_name]" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., Amoxicillin">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Dosage <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="medications[0][dosage]" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 500mg">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Frequency <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="medications[0][frequency]" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., Twice daily">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Duration
                                    </label>
                                    <input type="text" name="medications[0][duration]" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 7 days">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Quantity
                                    </label>
                                    <input type="number" name="medications[0][quantity]" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 30">
                                </div>
                                
                                <div class="md:col-span-2 lg:col-span-1">
                                    <label class="block text-gray-700 font-medium text-sm mb-2">
                                        Instructions
                                    </label>
                                    <textarea name="medications[0][instructions]" rows="2" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="Special instructions..."></textarea>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Prescription Details Section -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50/50 rounded-xl p-4 md:p-5 border border-blue-200 shadow-sm mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-clipboard-list text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-800">Prescription Details</h4>
                        <p class="text-xs text-gray-600">Additional information and notes</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold text-sm mb-2">
                            <i class="fas fa-calendar text-blue-600 mr-1"></i>Prescribed Date <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-calendar absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                            <input type="date" name="prescribed_date" id="prescribed_date" value="{{ old('prescribed_date', $prescription->prescription_date ? $prescription->prescription_date->format('Y-m-d') : date('Y-m-d')) }}" required class="form-input w-full pl-10 pr-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('prescribed_date') border-red-500 ring-red-500 @enderror">
                        </div>
                        @error('prescribed_date')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold text-sm mb-2">
                            <i class="fas fa-info-circle text-blue-600 mr-1"></i>Status <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-info-circle absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                            <select name="status" id="status" required class="form-input w-full pl-10 pr-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('status') border-red-500 ring-red-500 @enderror">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', $prescription->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="completed" {{ old('status', $prescription->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $prescription->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold text-sm mb-2">
                            <i class="fas fa-comment text-blue-600 mr-1"></i>Notes
                        </label>
                        <div class="relative">
                            <i class="fas fa-comment absolute left-3 top-3 text-gray-400 z-10"></i>
                            <textarea name="notes" id="notes" rows="3" class="form-input w-full pl-10 pr-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('notes') border-red-500 ring-red-500 @enderror" placeholder="Additional notes...">{{ old('notes', $prescription->notes) }}</textarea>
                        </div>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 mt-6 pt-6 border-t-2 border-gray-200">
                <a href="{{ route('admin.prescriptions.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md order-2 sm:order-1">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 order-1 sm:order-2">
                    <i class="fas fa-save mr-2"></i>Update Prescription
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let medicationCount = {{ count($prescription->medications ?? []) }};
    const container = document.getElementById('medications-container');
    const addButton = document.getElementById('add-medication');

    // Add medication functionality
    addButton.addEventListener('click', function() {
        const newMedication = createMedicationEntry(medicationCount);
        container.appendChild(newMedication);
        medicationCount++;
        updateMedicationNumbers();
        updateRemoveButtons();
    });

    // Remove medication functionality
    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-medication')) {
            e.target.closest('.medication-entry').remove();
            updateMedicationNumbers();
            updateRemoveButtons();
        }
    });

    function createMedicationEntry(index) {
        const div = document.createElement('div');
        div.className = 'medication-entry bg-white rounded-lg p-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow';
        div.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-700">Medication #${index + 1}</h4>
                <button type="button" class="remove-medication text-red-600 hover:text-red-800 transition-colors">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium text-sm mb-2">
                        Medication Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="medications[${index}][medication_name]" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., Amoxicillin">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium text-sm mb-2">
                        Dosage <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="medications[${index}][dosage]" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 500mg">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium text-sm mb-2">
                        Frequency <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="medications[${index}][frequency]" required class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., Twice daily">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium text-sm mb-2">
                        Duration
                    </label>
                    <input type="text" name="medications[${index}][duration]" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 7 days">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium text-sm mb-2">
                        Quantity
                    </label>
                    <input type="number" name="medications[${index}][quantity]" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="e.g., 30">
                </div>
                
                <div class="md:col-span-2 lg:col-span-1">
                    <label class="block text-gray-700 font-medium text-sm mb-2">
                        Instructions
                    </label>
                    <textarea name="medications[${index}][instructions]" rows="2" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200" placeholder="Special instructions..."></textarea>
                </div>
            </div>
        `;
        return div;
    }

    function updateMedicationNumbers() {
        const entries = container.querySelectorAll('.medication-entry');
        entries.forEach((entry, index) => {
            const title = entry.querySelector('h4');
            title.textContent = `Medication #${index + 1}`;
        });
    }

    function updateRemoveButtons() {
        const entries = container.querySelectorAll('.medication-entry');
        entries.forEach((entry, index) => {
            const removeBtn = entry.querySelector('.remove-medication');
            if (entries.length === 1) {
                removeBtn.style.display = 'none';
            } else {
                removeBtn.style.display = 'block';
            }
        });
    }

    // Initialize
    updateRemoveButtons();
});
</script>
@endpush

@push('styles')
<style>
.medication-entry {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

