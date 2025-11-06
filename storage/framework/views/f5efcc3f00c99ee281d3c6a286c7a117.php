

<?php $__env->startSection('title', 'Patient Dashboard - iWellCare'); ?>
<?php $__env->startSection('page-title', 'Patient Dashboard'); ?>
<?php $__env->startSection('page-subtitle', 'Welcome back, ' . (auth()->user()->first_name ?? 'Patient') . '!'); ?>

<?php $__env->startSection('content'); ?>

<!-- Quick Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-6 lg:mb-8">
    <!-- Today's Appointments -->
    <div class="bg-white rounded-xl p-4 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Today's Appointments</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-900"><?php echo e($todaysAppointments); ?></p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-day text-blue-600"></i>
            </div>
        </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="bg-white rounded-xl p-4 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Upcoming</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-900"><?php echo e($upcomingAppointmentsCount); ?></p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-green-600"></i>
            </div>
        </div>
    </div>

    <!-- Pending Results -->
    <div class="bg-white rounded-xl p-4 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Pending Results</p>
                <p class="text-2xl lg:text-3xl font-bold text-gray-900"><?php echo e($pendingResults); ?></p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-flask text-yellow-600"></i>
            </div>
        </div>
    </div>

</div>

<!-- Main Dashboard Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mb-6 lg:mb-8">
    <!-- Left Column - Appointments & Activity -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Upcoming Appointments -->
        <div class="bg-white rounded-xl p-4 lg:p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg lg:text-xl font-semibold text-gray-900">Upcoming Appointments</h3>
                <a href="<?php echo e(route('patient.appointments.index')); ?>" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View all</a>
            </div>
            <?php if($upcomingAppointments && $upcomingAppointments->count() > 0): ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $upcomingAppointments->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-calendar text-blue-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 text-sm lg:text-base">
                                <?php echo e($appointment->doctor ? 'Dr. ' . $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name : 'Doctor'); ?>

                            </p>
                            <p class="text-gray-600 text-xs lg:text-sm">
                                <?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y')); ?> at <?php echo e(\Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A')); ?>

                            </p>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                            <?php if($appointment->status === 'confirmed'): ?> bg-green-100 text-green-700
                            <?php elseif($appointment->status === 'pending'): ?> bg-yellow-100 text-yellow-700
                            <?php else: ?> bg-gray-100 text-gray-700 <?php endif; ?>">
                            <?php echo e(ucfirst($appointment->status)); ?>

                        </span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-plus text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm lg:text-base mb-2">No upcoming appointments</p>
                    <a href="<?php echo e(route('patient.appointments.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Book Appointment
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Right Column - Quick Actions -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl p-4 lg:p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg lg:text-xl font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="<?php echo e(route('patient.appointments.create')); ?>" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors group">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-600 transition-colors">
                        <i class="fas fa-calendar-plus text-white"></i>
                    </div>
                    <div>
                        <p class="font-medium text-blue-900 text-sm">Book Appointment</p>
                        <p class="text-blue-700 text-xs">Schedule new consultation</p>
                    </div>
                </a>

                <a href="<?php echo e(route('patient.medical-records.index')); ?>" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors group">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-600 transition-colors">
                        <i class="fas fa-file-medical text-white"></i>
                    </div>
                    <div>
                        <p class="font-medium text-green-900 text-sm">Medical Records</p>
                        <p class="text-green-700 text-xs">View your history</p>
                    </div>
                </a>

                <a href="<?php echo e(route('patient.prescriptions.index')); ?>" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors group">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-600 transition-colors">
                        <i class="fas fa-pills text-white"></i>
                    </div>
                    <div>
                        <p class="font-medium text-purple-900 text-sm">Prescriptions</p>
                        <p class="text-purple-700 text-xs">Current medications</p>
                    </div>
                </a>

                <a href="<?php echo e(route('patient.invoice.index')); ?>" class="flex items-center p-3 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors group">
                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center mr-3 group-hover:bg-orange-600 transition-colors">
                        <i class="fas fa-receipt text-white"></i>
                    </div>
                    <div>
                        <p class="font-medium text-orange-900 text-sm">Invoices</p>
                        <p class="text-orange-700 text-xs">Payment history</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.patient', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iWellCare\resources\views/patient/dashboard.blade.php ENDPATH**/ ?>