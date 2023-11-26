<x-layout>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <!-- Admin User Creation or Edit Card -->
          <div class="card mb-3">
            <div class="card-body">
              <!-- Title -->
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">
                  {{ isset($admin_user) ? 'Edit' : 'Create' }} Admin User
                </h5>
                <p class="text-center small">
                  {{ isset($admin_user) ? 'Update the details of the admin user' : 'Enter details to create a new admin user' }}
                </p>
              </div>

              <!-- Admin User Form -->
              <form class="row g-3" method="POST"
                action="{{ isset($admin_user) ? route('admin_users.update', $admin_user) : route('admin_users.store') }}">
                @csrf
                @if (isset($admin_user))
                  @method('PUT')
                @endif

                <!-- Username -->
                <div class="col-12">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" value="{{ isset($admin_user) ? $admin_user->username : old('username') }}"
                    name="username" class="form-control" id="username" required>
                  @error('username')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Email -->
                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" value="{{ isset($admin_user) ? $admin_user->email : old('email') }}"
                    name="email" class="form-control" id="email">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Password -->
                <div class="col-12">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password"
                    {{ !isset($admin_user) ? 'required' : '' }}>
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-12">
                  <label for="password_confirmation" class="form-label">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    {{ !isset($admin_user) ? 'required' : '' }}>
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-3">
                  <button class="btn btn-primary w-100" type="submit">
                    {{ isset($admin_user) ? 'Update Admin User' : 'Create Admin User' }}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</x-layout>
