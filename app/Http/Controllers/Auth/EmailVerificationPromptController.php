<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Settings; // Make sure you import the Settings model

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // Fetch the settings where status is 0
        $setting = Settings::where('status', 0)->firstOrFail();

        // Check if the user has verified their email
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect to the dashboard if the email is verified
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Pass the setting to the view
        return view('auth.verify-email', compact('setting'));
    }
}

