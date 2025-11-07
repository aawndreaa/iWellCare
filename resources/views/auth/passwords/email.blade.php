@extends('layouts.app')

@section('title', 'Forgot Password - iWellCare')

@section('head')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
@endsection

@section('content')
<style>
    footer { display: none !important; }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .forgot-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .forgot-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        padding: 2rem;
        width: 100%;
        max-width: 420px;
        position: relative;
        margin: 0 auto;
    }

    .forgot-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .forgot-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .forgot-subtitle {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: white;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input::placeholder {
        color: #9ca3af;
    }

    .btn-forgot {
        width: 100%;
        background: #3b82f6;
        color: white;
        border: none;
        padding: 0.875rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
        min-height: 44px;
        box-sizing: border-box;
    }

    .btn-forgot:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .error-text {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .links-section {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .link-text {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .link-text a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .link-text a:hover {
        color: #1d4ed8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .forgot-wrapper {
            padding: 0.75rem;
            align-items: flex-start;
            padding-top: 2rem;
        }

        .forgot-card {
            padding: 1.75rem;
            max-width: 100%;
            margin: 0 0.5rem;
            border-radius: 12px;
        }

        .forgot-title {
            font-size: 1.5rem;
        }

        .forgot-subtitle {
            font-size: 0.875rem;
        }

        .form-input {
            padding: 0.875rem 1rem;
            font-size: 1rem;
        }

        .btn-forgot {
            padding: 1rem 1.25rem;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .forgot-wrapper {
            padding: 0.5rem;
            padding-top: 1rem;
        }

        .forgot-card {
            padding: 1.5rem;
            margin: 0 0.25rem;
        }

        .forgot-header {
            margin-bottom: 1.5rem;
        }

        .forgot-title {
            font-size: 1.375rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-input {
            padding: 1rem;
        }

        .btn-forgot {
            padding: 1.125rem 1.5rem;
        }
    }

    @media (max-width: 360px) {
        .forgot-card {
            padding: 1.25rem;
        }

        .forgot-title {
            font-size: 1.25rem;
        }

        .form-input {
            padding: 0.875rem;
        }
    }

    /* Large screens */
    @media (min-width: 1024px) {
        .forgot-card {
            max-width: 450px;
            padding: 2.5rem;
        }

        .forgot-title {
            font-size: 2rem;
        }

        .forgot-subtitle {
            font-size: 1rem;
        }
    }

    /* Extra large screens */
    @media (min-width: 1280px) {
        .forgot-card {
            max-width: 480px;
            padding: 3rem;
        }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .form-input {
            font-size: 1rem; /* Prevents zoom on iOS */
        }

        .btn-forgot {
            min-height: 48px;
        }
    }

    /* High DPI displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .forgot-card {
            box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.15), 0 12px 12px -5px rgba(0, 0, 0, 0.08);
        }
    }
</style>

<div class="forgot-wrapper" style="width: 100vw; max-width: 100vw; overflow-x: hidden;">
    <div class="forgot-card">
        <div class="forgot-header">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 mb-6">
                <i class="fas fa-key text-white text-2xl"></i>
            </div>
            <h1 class="forgot-title">Forgot Password</h1>
            <p class="forgot-subtitle">Enter your email address or username and we'll send you a link to reset your password.</p>
        </div>

        @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('info'))
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-800">
                            {{ session('info') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address or Username</label>
                <input type="text"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Enter your email or username"
                       required
                       autofocus
                       class="form-input @error('email') border-red-500 @enderror">
                @error('email')
                    <div class="error-text">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-forgot">
                <i class="fas fa-paper-plane"></i>
                Send Reset Link
            </button>
        </form>

        <div class="links-section">
            <p class="link-text">
                Remember your password?
                <a href="{{ route('login') }}">Sign in here</a>
            </p>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500 text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">
                        <span class="font-semibold">Note:</span> The reset link will be sent to your email address and will expire in 60 minutes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 