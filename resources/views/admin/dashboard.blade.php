@extends('layouts.admin')

@section('content')
<!-- Main Content -->
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Staff Metrics (styled like Staff Dashboard) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Staff -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total Staff</p>
                        <p class="text-white text-3xl font-bold">{{ $totalStaff }}</p>
                        <p class="text-blue-100 text-xs mt-1">Active: {{ $activeStaff }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-white/30 transition-all duration-300">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white/10 rounded-full group-hover:scale-110 transition-transform duration-300"></div>
        </div>

        <!-- Staff Appointments This Month -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 p-6 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium mb-1">Appointments This Month</p>
                        <p class="text-white text-3xl font-bold">{{ $staffAppointmentsThisMonth }}</p>
                        <p class="text-amber-100 text-xs mt-1">This week: {{ $staffAppointmentsThisWeek }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-white/30 transition-all duration-300">
                        <i class="fas fa-calendar-check text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white/10 rounded-full group-hover:scale-110 transition-transform duration-300"></div>
        </div>

        <!-- Staff Consultations This Month -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-rose-500 to-pink-500 p-6 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-rose-100 text-sm font-medium mb-1">Consultations This Month</p>
                        <p class="text-white text-3xl font-bold">{{ $staffConsultationsThisMonth }}</p>
                        <p class="text-rose-100 text-xs mt-1">This week: {{ $staffConsultationsThisWeek }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-white/30 transition-all duration-300">
                        <i class="fas fa-stethoscope text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white/10 rounded-full group-hover:scale-110 transition-transform duration-300"></div>
        </div>

        <!-- New Staff This Month -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 p-6 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium mb-1">New Staff This Month</p>
                        <p class="text-white text-3xl font-bold">{{ $newStaffThisMonth }}</p>
                        <p class="text-emerald-100 text-xs mt-1">This week: {{ $newStaffThisWeek }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-white/30 transition-all duration-300">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white/10 rounded-full group-hover:scale-110 transition-transform duration-300"></div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white shadow-lg rounded-xl p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <a href="{{ route('admin.staff.create') }}" class="group flex flex-col items-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition-all">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mb-2">
                    <i class="fas fa-user-plus text-white text-lg"></i>
                </div>
                <span class="text-green-900 font-semibold text-center text-sm">Add Staff</span>
            </a>

            <a href="{{ route('admin.consultations.create') }}" class="group flex flex-col items-center p-4 bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl hover:from-teal-100 hover:to-teal-200 transition-all">
                <div class="w-10 h-10 bg-teal-500 rounded-lg flex items-center justify-center mb-2">
                    <i class="fas fa-stethoscope text-white text-lg"></i>
                </div>
                <span class="text-teal-900 font-semibold text-center text-sm">New Consultation</span>
            </a>

            <a href="{{ route('admin.prescriptions.create') }}" class="group flex flex-col items-center p-4 bg-gradient-to-br from-cyan-50 to-cyan-100 rounded-xl hover:from-cyan-100 hover:to-cyan-200 transition-all">
                <div class="w-10 h-10 bg-cyan-500 rounded-lg flex items-center justify-center mb-2">
                    <i class="fas fa-prescription-bottle text-white text-lg"></i>
                </div>
                <span class="text-cyan-900 font-semibold text-center text-sm">Create Prescription</span>
            </a>

            <a href="{{ route('admin.inventory.create') }}" class="group flex flex-col items-center p-4 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl hover:from-emerald-100 hover:to-emerald-200 transition-all">
                <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center mb-2">
                    <i class="fas fa-boxes text-white text-lg"></i>
                </div>
                <span class="text-emerald-900 font-semibold text-center text-sm">Add Inventory</span>
            </a>

            <a href="{{ route('admin.doctor-availability.index') }}" class="group flex flex-col items-center p-4 bg-gradient-to-br from-violet-50 to-violet-100 rounded-xl hover:from-violet-100 hover:to-violet-200 transition-all">
                <div class="w-10 h-10 bg-violet-500 rounded-lg flex items-center justify-center mb-2">
                    <i class="fas fa-clock text-white text-lg"></i>
                </div>
                <span class="text-violet-900 font-semibold text-center text-sm">Doctor Availability</span>
            </a>

            <a href="{{ route('admin.invoice.create') }}" class="group flex flex-col items-center p-4 bg-gradient-to-br from-rose-50 to-rose-100 rounded-xl hover:from-rose-100 hover:to-rose-200 transition-all">
                <div class="w-10 h-10 bg-rose-500 rounded-lg flex items-center justify-center mb-2">
                    <i class="fas fa-plus-circle text-white text-lg"></i>
                </div>
                <span class="text-rose-900 font-semibold text-center text-sm">Create Invoice</span>
            </a>
        </div>
    </div>


</div>
@endsection