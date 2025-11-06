@extends('layouts.staff')
@section('title', 'Inventory - iWellCare')
@section('page-title', 'Inventory')
@section('page-subtitle', 'Monitor and update supply levels')
@section('content')
<div class="inventory-content">

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="group relative overflow-hidden rounded-xl p-4 text-center transform hover:scale-105 transition-all duration-300 cursor-pointer" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 50%, #93c5fd 100%); box-shadow: 0 8px 12px -3px rgba(37, 99, 235, 0.12), 0 4px 6px -2px rgba(37, 99, 235, 0.06);">
            <div class="absolute inset-0 bg-gradient-to-br from-green-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-white/80 rounded-full mb-3 backdrop-blur-sm shadow-lg">
                    <i class="fas fa-boxes text-lg" style="color: #2563eb;"></i>
                </div>
                <div class="text-gray-600 text-xs font-medium mb-1 uppercase tracking-wide">Total Items</div>
                <div class="text-2xl font-bold mb-1" style="color: #1d4ed8;">{{ $inventory->total() }}</div>
                <div class="text-xs text-blue-700 font-medium bg-blue-100 px-2 py-1 rounded-full inline-block">All</div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-xl p-4 text-center transform hover:scale-105 transition-all duration-300 cursor-pointer" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fcd34d 100%); box-shadow: 0 8px 12px -3px rgba(245, 158, 11, 0.1), 0 4px 6px -2px rgba(245, 158, 11, 0.05);">
            <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-white/80 rounded-full mb-3 backdrop-blur-sm shadow-lg">
                    <i class="fas fa-exclamation-triangle text-lg text-yellow-600"></i>
                </div>
                <div class="text-gray-600 text-xs font-medium mb-1 uppercase tracking-wide">Low Stock</div>
                <div class="text-2xl font-bold mb-1 text-yellow-700">{{ $inventory->filter(fn($i) => $i->isLowStock())->count() }}</div>
                <div class="text-xs text-yellow-700 font-medium bg-yellow-100 px-2 py-1 rounded-full inline-block">Alert</div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-xl p-4 text-center transform hover:scale-105 transition-all duration-300 cursor-pointer" style="background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 50%, #f87171 100%); box-shadow: 0 8px 12px -3px rgba(239, 68, 68, 0.1), 0 4px 6px -2px rgba(239, 68, 68, 0.05);">
            <div class="absolute inset-0 bg-gradient-to-br from-red-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-white/80 rounded-full mb-3 backdrop-blur-sm shadow-lg">
                    <i class="fas fa-times-circle text-lg text-red-600"></i>
                </div>
                <div class="text-gray-600 text-xs font-medium mb-1 uppercase tracking-wide">Out of Stock</div>
                <div class="text-2xl font-bold mb-1 text-red-700">{{ $inventory->filter(fn($i) => $i->isOutOfStock())->count() }}</div>
                <div class="text-xs text-red-700 font-medium bg-red-100 px-2 py-1 rounded-full inline-block">Critical</div>
            </div>
        </div>
    </div>
<div class="bg-white rounded-xl p-6 mb-6 border border-gray-200 shadow-sm">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div class="flex flex-wrap gap-3 items-end flex-1">
            <div class="min-w-0 flex-1 lg:flex-initial">
                <label class="block text-gray-700 text-sm font-medium mb-1">Item Name</label>
                <input type="text" id="name-filter" name="name" class="form-input w-full" value="{{ request('name') }}" placeholder="Search items...">
            </div>
            <div class="min-w-0">
                <label class="block text-gray-700 text-sm font-medium mb-1">Category</label>
                <select id="category-filter" name="category" class="form-input w-full">
                    <option value="">All Categories</option>
                    <option value="medicine" {{ request('category') === 'medicine' ? 'selected' : '' }}>Medicine</option>
                    <option value="supplies" {{ request('category') === 'supplies' ? 'selected' : '' }}>Supplies</option>
                    <option value="equipment" {{ request('category') === 'equipment' ? 'selected' : '' }}>Equipment</option>
                </select>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('staff.inventory.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
        <a href="{{ route('staff.inventory.create') }}" class="btn btn-success flex items-center gap-2 px-4 py-2 whitespace-nowrap bg-blue-600 hover:bg-blue-700">
            <i class="fas fa-plus"></i> Add Item
        </a>
    </div>
</div>
@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-lg mb-6 flex items-center gap-3">
        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
            <i class="fas fa-check-circle text-green-600"></i>
        </div>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold text-sm text-gray-900">Item</th>
                    <th class="py-3 px-4 text-left font-semibold text-sm text-gray-900">Quantity</th>
                    <th class="py-3 px-4 text-left font-semibold text-sm text-gray-900">Status</th>
                    <th class="py-3 px-4 text-left font-semibold text-sm text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventory as $item)
                    <tr class="hover:bg-blue-50/50 transition-colors border-b border-gray-100 last:border-b-0">
                        <td class="py-3 px-4 flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold text-sm" style="background-color: #dbeafe; color: #1d4ed8;">
                                {{ strtoupper(substr($item->name, 0, 1)) }}
                            </span>
                            <span class="font-medium text-gray-900">{{ $item->name }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-semibold text-gray-900">{{ $item->quantity }}</span>
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $badge = $item->isOutOfStock() ? 'bg-red-100 text-red-700 border-red-200' : ($item->isLowStock() ? 'bg-yellow-100 text-yellow-700 border-yellow-200' : 'bg-green-100 text-green-700 border-green-200');
                                $label = $item->isOutOfStock() ? 'Out of Stock' : ($item->isLowStock() ? 'Low Stock' : 'In Stock');
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $badge }}">
                                <i class="fas fa-circle mr-1 text-[6px]"></i> {{ $label }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('staff.inventory.edit', $item->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-white text-xs font-medium rounded-md transition-colors bg-blue-600 hover:bg-blue-700">
                                <i class="fas fa-edit"></i> Update
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-boxes text-3xl text-green-500"></i>
                                </div>
                                <div class="text-gray-500 text-sm font-medium">No inventory items found</div>
                                <div class="text-xs text-gray-400">Add your first item using the button above</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6 flex justify-center">
    {{ $inventory->links() }}
</div>

@push('styles')
<style>
/* Custom select dropdown styling */
select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

/* Modal backdrop blur effect */
.modal-backdrop {
    backdrop-filter: blur(8px) !important;
    background-color: rgba(0, 0, 0, 0.7) !important;
    opacity: 1 !important;
}

/* Ensure backdrop covers entire viewport */
.modal-backdrop.show {
    opacity: 1 !important;
    backdrop-filter: blur(8px) !important;
    background-color: rgba(0, 0, 0, 0.7) !important;
}

/* Backdrop fade-in animation */
.modal-backdrop.fade {
    transition: opacity 0.3s ease-out, backdrop-filter 0.3s ease-out;
}

.modal-backdrop.fade.show {
    opacity: 1;
    backdrop-filter: blur(8px);
}

/* Ensure modal is perfectly centered */
.modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - 1rem);
}

