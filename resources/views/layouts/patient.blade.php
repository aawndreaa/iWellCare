<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Patient Portal - iWellCare')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/icon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/icon.png') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden !important;
        }

        /* Desktop sidebar */
        .sidebar {
            width: 280px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            background: linear-gradient(180deg, #1e40af 0%, #3b82f6 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            z-index: 50;
            overflow-y: auto;
        }

        /* Mobile sidebar - hidden by default */
        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 60;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        
        /* Main content mirrors staff layout */
        .main-content { 
            margin-left: 280px; 
            min-height: 100vh;
            background: #f8fafc;
        }
        
        .nav-item {
            padding: 0.75rem 1rem;
            margin: 4px 16px;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .btn-primary {
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }
        
        
        /* Enhanced Sidebar Logo */
        .sidebar-logo {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Simple Navigation Icons */
        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Header simplified to staff style */
        .page-header { background: white; border-bottom: 1px solid #e5e7eb; }
        .page-title { font-size: 1.875rem; font-weight: 700; color: #111827; }
        .page-subtitle { color: #64748b; font-weight: 500; }
        
        /* Standard mobile navigation */
        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
            }

            /* Top navigation bar for mobile */
            .mobile-nav {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 60px;
                background: white;
                border-bottom: 1px solid #e5e7eb;
                z-index: 55;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 1rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }

            .mobile-nav .logo {
                height: 40px;
                width: auto;
            }

            .hamburger-btn {
                background: none;
                border: none;
                padding: 0.5rem;
                border-radius: 0.375rem;
                color: #374151;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .hamburger-btn:hover {
                background: #f3f4f6;
            }

            /* Adjust main content for mobile nav */
            .main-content {
                padding-top: 60px;
            }

            /* Sidebar overlay for mobile */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 60px;
                left: 0;
                width: 100%;
                height: calc(100vh - 60px);
                background: rgba(0, 0, 0, 0.5);
                z-index: 55;
            }

            .sidebar-overlay.show {
                display: block;
            }

            /* Sidebar adjustments for mobile */
            .sidebar {
                top: 60px;
                height: calc(100vh - 60px);
                z-index: 65;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Navigation Bar -->
    <nav class="mobile-nav md:hidden">
        <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Open menu">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="flex-1 text-center">
            <img src="{{ asset('assets/img/iWellCare-logo.png') }}" alt="iWellCare" class="logo h-8 mx-auto">
        </div>
        <div class="w-10"></div> <!-- Spacer for centering -->
    </nav>

    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- Logo Section -->
        <div class="sidebar-logo">
            <div class="flex items-center justify-center">
                <img src="{{ asset('assets/img/iWellCare-logo.png') }}" alt="iWellCare" class="w-32 h-32 object-contain brightness-0 invert filter">
            </div>
        </div>

        <!-- Navigation -->
        <div class="p-4">
            <nav class="space-y-2">
                <a href="{{ route('patient.dashboard') }}" class="nav-item {{ request()->routeIs('patient.dashboard') ? 'active' : '' }} flex items-center space-x-4 px-4 py-4 text-white">
                    <div class="nav-icon">
                        <i class="fas fa-tachometer-alt text-lg"></i>
                    </div>
                    <span class="font-semibold">Dashboard</span>
                </a>
                
                <a href="{{ route('patient.appointments.index') }}" class="nav-item {{ request()->routeIs('patient.appointments.*') ? 'active' : '' }} flex items-center space-x-4 px-4 py-4 text-blue-100 hover:text-white">
                    <div class="nav-icon">
                        <i class="fas fa-calendar-check text-lg"></i>
                    </div>
                    <span class="font-semibold">Appointments</span>
                </a>
                
                <a href="{{ route('patient.consultations.index') }}" class="nav-item {{ request()->routeIs('patient.consultations.*') ? 'active' : '' }} flex items-center space-x-4 px-4 py-4 text-blue-100 hover:text-white">
                    <div class="nav-icon">
                        <i class="fas fa-stethoscope text-lg"></i>
                    </div>
                    <span class="font-semibold">Consultations</span>
                </a>
                
                <a href="{{ route('patient.prescriptions.index') }}" class="nav-item {{ request()->routeIs('patient.prescriptions.*') ? 'active' : '' }} flex items-center space-x-4 px-4 py-4 text-blue-100 hover:text-white">
                    <div class="nav-icon">
                        <i class="fas fa-pills text-lg"></i>
                    </div>
                    <span class="font-semibold">Prescriptions</span>
                </a>
                
                <a href="{{ route('patient.medical-records.index') }}" class="nav-item {{ request()->routeIs('patient.medical-records.*') ? 'active' : '' }} flex items-center space-x-4 px-4 py-4 text-blue-100 hover:text-white">
                    <div class="nav-icon">
                        <i class="fas fa-file-medical text-lg"></i>
                    </div>
                    <span class="font-semibold">Medical Records</span>
                </a>
                
                <a href="{{ route('patient.invoice.index') }}" class="nav-item {{ request()->routeIs('patient.invoice.*') ? 'active' : '' }} flex items-center space-x-4 px-4 py-4 text-blue-100 hover:text-white">
                    <div class="nav-icon">
                        <i class="fas fa-receipt text-lg"></i>
                    </div>
                    <span class="font-semibold">Invoices</span>
                </a>
                
                <a href="{{ route('patient.profile.edit') }}" class="nav-item {{ request()->routeIs('patient.profile.*') ? 'active' : '' }} flex items-center space-x-4 px-4 py-4 text-blue-100 hover:text-white">
                    <div class="nav-icon">
                        <i class="fas fa-user-circle text-lg"></i>
                    </div>
                    <span class="font-semibold">Profile</span>
                </a>
            </nav>
            
            <!-- User Info Section -->
            <div class="mt-8 p-4 bg-white/10 rounded-2xl backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-white font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                            <div class="text-blue-100 text-sm">Patient</div>
                        </div>
                    </div>
                    <a href="{{ route('patient.appointments.create') }}" class="w-8 h-8 bg-blue-500 hover:bg-blue-600 rounded-lg flex items-center justify-center text-white text-sm transition-colors" title="New Consultation">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-3 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-white text-sm font-medium transition-all duration-300 hover:scale-105">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header (enhanced design) -->
        <div class="bg-white border-b border-gray-200 px-4 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-1">@yield('page-title', 'Dashboard')</h1>
                    @if(View::hasSection('page-subtitle'))
                        <p class="text-gray-600 text-sm lg:text-base">@yield('page-subtitle')</p>
                    @endif
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Current Date/Time -->
                    <div class="hidden md:block text-right">
                        <p class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</p>
                        <p class="text-xs text-gray-400">{{ now()->format('g:i A') }}</p>
                    </div>
                    <!-- User Avatar -->
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-8">
            @yield('content')
        </div>
    </div>

    <script>
        // Standard mobile navigation functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth <= 1023) {
                const isOpen = sidebar.classList.contains('open');
                if (isOpen) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            }
        }

        function openSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth <= 1023) {
                sidebar.classList.add('open');
                overlay.classList.add('show');
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth <= 1023) {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Close sidebar when clicking navigation links on mobile
            const navLinks = document.querySelectorAll('.sidebar a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 1023) {
                        closeSidebar();
                    }
                });
            });

            // Close sidebar on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && window.innerWidth <= 1023) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>
</html> 