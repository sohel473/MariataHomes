<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\RecommendedSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase; // Ensures the database is reset for each test

    /** @test */
    public function user_can_view_create_profile_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/create_profile');
        $response->assertStatus(200);
        $response->assertViewIs('profile.create_profile');
    }

    /** @test */
    public function user_can_create_profile()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $recommendedSource = RecommendedSource::factory()->create();

        $response = $this->post('/create_profile', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1990-01-01',
            'telephone' => '1234567890',
            'next_of_kin' => 'Jane Doe',
            'passport_photograph' => UploadedFile::fake()->image('passport.jpg'),
            'any_illness' => 'None',
            'last_residence_address' => '1234 Main St',
            'source_type' => $recommendedSource->source_type,
            'source_address' => $recommendedSource->source_address,
        ]);

        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            // other assertions
            'date_of_birth' => '1990-01-01',
            'telephone' => '1234567890',
            'next_of_kin' => 'Jane Doe',
            'any_illness' => 'None',
            'last_residence_address' => '1234 Main St',
            'recommended_source_id' => $recommendedSource->id,
        ]);
    }

    /** @test */
    public function user_can_view_profile_page()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->get('/profile');
        $response->assertStatus(200);
        $response->assertViewIs('profile.profile');
        $response->assertViewHas('full_name', $profile->first_name . ' ' . $profile->last_name);
        // other assertions
        $response->assertViewHas('date_of_birth', $profile->date_of_birth);
        $response->assertViewHas('age', $profile->age);
        $response->assertViewHas('telephone', $profile->telephone);
        $response->assertViewHas('next_of_kin', $profile->next_of_kin);
        $response->assertViewHas('passport_photograph', $profile->passport_photograph);
        $response->assertViewHas('illness', $profile->any_illness);
        $response->assertViewHas('last_residence_address', $profile->last_residence_address);
        $response->assertViewHas('recommended_source_type', $profile->recommended_source_type);
        $response->assertViewHas('recommended_source_address', $profile->recommended_source_address);
    }
}
