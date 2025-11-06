
<?php $__env->startSection('title', 'Prescriptions - iWellCare'); ?>
<?php $__env->startSection('page-title', 'Prescriptions'); ?>
<?php $__env->startSection('page-subtitle', 'Manage patient prescriptions and medications'); ?>
<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-blue-50/30 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Total Prescriptions</p>
                        <p class="text-3xl font-bold text-gray-900 mb-2"><?php echo e($prescriptions->total()); ?></p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            All Time
                        </span>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-pills text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Active Prescriptions</p>
                        <p class="text-3xl font-bold text-gray-900 mb-2"><?php echo e($prescriptions->filter(fn($p) => $p->status === 'active')->count()); ?></p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Completed</p>
                        <p class="text-3xl font-bold text-gray-900 mb-2"><?php echo e($prescriptions->filter(fn($p) => $p->status === 'completed')->count()); ?></p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            Completed
                        </span>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-clipboard-check text-white text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 flex items-center gap-3 shadow-md">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                <div class="font-medium"><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>

        <!-- Prescriptions List -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-xl">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                            <i class="fas fa-pills text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Prescriptions List</h3>
                            <p class="text-sm text-gray-600 mt-0.5">All patient prescriptions and medications</p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('admin.prescriptions.create')); ?>" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i> Create Prescription
                    </a>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="p-6 border-b border-gray-200 bg-gray-50">
                <form method="GET" action="<?php echo e(route('admin.prescriptions.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium text-sm mb-2">
                            <i class="fas fa-search text-gray-400 mr-1"></i>Search Patient
                        </label>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by patient name..." class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium text-sm mb-2">
                            <i class="fas fa-filter text-gray-400 mr-1"></i>Status
                        </label>
                        <select name="status" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                            <option value="">All Statuses</option>
                            <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                            <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                            <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium text-sm mb-2">
                            <i class="fas fa-calendar text-gray-400 mr-1"></i>Date From
                        </label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="form-input w-full px-4 py-2.5 bg-white border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                    </div>
                    <div class="md:col-span-3 flex gap-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-filter mr-2"></i>Apply Filters
                        </button>
                        <a href="<?php echo e(route('admin.prescriptions.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            <i class="fas fa-times mr-2"></i>Clear
                        </a>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Prescription #</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Patient</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Medications</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Prescribed Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-prescription text-white text-xs"></i>
                                        </div>
                                        <div class="font-semibold text-purple-600"><?php echo e($prescription->prescription_number ?? 'N/A'); ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <?php
                                            $patientName = $prescription->patient->first_name ?? 'N';
                                            $patientLastName = $prescription->patient->last_name ?? 'A';
                                            $patientEmail = $prescription->patient->email ?? '';
                                        ?>
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                            <?php echo e(strtoupper(substr($patientName, 0, 1))); ?><?php echo e(strtoupper(substr($patientLastName, 0, 1))); ?>

                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-medium text-gray-900">
                                                <?php echo e($patientName); ?> <?php echo e($patientLastName); ?>

                                            </div>
                                            <div class="text-xs text-gray-500 truncate"><?php echo e($patientEmail); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-user-md text-gray-400 text-xs"></i>
                                        <div>
                                            <div class="font-medium text-gray-900">
                                                Dr. <?php echo e($prescription->doctor->user->first_name ?? ''); ?> <?php echo e($prescription->doctor->user->last_name ?? ''); ?>

                                            </div>
                                            <div class="text-xs text-gray-500"><?php echo e($prescription->doctor->specialization ?? 'General'); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?php echo e($prescription->medications->first()->medication_name ?? 'N/A'); ?>

                                    </div>
                                    <?php if($prescription->medications->count() > 1): ?>
                                        <div class="text-xs text-gray-500">+<?php echo e($prescription->medications->count() - 1); ?> more</div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($prescription->status === 'active'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1.5"></i> Active
                                        </span>
                                    <?php elseif($prescription->status === 'completed'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                            <i class="fas fa-clipboard-check mr-1.5"></i> Completed
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1.5"></i> Cancelled
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($prescription->prescription_date): ?>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-calendar text-gray-400 text-xs"></i>
                                            <div>
                                                <div class="font-medium text-gray-900"><?php echo e(\Carbon\Carbon::parse($prescription->prescription_date)->format('M d, Y')); ?></div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a href="<?php echo e(route('admin.prescriptions.show', $prescription->id)); ?>" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <i class="fas fa-eye mr-1.5"></i> View
                                        </a>
                                        <a href="<?php echo e(route('admin.prescriptions.edit', $prescription->id)); ?>" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg text-white bg-purple-600 hover:bg-purple-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <i class="fas fa-edit mr-1.5"></i> Edit
                                        </a>
                                        <form action="<?php echo e(route('admin.prescriptions.destroy', $prescription->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this prescription?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                                                <i class="fas fa-trash mr-1.5"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-pills text-gray-400 text-2xl"></i>
                                        </div>
                                        <div class="text-lg font-semibold text-gray-700">No prescriptions found</div>
                                        <div class="text-sm text-gray-500">Create your first prescription to get started</div>
                                        <a href="<?php echo e(route('admin.prescriptions.create')); ?>" class="mt-2 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200">
                                            <i class="fas fa-plus mr-2"></i> Create Prescription
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($prescriptions->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <?php echo e($prescriptions->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iWellCare\resources\views/admin/prescriptions/index.blade.php ENDPATH**/ ?>