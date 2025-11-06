@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 flex flex-col justify-center py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-md sm:max-w-lg">
        <!-- Main Card with Gradient Background -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 px-6 sm:px-8 py-8 sm:py-12 text-center">
                <!-- Icon with gradient background -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 sm:h-20 sm:w-20 rounded-full bg-white/20 backdrop-blur-sm mb-6">
                    <svg class="h-8 w-8 sm:h-10 sm:w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-3">
                    Verify Your Email
                </h1>
                @if($email)
                    <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                        We've sent a 6-digit verification code to:<br>
                        <span class="font-semibold text-white text-base">{{ $email }}</span>
                    </p>
                @else
                    <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                        Enter your email address to receive a verification code.
                    </p>
                @endif
            </div>

            <!-- Form Section -->
            <div class="px-6 sm:px-8 py-8">

                @if(!$email)
                    <!-- Email Input Form -->
                    <form id="emailForm" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-3">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" required
                                       class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-base"
                                       placeholder="Enter your email address">
                            </div>
                        </div>

                        <div>
                            <button type="submit" id="sendOtpBtn"
                                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Verification Code
                            </button>
                        </div>
                    </form>
                @else
                    <!-- OTP Verification Form -->
                    <form id="otpForm" class="space-y-6">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-3 text-center">
                                Enter the 6-digit verification code
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                                <input id="code" name="code" type="text" required maxlength="6"
                                       class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-center text-2xl font-mono tracking-[0.5em] text-base"
                                       placeholder="000000" autocomplete="off">
                            </div>
                        </div>

                        <div>
                            <button type="submit" id="verifyBtn"
                                    class="w-full bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                <i class="fas fa-check mr-2"></i>
                                Verify Email Address
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600 mb-4">Didn't receive the code?</p>
                        <button type="button" id="resendBtn"
                                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-redo mr-2"></i>
                            Resend Code
                        </button>
                    </div>
                @endif

                <!-- Info Card -->
                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <span class="font-semibold">Security Note:</span> The verification code will expire in 10 minutes for your security. Never share this code with anyone.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Back to Login Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm mx-4 w-full">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 mb-6">
                <svg class="h-8 w-8 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900" id="loadingMessage">
                Verifying your email...
            </h3>
            <p class="text-sm text-gray-600 mt-2">Please wait while we process your request.</p>
        </div>
    </div>
</div>

@endsection

<style>
/* Additional mobile responsiveness */
@media (max-width: 640px) {
    .verification-card {
        margin: 1rem;
        max-width: none;
    }

    .verification-header {
        padding: 2rem 1.5rem;
    }

    .verification-title {
        font-size: 1.75rem;
    }

    .verification-form {
        padding: 1.5rem;
    }

    /* Improve OTP input on mobile */
    #code {
        font-size: 1.25rem !important;
        letter-spacing: 0.25rem !important;
    }
}

/* Focus states for better accessibility */
.form-input:focus {
    transform: translateY(-1px);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Button hover effects */
.btn-primary:hover {
    transform: translateY(-1px);
}

.btn-primary:active {
    transform: translateY(0);
}

/* Loading animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Success/error states */
.input-success {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.input-error {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let resendTimer = 60;
    let resendInterval;

    // Auto-focus and input enhancements
    @if($email)
        const codeInput = document.getElementById('code');
        if (codeInput) {
            // Auto-focus on code input
            codeInput.focus();

            // Format OTP input and auto-submit when complete
            codeInput.addEventListener('input', function(e) {
                // Remove non-numeric characters
                this.value = this.value.replace(/[^0-9]/g, '');

                // Auto-submit when 6 digits are entered
                if (this.value.length === 6) {
                    setTimeout(() => {
                        document.getElementById('otpForm').dispatchEvent(new Event('submit'));
                    }, 500); // Small delay for better UX
                }
            });

            // Handle paste events
            codeInput.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedText = (e.clipboardData || window.clipboardData).getData('text');
                const numericText = pastedText.replace(/[^0-9]/g, '').substring(0, 6);
                this.value = numericText;

                if (numericText.length === 6) {
                    setTimeout(() => {
                        document.getElementById('otpForm').dispatchEvent(new Event('submit'));
                    }, 500);
                }
            });
        }

        // Handle OTP form submission
        document.getElementById('otpForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const codeInput = document.getElementById('code');
            const code = codeInput.value.trim();

            // Validate code length
            if (code.length !== 6) {
                showError('Please enter a valid 6-digit verification code.');
                codeInput.focus();
                codeInput.select();
                return;
            }

            const formData = new FormData(this);

            showLoading('Verifying your email...');

            fetch('{{ route("otp.verify") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();

                if (data.success) {
                    showSuccess('Email Verified!', data.message, () => {
                        window.location.href = data.redirect || '{{ route("home") }}';
                    });
                } else {
                    showError(data.message);
                    codeInput.focus();
                    codeInput.select();
                }
            })
            .catch(error => {
                hideLoading();
                showError('An error occurred. Please try again.');
                console.error('Verification error:', error);
            });
        });

        // Handle resend OTP
        document.getElementById('resendBtn').addEventListener('click', function() {
            const email = '{{ $email }}';

            showLoading('Sending verification code...');

            fetch('{{ route("otp.resend") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();

                if (data.success) {
                    showSuccess('Code Sent!', data.message);
                    startResendTimer();
                } else {
                    showError(data.message);
                }
            })
            .catch(error => {
                hideLoading();
                showError('Failed to send verification code.');
                console.error('Resend error:', error);
            });
        });

        // Start resend timer
        startResendTimer();

        function startResendTimer() {
            resendTimer = 60;
            const resendBtn = document.getElementById('resendBtn');
            resendBtn.disabled = true;
            resendBtn.innerHTML = `<i class="fas fa-clock mr-1"></i>Resend in ${resendTimer}s`;

            resendInterval = setInterval(function() {
                resendTimer--;
                resendBtn.innerHTML = `<i class="fas fa-clock mr-1"></i>Resend in ${resendTimer}s`;

                if (resendTimer <= 0) {
                    clearInterval(resendInterval);
                    resendBtn.disabled = false;
                    resendBtn.innerHTML = '<i class="fas fa-redo mr-1"></i>Resend Code';
                }
            }, 1000);
        }
    @else
        // Handle email form submission
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const emailInput = document.getElementById('email');
            const email = emailInput.value.trim();

            // Basic email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError('Please enter a valid email address.');
                emailInput.focus();
                return;
            }

            const formData = new FormData(this);

            showLoading('Sending verification code...');

            fetch('{{ route("otp.send") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();

                if (data.success) {
                    showSuccess('Code Sent!', data.message, () => {
                        window.location.reload();
                    });
                } else {
                    showError(data.message);
                }
            })
            .catch(error => {
                hideLoading();
                showError('Failed to send verification code.');
                console.error('Send error:', error);
            });
        });
    @endif

    // Utility functions for better UX
    function showLoading(message) {
        document.getElementById('loadingMessage').textContent = message;
        document.getElementById('loadingModal').classList.remove('hidden');
    }

    function hideLoading() {
        document.getElementById('loadingModal').classList.add('hidden');
    }

    function showSuccess(title, message, callback = null) {
        Swal.fire({
            icon: 'success',
            title: title,
            text: message,
            confirmButtonText: 'Continue',
            confirmButtonColor: '#10b981',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (callback) callback();
        });
    }

    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonColor: '#ef4444'
        });
    }
});
</script>
@endpush 