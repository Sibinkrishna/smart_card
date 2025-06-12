<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->profile;

        return view('user.profile.show', compact('profile'));
    }

    // Update the profile
    public function update(Request $request)
    {
        $request->validate([
            'gender' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'nationality' => 'nullable|string|max:100',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile = Auth::user()->profile;

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
            $profile->profile_image = $imagePath;
        }

        $profile->gender = $request->gender;
        $profile->address = $request->address;
        $profile->pincode = $request->pincode;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->nationality = $request->nationality;

        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
