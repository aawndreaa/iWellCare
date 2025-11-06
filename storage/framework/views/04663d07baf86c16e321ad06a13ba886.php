
<?php $__env->startSection('title', 'Invoice - iWellCare'); ?>
<?php $__env->startSection('page-title', 'Invoice & Payments'); ?>
<?php $__env->startSection('page-subtitle', 'Manage patient invoices and payment records'); ?>
<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-blue-50/30 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Total Invoices</p>
                        <p class="text-3xl font-bold text-gray-900 mb-2"><?php echo e($invoices->total()); ?></p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            All Time
                        </span>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-file-invoice-dollar text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Paid Invoices</p>
                        <p class="text-3xl font-bold text-gray-900 mb-2"><?php echo e($invoices->filter(fn($b) => $b->status === 'paid')->count()); ?></p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Completed
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
                        <p class="text-gray-600 text-sm font-medium mb-1">Unpaid Invoices</p>
                        <p class="text-3xl font-bold text-gray-900 mb-2"><?php echo e($invoices->filter(fn($b) => $b->status === 'unpaid')->count()); ?></p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
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

        <!-- Invoice List -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-xl">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                            <i class="fas fa-file-invoice-dollar text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Invoice List</h3>
                            <p class="text-sm text-gray-600 mt-0.5">All patient invoices and payment records</p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('admin.invoice.create')); ?>" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i> Create Invoice
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Invoice #</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Patient</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Appointment</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Payment Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-file-invoice text-white text-xs"></i>
                                        </div>
                                        <div class="font-semibold text-indigo-600"><?php echo e($invoice->invoice_no ?? 'INV-' . str_pad($invoice->id, 6, '0', STR_PAD_LEFT)); ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                                            <?php echo e(strtoupper(substr($invoice->patient->user->first_name ?? $invoice->patient->first_name ?? '-', 0, 1))); ?>

                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-medium text-gray-900">
                                                <?php echo e($invoice->patient->user->first_name ?? $invoice->patient->first_name ?? '-'); ?> <?php echo e($invoice->patient->user->last_name ?? $invoice->patient->last_name ?? ''); ?>

                                            </div>
                                            <div class="text-xs text-gray-500 truncate"><?php echo e($invoice->patient->user->email ?? $invoice->patient->email ?? ''); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($invoice->appointment): ?>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-calendar text-gray-400 text-xs"></i>
                                            <div>
                                                <div class="font-medium text-gray-900"><?php echo e($invoice->appointment->appointment_date->format('M d, Y')); ?></div>
                                                <div class="text-xs text-gray-500"><?php echo e($invoice->appointment->appointment_time->format('h:i A')); ?></div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-lg text-gray-900">₱<?php echo e(number_format($invoice->grand_total ?? $invoice->total_amount ?? $invoice->amount ?? 0, 2)); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($invoice->status === 'paid'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1.5"></i> Paid
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1.5"></i> Unpaid
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($invoice->payment_date): ?>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-calendar-check text-gray-400 text-xs"></i>
                                            <div>
                                                <div class="font-medium text-gray-900"><?php echo e(\Carbon\Carbon::parse($invoice->payment_date)->format('M d, Y')); ?></div>
                                                <div class="text-xs text-gray-500"><?php echo e(\Carbon\Carbon::parse($invoice->payment_date)->format('h:i A')); ?></div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <?php if($invoice->status === 'unpaid'): ?>
                                            <a href="<?php echo e(route('admin.invoice.mark-as-paid', $invoice->id)); ?>"
                                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors duration-200 shadow-sm hover:shadow-md"
                                               onclick="return confirm('Mark this invoice as paid?')">
                                                <i class="fas fa-check mr-1.5"></i> Mark Paid
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('admin.invoice.generate-pdf', $invoice->id)); ?>"
                                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <i class="fas fa-file-pdf mr-1.5"></i> PDF
                                        </a>
                                        <a href="<?php echo e(route('admin.invoice.generate-pdf', [$invoice->id, 'print' => 1])); ?>" target="_blank"
                                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg text-gray-700 bg-gray-100 hover:bg-gray-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <i class="fas fa-print mr-1.5"></i> Print
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-file-invoice text-gray-400 text-2xl"></i>
                                        </div>
                                        <div class="text-lg font-semibold text-gray-700">No invoices found</div>
                                        <div class="text-sm text-gray-500">Create your first invoice to get started</div>
                                        <a href="<?php echo e(route('admin.invoice.create')); ?>" class="mt-2 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200">
                                            <i class="fas fa-plus mr-2"></i> Create Invoice
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($invoices->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <?php echo e($invoices->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iWellCare\resources\views/admin/invoice/index.blade.php ENDPATH**/ ?>