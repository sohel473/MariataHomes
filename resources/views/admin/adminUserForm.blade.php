<x-layout>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <!-- Admin User Creation Card -->
          <div class="card mb-3">
            <div class="card-body">
              <!-- Title -->
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create Admin User</h5>
                <p class="text-center small">Enter details to create a new admin user</p>
              </div>

              <!-- Admin User Creation Form -->
              <form class="row g-3" method="POST" action="/create_admin_user">
                @csrf
                <!-- Username -->
                <div class="col-12">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" value="{{ old('username') }}" name="username" class="form-control"
                    id="username" required>
                  @error('username')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Email -->
                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email"
                    required>
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Submit Button -->
                <div class="col-12 mt-3">
                  <button class="btn btn-primary w-100" type="submit">Create Admin User</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-layout>
