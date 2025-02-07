<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
   public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = Auth::user();

    // Validate request
    $validated = $request->validated();

    // Handle image upload
    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('profile_images', $fileName, 'public');

        // Delete old image if exists
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $validated['profile_image'] = $filePath;
    }

    // Update user data
    $user->fill($validated);

    // If email is changed, reset email verification
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    // Success Toast Message
    Flasher::addSuccess('Your profile has been successfully updated.');

    return Redirect::route('profile.edit');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        try {
            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Success Message
            Flasher::addSuccess('Your account has been successfully deleted.');

            return Redirect::route('login');
        } catch (\Exception $e) {
            // Error Message with Details
            Flasher::addError('Account deletion failed: ' . $e->getMessage());

            return Redirect::route('login');
        }
    }
}
