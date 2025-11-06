@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-sky-50 via-sky-100 to-sky-200">
    <!-- Doctor Availability Notification - Centered Top -->
    <div id="availabilityModal" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 shadow-lg rounded-lg z-[9999] hidden max-w-sm mx-auto">
        <div class="p-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div class="flex-1 text-center">
                    <h3 class="text-base font-bold text-green-700 mb-1">Dr. Bigornia is Available</h3>
                    <p class="text-sm text-gray-600 mb-2">Great news! You can book appointments now</p>
                    <span class="inline-block text-sm font-medium text-green-600 bg-white px-3 py-1 rounded-full border border-green-200">
                        Available for appointments
                    </span>
                </div>
                <button onclick="closeAvailabilityModal()" class="text-gray-400 hover:text-gray-600 transition-colors flex-shrink-0 ml-2">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Registration/Login Choice Modal -->
    <div id="authChoiceModal" class="fixed inset-0 z-[9999] flex items-center justify-center" style="display: none;">
        <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-80 transform transition-all duration-500 ease-out border border-gray-200 opacity-100 scale-100 translate-y-0 relative z-10">
            <div class="p-6">
                <!-- Header -->
                <div class="text-center mb-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 transform transition-all duration-700 ease-out scale-100">
                        <i class="fas fa-user-plus text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 transform transition-all duration-700 ease-out translate-y-0 opacity-100">Get Started</h3>
                    <p class="text-sm text-gray-600 transform transition-all duration-700 ease-out translate-y-0 opacity-100">Choose how you'd like to proceed</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="space-y-3">
                    <button onclick="goToRegistration()" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-4 rounded-lg text-base shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 opacity-100 translate-y-0">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create New Account
                    </button>
                    
                    <button onclick="goToLogin()" class="w-full bg-white border-2 border-blue-600 hover:bg-blue-50 text-blue-600 font-bold py-3 px-4 rounded-lg text-base shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 opacity-100 translate-y-0">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In to Existing Account
                    </button>
                </div>
                
                <!-- Close Button -->
                <div class="text-center mt-4">
                    <button onclick="closeAuthChoiceModal()" class="text-gray-400 hover:text-gray-600 transition-colors text-xs transform transition-all duration-300 hover:scale-110 opacity-100">
                        <i class="fas fa-times mr-1"></i>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('/assets/img/landing.png');"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-purple-900/85 to-indigo-900/90"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        
        <!-- Main Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-24 hero-content">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
                <!-- Left Side - Text Content -->
                <div class="text-white">
                    <div class="mb-6 md:mb-8" data-aos="fade-right">
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-4 md:mb-6 leading-tight hero-title">
                            Welcome to
                            <span class="gradient-text bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                                iWellCare
                            </span>
                        </h1>
                        <p class="text-lg sm:text-xl md:text-2xl mb-6 md:mb-8 leading-relaxed text-white hero-subtitle drop-shadow-lg">
                            <strong>Your Health, Our Priority - Excellence in Healthcare, Compassion in Care.</strong> Discover comprehensive medical excellence with our advanced diagnostics, personalized treatment plans, and dedicated healthcare professionals. Experience the future of healthcare where cutting-edge technology meets compassionate patient care in our state-of-the-art facilities designed for your comfort and well-being.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 md:gap-6 hero-buttons" data-aos="fade-up" data-aos-delay="200">
                        <button onclick="handleBookAppointment()"
                            class="group bg-gradient-to-r from-emerald-400 to-teal-500 hover:from-emerald-500 hover:to-teal-600 text-white font-bold py-3 md:py-4 px-6 md:px-8 rounded-xl text-base md:text-lg shadow-xl hover:shadow-2xl hero-button drop-shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Book Appointment
                        </button>
                    </div>
                </div>
                
                <!-- Right Side - Clinic Hours -->
                <div class="flex justify-center lg:justify-end" data-aos="fade-left">
                    <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8 max-w-md lg:max-w-lg xl:max-w-xl w-full">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Clinic Hours</h3>
                        <div class="space-y-3">
                            <!-- Monday - Friday -->
                            <div class="flex items-center justify-between py-3 px-2 rounded-lg bg-blue-50 border border-blue-100">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar-week text-blue-500 text-sm"></i>
                                    <span class="font-medium text-gray-700">Mon - Fri</span>
                                </div>
                                <span class="text-blue-600 font-semibold bg-white px-3 py-1 rounded-full text-sm">9:00 AM - 2:00 PM</span>
                            </div>

                            <!-- Saturday -->
                            <div class="flex items-center justify-between py-3 px-2 rounded-lg bg-green-50 border border-green-100">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar-day text-green-500 text-sm"></i>
                                    <span class="font-medium text-gray-700">Saturday</span>
                                </div>
                                <span class="text-green-600 font-semibold bg-white px-3 py-1 rounded-full text-sm">9:00 AM - 2:00 PM</span>
                            </div>

                            <!-- Sunday -->
                            <div class="flex items-center justify-between py-3 px-2 rounded-lg bg-red-50 border border-red-100">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar-times text-red-500 text-sm"></i>
                                    <span class="font-medium text-gray-700">Sunday</span>
                                </div>
                                <span class="text-red-600 font-semibold bg-white px-3 py-1 rounded-full text-sm">Closed</span>
                            </div>
                        </div>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">Call: <span class="font-semibold text-blue-600">09352410173</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Services Section -->
    <div id="services" class="py-20 bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Services</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Comprehensive healthcare services tailored to meet your wellness needs. We provide a wide range of medical services to ensure your health and well-being.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 services-grid">
                <!-- General Consultation -->
                <div class="bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-100 rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-xl service-card border border-blue-200/50" data-aos="fade-up">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6 service-icon shadow-lg">
                        <i class="fas fa-user-md text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4 text-center service-title">General Consultation</h3>
                    <p class="text-gray-600 text-center mb-6">
                        Comprehensive health assessments and medical consultations with our experienced healthcare professionals.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Health assessments
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Medical consultations
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Preventive care
                        </li>
                    </ul>
                </div>
                
                <!-- Laboratory Services -->
                <div class="bg-gradient-to-br from-green-50 via-emerald-100 to-teal-100 rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-xl service-card border border-green-200/50" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6 service-icon shadow-lg">
                        <i class="fas fa-flask text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4 text-center service-title">Laboratory Services</h3>
                    <p class="text-gray-600 text-center mb-6">
                        State-of-the-art laboratory testing and diagnostic services for accurate health assessments.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Blood tests
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Urinalysis
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Diagnostic imaging
                        </li>
                    </ul>
                </div>
                
                <!-- Pharmacy Services -->
                <div class="bg-gradient-to-br from-purple-50 via-violet-100 to-indigo-100 rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-xl service-card border border-purple-200/50" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-purple-500 via-violet-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6 service-icon shadow-lg">
                        <i class="fas fa-pills text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4 text-center service-title">Pharmacy Services</h3>
                    <p class="text-gray-600 text-center mb-6">
                        Complete pharmacy services with prescription medications and over-the-counter products for your healthcare needs.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Prescription medications
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Over-the-counter products
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Medication consultation
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="py-20 bg-gradient-to-br from-slate-100 via-purple-50/30 to-indigo-50/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Contact Us</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Have questions? We're here to help. Get in touch with us today.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 contact-grid">
                <!-- Phone -->
                <div class="text-center" data-aos="fade-up">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-phone text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Phone</h3>
                    <p class="text-gray-600">09352410173</p>
                </div>

                <!-- Email -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-envelope text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600">adultwellnessclinicandmedicall@gmail.com</p>
                </div>

                <!-- Address -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-map-marker-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Address</h3>
                    <p class="text-gray-600">Capitulacion Street, Zone 2, Bangued, Abra</p>
                </div>
            </div>
        </div>
    </div>


