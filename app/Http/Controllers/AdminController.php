<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\RecommendedSource;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminPage() {
        // Get all clients
        $clients = User::where('role', 'client')->whereHas('profile')->get();
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

        // Retrieve the recommendation source details
        $recommendedSourceType = $user->profile->recommendedSource->source_type ?? null;
        $recommendedSourceAddress = $user->profile->recommendedSource->source_address ?? null;

        return view('profile/profile', [
            'passport_photograph' => $user->profile->passport_photograph,
            'full_name' => $user->profile->first_name . ' ' . $user->profile->last_name,
            'date_of_birth' => $user->profile->date_of_birth,
            'age' => $age,
            'telephone' => $user->profile->telephone,
            'next_of_kin' => $user->profile->next_of_kin,
            'illness' => $user->profile->any_illness,
            'last_residence_address' => $user->profile->last_residence_address,
            'recommended_source_type' => $recommendedSourceType,
            'recommended_source_address' => $recommendedSourceAddress,
        ]);
    }

    public function showAdminUserPage(User $admin_user) {
        return view('profile/admin_profile', ['user' => $admin_user]);
    }

    public function showCreateUserPage() {
        $recommendedSources = RecommendedSource::all()->groupBy('source_type');
        return view('admin/userForm',[
            'recommendedSources' => $recommendedSources,
            'selectedSourceType' => null, // Default value for creating user
            'selectedSourceAddress' => null, // Default value for creating user
            'passportPhotographUrl' => null, // Default value for creating user
        ]);
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

    public function showEditRecommendedSourcePage(RecommendedSource $recommended_source) {
        return view('admin/recommendedSourceForm', ['recommended_source' => $recommended_source]);
    }

    public function showEditAdminUserPage(User $admin_user) {
        return view('admin/adminUserForm', ['admin_user' => $admin_user]);
    }

    public function showEditUserPage(User $user) {
        $recommendedSources = RecommendedSource::all()->groupBy('source_type');
    
        $selectedSourceType = $user->profile->recommendedSource->source_type ?? null;

        $selectedSourceAddress = $user->profile->recommendedSource->source_address ?? null;

        // Retrieve the passport photograph URL
        $passportPhotographUrl = $user->profile && $user->profile->passport_photograph
        ? asset($user->profile->passport_photograph)
        : null;

    
        return view('admin/userForm', [
            'user' => $user,
            'recommendedSources' => $recommendedSources,
            'selectedSourceType' => $selectedSourceType,
            'selectedSourceAddress' => $selectedSourceAddress,
            'passportPhotographUrl' => $passportPhotographUrl,
        ]);
    }
    
    public function editRecommendedSource(Request $request, RecommendedSource $recommended_source) {
        // Validate the request data
        $validatedData = $request->validate([
            'source_type' => 'required|in:police,prison,immigration',
            'source_address' => 'required|string|max:255',
        ]);
    
        // Update the recommended source record
        $recommended_source->update([
            'source_type' => $validatedData['source_type'],
            'source_address' => $validatedData['source_address'],
        ]);
    
        // Redirect back with a success message
        return redirect('/admin')->with('success', 'Recommended Source updated successfully.');
    }

    public function deleteRecommendedSource(RecommendedSource $recommended_source) {
        // Delete the recommended source record
        $recommended_source->delete();
    
        // Redirect back with a success message
        return redirect('/admin')->with('success', 'Recommended Source deleted successfully.');
    }
    
}
