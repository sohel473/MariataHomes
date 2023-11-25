<x-layout>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <!-- Recommended Source Creation or Edit Card -->
          <div class="card mb-3">
            <div class="card-body">
              <!-- Title -->
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">
                  {{ isset($recommended_source) ? 'Edit' : 'Create' }} Recommended Source
                </h5>
                <p class="text-center small">
                  {{ isset($recommended_source) ? 'Update the details of the recommended source' : 'Enter the details of the recommended source' }}
                </p>
              </div>

              <!-- Recommended Source Form -->
              <form class="row g-3" method="POST"
                action="{{ isset($recommended_source) ? route('recommended_sources.update', $recommended_source) : route('recommended_sources.store') }}">
                @csrf
                @if (isset($recommended_source))
                  @method('PUT')
                @endif

                <!-- Source Type -->
                <div class="col-12">
                  <label for="source_type" class="form-label">Source Type</label>
                  <select name="source_type" class="form-control" id="source_type" required>
                    <option value="">Choose...</option>
                    <option value="police"
                      {{ isset($recommended_source) && $recommended_source->source_type == 'police' ? 'selected' : '' }}>
                      Police</option>
                    <option value="prison"
                      {{ isset($recommended_source) && $recommended_source->source_type == 'prison' ? 'selected' : '' }}>
                      Prison</option>
                    <option value="immigration"
                      {{ isset($recommended_source) && $recommended_source->source_type == 'immigration' ? 'selected' : '' }}>
                      Immigration</option>
                  </select>
                  @error('source_type')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Source Address -->
                <div class="col-12">
                  <label for="source_address" class="form-label">Source Address</label>
                  <input type="text"
                    value="{{ isset($recommended_source) ? $recommended_source->source_address : old('source_address') }}"
                    name="source_address" class="form-control" id="source_address" required>
                  @error('source_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-3">
                  <button class="btn btn-primary w-100" type="submit">
                    {{ isset($recommended_source) ? 'Update Source' : 'Create Source' }}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- JavaScript to clear the source address when the source type changes --}}
  <script>
    document.getElementById('source_type').addEventListener('change', function() {
      // Clear the source address input field
      document.getElementById('source_address').value = '';
    });
  </script>
</x-layout>
