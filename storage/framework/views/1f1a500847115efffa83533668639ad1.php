
<?php $__env->startSection('title', 'Create Invoice - iWellCare'); ?>
<?php $__env->startSection('page-title', 'Create Invoice'); ?>
<?php $__env->startSection('page-subtitle', 'Generate a new patient invoice'); ?>
<?php $__env->startSection('content'); ?>

<div class="billing-content min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-blue-50/30 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="card p-4 md:p-6 bg-white rounded-xl border border-gray-200 shadow-xl">

        <form action="<?php echo e(route('staff.invoice.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <!-- Billing Details Section -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
                <!-- Left Column - Invoice Form -->
                <div class="space-y-6">
                    <!-- Patient Information Section -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50/50 rounded-xl p-4 md:p-5 border border-green-200 shadow-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-800">Patient Information</h4>
                                <p class="text-xs text-gray-600">Select patient and appointment details</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-semibold text-sm mb-2">
                                    <i class="fas fa-user-circle text-green-600 mr-1"></i>Patient <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                                    <select name="patient_id" class="form-input w-full pl-10 pr-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">Select Patient</option>
                                        <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($patient && $patient->user): ?>
                                                <option value="<?php echo e($patient->id); ?>" <?php echo e(old('patient_id') == $patient->id ? 'selected' : ''); ?>>
                                                    <?php echo e($patient->user->first_name ?? $patient->first_name ?? ''); ?> <?php echo e($patient->user->last_name ?? $patient->last_name ?? ''); ?> (<?php echo e($patient->user->email ?? $patient->email ?? 'No email'); ?>)
                                                </option>
                                            <?php elseif($patient): ?>
                                                <option value="<?php echo e($patient->id); ?>" <?php echo e(old('patient_id') == $patient->id ? 'selected' : ''); ?>>
                                                    <?php echo e($patient->first_name ?? ''); ?> <?php echo e($patient->last_name ?? ''); ?> (<?php echo e($patient->email ?? 'No email'); ?>)
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                    </p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold text-sm mb-2">
                                    <i class="fas fa-calendar-check text-blue-600 mr-1"></i>Appointment (Optional)
                                </label>
                                <div class="relative">
                                    <i class="fas fa-calendar absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                                    <select name="appointment_id" class="form-input w-full pl-10 pr-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 <?php $__errorArgs = ['appointment_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">No appointment linked</option>
                                        <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($appointment->id); ?>" <?php echo e(old('appointment_id') == $appointment->id ? 'selected' : ''); ?>>
                                                <?php echo e($appointment->appointment_date->format('M d, Y h:i A')); ?> - <?php echo e($appointment->patient->first_name ?? ''); ?> <?php echo e($appointment->patient->last_name ?? ''); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['appointment_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                    </p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                <!-- Right Column - Invoice Preview -->
                <div class="xl:sticky xl:top-6 h-fit">
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 md:p-5 border border-gray-300 shadow-lg">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                                <i class="fas fa-eye text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-800">Invoice Preview</h4>
                                <p class="text-xs text-gray-600">Live preview of your invoice</p>
                            </div>
                        </div>
                    <div class="bg-white rounded-lg p-4 border-2 border-gray-200 shadow-inner max-h-[600px] overflow-y-auto">
                        <div class="text-center mb-4" style="font-family: Arial, sans-serif; font-size: 11px; line-height: 1.2;">
                            <h5 style="font-size: 13px; margin: 0; font-weight: bold;">ADULT WELLNESS CLINIC & MEDICAL LABORATORY</h5>
                            <p style="margin: 2px 0; font-size: 10px;">40 Capitulacion St., Zone 2, Pob. (Consillman), 2800 Bangued (Capital), Abra</p>
                            <p style="margin: 2px 0; font-size: 10px;">AUGUSTUS CAESAR BUTCH B. BIGORNIA - Prop. | Non-VAT Reg. TIN: 248-390-356-00000</p>
                            <h6 style="margin: 4px 0; font-size: 12px; text-decoration: underline; font-weight: bold;">SERVICE INVOICE</h6>
                            <p style="margin: 2px 0;"><strong>No.</strong> <span id="preview-invoice-no"><?php echo e('INV-' . date('Y') . '-0001'); ?></span> &nbsp;&nbsp;&nbsp; <strong>Date:</strong> <span id="preview-date"><?php echo e(date('M d, Y')); ?></span></p>
                        </div>

                        <table style="width: 100%; font-size: 11px; margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 2px 4px;"><strong>Sold To:</strong> <span id="preview-patient">Select patient</span></td>
                                <td style="padding: 2px 4px;"><strong>TIN:</strong> <span id="preview-tin"></span></td>
                            </tr>
                            <tr>
                                <td style="padding: 2px 4px;"><strong>Address:</strong> <span id="preview-address"></span></td>
                                <td style="padding: 2px 4px;"><strong>ID No.:</strong> <span id="preview-id-no"></span></td>
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
                                    <td style="border: 1px solid #000; padding: 4px;" id="preview-consultation-unit">₱0.00</td>
                                    <td style="border: 1px solid #000; padding: 4px;" id="preview-consultation">₱0.00</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; padding: 4px;">1</td>
                                    <td style="border: 1px solid #000; padding: 4px;">Medication Fee</td>
                                    <td style="border: 1px solid #000; padding: 4px;" id="preview-medication-unit">₱0.00</td>
                                    <td style="border: 1px solid #000; padding: 4px;" id="preview-medication">₱0.00</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; padding: 4px;">1</td>
                                    <td style="border: 1px solid #000; padding: 4px;">Laboratory Fee</td>
                                    <td style="border: 1px solid #000; padding: 4px;" id="preview-laboratory-unit">₱0.00</td>
                                    <td style="border: 1px solid #000; padding: 4px;" id="preview-laboratory">₱0.00</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; padding: 4px;">1</td>
                                    <td style="border: 1px solid #000; padding: 4px;">Other Fees</td>
                                    <td style="border: 1px solid #000; padding: 4px;" id="preview-other-unit">₱0.00</td>
                                    <td style="border: 1px solid #000; padding: 4px;" id="preview-other">₱0.00</td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="width: 45%; float: right; margin-top: 5px; font-size: 11px;">
                            <tr><td>Total Sales</td><td style="text-align: right;" id="preview-total-sales">₱0.00</td></tr>
                            <tr><td>Less: SC/PWD/NAAC/SP Disc.</td><td style="text-align: right;" id="preview-discount">₱0.00</td></tr>
                            <tr><td><strong>Total Due</strong></td><td style="text-align: right;"><strong id="preview-total-due">₱0.00</strong></td></tr>
                            <tr><td>Less: Withholding</td><td style="text-align: right;">₱0.00</td></tr>
                            <tr><td><strong>Total Amount Due</strong></td><td style="text-align: right;"><strong id="preview-amount-due">₱0.00</strong></td></tr>
                        </table>

                        <div style="clear: both;"></div>

                        <div style="font-size: 11px; margin-top: 6px;">
                            <strong>Payment Method:</strong><br>
                            <input type="checkbox" id="preview-cash" disabled> Cash
                            <input type="checkbox" id="preview-check" disabled> Check
                            <input type="checkbox" id="preview-credit" disabled> Credit
                        </div>

                        <div style="text-align: right; margin-top: 15px; font-size: 10px;">
                            _______________________________<br>
                            <em id="representative-name"><?php echo e(auth()->user()->first_name ?? 'Staff'); ?> <?php echo e(auth()->user()->last_name ?? 'Member'); ?></em><br>
                            <em>Cashier / Authorized Representative</em>
                        </div>

                        <div style="font-size: 9px; margin-top: 8px;">
                            <p>Sale(s) Subject to PT. Exempt Sales<br>
                            OCN: 007AU20240000001188 | DATE OF ATP: May 14, 2024</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information Section -->
            <div class="bg-white rounded-xl p-5 md:p-6 border border-gray-200 shadow-lg">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-credit-card text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-800">Payment Information</h4>
                    </div>
                </div>

                <!-- Fees Section -->
                <div class="mb-6">
                    <h5 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-money-bill-wave text-green-600"></i>
                        Service Fees
                    </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Consultation Fee -->
                        <div>
                            <label class="block text-gray-700 font-medium text-sm mb-2">
                                Consultation Fee (₱) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-stethoscope text-gray-400"></i>
                                </div>
                                <input type="number" name="consultation_fee" class="form-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:bg-white transition-all duration-200 <?php $__errorArgs = ['consultation_fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       min="0" step="0.01" value="<?php echo e(old('consultation_fee')); ?>" placeholder="0.00" required>
                            </div>
                            <?php $__errorArgs = ['consultation_fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Medication Fee -->
                        <div>
                            <label class="block text-gray-700 font-medium text-sm mb-2">
                                Medication Fee (₱)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-pills text-gray-400"></i>
                                </div>
                                <input type="number" name="medication_fee" class="form-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:bg-white transition-all duration-200 <?php $__errorArgs = ['medication_fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       min="0" step="0.01" value="<?php echo e(old('medication_fee')); ?>" placeholder="0.00">
                            </div>
                            <?php $__errorArgs = ['medication_fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Laboratory Fee -->
                        <div>
                            <label class="block text-gray-700 font-medium text-sm mb-2">
                                Laboratory Fee (₱)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-flask text-gray-400"></i>
                                </div>
                                <input type="number" name="laboratory_fee" class="form-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:bg-white transition-all duration-200 <?php $__errorArgs = ['laboratory_fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       min="0" step="0.01" value="<?php echo e(old('laboratory_fee')); ?>" placeholder="0.00">
                            </div>
                            <?php $__errorArgs = ['laboratory_fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Other Fees -->
                        <div>
                            <label class="block text-gray-700 font-medium text-sm mb-2">
                                Other Fees (₱)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-plus-circle text-gray-400"></i>
                                </div>
                                <input type="number" name="other_fees" class="form-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:bg-white transition-all duration-200 <?php $__errorArgs = ['other_fees'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       min="0" step="0.01" value="<?php echo e(old('other_fees')); ?>" placeholder="0.00">
                            </div>
                            <?php $__errorArgs = ['other_fees'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Discount Section -->
                <div class="mb-6">
                    <h5 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-tag text-indigo-600"></i>
                        Discount
                    </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Discount Percentage -->
                        <div class="sm:col-span-1">
                            <label class="block text-gray-700 font-medium text-sm mb-2">
                                Discount Percentage (%)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-percent text-gray-400"></i>
                                </div>
                                <input type="number" name="discount_percentage" id="discount_percentage" class="form-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:bg-white transition-all duration-200 <?php $__errorArgs = ['discount_percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       min="0" max="100" step="0.01" value="<?php echo e(old('discount_percentage')); ?>" placeholder="0.00">
                            </div>
                            <p class="text-xs text-gray-500 mt-1.5">
                                SC/PWD/NAAC/SP Discount
                            </p>
                            <input type="hidden" name="less_sc" id="less_sc" value="">
                            <?php $__errorArgs = ['discount_percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Payment Details Section -->
                <div>
                    <h5 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle text-blue-600"></i>
                        Payment Details
                    </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Payment Status -->
                        <div>
                            <label class="block text-gray-700 font-medium text-sm mb-2">
                                Payment Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-check-circle text-gray-400"></i>
                                </div>
                                <select name="status" class="form-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:bg-white transition-all duration-200 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <option value="">Select Status</option>
                                    <option value="paid" <?php echo e(old('status') == 'paid' ? 'selected' : ''); ?>>Paid</option>
                                    <option value="unpaid" <?php echo e(old('status') == 'unpaid' ? 'selected' : ''); ?>>Unpaid</option>
                                </select>
                            </div>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Payment Date -->
                        <div>
                            <label class="block text-gray-700 font-medium text-sm mb-2">
                                Payment Date <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-day text-gray-400"></i>
                                </div>
                                <input type="date" name="payment_date" class="form-input w-full pl-10 pr-4 py-2.5 bg-gray-50 border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:bg-white transition-all duration-200 <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e(old('payment_date')); ?>" required>
                            </div>
                            <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i><?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 mt-6 pt-6 border-t-2 border-gray-200">
                <a href="<?php echo e(route('staff.invoice.index')); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md order-2 sm:order-1">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 order-1 sm:order-2">
                    <i class="fas fa-save mr-2"></i>Create Invoice
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to generate next invoice number
    function generateNextInvoiceNumber() {
        const year = new Date().getFullYear();
        // For preview, we'll show the next number (this would be calculated server-side)
        return 'INV-' + year + '-0001';
    }

    // Function to update invoice preview
    function updateInvoicePreview() {
        // Get form values
        const patientSelect = document.querySelector('select[name="patient_id"]');
        const consultationFee = parseFloat(document.querySelector('input[name="consultation_fee"]').value) || 0;
        const medicationFee = parseFloat(document.querySelector('input[name="medication_fee"]').value) || 0;
        const laboratoryFee = parseFloat(document.querySelector('input[name="laboratory_fee"]').value) || 0;
        const otherFees = parseFloat(document.querySelector('input[name="other_fees"]').value) || 0;
        const discountPercentage = parseFloat(document.querySelector('input[name="discount_percentage"]').value) || 0;
        const statusSelect = document.querySelector('select[name="status"]');

        // Calculate total sales first
        const totalSales = consultationFee + medicationFee + laboratoryFee + otherFees;
        
        // Calculate discount amount from percentage
        const discount = totalSales * (discountPercentage / 100);
        
        // Update hidden field for form submission (set to empty if discount is 0)
        const lessScField = document.getElementById('less_sc');
        if (lessScField) {
            lessScField.value = discount > 0 ? discount.toFixed(2) : '';
        }

        // Update invoice number (preview)
        document.getElementById('preview-invoice-no').textContent = generateNextInvoiceNumber();

        // Update patient name
        const selectedOption = patientSelect.options[patientSelect.selectedIndex];
        const patientName = selectedOption ? selectedOption.text.split(' (')[0] : 'Select patient';
        document.getElementById('preview-patient').textContent = patientName;

        // Update fees (both unit cost and amount are the same for single quantity items)
        document.getElementById('preview-consultation-unit').textContent = '₱' + consultationFee.toFixed(2);
        document.getElementById('preview-consultation').textContent = '₱' + consultationFee.toFixed(2);
        document.getElementById('preview-medication-unit').textContent = '₱' + medicationFee.toFixed(2);
        document.getElementById('preview-medication').textContent = '₱' + medicationFee.toFixed(2);
        document.getElementById('preview-laboratory-unit').textContent = '₱' + laboratoryFee.toFixed(2);
        document.getElementById('preview-laboratory').textContent = '₱' + laboratoryFee.toFixed(2);
        document.getElementById('preview-other-unit').textContent = '₱' + otherFees.toFixed(2);
        document.getElementById('preview-other').textContent = '₱' + otherFees.toFixed(2);

        // Calculate and update totals (totalSales already calculated above)
        const totalDue = totalSales - discount; // Total after discount
        const totalAmountDue = totalDue; // After withholding (currently 0)
        
        document.getElementById('preview-total-sales').textContent = '₱' + totalSales.toFixed(2);
        document.getElementById('preview-discount').textContent = '₱' + discount.toFixed(2);
        document.getElementById('preview-total-due').textContent = '₱' + totalDue.toFixed(2);
        document.getElementById('preview-amount-due').textContent = '₱' + totalAmountDue.toFixed(2);

        // Update payment method checkboxes based on status
        const cashCheckbox = document.getElementById('preview-cash');
        const checkCheckbox = document.getElementById('preview-check');
        const creditCheckbox = document.getElementById('preview-credit');

        // Reset all checkboxes
        cashCheckbox.checked = false;
        checkCheckbox.checked = false;
        creditCheckbox.checked = false;

        // Set checkbox based on status (assuming paid = cash, unpaid = credit)
        if (statusSelect.value === 'paid') {
            cashCheckbox.checked = true;
        } else {
            creditCheckbox.checked = true;
        }
    }

    // Add event listeners to form inputs
    document.querySelectorAll('input[name="consultation_fee"], input[name="medication_fee"], input[name="laboratory_fee"], input[name="other_fees"], input[name="discount_percentage"], select[name="patient_id"], select[name="status"]').forEach(function(element) {
        element.addEventListener('input', updateInvoicePreview);
        element.addEventListener('change', updateInvoicePreview);
    });

    // Initial preview update
    updateInvoicePreview();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.staff', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iWellCare\resources\views/staff/invoice/create.blade.php ENDPATH**/ ?>