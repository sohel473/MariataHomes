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
                  <input type="text" name="first_name" class="form-control" id="yourFirstName" required>
                  @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Last Name -->
                <div class="col-12">
                  <label for="yourLastName" class="form-label">Last Name</label>
                  <input type="text" name="last_name" class="form-control" id="yourLastName" required>
                  @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Date of Birth -->
                <div class="col-12">
                  <label for="yourDateOfBirth" class="form-label">Date of Birth</label>
                  <input type="date" name="date_of_birth" class="form-control" id="yourDateOfBirth" required>
                  @error('date_of_birth')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Telephone -->
                <div class="col-12">
                  <label for="yourTelephone" class="form-label">Telephone</label>
                  <input type="text" name="telephone" class="form-control" id="yourTelephone" required>
                  @error('telephone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Next of Kin -->
                <div class="col-12">
                  <label for="yourNextOfKin" class="form-label">Next of Kin</label>
                  <input type="text" name="next_of_kin" class="form-control" id="yourNextOfKin" required>
                  @error('next_of_kin')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Recent Passport Photograph -->
                <div class="col-12">
                  <label for="passportPhotograph" class="form-label">Passport Photograph</label>
                  <input type="file" name="passport_photograph" class="form-control-file" id="passportPhotograph"
                    required>
                  @error('passport_photograph')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Any Illness -->
                <div class="col-12">
                  <label for="yourIllness" class="form-label">Any Illness</label>
                  <input type="text" name="any_illness" class="form-control" id="yourIllness" required>
                  @error('any_illness')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Last Residence Address -->
                <div class="col-12">
                  <label for="yourResidenceAddress" class="form-label">Last Residence Address</label>
                  <input type="text" name="last_residence_address" class="form-control" id="yourResidenceAddress"
                    required>
                  @error('last_residence_address')
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
</x-layout>
