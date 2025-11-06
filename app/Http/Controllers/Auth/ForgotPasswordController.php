<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a password reset link to the given user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
        ], [
            'email.required' => 'Email address or username is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $input = $request->email;

        // Check if input is email or username
        $user = User::where('email', $input)->orWhere('username', $input)->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'We could not find a user with that email address or username.'])
                ->withInput($request->only('email'));
        }

        $email = $user->email;

        // Send password reset link
        $status = Password::sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            Log::info('Password reset link sent', ['email' => $email]);

            return redirect()->back()
                ->with('status', 'We have emailed your password reset link!');
        } else {
            Log::error('Failed to send password reset link', ['email' => $email, 'status' => $status]);

            return redirect()->back()
                ->withErrors(['email' => 'There was an error sending the password reset link. Please try again.'])
                ->withInput($request->only('email'));
        }
    }

    /**
     * This method is no longer needed for link-based reset
     * Keeping for backward compatibility if needed
     */
    public function resendOtp(Request $request)
    {
        return response()->json([
            'success' => false,
            'message' => 'OTP resend is not available for link-based password reset.',
        ], 400);
    }
}
