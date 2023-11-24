<x-layout>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Admin Profile</div>
        <div class="card-body">
          <!-- User Details -->
          <div class="mb-3">
            <label class="form-label">Username: </label>
            {{ $user->username }}
          </div>

          <div class="mb-3">
            <label class="form-label">Email: </label>
            {{ $user->email ?? 'Email not set' }}
          </div>
          <div class="mb-3">
            <label class="form-label">created at: </label>
            {{ $user->created_at ? $user->created_at->format('d-m-Y') : 'creation date not set' }}
          </div>

          <!-- Other Admin Specific Information -->
          <!-- You can add more admin-specific information here -->

          <!-- Links or Actions -->
          <div class="mb-3">
            <a href="/edit-profile" class="btn btn-warning">Edit Profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>
