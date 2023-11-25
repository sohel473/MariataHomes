<x-layout>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <!-- Recommended Source Creation Card -->
          <div class="card mb-3">
            <div class="card-body">
              <!-- Title -->
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create Recommended Source</h5>
                <p class="text-center small">Enter the details of the recommended source</p>
              </div>

              <!-- Recommended Source Creation Form -->
              <form class="row g-3" method="POST" action="/create_recommended_source">
                @csrf
                <!-- Source Type -->
                <div class="col-12">
                  <label for="source_type" class="form-label">Source Type</label>
                  <select name="source_type" class="form-control" id="source_type" required>
                    <option value="">Choose...</option>
                    <option value="police">Police</option>
                    <option value="prison">Prison</option>
                    <option value="immigration">Immigration</option>
                  </select>
                  @error('source_type')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Source Address -->
                <div class="col-12">
                  <label for="source_address" class="form-label">Source Address</label>
                  <input type="text" value="{{ old('source_address') }}" name="source_address" class="form-control"
                    id="source_address" required>
                  @error('source_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Submit Button -->
                <div class="col-12 mt-3">
                  <button class="btn btn-primary w-100" type="submit">Create Source</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-layout>
