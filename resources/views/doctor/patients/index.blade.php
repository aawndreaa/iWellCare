@extends('layouts.admin')

@section('title', 'Patients - iWellCare')

@section('page-title', 'Patients')
@section('page-subtitle', 'Manage patient information and records')

@section('content')
<!-- Search and Filters -->
<div class="card mb-6">
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Patients</h3>
            </div>
            <div class="flex space-x-2">
                <a href="?filter=active&t={{ time() }}" class="px-4 py-2 text-sm font-medium rounded-md {{ request('filter') !== 'archived' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' }}">
                    Active Patients
                </a>
                <a href="?filter=archived&t={{ time() }}" class="px-4 py-2 text-sm font-medium rounded-md {{ request('filter') === 'archived' ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:text-gray-700' }}">
                    Archived Patients ({{ $archivedCount ?? 0 }})
                </a>
            </div>
        </div>
        <form method="GET" action="{{ route('doctor.patients.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <input type="text" class="form-input w-full" name="search"
                       placeholder="Search by name, contact, or email"
                       value="{{ request('search') }}">
            </div>
            <div>
                <select class="form-input w-full" name="status">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="btn-primary">Search</button>
                <a href="{{ route('doctor.patients.index') }}" class="btn-secondary">Clear</a>
            </div>
        </form>
    </div>
</div>

<!-- Patients Table -->
<div class="table-container">
    <div class="table-header">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold">
                @if(request('filter') === 'archived')
                    Archived Patients
                @else
                    Active Patients
                @endif
            </h3>
            <div class="text-white/80 text-sm">
                <i class="fas fa-info-circle mr-2"></i>
                @if(request('filter') === 'archived')
                    Archived patients can be restored if needed
                @else
                    Patients are managed by staff
                @endif
            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Contact</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Age</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Gender</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($patients as $patient)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-3">
                                        <div class="font-semibold text-gray-900">{{ $patient->full_name }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $patient->id }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $patient->contact ?? 'Not provided' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $patient->email ?? 'Not provided' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $patient->age ?? 'Not provided' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($patient->gender ?? 'Not provided') }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            {{ $patient->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $patient->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('doctor.patients.edit', $patient) }}" 
                               class="text-gray-600 hover:text-gray-800 p-2 rounded-lg hover:bg-gray-50 transition-all duration-200" 
                               title="Edit Patient Information">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('doctor.patients.history', $patient) }}" 
                               class="text-purple-600 hover:text-purple-800 p-2 rounded-lg hover:bg-purple-50 transition-all duration-200" 
                               title="View Medical History">
                                <i class="fas fa-history"></i>
                            </a>
                            <a href="{{ route('doctor.appointments.index', ['patient_id' => $patient->id]) }}" 
                               class="text-orange-600 hover:text-orange-800 p-2 rounded-lg hover:bg-orange-50 transition-all duration-200" 
                               title="View Appointments">
                                <i class="fas fa-calendar"></i>
                            </a>
                            @if(request('filter') === 'archived')
                                <form action="{{ route('doctor.patients.restore', $patient) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 p-2 rounded-lg hover:bg-green-50 transition-all duration-200" title="Restore Patient">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('doctor.patients.destroy', $patient) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-patient text-orange-600 hover:text-orange-800 p-2 rounded-lg hover:bg-orange-50 transition-all duration-200" title="Archive Patient">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-users text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">No patients found</p>
                            <p class="text-gray-400 text-sm mt-1">Patients will appear here once registered by staff</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($patients->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing {{ $patients->firstItem() }} to {{ $patients->lastItem() }} of {{ $patients->total() }} results
            </div>
            <div class="flex space-x-2">
                @if($patients->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $patients->previousPageUrl() }}" class="px-3 py-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">Previous</a>
                @endif
                
                @if($patients->hasMorePages())
                    <a href="{{ $patients->nextPageUrl() }}" class="px-3 py-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">Next</a>
                @else
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Archive Confirmation Modal -->
<div id="deletePatientModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md text-center">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Archive Patient</h3>
        <p class="mb-6 text-gray-600">Are you sure you want to archive this patient? You can restore archived patients later if needed.</p>
        <div class="flex justify-center gap-4">
            <button id="cancelDeletePatient" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition">Cancel</button>
            <button id="confirmDeletePatient" class="px-6 py-2 rounded-lg bg-orange-600 text-white font-semibold hover:bg-orange-700 transition">Archive</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let formToDelete = null;
    document.querySelectorAll('.btn-delete-patient').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            formToDelete = this.closest('form');
            document.getElementById('deletePatientModal').classList.remove('hidden');
        });
    });
    document.getElementById('cancelDeletePatient').onclick = function() {
        document.getElementById('deletePatientModal').classList.add('hidden');
        formToDelete = null;
    };
    document.getElementById('confirmDeletePatient').onclick = function() {
        if (formToDelete) formToDelete.submit();
    };
</script>
@endpush
@endsection 