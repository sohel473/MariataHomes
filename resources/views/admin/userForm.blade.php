<x-layout>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <!-- User Creation or Edit Card -->
          <div class="card mb-3">
            <div class="card-body">
              <!-- Title -->
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">
                  {{ isset($user) ? 'Edit' : 'Create' }} User
                </h5>
                <p class="text-center small">
                  {{ isset($user) ? 'Update the details of the user' : 'Enter details to create a new user' }}
                </p>
              </div>

              <!-- User Creation Form -->
              <form class="row g-3" method="POST"
                action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($user))
                  @method('PUT')
                @endif

                <!-- Username -->
                <div class="col-12">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" value="{{ isset($user) ? $user->username : old('username') }}" name="username"
                    class="form-control" id="username" required>
                  @error('username')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Email -->
                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" value="{{ isset($user) ? $user->email : old('email') }}" name="email"
                    class="form-control" id="email">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Password -->
                <div class="col-12">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password"
                    {{ !isset($user) ? 'required' : '' }}>
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-12">
                  <label for="password_confirmation" class="form-label">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    {{ !isset($user) ? 'required' : '' }}>
                </div>

                <!-- Additional fields similar to the 'create_profile' form -->

                <!-- First Name -->
                <div class="col-12">
                  <label for="first_name" class="form-label">First Name</label>
                  <input type="text"
                    value="{{ isset($user) && $user->profile ? $user->profile->first_name : old('first_name') }}"
                    name="first_name" class="form-control" id="first_name" required>
                  @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Last Name -->
                <div class="col-12">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input type="text"
                    value="{{ isset($user) && $user->profile ? $user->profile->last_name : old('last_name') }}"
                    name="last_name" class="form-control" id="last_name" required>
                  @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Date of Birth -->
                <div class="col-12">
                  <label for="date_of_birth" class="form-label">Date of Birth</label>
                  <input type="date"
                    value="{{ isset($user) && $user->profile ? $user->profile->date_of_birth->format('Y-m-d') : old('date_of_birth') }}"
                    name="date_of_birth" class="form-control" id="date_of_birth" required>
                  @error('date_of_birth')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Telephone -->
                <div class="col-12">
                  <label for="telephone" class="form-label">Telephone</label>
                  <input type="text"
                    value="{{ isset($user) && $user->profile ? $user->profile->telephone : old('telephone') }}"
                    name="telephone" class="form-control" id="telephone">
                  @error('telephone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Next of Kin -->
                <div class="col-12">
                  <label for="next_of_kin" class="form-label">Next of Kin</label>
                  <input type="text"
                    value="{{ isset($user) && $user->profile ? $user->profile->next_of_kin : old('next_of_kin') }}"
                    name="next_of_kin" class="form-control" id="next_of_kin">
                  @error('next_of_kin')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Passport Photograph Input and Display -->
                <div class="row {{ isset($passportPhotographUrl) ? 'mt-3 ml-1' : 'col-12' }} ">
                  <!-- File Input Column -->
                  <div class="{{ isset($passportPhotographUrl) ? 'col-md-6' : 'col-12' }}">
                    <label for="passport_photograph" class="form-label">Passport Photograph</label>
                    <input type="file" name="passport_photograph" class="form-control-file" id="passport_photograph"
                      {{ !isset($user) ? 'required' : '' }}>
                    @error('passport_photograph')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <!-- Image Display Column -->
                  @if (isset($passportPhotographUrl))
                    <div class="col-md-6 text-center">
                      <img src="{{ $passportPhotographUrl }}" alt="Passport Photograph"
                        style="max-width: 200px; max-height: 200px;">
                    </div>
                  @endif
                </div>

                <!-- Any Illness -->
                <div class="col-12">
                  <label for="any_illness" class="form-label">Any Illness</label>
                  <input type="text"
                    value="{{ isset($user) && $user->profile ? $user->profile->any_illness : old('any_illness') }}"
                    name="any_illness" class="form-control" id="any_illness">
                  @error('any_illness')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Last Residence Address -->
                <div class="col-12">
                  <label for="last_residence_address" class="form-label">Last Residence Address</label>
                  <input type="text"
                    value="{{ isset($user) && $user->profile ? $user->profile->last_residence_address : old('last_residence_address') }}"
                    name="last_residence_address" class="form-control" id="last_residence_address">
                  @error('last_residence_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                {{-- Recommended Source Type --}}
                <div class="col-12">
                  <label for="source_type" class="form-label">Recommended Source Type</label>
                  <select name="source_type" class="form-control" id="source_type">
                    <option value="">Choose...</option>
                    @foreach ($recommendedSources as $type => $sources)
                      <option value="{{ $type }}"
                        {{ isset($selectedSourceType) && $selectedSourceType == $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                      </option>
                    @endforeach
                  </select>
                  @error('source_type')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                {{-- Recommended Source Address --}}
                <div class="col-12">
                  <label for="source_address" class="form-label">Recommended Source Address</label>
                  <select name="source_address" class="form-control" id="source_address">
                    <option value="">Select Address...</option>
                    @if (isset($selectedSourceType) && isset($recommendedSources[$selectedSourceType]))
                      @foreach ($recommendedSources[$selectedSourceType] as $source)
                        <option value="{{ $source->source_address }}"
                          {{ isset($selectedSourceAddress) && $selectedSourceAddress == $source->source_address ? 'selected' : '' }}>
                          {{ $source->source_address }}
                        </option>
                      @endforeach
                    @endif
                  </select>
                  @error('source_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-3">
                  <button class="btn btn-primary w-100" type="submit">
                    {{ isset($user) ? 'Update' : 'Create' }} User
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  {{-- JavaScript to update source_address options --}}
  <script>
    const recommendedSources = @json($recommendedSources);

    document.getElementById('source_type').addEventListener('change', function() {
      const type = this.value;
      const addressSelect = document.getElementById('source_address');
      addressSelect.innerHTML = '<option value="">Select Address...</option>';

      if (recommendedSources[type]) {
        recommendedSources[type].forEach(source => {
          const option = document.createElement('option');
          option.value = source.source_address;
          option.textContent = source.source_address;
          addressSelect.appendChild(option);
        });
      }
    });
  </script>
</x-layout>