</div>

<style>
.bg-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.gradient-text {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Enhanced Modal Styling */
#authChoiceModal {
    backdrop-filter: blur(4px);
}

#authChoiceModal .bg-white {
    animation: modalSlideIn 0.5s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(1rem);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Mobile enhancements */
@media (max-width: 768px) {
    /* Hero section mobile adjustments */
    .hero-content {
        padding: 1.5rem 1rem;
    }

    .hero-title {
        font-size: 1.75rem;
        line-height: 1.1;
        margin-bottom: 0.5rem;
    }

    .hero-subtitle {
        font-size: 0.875rem;
        line-height: 1.3;
        margin-bottom: 1rem;
    }

    /* Button adjustments */
    .hero-buttons {
        flex-direction: column;
        gap: 1rem;
    }

    .hero-button {
        width: 100%;
        text-align: center;
    }

    /* Services grid */
    .services-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    /* Contact grid */
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    /* Clinic hours grid */
    .clinic-hours-grid {
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    /* Modal adjustments */
    #authChoiceModal {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 1rem;
    }

    #authChoiceModal .bg-white {
        width: 100%;
        max-width: 320px;
        margin: 0 auto;
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    #authChoiceModal h3 {
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
    }

    #authChoiceModal p {
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    /* Button adjustments for mobile */
    #authChoiceModal button {
        width: 100%;
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 12px;
        margin-bottom: 0.5rem;
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-sizing: border-box;
        line-height: 1.2;
        position: relative;
        z-index: 10;
        cursor: pointer;
        border: none;
        outline: none;
        -webkit-tap-highlight-color: transparent;
    }

    /* Ensure consistent button heights */
    #authChoiceModal button:first-of-type,
    #authChoiceModal button:nth-of-type(2) {
        height: auto;
        min-height: 48px;
    }

    /* Ensure buttons are clickable */
    #authChoiceModal button:active {
        transform: scale(0.98);
    }

    #authChoiceModal button:last-child {
        margin-bottom: 0;
    }

    /* Ensure modal content doesn't overflow */
    #authChoiceModal .bg-white {
        max-height: 90vh;
        overflow-y: auto;
    }

    /* Close button adjustments */
    #authChoiceModal button[onclick*="closeAuthChoiceModal"] {
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
        margin-top: 1rem;
    }

    /* Availability modal */
    #availabilityModal {
        max-width: 90vw;
        margin: 1rem;
        top: 10rem; /* Move much further down on mobile to avoid overlapping title */
    }

    /* Desktop positioning for availability modal */
    @media (min-width: 769px) {
        #availabilityModal {
            top: 1rem; /* Original position for desktop */
        }
    }
}

