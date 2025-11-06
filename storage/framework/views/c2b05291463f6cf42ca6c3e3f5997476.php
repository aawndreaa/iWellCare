

<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* Hide the entire footer on registration page - multiple selectors for reliability */
    footer,
    footer[class*="bg-gradient-to-r"],
    .bg-gradient-to-r.from-gray-900.to-gray-800.text-white,
    body > footer,
    div.footer,
    .footer {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
    }

    /* Test element to confirm CSS is loading */
    .css-test {
        display: none;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .register-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        padding: clamp(1.5rem, 4vw, 2.5rem);
        width: 100%;
        max-width: min(95vw, 1000px);
        margin: 0 auto;
    }

    .register-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .register-title {
        font-size: clamp(1.5rem, 4vw, 2rem);
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .register-subtitle {
        color: #6b7280;
        font-size: clamp(0.875rem, 2vw, 1rem);
    }

    .section-divider {
        border-top: 1px solid #e5e7eb;
        margin: 2.25rem 0 1.75rem 0;
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
        top: -0.6875rem;
        display: inline-block;
        letter-spacing: 0.025em;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
        margin-bottom: 0.5rem;
    }

    /* Responsive grid - structured layout */
    @media (min-width: 640px) {
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .form-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
    }

    .account-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
        margin-bottom: 0.5rem;
    }

    /* Account grid - structured 2x2 layout */
    @media (min-width: 640px) {
        .account-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s ease;
        background: white;
        box-sizing: border-box;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input::placeholder {
        color: #9ca3af;
    }

    .password-input {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        font-size: 1.1rem;
    }

    .password-toggle:hover {
        color: #6b7280;
        background: rgba(0, 0, 0, 0.05);
    }

    .form-input.password {
        padding-right: 3.5rem;
    }

    .checkbox-container {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin: 2rem 0 1.5rem 0;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .checkbox-input {
        width: 1.25rem;
        height: 1.25rem;
        accent-color: #3b82f6;
        margin-top: 0.125rem;
        cursor: pointer;
    }

    .checkbox-label {
        font-size: 0.875rem;
        color: #374151;
        line-height: 1.5;
        flex: 1;
    }

    .checkbox-label a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .checkbox-label a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .links-section {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }

    .link-text {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .link-text a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .link-text a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .error-text {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    /* Mobile optimizations */
    @media (max-width: 640px) {
        .register-wrapper {
            padding: 1rem 0.75rem;
            align-items: flex-start;
            padding-top: 1.5rem;
        }

        .register-card {
            padding: 1.5rem;
            margin: 0;
            border-radius: 12px;
            max-width: 100%;
        }

        .register-header {
            margin-bottom: 1.5rem;
        }

        .register-title {
            font-size: 1.5rem;
            margin-bottom: 0.375rem;
        }

        .register-subtitle {
            font-size: 0.875rem;
        }

        .section-divider {
            margin: 2rem 0 1.25rem 0;
        }

        .form-grid,
        .account-grid {
            gap: 1rem;
            grid-template-columns: 1fr;
        }

        .form-group {
            margin-bottom: 0.75rem;
        }

        .form-label {
            margin-bottom: 0.375rem;
            font-size: 0.875rem;
        }

        .form-input,
        .form-select {
            font-size: 16px; /* Prevents zoom on iOS */
            padding: 0.875rem 1rem;
        }

        .form-input.password {
            padding-right: 3.5rem;
        }

        .password-toggle {
            right: 1rem;
            font-size: 1.1rem;
        }

        .checkbox-container {
            padding: 1rem;
            margin: 1.75rem 0 1.25rem 0;
            gap: 0.625rem;
        }

        .checkbox-input {
            margin-top: 0.125rem;
        }

        .btn-submit {
            padding: 1rem 1.25rem;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .links-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
        }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .form-input,
        .form-select,
        .btn-submit,
        .checkbox-input {
            -webkit-tap-highlight-color: transparent;
        }

        .btn-submit:hover {
            transform: none;
        }

        .form-input:focus,
        .form-select:focus {
            transform: none;
        }
    }
</style>

<div class="register-wrapper">
    <div class="register-card">
        <div class="register-header">
            <h1 class="register-title">Create Account</h1>
            <p class="register-subtitle">Join our healthcare community</p>
        </div>

        <form method="POST" action="<?php echo e(route('register')); ?>">
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
                               id="first_name" name="first_name" value="<?php echo e(old('first_name')); ?>" placeholder="First name" required>
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
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="middle_name" name="middle_name" value="<?php echo e(old('middle_name')); ?>" placeholder="Middle name">
                        <?php $__errorArgs = ['middle_name'];
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
                               id="last_name" name="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="Last name" required>
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
                        <label for="phone_number" class="form-label">Phone Number *</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="phone_number" name="phone_number" value="<?php echo e(old('phone_number')); ?>" placeholder="Phone number" required>
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
                        <label for="date_of_birth" class="form-label">Date of Birth *</label>
                        <input type="date" class="form-input <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="date_of_birth" name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" max="<?php echo e(date('Y-m-d', strtotime('-1 day'))); ?>" required>
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
                            <option value="male" <?php echo e(old('gender') == 'male' ? 'selected' : ''); ?>>Male</option>
                            <option value="female" <?php echo e(old('gender') == 'female' ? 'selected' : ''); ?>>Female</option>
                            <option value="other" <?php echo e(old('gender') == 'other' ? 'selected' : ''); ?>>Other</option>
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
                        <label for="blood_type" class="form-label">Blood Type</label>
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
                            <option value="A+" <?php echo e(old('blood_type') == 'A+' ? 'selected' : ''); ?>>A+</option>
                            <option value="A-" <?php echo e(old('blood_type') == 'A-' ? 'selected' : ''); ?>>A-</option>
                            <option value="B+" <?php echo e(old('blood_type') == 'B+' ? 'selected' : ''); ?>>B+</option>
                            <option value="B-" <?php echo e(old('blood_type') == 'B-' ? 'selected' : ''); ?>>B-</option>
                            <option value="AB+" <?php echo e(old('blood_type') == 'AB+' ? 'selected' : ''); ?>>AB+</option>
                            <option value="AB-" <?php echo e(old('blood_type') == 'AB-' ? 'selected' : ''); ?>>AB-</option>
                            <option value="O+" <?php echo e(old('blood_type') == 'O+' ? 'selected' : ''); ?>>O+</option>
                            <option value="O-" <?php echo e(old('blood_type') == 'O-' ? 'selected' : ''); ?>>O-</option>
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

            <!-- Account Credentials -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Account Credentials</span>
                </div>

                <div class="account-grid">
                    <div class="form-group">
                        <label for="username" class="form-label">Username *</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="username" name="username" value="<?php echo e(old('username')); ?>" placeholder="Choose username" required>
                        <?php $__errorArgs = ['username'];
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
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email address" required>
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
                        <label for="password" class="form-label">Password *</label>
                        <div class="password-input">
                            <input type="password" class="form-input password <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="password" name="password" placeholder="Create password" required>
                            <button type="button" id="toggle-password" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <?php $__errorArgs = ['password'];
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
                        <label for="password_confirmation" class="form-label">Confirm Password *</label>
                        <div class="password-input">
                            <input type="password" class="form-input password"
                                    id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                            <button type="button" id="toggle-password-confirmation" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
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
                        <label for="street_address" class="form-label">Street Address/Sitio *</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['street_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="street_address" name="street_address" value="<?php echo e(old('street_address')); ?>" placeholder="Street address or sitio" required>
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
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-input <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="postal_code" name="postal_code" value="<?php echo e(old('postal_code')); ?>" placeholder="Postal code">
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

                <div class="checkbox-container">
                    <input class="checkbox-input" type="checkbox" name="terms" id="terms" required disabled>
                    <label class="checkbox-label" for="terms">
                        I have read and agree to the <a href="#" id="terms-link">Terms and Conditions</a>
                    </label>
                </div>

                <!-- Terms Modal -->
                <div id="terms-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
                        <div class="flex items-center justify-between p-6 border-b">
                            <h2 class="text-2xl font-bold text-gray-900">Terms and Conditions</h2>
                            <div class="flex items-center space-x-4">
                                <div class="text-sm text-gray-600">
                                    <span id="reading-progress">0%</span> read
                                </div>
                                <button id="close-terms-modal" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="terms-content" class="p-6 overflow-y-auto max-h-[calc(90vh-200px)]">
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">1. Acceptance of Terms</h3>
                                    <p class="text-gray-700">By accessing and using the iWellCare website and services, you accept and agree to be bound by the terms and provision of this agreement.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">2. Description of Service</h3>
                                    <p class="text-gray-700">iWellCare provides healthcare services including medical consultations, laboratory services, pharmacy services, and emergency care.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">3. Medical Disclaimer</h3>
                                    <p class="text-gray-700">The information provided on this website is for general informational purposes only and should not be considered as medical advice.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">4. User Responsibilities</h3>
                                    <p class="text-gray-700">As a user of our services, you are responsible for providing accurate information, arriving on time for appointments, following medical advice, and respecting clinic policies.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">5. Appointment Cancellation Policy</h3>
                                    <p class="text-gray-700">We require at least 24 hours notice for appointment cancellations. Late cancellations or no-shows may result in a cancellation fee.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">6. Payment Terms</h3>
                                    <p class="text-gray-700">Payment is due at the time of service unless other arrangements have been made. We accept cash, credit cards, insurance, and other arrangements.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">7. Privacy & Confidentiality</h3>
                                    <p class="text-gray-700">We are committed to protecting your privacy and maintaining the confidentiality of your medical information.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">8. Limitation of Liability</h3>
                                    <p class="text-gray-700">iWellCare shall not be liable for indirect, incidental, special, consequential, or punitive damages.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">9. Changes to Terms</h3>
                                    <p class="text-gray-700">We reserve the right to modify these terms. Continued use constitutes acceptance of changes.</p>
                                </div>

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">10. Governing Law</h3>
                                    <p class="text-gray-700">These terms are governed by the laws of the Philippines and applicable healthcare regulations.</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 border-t bg-gray-50">
                            <div class="text-center">
                                <div class="text-sm text-gray-600 mb-4">
                                    Please scroll through and read the entire terms and conditions before agreeing.
                                </div>
                                <button id="accept-terms" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed text-lg shadow-lg" disabled>
                                    I Have Read and Agree
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Create Account
                </button>

                <div class="links-section">
                    <p class="link-text">
                        Already have an account? <a href="<?php echo e(route('login')); ?>">Sign in here</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/philippine-addresses.js')); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Philippine address selection
    initializeAddressSelection();
    // Password toggle functionality
    const togglePassword = document.getElementById('toggle-password');
    const togglePasswordConfirmation = document.getElementById('toggle-password-confirmation');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');

    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }

    if (togglePasswordConfirmation) {
        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }

    // Password confirmation matching
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmation = passwordConfirmationInput.value;
        const matchElement = document.getElementById('password-match');

        if (confirmation && matchElement) {
            matchElement.classList.remove('hidden');
            const indicator = document.getElementById('password-match-indicator');
            const icon = indicator.querySelector('i');
            const text = indicator.querySelector('span');

            if (password === confirmation && password.length > 0) {
                icon.className = 'fas fa-check-circle text-green-500';
                text.className = 'text-green-600';
                text.textContent = 'Passwords match';
            } else {
                icon.className = 'fas fa-times-circle text-red-500';
                text.className = 'text-red-600';
                text.textContent = 'Passwords do not match';
            }
        } else if (matchElement) {
            matchElement.classList.add('hidden');
        }
    }

    if (passwordConfirmationInput) {
        passwordConfirmationInput.addEventListener('input', checkPasswordMatch);
    }
    if (passwordInput) {
        passwordInput.addEventListener('input', checkPasswordMatch);
    }

    // Modal functionality
    const termsLink = document.getElementById('terms-link');
    const termsModal = document.getElementById('terms-modal');
    const closeTermsModal = document.getElementById('close-terms-modal');
    const termsContent = document.getElementById('terms-content');
    const acceptTermsBtn = document.getElementById('accept-terms');
    const readingProgress = document.getElementById('reading-progress');
    const termsCheckbox = document.getElementById('terms');

    let hasReadTerms = false;

    if (termsLink && termsModal) {
        termsLink.addEventListener('click', function(e) {
            e.preventDefault();
            termsModal.classList.remove('hidden');
            // Reset reading state when opening modal
            hasReadTerms = false;
            if (acceptTermsBtn) acceptTermsBtn.disabled = true;
            if (readingProgress) readingProgress.textContent = '0%';
        });
    }

    if (closeTermsModal && termsModal) {
        closeTermsModal.addEventListener('click', function() {
            termsModal.classList.add('hidden');
        });
    }

    // Close modal when clicking outside
    if (termsModal) {
        termsModal.addEventListener('click', function(e) {
            if (e.target === termsModal) {
                termsModal.classList.add('hidden');
            }
        });
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && termsModal && !termsModal.classList.contains('hidden')) {
            termsModal.classList.add('hidden');
        }
    });

    // Reading progress tracking
    if (termsContent && readingProgress && acceptTermsBtn) {
        termsContent.addEventListener('scroll', function() {
            const scrollTop = termsContent.scrollTop;
            const scrollHeight = termsContent.scrollHeight - termsContent.clientHeight;
            const scrollPercentage = Math.min((scrollTop / scrollHeight) * 100, 100);

            readingProgress.textContent = Math.round(scrollPercentage) + '%';

            // Enable accept button when user has scrolled through 90% of content
            if (scrollPercentage >= 90 && !hasReadTerms) {
                hasReadTerms = true;
                acceptTermsBtn.disabled = false;
                acceptTermsBtn.textContent = 'I Have Read and Agree';
            }
        });

        // Accept terms button functionality
        acceptTermsBtn.addEventListener('click', function() {
            if (hasReadTerms) {
                termsModal.classList.add('hidden');
                if (termsCheckbox) {
                    termsCheckbox.checked = true;
                    termsCheckbox.disabled = false; // Enable the checkbox after reading
                }
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iWellCare\resources\views/auth/register.blade.php ENDPATH**/ ?>