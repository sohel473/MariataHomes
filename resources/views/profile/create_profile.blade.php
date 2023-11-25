<x-layout>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <!-- Profile Creation Card -->
          <div class="card mb-3">
            <div class="card-body">
              <!-- Title -->
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create Your Profile</h5>
                <p class="text-center small">Enter your personal details to create a profile</p>
              </div>

              <!-- Profile Creation Form -->
              <form class="row g-3" method="POST" action="/create_profile" enctype="multipart/form-data">
                @csrf

                <!-- First Name -->
                <div class="col-12">
                  <label for="yourFirstName" class="form-label">First Name</label>
                  <input type="text" value="{{ old('first_name') }}" name="first_name" class="form-control"
                    id="yourFirstName" required>
                  @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Last Name -->
                <div class="col-12">
                  <label for="yourLastName" class="form-label">Last Name</label>
                  <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control"
                    id="yourLastName" required>
                  @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Date of Birth -->
                <div class="col-12">
                  <label for="yourDateOfBirth" class="form-label">Date of Birth</label>
                  <input type="date" value="{{ old('date_of_birth') }}" name="date_of_birth" class="form-control"
                    id="yourDateOfBirth" required>
                  @error('date_of_birth')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Telephone -->
                <div class="col-12">
                  <label for="yourTelephone" class="form-label">Telephone</label>
                  <input type="text" value="{{ old('telephone') }}" name="telephone" class="form-control"
                    id="yourTelephone">
                  @error('telephone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Next of Kin -->
                <div class="col-12">
                  <label for="yourNextOfKin" class="form-label">Next of Kin</label>
                  <input type="text" value="{{ old('next_of_kin') }}" name="next_of_kin" class="form-control"
                    id="yourNextOfKin">
                  @error('next_of_kin')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Recent Passport Photograph -->
                <div class="col-12">
                  <label for="passportPhotograph" class="form-label">Passport Photograph</label>
                  <input type="file" value="{{ old('passport_photograph') }}" name="passport_photograph"
                    class="form-control-file" id="passportPhotograph" required>
                  @error('passport_photograph')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Any Illness -->
                <div class="col-12">
                  <label for="yourIllness" class="form-label">Any Illness</label>
                  <input type="text" value="{{ old('any_illness') }}" name="any_illness" class="form-control"
                    id="yourIllness">
                  @error('any_illness')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Last Residence Address -->
                <div class="col-12">
                  <label for="yourResidenceAddress" class="form-label">Last Residence Address</label>
                  <input type="text" value="{{ old('last_residence_address') }}" name="last_residence_address"
                    class="form-control" id="yourResidenceAddress">
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
                    <!-- Options will be populated by JavaScript -->
                  </select>
                  @error('source_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-3">
                  <button class="btn btn-primary w-100" type="submit">Create Profile</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- JavaScript to update source_address options -->
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
