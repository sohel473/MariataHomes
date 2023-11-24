<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    function handlePassPortPhotograph(Request $request,) {
        if ($request->hasFile('passport_photograph')) {

            // Get the user
            /** @var \App\Models\User $user **/
            $user = Auth::user();

            // Generate the custom filename
            $filename = $user->id . '_' . $user->username . '_' . time() . '.' . $request->passport_photograph->extension();
    
            // Log::info("Filename: " . $filename);
    
            // Store the file in the 'public/passports' directory
            $request->passport_photograph->storeAs('passports', $filename, 'public');
    
            return $filename;
        }  
    }

    public function showProfilePage() {
        $user = Auth::user();
        $profile = $user->profile;
    
        // Check if the profile is not null
        if ($profile) {
            // Calculate age
            $dob = new \DateTime($profile->date_of_birth);
            $now = new \DateTime();
            $age = $now->diff($dob)->y;
    
            return view('profile/profile', [
                'full_name' => $profile->first_name . ' ' . $profile->last_name,
                'date_of_birth' => $profile->date_of_birth,
                'age' => $age,
                'telephone' => $profile->telephone,
                'next_of_kin' => $profile->next_of_kin,
                'passport_photograph' => $profile->passport_photograph,
                'illness' => $profile->any_illness,
                'last_residence_address' => $profile->last_residence_address,
            ]);
        } else {
            return view('profile/admin_profile', ['user' => Auth::user()]);
        }
    }
    

    public function showCreateProfilePage() {
        return view('profile/create_profile');
    }

    public function createProfile(Request $request) {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['required', 'min:3', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'telephone' => ['min:10', 'max:15'],
            'next_of_kin' => ['min:3', 'max:255'],
            'passport_photograph' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'any_illness' => ['max:255'],
            'last_residence_address' => ['min:3', 'max:255'],
        ]);

        /** @var \App\Models\User $user **/
        $user = Auth::user();

        $user->profile()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name, 
            'date_of_birth' => $request->date_of_birth,
            'telephone' => $request->telephone,
            'next_of_kin' => $request->next_of_kin,
            'passport_photograph' => $this->handlePassPortPhotograph($request),
            'any_illness' => $request->any_illness,
            'last_residence_address' => $request->last_residence_address,
        ]);
     
    
        session()->flash('success', 'You have created your profile successfully.');
    
        return redirect('/profile');
    }
}
