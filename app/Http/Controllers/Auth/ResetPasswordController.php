<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    /**
     * Reset the given user's password.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                Log::info('Password reset completed successfully', ['email' => $user->email]);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/')->with('status', 'Your password has been reset successfully!')
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Legacy methods for backward compatibility - no longer used
     */
    public function verifyOtp(Request $request)
    {
        return redirect()->route('password.request')
            ->with('error', 'Invalid password reset link. Please request a new one.');
    }

    public function checkVerificationStatus(Request $request)
    {
        return response()->json([
            'requires_verification' => false,
            'message' => 'Token-based reset does not require additional verification.',
        ]);
    }
}
