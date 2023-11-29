<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\RecommendedSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertViewIs('admin.adminDashboard');
    }

    /** @test */
    public function admin_can_create_user()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $recommendedSource = RecommendedSource::factory()->create();

        $response = $this->post('/create_user', [
            'username' => 'newuser',
            'email' => 'newuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            // Additional fields for the profile
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

        $response->assertRedirect('/admin');
        $this->assertDatabaseHas('users', ['username' => 'newuser']);
        $this->assertDatabaseHas('profiles', ['first_name' => 'John']);
    }

    // Additional tests for editing user, deleting user, creating admin user, etc.

    /** @test */
    public function admin_can_download_clients_report()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get('/admin/download_clients_report');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

        /** @test */
    public function admin_can_edit_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Create a RecommendedSource
        $recommendedSource = RecommendedSource::factory()->create([
          'source_type' => 'police',
          'source_address' => '123 Main St'
      ]);

        $user = User::factory()->create();
        $newEmail = 'updated@example.com';

        $response = $this->put("/user/{$user->id}", [
            'username' => $user->username,
            'email' => $newEmail,
            // ... other fields ...
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1990-01-01',
            'telephone' => '1234567890',
            'next_of_kin' => 'Jane Doe',
            'passport_photograph' => UploadedFile::fake()->image('passport.jpg'),
            'any_illness' => 'None',
            'last_residence_address' => '1234 Main St',
            'source_type' => 'police',
            'source_address' => '123 Main St',
        ]);

        $response->assertRedirect('/admin');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'email' => $newEmail]);
    }

    /** @test */
    public function admin_can_delete_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();

        $response = $this->delete("/user/{$user->id}");

        $response->assertRedirect('/admin');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function admin_can_create_recommended_source()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->post('/create_recommended_source', [
            'source_type' => 'police',
            'source_address' => '123 Main St'
        ]);

        $response->assertRedirect('/admin');
        $this->assertDatabaseHas('recommended_sources', ['source_type' => 'police']);
    }

    /** @test */
    public function admin_can_edit_recommended_source()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $source = RecommendedSource::factory()->create();
        $newAddress = '456 Main St';

        $response = $this->put("/recommended_source/{$source->id}", [
            'source_type' => $source->source_type,
            'source_address' => $newAddress
        ]);

        $response->assertRedirect('/admin');
        $this->assertDatabaseHas('recommended_sources', ['id' => $source->id, 'source_address' => $newAddress]);
    }

    /** @test */
    public function admin_can_delete_recommended_source()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $source = RecommendedSource::factory()->create();

        $response = $this->delete("/recommended_source/{$source->id}");

        $response->assertRedirect('/admin');
        $this->assertDatabaseMissing('recommended_sources', ['id' => $source->id]);
    }

    /** @test */
    public function admin_can_download_admin_users_report()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get('/admin/download_admin_users_report');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    /** @test */
    public function admin_can_download_recommended_sources_report()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get('/admin/download_recommended_sources_report');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    // ... more tests ...

}

