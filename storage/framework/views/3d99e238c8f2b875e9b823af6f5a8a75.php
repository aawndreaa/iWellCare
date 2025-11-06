
<?php $__env->startSection('title', 'Edit Profile - iWellCare'); ?>
<?php $__env->startSection('page-title', 'Edit Profile'); ?>
<?php $__env->startSection('page-subtitle', 'Update your personal information'); ?>
<?php $__env->startSection('content'); ?>

<style>
    .section-divider {
        border-top: 1px solid #e5e7eb;
        margin: 1.5rem 0;
        position: relative;
        text-align: center;
    }

    .section-title {
        background: white;
        padding: 0 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #6b7280;
        position: relative;
        top: -0.75rem;
        display: inline-block;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    @media (min-width: 480px) {
        .form-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: white;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input::placeholder {
        color: #9ca3af;
    }

    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        background: white;
        transition: all 0.2s ease;
    }

    .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .password-input {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 4px;
        transition: color 0.2s ease;
    }

    .password-toggle:hover {
        color: #6b7280;
    }

    .form-input.password {
        padding-right: 3rem;
    }

    .error-text {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    @media (max-width: 640px) {
        .form-grid {
            gap: 0.75rem;
        }

        .form-input,
        .form-select {
            padding: 0.625rem;
            font-size: 16px; /* Prevents zoom on iOS */
        }
    }

    @media (max-width: 480px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="max-w-4xl mx-auto">
    <div class="card p-8">
        <form action="<?php echo e(route('patient.profile.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <!-- Basic Information -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Basic Information</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="first_name" name="first_name" value="<?php echo e(old('first_name', $user->first_name)); ?>" placeholder="First name" required>
                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="last_name" name="last_name" value="<?php echo e(old('last_name', $user->last_name)); ?>" placeholder="Last name" required>
                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" placeholder="Email address" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone Number *</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="phone_number" name="phone_number" value="<?php echo e(old('phone_number', $user->phone_number)); ?>" placeholder="Phone number" required>
                        <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="contact" class="form-label">Contact Number *</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="contact" name="contact" value="<?php echo e(old('contact', $patient->contact)); ?>" placeholder="Contact number" required>
                        <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth" class="form-label">Date of Birth *</label>
                        <input type="date" class="form-input <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="date_of_birth" name="date_of_birth" value="<?php echo e(old('date_of_birth', $patient->date_of_birth ? $patient->date_of_birth->format('Y-m-d') : '')); ?>" max="<?php echo e(date('Y-m-d', strtotime('-1 day'))); ?>" required>
                        <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="gender" class="form-label">Gender *</label>
                        <select class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            <option value="male" <?php echo e(old('gender', $patient->gender) == 'male' ? 'selected' : ''); ?>>Male</option>
                            <option value="female" <?php echo e(old('gender', $patient->gender) == 'female' ? 'selected' : ''); ?>>Female</option>
                            <option value="other" <?php echo e(old('gender', $patient->gender) == 'other' ? 'selected' : ''); ?>>Other</option>
                        </select>
                        <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="blood_type" class="form-label">Blood Type (Optional)</label>
                        <select class="form-select <?php $__errorArgs = ['blood_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="blood_type" name="blood_type">
                            <option value="">Select blood type</option>
                            <option value="A+" <?php echo e(old('blood_type', $patient->blood_type) == 'A+' ? 'selected' : ''); ?>>A+</option>
                            <option value="A-" <?php echo e(old('blood_type', $patient->blood_type) == 'A-' ? 'selected' : ''); ?>>A-</option>
                            <option value="B+" <?php echo e(old('blood_type', $patient->blood_type) == 'B+' ? 'selected' : ''); ?>>B+</option>
                            <option value="B-" <?php echo e(old('blood_type', $patient->blood_type) == 'B-' ? 'selected' : ''); ?>>B-</option>
                            <option value="AB+" <?php echo e(old('blood_type', $patient->blood_type) == 'AB+' ? 'selected' : ''); ?>>AB+</option>
                            <option value="AB-" <?php echo e(old('blood_type', $patient->blood_type) == 'AB-' ? 'selected' : ''); ?>>AB-</option>
                            <option value="O+" <?php echo e(old('blood_type', $patient->blood_type) == 'O+' ? 'selected' : ''); ?>>O+</option>
                            <option value="O-" <?php echo e(old('blood_type', $patient->blood_type) == 'O-' ? 'selected' : ''); ?>>O-</option>
                        </select>
                        <?php $__errorArgs = ['blood_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Address Information</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="street_address" class="form-label">Street Address *</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['street_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="street_address" name="street_address" value="<?php echo e(old('street_address', $user->street_address)); ?>" placeholder="Street address, sitio, barangay" required>
                        <?php $__errorArgs = ['street_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="region" class="form-label">Region *</label>
                        <select class="form-select <?php $__errorArgs = ['region'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="region" name="region" required>
                            <option value="">Select Region</option>
                            <option value="NCR" <?php echo e(old('region', $user->region) == 'NCR' ? 'selected' : ''); ?>>NCR - National Capital Region</option>
                            <option value="CAR" <?php echo e(old('region', $user->region) == 'CAR' ? 'selected' : ''); ?>>CAR - Cordillera Administrative Region</option>
                            <option value="Region I" <?php echo e(old('region', $user->region) == 'Region I' ? 'selected' : ''); ?>>Region I - Ilocos Region</option>
                            <option value="Region II" <?php echo e(old('region', $user->region) == 'Region II' ? 'selected' : ''); ?>>Region II - Cagayan Valley</option>
                            <option value="Region III" <?php echo e(old('region', $user->region) == 'Region III' ? 'selected' : ''); ?>>Region III - Central Luzon</option>
                            <option value="Region IV-A" <?php echo e(old('region', $user->region) == 'Region IV-A' ? 'selected' : ''); ?>>Region IV-A - CALABARZON</option>
                            <option value="Region IV-B" <?php echo e(old('region', $user->region) == 'Region IV-B' ? 'selected' : ''); ?>>Region IV-B - MIMAROPA</option>
                            <option value="Region V" <?php echo e(old('region', $user->region) == 'Region V' ? 'selected' : ''); ?>>Region V - Bicol Region</option>
                            <option value="Region VI" <?php echo e(old('region', $user->region) == 'Region VI' ? 'selected' : ''); ?>>Region VI - Western Visayas</option>
                            <option value="Region VII" <?php echo e(old('region', $user->region) == 'Region VII' ? 'selected' : ''); ?>>Region VII - Central Visayas</option>
                            <option value="Region VIII" <?php echo e(old('region', $user->region) == 'Region VIII' ? 'selected' : ''); ?>>Region VIII - Eastern Visayas</option>
                            <option value="Region IX" <?php echo e(old('region', $user->region) == 'Region IX' ? 'selected' : ''); ?>>Region IX - Zamboanga Peninsula</option>
                            <option value="Region X" <?php echo e(old('region', $user->region) == 'Region X' ? 'selected' : ''); ?>>Region X - Northern Mindanao</option>
                            <option value="Region XI" <?php echo e(old('region', $user->region) == 'Region XI' ? 'selected' : ''); ?>>Region XI - Davao Region</option>
                            <option value="Region XII" <?php echo e(old('region', $user->region) == 'Region XII' ? 'selected' : ''); ?>>Region XII - SOCCSKSARGEN</option>
                            <option value="Region XIII" <?php echo e(old('region', $user->region) == 'Region XIII' ? 'selected' : ''); ?>>Region XIII - Caraga</option>
                            <option value="BARMM" <?php echo e(old('region', $user->region) == 'BARMM' ? 'selected' : ''); ?>>BARMM - Bangsamoro Autonomous Region</option>
                        </select>
                        <?php $__errorArgs = ['region'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="province" class="form-label">Province *</label>
                        <select class="form-select <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="province" name="province" required>
                            <option value="">Select Province</option>
                            <?php if(old('region', $user->region)): ?>
                                <!-- Province options will be populated by JavaScript -->
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="municipality" class="form-label">Municipality/City *</label>
                        <select class="form-select <?php $__errorArgs = ['municipality'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="municipality" name="municipality" required>
                            <option value="">Select Municipality/City</option>
                            <?php if(old('province', $user->province)): ?>
                                <!-- Municipality options will be populated by JavaScript -->
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['municipality'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="barangay" class="form-label">Barangay *</label>
                        <select class="form-select <?php $__errorArgs = ['barangay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="barangay" name="barangay" required>
                            <option value="">Select Barangay</option>
                            <?php if(old('municipality', $user->municipality)): ?>
                                <!-- Barangay options will be populated by JavaScript -->
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['barangay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="postal_code" class="form-label">Postal Code (Optional)</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="postal_code" name="postal_code" value="<?php echo e(old('postal_code', $user->postal_code)); ?>" placeholder="Postal code">
                        <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact Information -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Emergency Contact</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="emergency_contact" class="form-label">Emergency Contact Name (Optional)</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['emergency_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="emergency_contact" name="emergency_contact" value="<?php echo e(old('emergency_contact', $patient->emergency_contact)); ?>" placeholder="Emergency contact name">
                        <?php $__errorArgs = ['emergency_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="emergency_contact_phone" class="form-label">Emergency Contact Phone (Optional)</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['emergency_contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="emergency_contact_phone" name="emergency_contact_phone" value="<?php echo e(old('emergency_contact_phone', $patient->emergency_contact_phone)); ?>" placeholder="Emergency contact phone">
                        <?php $__errorArgs = ['emergency_contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Medical Information -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Medical Information</span>
                </div>

                <div class="form-grid">
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="medical_history" class="form-label">Medical History (Optional)</label>
                        <textarea class="form-input <?php $__errorArgs = ['medical_history'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  id="medical_history" name="medical_history" rows="4" placeholder="Enter your medical history..."><?php echo e(old('medical_history', $patient->medical_history)); ?></textarea>
                        <?php $__errorArgs = ['medical_history'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="allergies" class="form-label">Allergies (Optional)</label>
                        <textarea class="form-input <?php $__errorArgs = ['allergies'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  id="allergies" name="allergies" rows="3" placeholder="Enter any allergies..."><?php echo e(old('allergies', $patient->allergies)); ?></textarea>
                        <?php $__errorArgs = ['allergies'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="current_medications" class="form-label">Current Medications (Optional)</label>
                        <textarea class="form-input <?php $__errorArgs = ['current_medications'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  id="current_medications" name="current_medications" rows="3" placeholder="Enter current medications..."><?php echo e(old('current_medications', $patient->current_medications)); ?></textarea>
                        <?php $__errorArgs = ['current_medications'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Insurance Information -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Insurance Information</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="insurance_provider" class="form-label">Insurance Provider (Optional)</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['insurance_provider'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="insurance_provider" name="insurance_provider" value="<?php echo e(old('insurance_provider', $patient->insurance_provider)); ?>" placeholder="Insurance provider">
                        <?php $__errorArgs = ['insurance_provider'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="insurance_number" class="form-label">Insurance Number (Optional)</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['insurance_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="insurance_number" name="insurance_number" value="<?php echo e(old('insurance_number', $patient->insurance_number)); ?>" placeholder="Insurance number">
                        <?php $__errorArgs = ['insurance_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Security</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password</label>
                        <div class="password-input">
                            <input type="password" class="form-input password <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="current_password" name="current_password" placeholder="Current password">
                            <button type="button" id="toggle-current-password" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="password-input">
                            <input type="password" class="form-input password <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="new_password" name="new_password" placeholder="New password">
                            <button type="button" id="toggle-new-password" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-text"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <div class="password-input">
                            <input type="password" class="form-input password"
                                   id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm new password">
                            <button type="button" id="toggle-confirm-password" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                <button type="submit" class="btn-primary flex-1 text-lg py-4">
                    <i class="fas fa-save mr-2"></i>
                    Update Profile
                </button>
                <a href="<?php echo e(route('patient.profile.index')); ?>" class="btn btn-secondary flex-1 text-lg py-4 text-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Profile
                </a>
            </div>
        </form>
    </div>
</div>
</div>

<script src="<?php echo e(asset('assets/js/philippine-addresses.js')); ?>"></script>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Philippine address dropdowns
    initializeAddressDropdowns();

    // Password toggle functionality
    const toggleCurrentPassword = document.getElementById('toggle-current-password');
    const toggleNewPassword = document.getElementById('toggle-new-password');
    const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
    const currentPasswordInput = document.getElementById('current_password');
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('new_password_confirmation');

    if (toggleCurrentPassword && currentPasswordInput) {
        toggleCurrentPassword.addEventListener('click', function() {
            const type = currentPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            currentPasswordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }

    if (toggleNewPassword && newPasswordInput) {
        toggleNewPassword.addEventListener('click', function() {
            const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            newPasswordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }

    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.patient', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iWellCare\resources\views/patient/profile/edit.blade.php ENDPATH**/ ?>