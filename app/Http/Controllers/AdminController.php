<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\RecommendedSource;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminPage() {
        // Get all clients
        $clients = User::where('role', 'client')->get();
        // get all admins
        $admins = User::where('role', 'admin')->get();
        // get all recommended sources
        $recommended_sources = RecommendedSource::all();
        return view('admin/adminDashboard', [
            'clients' => $clients,
            'admins' => $admins,
            'recommended_sources' => $recommended_sources,
        ]);
    }

    public function showUserPage(User $user) {
        // Calculate age
        $dob = new \DateTime($user->profile->date_of_birth);
        $now = new \DateTime();
        $age = $now->diff($dob)->y;

        return view('profile/profile', [
            'passport_photograph' => $user->profile->passport_photograph,
            'full_name' => $user->profile->first_name . ' ' . $user->profile->last_name,
            'date_of_birth' => $user->profile->date_of_birth,
            'age' => $age,
            'telephone' => $user->profile->telephone,
            'next_of_kin' => $user->profile->next_of_kin,
            'illness' => $user->profile->any_illness,
            'last_residence_address' => $user->profile->last_residence_address,
        ]);
    }

    public function showAdminUserPage(User $admin_user) {
        return view('profile/admin_profile', ['user' => $admin_user]);
    }

    public function showCreateUserPage() {
        return view('admin/userForm');
    }

    public function showCreateAdminUserPage() {
        return view('admin/adminUserForm');
    }

    public function showCreateRecommendedSourcePage() {
        return view('admin/recommendedSourceForm');
    }

    public function createRecommendedSource(Request $request) {
        // Validate the request
        $validatedData = $request->validate([
            'source_type' => 'required|in:police,prison,immigration',
            'source_address' => 'required|string|max:255',
        ]);
    
        // Create a new recommended source record
        $recommendedSource = RecommendedSource::create([
            'source_type' => $validatedData['source_type'],
            'source_address' => $validatedData['source_address'],
        ]);
    
        // Redirect to back with success message
        return redirect('/admin')->with('success', 'Recommended Source created successfully.');
    }
    
}