.modal.show .modal-dialog {
    transform: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Enhanced modal z-index for proper layering */
.modal {
    z-index: 1060 !important;
}

.modal-backdrop {
    z-index: 1055 !important;
}

.modal-dialog {
    z-index: 1065 !important;
}

.modal-content {
    z-index: 1070 !important;
    border: none;
    border-radius: 16px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Modal entrance animation */
.modal.fade .modal-dialog {
    transition: transform 0.3s ease-out;
    transform: translate(0, -50px) scale(0.95);
}

.modal.show .modal-dialog {
    transform: translate(0, 0) scale(1);
}

/* Enhanced modal header with staff green theme */
.modal-header {
    background: linear-gradient(135deg, #059669 0%, #047857 50%, #065f46 100%) !important;
    border: none !important;
    border-radius: 16px 16px 0 0 !important;
}

/* Modal body styling */
.modal-body {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #f1f5f9 100%);
}

/* Modal footer styling */
.modal-footer {
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    border-radius: 0 0 16px 16px;
}

/* Custom scrollbar for modal */
.modal-body::-webkit-scrollbar {
    width: 6px;
}

.modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.modal-body::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.modal-body::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Focus states for better accessibility */
input:focus, select:focus, textarea:focus {
    transform: translateY(-1px);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12), 0 4px 6px -1px rgba(59, 130, 246, 0.12);
}

/* Enhanced table row hover effects */
tbody tr {
    transition: all 0.2s ease-in-out;
}

tbody tr:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px -8px rgba(37, 99, 235, 0.25);
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 50%, #bfdbfe 100%) !important;
}

/* Button hover animations */
.btn:hover {
    transform: translateY(-1px);
    transition: all 0.2s ease-in-out;
}

/* Card hover effects */
.card {
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(5, 150, 105, 0.1), 0 10px 10px -5px rgba(5, 150, 105, 0.04);
}

/* Form container animations */
.bg-white.rounded-2xl {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Stats cards staggered animation */
.grid.grid-cols-1.md\\:grid-cols-3 > div:nth-child(1) {
    animation: fadeInUp 0.6s ease-out 0.1s both;
}

.grid.grid-cols-1.md\\:grid-cols-3 > div:nth-child(2) {
    animation: fadeInUp 0.6s ease-out 0.2s both;
}

.grid.grid-cols-1.md\\:grid-cols-3 > div:nth-child(3) {
    animation: fadeInUp 0.6s ease-out 0.3s both;
}

/* Hero section floating animation */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

.relative.overflow-hidden.rounded-2xl {
    animation: float 6s ease-in-out infinite;
}

/* Enhanced input focus states */
input:focus, select:focus, textarea:focus {
    border-color: #2563eb !important;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12) !important;
}

/* Custom gradient text effects */
.text-shadow {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Smooth transitions for all interactive elements */
* {
    transition: all 0.2s ease-in-out;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameFilter = document.getElementById('name-filter');
    const categoryFilter = document.getElementById('category-filter');
    let searchTimeout;

    function performSearch() {
        const name = nameFilter.value;
        const category = categoryFilter.value;

        // Build query string
        const params = new URLSearchParams();
        if (name) params.append('name', name);
        if (category) params.append('category', category);

        // Update URL without page reload
        const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
        window.location.href = newUrl;
    }

    // Add event listeners for automatic search
    nameFilter.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 500); // Debounce for 500ms
    });

    categoryFilter.addEventListener('change', function() {
        performSearch(); // Immediate search for category changes
    });
});
</script>
@endpush
@endsection