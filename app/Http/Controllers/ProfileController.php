<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateImage(Request $request) {

        $oldImage = $request->oldImage;

        if ($request->hasFile('profile')) {

            if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                unlink(public_path('images/' . $oldImage));
            }

            $file = $request->file('profile');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            User::where('id', Auth::user()->id)->update([
                'profile_image' => $filename
            ]);

        } else {
            User::where('id', Auth::user()->id)->update([
                'profile_image' => $request->oldImage ?: null
            ]);
        }

        if(Auth::user()->role == 'user') {
            return to_route('applicant.profile')->with([
                'title' => 'Updated Successfully',
                'message' => 'Your profile image has updated successfully!.'
            ]);
        }
        elseif(Auth::user()->role == 'employer') {
            return to_route('employer.profile')->with([
                'title' => 'Updated Successfully',
                'message' => 'Your profile image has updated successfully!.'
            ]);
        }
    }

    public function removeImage() {
        $user = Auth::user();
        $image = $user->profile_image;

        if($image) {
            unlink(public_path('images/' . $image ));

            User::where('id', $user->id)->update([
                'profile_image' => null
            ]);
        }

        return redirect()->route('applicant.profile.edit');
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

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
