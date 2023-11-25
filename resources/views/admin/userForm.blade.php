<x-layout>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <!-- User Creation Card -->
          <div class="card mb-3">
            <div class="card-body">
              <!-- Title -->
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create User</h5>
                <p class="text-center small">Enter details to create a new user</p>
              </div>

              <!-- User Creation Form -->
              <form class="row g-3" method="POST" action="/create_user" enctype="multipart/form-data">
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
                <!-- Additional fields similar to the 'create_profile' form -->
                <!-- First Name -->
                <div class="col-12">
                  <label for="first_name" class="form-label">First Name</label>
                  <input type="text" value="{{ old('first_name') }}" name="first_name" class="form-control"
                    id="first_name" required>
                  @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Last Name -->
                <div class="col-12">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control"
                    id="last_name" required>
                  @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Date of Birth -->
                <div class="col-12">
                  <label for="date_of_birth" class="form-label">Date of Birth</label>
                  <input type="date" value="{{ old('date_of_birth') }}" name="date_of_birth" class="form-control"
                    id="date_of_birth" required>
                  @error('date_of_birth')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Telephone -->
                <div class="col-12">
                  <label for="telephone" class="form-label">Telephone</label>
                  <input type="text" value="{{ old('telephone') }}" name="telephone" class="form-control"
                    id="telephone">
                  @error('telephone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Next of Kin -->
                <div class="col-12">
                  <label for="next_of_kin" class="form-label">Next of Kin</label>
                  <input type="text" value="{{ old('next_of_kin') }}" name="next_of_kin" class="form-control"
                    id="next_of_kin">
                  @error('next_of_kin')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Passport Photograph -->
                <div class="col-12">
                  <label for="passport_photograph" class="form-label">Passport Photograph</label>
                  <input type="file" name="passport_photograph" class="form-control-file" id="passport_photograph"
                    required>
                  @error('passport_photograph')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Any Illness -->
                <div class="col-12">
                  <label for="any_illness" class="form-label">Any Illness</label>
                  <input type="text" value="{{ old('any_illness') }}" name="any_illness" class="form-control"
                    id="any_illness">
                  @error('any_illness')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Last Residence Address -->
                <div class="col-12">
                  <label for="last_residence_address" class="form-label">Last Residence Address</label>
                  <input type="text" value="{{ old('last_residence_address') }}" name="last_residence_address"
                    class="form-control" id="last_residence_address">
                  @error('last_residence_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Recommended Source Type -->
                <div class="col-12">
                  <label for="source_type" class="form-label">Recommended Source Type</label>
                  <select name="source_type" class="form-control" id="source_type">
                    <option value="">Choose...</option>
                    <option value="police">Police</option>
                    <option value="prison">Prison</option>
                    <option value="immigration">Immigration</option>
                  </select>
                  @error('source_type')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Recommended Source Address -->
                <div class="col-12">
                  <label for="source_address" class="form-label">Recommended Source Address</label>
                  <select name="source_address" class="form-control" id="source_address">
                    <option value="">Select Address...</option>
                    {{-- @foreach ($source_addresses as $address)
                      <option value="{{ $address }}" {{ old('source_address') == $address ? 'selected' : '' }}>
                        {{ $address }}
                      </option>
                    @endforeach --}}
                  </select>
                  @error('source_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>


                <!-- Submit Button -->
                <div class="col-12 mt-3">
                  <button class="btn btn-primary w-100" type="submit">Create User</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-layout>
