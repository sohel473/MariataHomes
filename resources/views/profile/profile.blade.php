<x-layout>
  <div class="row">
    <!-- Recent Passport Photograph (Left Side) -->
    <div class="col-lg-4 col-md-4">
      <div class="label">Passport Photograph</div>
      <div>
        <img src={{ $passport_photograph }} alt="Passport Photograph" style="max-width: 350px; max-height: 350px;">
      </div>
    </div>

    <!-- Information (Right Side) -->
    <div class="col-lg-8 col-md-8">
      <!-- Full Name -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Full Name</div>
        <div class="col-lg-9 col-md-8">
          {{ $full_name }}
        </div>
      </div>

      <!-- Date of Birth -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Date of Birth</div>
        <div class="col-lg-9 col-md-8">
          {{ date('d-m-Y', strtotime($date_of_birth)) }}
        </div>
      </div>

      <!-- Telephone -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Telephone</div>
        <div class="col-lg-9 col-md-8">
          {{ $telephone }}
        </div>
      </div>

      <!-- Next of Kin -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Next of Kin</div>
        <div class="col-lg-9 col-md-8">
          {{ $next_of_kin }}
        </div>
      </div>

      <!-- Age -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Age</div>
        <div class="col-lg-9 col-md-8">
          {{ $age }}
        </div>
      </div>

      <!-- Any Illness -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Any Illness</div>
        <div class="col-lg-9 col-md-8">
          {{ $illness }}
        </div>
      </div>

      <!-- Last Residence Address -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Last Residence Address</div>
        <div class="col-lg-9 col-md-8">
          {{ $last_residence_address }}
        </div>
      </div>

      <!-- Recommended Source Type -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Recommended Source Type</div>
        <div class="col-lg-9 col-md-8">{{ $recommended_source_type ?? 'Not Specified' }}</div>
      </div>

      <!-- Recommended Source Address -->
      <div class="row mb-3">
        <div class="col-lg-3 col-md-4 label">Recommended Source Address</div>
        <div class="col-lg-9 col-md-8">{{ $recommended_source_address ?? 'Not Specified' }}</div>
      </div>

    </div>
  </div>
</x-layout>