@media (max-width: 640px) {
    /* Extra small screens */
    .hero-content {
        padding: 1rem 0.75rem;
    }

    .hero-title {
        font-size: 1.5rem;
        line-height: 1.1;
        margin-bottom: 0.5rem;
    }

    .hero-subtitle {
        font-size: 0.8rem;
        line-height: 1.3;
        margin-bottom: 0.75rem;
    }

    .clinic-hours-grid {
        grid-template-columns: 1fr;
    }

    /* Services cards */
    .service-card {
        padding: 1rem;
    }

    .service-icon {
        width: 3rem;
        height: 3rem;
    }

    .service-title {
        font-size: 1.25rem;
    }
}

/* Touch-friendly buttons */
@media (hover: none) and (pointer: coarse) {
    .card-hover:hover {
        transform: none;
    }

    button, .btn {
        min-height: 44px;
        min-width: 44px;
    }
}
</style>

<script>
window.isAuthenticated = @auth true @else false @endauth;

function handleBookAppointment() {
    // Check if user is authenticated
    @auth
        // User is logged in, redirect to booking form
        window.location.href = "{{ route('book.appointment') }}";
    @else
        // User is not logged in, show registration/login modal
        const authChoiceModal = document.getElementById('authChoiceModal');
        if (authChoiceModal) {
            authChoiceModal.style.display = 'flex';
        }
    @endauth
}

function animateModalElements(modal) {
    // Animate header elements
    const icon = modal.querySelector('.w-12.h-12');
    const title = modal.querySelector('h3');
    const subtitle = modal.querySelector('p');
    
    if (icon) setTimeout(() => icon.classList.remove('scale-0'), 100);
    if (title) setTimeout(() => {
        title.classList.remove('opacity-0', 'translate-y-4');
        title.classList.add('opacity-100', 'translate-y-0');
    }, 300);
    if (subtitle) setTimeout(() => {
        subtitle.classList.remove('opacity-0', 'translate-y-4');
        subtitle.classList.add('opacity-100', 'translate-y-0');
    }, 400);
    
    // Animate buttons
    const buttons = modal.querySelectorAll('button:not([onclick*="closeAuthChoiceModal"])');
    buttons.forEach((button, index) => {
        setTimeout(() => {
            button.classList.remove('opacity-0', 'translate-y-4');
            button.classList.add('opacity-100', 'translate-y-0');
        }, 500 + (index * 100));
    });
    
    // Animate close button
    const closeButton = modal.querySelector('button[onclick*="closeAuthChoiceModal"]');
    if (closeButton) setTimeout(() => {
        closeButton.classList.remove('opacity-0');
        closeButton.classList.add('opacity-100');
    }, 800);
}

