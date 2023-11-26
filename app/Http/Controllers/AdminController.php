<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\RecommendedSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    function handlePassPortPhotograph(Request $request, User $user) {
        if ($request->hasFile('passport_photograph')) {

            // Generate the custom filename
            $filename = $user->id . '_' . $user->username . '_' . time() . '.' . $request->passport_photograph->extension();
    
            // Log::info("Filename: " . $filename);
    
            // Store the file in the 'public/passports' directory
            $request->passport_photograph->storeAs('passports', $filename, 'public');

            Log::info("Filename: " . $filename);
    
            return $filename;
        }  
    }

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

    public function createAdminUser(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['max:255'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
    
        // Create the new admin user
        User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'admin',
        ]);
    
        // Redirect back with a success message
        return redirect('/admin')->with('success', 'Admin User created successfully.');
    }
    
    public function editAdminUser(Request $request, User $admin_user) {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $admin_user->id],
            'email' => ['max:255'],
            'password' => ['nullable', 'string', 'min:5', 'confirmed'],
        ]);
    
        // Update the admin user record
        $admin_user->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $admin_user->password,
        ]);
    
        // Redirect back with a success message
        return redirect('/admin')->with('success', 'Admin User updated successfully.');
    }

    public function deleteAdminUser(User $admin_user) {
        // Delete the admin user record
        $admin_user->delete();
    
        // Redirect back with a success message
        return redirect('/admin')->with('success', 'Admin User deleted successfully.');
    }

    public function createUser(Request $request) {
        // Validate the request data
        $validatedUserData = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['max:255'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            // Add validation rules for profile fields
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['required', 'min:3', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'telephone' => ['max:15'],
            'next_of_kin' => ['max:255'],
            'any_illness' => ['max:255'],
            'last_residence_address' => ['max:255'],
            'source_type' => ['required', 'string'],
            'source_address' => ['required', 'string'],
        ]);

        // Query the recommended source by type and address
        $recommendedSource = RecommendedSource::where('source_type', $request->source_type)
                                               ->where('source_address', $request->source_address)
                                               ->first();
    
        // Check if a matching recommended source was found
        if (!$recommendedSource) {
            return back()->withErrors(['source_address' => 'Invalid recommended source address.'])->withInput();
        }

        // Create the new user
        $user = User::create([
            'username' => $validatedUserData['username'],
            'email' => $validatedUserData['email'],
            'password' => bcrypt($validatedUserData['password']),
        ]);

        $user->profile()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name, 
            'date_of_birth' => $request->date_of_birth,
            'telephone' => $request->telephone,
            'next_of_kin' => $request->next_of_kin,
            'passport_photograph' => $this->handlePassPortPhotograph($request, $user),
            'any_illness' => $request->any_illness,
            'last_residence_address' => $request->last_residence_address,
            'recommended_source_id' => $recommendedSource->id,
        ]);

        // Redirect back with a success message
        return redirect('/admin')->with('success', 'User created successfully.');
    
    }

    public function editUser(Request $request, User $user) {
        // Validate the request data
        $validatedUserData = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['max:255'],
            // Add validation rules for profile fields
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['required', 'min:3', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'telephone' => ['max:15'],
            'next_of_kin' => ['max:255'],
            'any_illness' => ['max:255'],
            'last_residence_address' => ['max:255'],
            'source_type' => ['required', 'string'],
            'source_address' => ['required', 'string'],
        ]);
    
        // Update the user record
        $user->update([
            'username' => $validatedUserData['username'],
            'email' => $validatedUserData['email'],
            // Only update password if it's provided
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        // Query the recommended source by type and address
        $recommendedSource = RecommendedSource::where('source_type', $request->source_type)
                                               ->where('source_address', $request->source_address)
                                               ->first();
    
        // Check if a matching recommended source was found
        if (!$recommendedSource) {
            return back()->withErrors(['source_address' => 'Invalid recommended source address.'])->withInput();
        }
    
        // Handle passport photograph upload
        $passportPhotograph = $this->handlePassPortPhotograph($request, $user);
    
        // Update or create the profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name, 
                'date_of_birth' => $request->date_of_birth,
                'telephone' => $request->telephone,
                'next_of_kin' => $request->next_of_kin,
                'passport_photograph' => $passportPhotograph ?:$user->profile->getRawOriginal('passport_photograph'),
                'any_illness' => $request->any_illness,
                'last_residence_address' => $request->last_residence_address,
                'recommended_source_id' => $recommendedSource->id,
            ]
        );
    
        // Redirect back with a success message
        return redirect('/admin')->with('success', 'User updated successfully.');
    }
    


    public function deleteUser(User $user) {
        // Delete the user record
        $user->delete();
    
        // Redirect back with a success message
        return redirect('/admin')->with('success', 'User deleted successfully.');
    }
}
