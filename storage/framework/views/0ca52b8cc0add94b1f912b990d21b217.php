

<?php $__env->startSection('title', 'Create Consultation - iWellCare'); ?>
<?php $__env->startSection('page-title', 'Create New Consultation'); ?>
<?php $__env->startSection('page-subtitle', 'Start a new patient consultation'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Create New Consultation</h1>
                <p class="mt-2 text-gray-600">Start a consultation with a patient</p>
            </div>
            <a href="<?php echo e(route('admin.consultations.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Consultations
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <form action="<?php echo e(route('admin.consultations.store')); ?>" method="POST" id="consultationForm">
            <?php echo csrf_field(); ?>
            <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

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
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                required>
                            <option value="">Select Patient</option>
                            <?php $__currentLoopData = $patients ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(is_object($patient) && $patient && is_object($patient->user) && $patient->user): ?>
                                    <option value="<?php echo e($patient->id ?? ''); ?>" <?php echo e((string) old('patient_id', $selectedPatientId ?? '') === (string) ($patient->id ?? '') ? 'selected' : ''); ?>>
                                        <?php echo e($patient->user->first_name ?? ''); ?> <?php echo e($patient->user->last_name ?? ''); ?> - <?php echo e($patient->user->email ?? 'No Email'); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Doctor Selection -->
                    <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Doctor <span class="text-red-500">*</span>
                        </label>
                        <select name="doctor_id" id="doctor_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                required>
                            <option value="">Select Doctor</option>
                            <?php $__currentLoopData = $doctors ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(is_object($doctor) && $doctor && is_object($doctor->user) && $doctor->user): ?>
                                    <option value="<?php echo e($doctor->user_id ?? ''); ?>" <?php echo e((string) old('doctor_id', $selectedDoctorId ?? '') === (string) ($doctor->user_id ?? '') ? 'selected' : ''); ?>>
                                        Dr. <?php echo e($doctor->user->first_name ?? ''); ?> <?php echo e($doctor->user->last_name ?? ''); ?> - <?php echo e($doctor->specialization ?? 'General'); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Consultation Date -->
                <div>
                    <label for="consultation_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Consultation Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="consultation_date" id="consultation_date"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['consultation_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('consultation_date', date('Y-m-d'))); ?>" required>
                    <?php $__errorArgs = ['consultation_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Chief Complaint -->
                <div>
                    <label for="chief_complaint" class="block text-sm font-medium text-gray-700 mb-2">
                        Chief Complaint <span class="text-red-500">*</span>
                    </label>
                    <textarea name="chief_complaint" id="chief_complaint" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['chief_complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Enter the patient's main complaint or reason for visit..." required><?php echo e(old('chief_complaint')); ?></textarea>
                    <?php $__errorArgs = ['chief_complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Present Illness -->
                <div>
                    <label for="present_illness" class="block text-sm font-medium text-gray-700 mb-2">
                        Present Illness
                    </label>
                    <textarea name="present_illness" id="present_illness" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['present_illness'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Describe the history and progression of the current illness..."><?php echo e(old('present_illness')); ?></textarea>
                    <?php $__errorArgs = ['present_illness'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Past Medical History -->
                <div>
                    <label for="past_medical_history" class="block text-sm font-medium text-gray-700 mb-2">
                        Past Medical History
                    </label>
                    <textarea name="past_medical_history" id="past_medical_history" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['past_medical_history'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Relevant past medical conditions, surgeries, etc..."><?php echo e(old('past_medical_history')); ?></textarea>
                    <?php $__errorArgs = ['past_medical_history'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Current Medications -->
                <div>
                    <label for="medications" class="block text-sm font-medium text-gray-700 mb-2">
                        Current Medications
                    </label>
                    <textarea name="medications" id="medications" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['medications'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="List current medications and dosages..."><?php echo e(old('medications')); ?></textarea>
                    <?php $__errorArgs = ['medications'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Allergies -->
                <div>
                    <label for="allergies" class="block text-sm font-medium text-gray-700 mb-2">
                        Allergies
                    </label>
                    <textarea name="allergies" id="allergies" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 <?php $__errorArgs = ['allergies'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="List any known allergies..."><?php echo e(old('allergies')); ?></textarea>
                    <?php $__errorArgs = ['allergies'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                   placeholder="120/80 mmHg" value="<?php echo e(old('blood_pressure')); ?>">
                        </div>

                        <!-- Heart Rate -->
                        <div>
                            <label for="heart_rate" class="block text-sm font-medium text-gray-700 mb-2">
                                Heart Rate
                            </label>
                            <input type="text" name="heart_rate" id="heart_rate"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="72 bpm" value="<?php echo e(old('heart_rate')); ?>">
                        </div>

                        <!-- Temperature -->
                        <div>
                            <label for="temperature" class="block text-sm font-medium text-gray-700 mb-2">
                                Temperature
                            </label>
                            <input type="text" name="temperature" id="temperature"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="98.6°F" value="<?php echo e(old('temperature')); ?>">
                        </div>

                        <!-- Respiratory Rate -->
                        <div>
                            <label for="respiratory_rate" class="block text-sm font-medium text-gray-700 mb-2">
                                Respiratory Rate
                            </label>
                            <input type="text" name="respiratory_rate" id="respiratory_rate"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="16/min" value="<?php echo e(old('respiratory_rate')); ?>">
                        </div>

                        <!-- Height -->
                        <div>
                            <label for="height" class="block text-sm font-medium text-gray-700 mb-2">
                                Height
                            </label>
                            <input type="text" name="height" id="height"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="170 cm" value="<?php echo e(old('height')); ?>">
                        </div>

                        <!-- Weight -->
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">
                                Weight
                            </label>
                            <input type="text" name="weight" id="weight"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="70 kg" value="<?php echo e(old('weight')); ?>">
                        </div>

                        <!-- BMI -->
                        <div class="md:col-span-2 lg:col-span-1">
                            <label for="bmi" class="block text-sm font-medium text-gray-700 mb-2">
                                BMI (Auto-calculated)
                            </label>
                            <input type="text" name="bmi" id="bmi"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50"
                                   placeholder="24.2" readonly value="<?php echo e(old('bmi')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="<?php echo e(route('admin.consultations.index')); ?>" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-stethoscope mr-2"></i>Create Consultation
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iWellCare\resources\views/admin/consultations/create.blade.php ENDPATH**/ ?>