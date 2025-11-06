<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\Patient;
use App\Models\User;
use App\Services\EmailService;
use App\Providers\RouteServiceProvider;
use App\Rules\StrongPassword;
use App\Rules\ValidUsername;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                Rule::unique('users', 'username')->whereNull('deleted_at'),
                new ValidUsername,
            ],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'phone_number' => ['required', 'string', 'max:20'],
            'street_address' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'municipality' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'in:male,female,other'],
            'blood_type' => ['nullable', 'string', 'max:10'],
            'password' => [
                'required',
                'string',
                'confirmed',
                new StrongPassword,
            ],
        ], [
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'username.regex' => 'Username can only contain letters, numbers, and underscores.',
            'username.min' => 'Username must be at least 4 characters long.',
            'username.max' => 'Username cannot exceed 20 characters.',
            'username.not_regex' => 'This username is not allowed for security reasons.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Create the user
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'full_name' => trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? '')),
                'username' => $data['username'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'street_address' => $data['street_address'],
                'city' => $data['municipality'],
                'state_province' => $data['province'],
                'postal_code' => $data['postal_code'] ?? null,
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'] ?? 'patient', // Allow role to be set from data
                'is_active' => true,
            ]);

            // Create the patient record
            Patient::create([
                'user_id' => $user->id,
                'full_name' => trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? '')),
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'contact' => $data['phone_number'],
                'email' => $data['email'],
                'address' => $data['street_address'].', '.$data['municipality'].', '.$data['province'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'blood_type' => $data['blood_type'] ?? null,
                'emergency_contact' => 'Not provided',
                'emergency_contact_phone' => 'Not provided',
                'medical_history' => 'No significant medical history',
                'allergies' => 'None known',
                'current_medications' => 'None',
                'insurance_provider' => null,
                'insurance_number' => null,
                'registration_date' => now(),
                'is_active' => true,
            ]);

            return $user;
        });
    }

    /**
     /**
      * Handle a registration request for the application.
      *
      * @return \Illuminate\Http\RedirectResponse
      */
     public function register(\Illuminate\Http\Request $request)
     {
         $this->validator($request->all())->validate();

         $user = $this->create($request->all());

        // Do NOT verify or log in immediately. Send OTP for email verification
        try {
            $result = EmailService::sendOtpEmail($user, 'email_verification');

            // Put email and otp timestamp in session for verification flow
            $request->session()->put('verification_email', $user->email);
            $request->session()->put('otp_sent_time', time());

            Log::info('Registration OTP sent', [
                'user_id' => $user->id,
                'email' => $user->email,
                'sent' => $result['success'] ?? false,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send registration OTP', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        // Redirect to OTP verification page
        return redirect()->route('otp.verify.form')
            ->with('success', 'We sent a 6-digit verification code to your email. Please enter it to verify your account.');
     }

    /**
     * Redirect user based on their role
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBasedOnRole($user)
    {
        Log::info('Redirecting registered user based on role', [
            'user_id' => $user->id,
            'role' => $user->role,
        ]);

        switch ($user->role) {
            case 'doctor':
                return redirect()->route('admin.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            case 'patient':
                return redirect()->route('patient.dashboard');
            default:
                return redirect('/');
        }
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered($request, $user)
    {
        // This method is no longer used since we override register()
        // But keeping it for compatibility
    }
}
