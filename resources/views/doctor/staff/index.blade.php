@extends('layouts.admin')

@section('title', 'Staff Management')

@section('content')
@php
use App\Models\User;
@endphp
@include('doctor.staff.partials.alert-modal')

<script src="{{ asset('assets/js/real-time-service.js') }}"></script>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40" style="display: none;">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-2" id="modalTitle">Confirm Action</h3>
            <p class="text-gray-600" id="modalMessage">Are you sure you want to perform this action?</p>
        </div>
        <div class="flex justify-end space-x-3">
            <button onclick="closeConfirmationModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-400 transition">
                Cancel
            </button>
            <button onclick="executeConfirmedAction()" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
                Confirm
            </button>
        </div>
    </div>
</div>

<script>
let currentActionForm = null;

function showConfirmationModal(title, message, form) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    currentActionForm = form;
    document.getElementById('confirmationModal').style.display = 'flex';
}

function closeConfirmationModal() {
    document.getElementById('confirmationModal').style.display = 'none';
    currentActionForm = null;
}

function executeConfirmedAction() {
    if (currentActionForm) {
        currentActionForm.submit();
    }
    closeConfirmationModal();
}
</script>

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Staff Management</h1>
        <a href="{{ route('doctor.staff.create') }}" class="btn-primary">
            <i class="fas fa-plus mr-2"></i>Add New Staff
        </a>
    </div>

    <!-- Filter Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <a href="?filter=all&t={{ time() }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ !request('filter') || request('filter') === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    All Staff ({{ $totalStaff ?? 0 }})
                </a>
                <a href="?filter=active&t={{ time() }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('filter') === 'active' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Active ({{ $activeStaff ?? 0 }})
                </a>
                <a href="?filter=inactive&t={{ time() }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('filter') === 'inactive' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Inactive ({{ $inactiveStaff ?? 0 }})
                </a>
                <a href="?filter=archived&t={{ time() }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('filter') === 'archived' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Archived ({{ $archivedCount ?? 0 }})
                </a>
            </nav>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Staff</p>
                    <p class="text-2xl font-bold text-gray-900" id="counter-total_staff">{{ $totalStaff ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-user-check text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Staff</p>
                    <p class="text-2xl font-bold text-gray-900" id="counter-active_staff">{{ $activeStaff ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-user-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Inactive Staff</p>
                    <p class="text-2xl font-bold text-gray-900" id="counter-inactive_staff">{{ $inactiveStaff ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff Member</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($staff as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $member->first_name }} {{ $member->last_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $member->username }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $member->email ?: 'No email' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $member->phone_number ?: 'No phone' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(request('filter') === 'archived')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-archive mr-1"></i>Archived
                                    </span>
                                @elseif($member->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $member->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    @if(request('filter') === 'archived')
                                        <!-- Restore Button for archived staff -->
                                        <form method="POST" action="{{ route('doctor.staff.restore', $member) }}"
                                              class="inline"
                                              onsubmit="event.preventDefault(); showConfirmationModal('Restore Staff', 'Are you sure you want to restore this staff member?', this)">
                                            @csrf
                                            <button type="submit"
                                                    class="text-green-600 hover:text-green-800 px-3 py-1 rounded-lg hover:bg-green-50 transition-all duration-200 text-sm"
                                                    title="Restore Staff">
                                                <i class="fas fa-undo mr-1"></i>Restore
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('doctor.staff.show', $member) }}"
                                           class="text-blue-600 hover:text-blue-800 px-3 py-1 rounded-lg hover:bg-blue-50 transition-all duration-200 text-sm"
                                           title="View Details">
                                            View
                                        </a>

                                        <a href="{{ route('doctor.staff.edit', $member) }}"
                                           class="text-yellow-600 hover:text-yellow-800 px-3 py-1 rounded-lg hover:bg-yellow-50 transition-all duration-200 text-sm"
                                           title="Edit Staff">
                                            Edit
                                        </a>

                                        @if($member->id !== auth()->id())
                                            <!-- Toggle Status Button -->
                                            <form method="POST" action="{{ route('doctor.staff.toggle-status', $member) }}"
                                                  class="inline"
                                                  onsubmit="event.preventDefault(); showConfirmationModal('{{ $member->is_active ? 'Deactivate Staff' : 'Activate Staff' }}', 'Are you sure you want to {{ $member->is_active ? 'deactivate' : 'activate' }} this staff member?', this)">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="{{ $member->is_active ? 'text-orange-600 hover:text-orange-800 hover:bg-orange-50' : 'text-green-600 hover:text-green-800 hover:bg-green-50' }} px-3 py-1 rounded-lg transition-all duration-200 text-sm"
                                                        title="{{ $member->is_active ? 'Deactivate' : 'Activate' }} Staff">
                                                    {{ $member->is_active ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>

                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('doctor.staff.destroy', $member) }}"
                                                  class="inline"
                                                  onsubmit="event.preventDefault(); showConfirmationModal('Archive Staff', 'Are you sure you want to archive this staff member? This action can be undone.', this)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 px-3 py-1 rounded-lg hover:bg-red-50 transition-all duration-200 text-sm"
                                                        title="Archive Staff">
                                                    Archive
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 px-3 py-1 text-sm" title="Cannot modify your own account">
                                                Locked
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center py-8">
                                    <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg font-medium text-gray-400">No staff members found</p>
                                    <p class="text-sm text-gray-400">Get started by adding your first staff member</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($staff->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $staff->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 