@extends('layouts.patient')
@section('title', 'Edit Profile - iWellCare')
@section('page-title', 'Edit Profile')
@section('page-subtitle', 'Update your personal information')
@section('content')

<style>
    .section-divider {
        border-top: 1px solid #e5e7eb;
        margin: 1.5rem 0;
        position: relative;
        text-align: center;
    }

    .section-title {
        background: white;
        padding: 0 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #6b7280;
        position: relative;
        top: -0.75rem;
        display: inline-block;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    @media (min-width: 480px) {
        .form-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    .form-group {
        margin-bottom: 1rem;
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
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: white;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input::placeholder {
        color: #9ca3af;
    }

    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        background: white;
        transition: all 0.2s ease;
    }

    .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .password-input {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 4px;
        transition: color 0.2s ease;
    }

    .password-toggle:hover {
        color: #6b7280;
    }

    .form-input.password {
        padding-right: 3rem;
    }

    .error-text {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    @media (max-width: 640px) {
        .form-grid {
            gap: 0.75rem;
        }

        .form-input,
        .form-select {
            padding: 0.625rem;
            font-size: 16px; /* Prevents zoom on iOS */
        }
    }

    @media (max-width: 480px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="max-w-4xl mx-auto">
    <div class="card p-8">
        <form action="{{ route('patient.profile.update') }}" method="POST">
            @csrf

            <!-- Basic Information -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Basic Information</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input type="text" class="form-input @error('first_name') border-red-500 @enderror"
                               id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="First name" required>
                        @error('first_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" class="form-input @error('last_name') border-red-500 @enderror"
                               id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Last name" required>
                        @error('last_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-input @error('email') border-red-500 @enderror"
                               id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email address" required>
                        @error('email')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone Number *</label>
                        <input type="text" class="form-input @error('phone_number') border-red-500 @enderror"
                               id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Phone number" required>
                        @error('phone_number')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact" class="form-label">Contact Number *</label>
                        <input type="text" class="form-input @error('contact') border-red-500 @enderror"
                               id="contact" name="contact" value="{{ old('contact', $patient->contact) }}" placeholder="Contact number" required>
                        @error('contact')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth" class="form-label">Date of Birth *</label>
                        <input type="date" class="form-input @error('date_of_birth') border-red-500 @enderror"
                               id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth ? $patient->date_of_birth->format('Y-m-d') : '') }}" max="{{ date('Y-m-d', strtotime('-1 day')) }}" required>
                        @error('date_of_birth')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender" class="form-label">Gender *</label>
                        <select class="form-select @error('gender') border-red-500 @enderror"
                                id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="blood_type" class="form-label">Blood Type (Optional)</label>
                        <select class="form-select @error('blood_type') border-red-500 @enderror"
                                id="blood_type" name="blood_type">
                            <option value="">Select blood type</option>
                            <option value="A+" {{ old('blood_type', $patient->blood_type) == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ old('blood_type', $patient->blood_type) == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ old('blood_type', $patient->blood_type) == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ old('blood_type', $patient->blood_type) == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ old('blood_type', $patient->blood_type) == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ old('blood_type', $patient->blood_type) == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ old('blood_type', $patient->blood_type) == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ old('blood_type', $patient->blood_type) == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                        @error('blood_type')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Address Information</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="street_address" class="form-label">Street Address *</label>
                        <input type="text" class="form-input @error('street_address') border-red-500 @enderror"
                               id="street_address" name="street_address" value="{{ old('street_address', $user->street_address) }}" placeholder="Street address, sitio, barangay" required>
                        @error('street_address')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="region" class="form-label">Region *</label>
                        <select class="form-select @error('region') border-red-500 @enderror"
                                id="region" name="region" required>
                            <option value="">Select Region</option>
                        </select>
                        @error('region')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="province" class="form-label">Province *</label>
                        <select class="form-select @error('province') border-red-500 @enderror"
                                id="province" name="province" required>
                            <option value="">Select Province</option>
                        </select>
                        @error('province')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="municipality" class="form-label">Municipality/City *</label>
                        <select class="form-select @error('municipality') border-red-500 @enderror"
                                id="municipality" name="municipality" required>
                            <option value="">Select Municipality/City</option>
                        </select>
                        @error('municipality')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="barangay" class="form-label">Barangay *</label>
                        <select class="form-select @error('barangay') border-red-500 @enderror"
                                id="barangay" name="barangay" required>
                            <option value="">Select Barangay</option>
                        </select>
                        @error('barangay')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="postal_code" class="form-label">Postal Code (Optional)</label>
                        <input type="text" class="form-input @error('postal_code') border-red-500 @enderror"
                               id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" placeholder="Postal code">
                        @error('postal_code')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>




            <!-- Security -->
            <div>
                <div class="section-divider">
                    <span class="section-title">Security</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password</label>
                        <div class="password-input">
                            <input type="password" class="form-input password @error('current_password') border-red-500 @enderror"
                                   id="current_password" name="current_password" placeholder="Current password">
                            <button type="button" id="toggle-current-password" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="password-input">
                            <input type="password" class="form-input password @error('new_password') border-red-500 @enderror"
                                   id="new_password" name="new_password" placeholder="New password">
                            <button type="button" id="toggle-new-password" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('new_password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <div class="password-input">
                            <input type="password" class="form-input password"
                                   id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm new password">
                            <button type="button" id="toggle-confirm-password" class="password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                <button type="submit" class="btn-primary flex-1 text-lg py-4">
                    <i class="fas fa-save mr-2"></i>
                    Update Profile
                </button>
                <a href="{{ route('patient.profile.index') }}" class="btn btn-secondary flex-1 text-lg py-4 text-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Profile
                </a>
            </div>
        </form>
    </div>
</div>
</div>

<script src="{{ asset('assets/js/philippine-addresses.js') }}"></script>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Philippine address dropdowns
    initializeAddressSelection();

    // Set current values if they exist
    const currentRegion = '{{ $user->region }}';
    const currentProvince = '{{ $user->province }}';
    const currentMunicipality = '{{ $user->municipality }}';
    const currentBarangay = '{{ $user->barangay }}';

    if (currentRegion) {
        document.getElementById('region').value = currentRegion;
        populateProvinces(currentRegion);
    }

    if (currentProvince) {
        setTimeout(() => {
            document.getElementById('province').value = currentProvince;
            populateMunicipalities(currentProvince);
        }, 100);
    }

    if (currentMunicipality) {
        setTimeout(() => {
            document.getElementById('municipality').value = currentMunicipality;
            populateBarangays(currentMunicipality);
        }, 200);
    }

    if (currentBarangay) {
        setTimeout(() => {
            document.getElementById('barangay').value = currentBarangay;
        }, 300);
    }

    // Password toggle functionality
    const toggleCurrentPassword = document.getElementById('toggle-current-password');
    const toggleNewPassword = document.getElementById('toggle-new-password');
    const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
    const currentPasswordInput = document.getElementById('current_password');
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('new_password_confirmation');

    if (toggleCurrentPassword && currentPasswordInput) {
        toggleCurrentPassword.addEventListener('click', function() {
            const type = currentPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            currentPasswordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }

    if (toggleNewPassword && newPasswordInput) {
        toggleNewPassword.addEventListener('click', function() {
            const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            newPasswordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }

    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }
});
</script>
@endpush

@endsection