<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\OtpNotification;

class OtpController extends Controller
{
    // Step 1: Request OTP (Generate and Store)
    public function requestOtp(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP and timestamp in the database (hashed for security)
        $user->otp = bcrypt($otp);
        $user->otp_created_at = now();
        $user->save();

        // Send OTP via email using a notification
        $user->notify(new OtpNotification($otp));

        return back()->with('status', 'OTP has been sent to your email.');
    }

    // Step 2: Verify OTP and Authenticate User
    public function verifyOtp(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        // Check if OTP is valid and not expired (5-minute window)
        if (Hash::check($request->otp, $user->otp) && $user->otp_created_at->diffInMinutes(now()) < 5) {
            // Authenticate user
            Auth::login($user);

            // Clear OTP to prevent reuse
            $user->otp = null;
            $user->otp_created_at = null;
            $user->save();

            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors(['otp' => 'The provided OTP is invalid or has expired.']);
        }
    }
}