function checkDoctorAvailability() {
    // Only show modal for guest users
    if (window.isAuthenticated) {
        return;
    }

    // Fetch doctor availability from API
    fetch('/api/doctors/available')
        .then(response => response.json())
        .then(data => {
            const modal = document.getElementById('availabilityModal');
            if (modal) {
                const title = modal.querySelector('h3');
                const subtitle = modal.querySelector('p');
                const badge = modal.querySelector('.inline-block');
                const icon = modal.querySelector('i');
                const iconContainer = modal.querySelector('.w-10.h-10');

                // Check if Dr. Bigornia (user_id: 2) is available
                const doctorBigornia = data.doctors.find(doctor => doctor.id === 2);
                const isBigorniaAvailable = doctorBigornia && doctorBigornia.is_available;

                if (isBigorniaAvailable) {
                    // Dr. Bigornia is available
                    title.textContent = 'Dr. Bigornia is Available';
                    subtitle.textContent = 'Great news! You can book appointments now';
                    badge.textContent = 'Doctor is available';
                    badge.className = 'inline-block text-xs font-medium text-green-600 bg-white px-2 py-1 rounded-full border border-green-200';
                    iconContainer.className = 'w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0';
                    icon.className = 'fas fa-check-circle text-green-600 text-sm';
                } else {
                    // Dr. Bigornia is not available
                    title.textContent = 'Dr. Bigornia is Not Available';
                    subtitle.textContent = 'Please check back later or contact us';
                    badge.textContent = 'Doctor is not available';
                    badge.className = 'inline-block text-xs font-medium text-red-600 bg-white px-2 py-1 rounded-full border border-red-200';
                    iconContainer.className = 'w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0';
                    icon.className = 'fas fa-exclamation-triangle text-red-600 text-sm';
                }

                modal.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error fetching doctor availability:', error);
            // Fallback to show modal with default message
            const modal = document.getElementById('availabilityModal');
            if (modal) {
                modal.classList.remove('hidden');
            }
        });
}

function closeAvailabilityModal() {
    const modal = document.getElementById('availabilityModal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

function goToRegistration() {
    window.location.href = "{{ route('register') }}";
}

function goToLogin() {
    window.location.href = "{{ route('login') }}";
}

function closeAuthChoiceModal() {
    const authChoiceModal = document.getElementById('authChoiceModal');
    if (authChoiceModal) {
        // Hide modal by changing display style
        authChoiceModal.style.display = 'none';
    }
}

function resetModalState(modal) {
    // Reset all elements to initial state for next opening
    const icon = modal.querySelector('.w-12.h-12');
    const title = modal.querySelector('h3');
    const subtitle = modal.querySelector('p');
    const buttons = modal.querySelectorAll('button:not([onclick*="closeAuthChoiceModal"])');
    const closeButton = modal.querySelector('button[onclick*="closeAuthChoiceModal"]');
    
    // Reset to initial animation state
    if (icon) icon.classList.add('scale-0');
    if (title) {
        title.classList.add('opacity-0', 'translate-y-4');
        title.classList.remove('opacity-100', 'translate-y-0');
    }
    if (subtitle) {
        subtitle.classList.add('opacity-0', 'translate-y-4');
        subtitle.classList.remove('opacity-100', 'translate-y-0');
    }
    
    buttons.forEach(button => {
        button.classList.add('opacity-0', 'translate-y-4');
        button.classList.remove('opacity-100', 'translate-y-0');
    });
    
    if (closeButton) {
        closeButton.classList.add('opacity-0');
        closeButton.classList.remove('opacity-100');
    }
}

function scrollToServices() {
    const servicesSection = document.getElementById('services'); // Services section
    if (servicesSection) {
        servicesSection.scrollIntoView({ behavior: 'smooth' });
    }
}

// Show the modal automatically on page load
document.addEventListener('DOMContentLoaded', function() {
    // Hide the modal initially
    const modal = document.getElementById('availabilityModal');
    if (modal) {
        modal.classList.add('hidden');
    }

    const authChoiceModal = document.getElementById('authChoiceModal');
    if (authChoiceModal) {
        authChoiceModal.classList.add('hidden');
    }

    @guest
    // Show the availability modal after a short delay for better UX
    setTimeout(() => {
        checkDoctorAvailability();
    }, 1000); // 1 second delay
    @endguest
    
    // Add click outside to close functionality
    document.addEventListener('click', function(event) {
        if (authChoiceModal && !authChoiceModal.classList.contains('hidden')) {
            const modalContent = authChoiceModal.querySelector('.bg-white');
            if (!modalContent.contains(event.target)) {
                closeAuthChoiceModal();
            }
        }
    });
    
    // Add ESC key to close
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            if (authChoiceModal && !authChoiceModal.classList.contains('hidden')) {
                closeAuthChoiceModal();
            }
        }
    });
});
</script>
@endsection 