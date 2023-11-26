<x-layout>


  <div class="container py-md-5 container--narrow">
    <div class="text-center">
      <h2>
        {{ auth()->user()->username }}
        <a href="/profile" class="btn btn-info btn-sm">See Profile</a>
      </h2>
    </div>

    <!-- Nav Pills -->
    <div class="d-flex justify-content-center mb-3">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
            aria-controls="pills-home" aria-selected="true">
            Clients: {{ $clients->count() }}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
            aria-controls="pills-profile" aria-selected="false">
            Admins: {{ $admins->count() }}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
            aria-controls="pills-contact" aria-selected="false">
            Recommendation Sources: {{ $recommended_sources->count() }}
          </a>
        </li>
      </ul>
    </div>


    <!-- Tab Content -->
    <div class="tab-content" id="pills-tabContent">
      <!-- Clients Tab -->
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <!-- Add Client Button -->
        <div class="text-center">
          <a href="/create_user" class="btn btn-sm btn-outline-primary mb-3">Add Client</a>
        </div>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="list-group">
              @foreach ($clients as $client)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                  <div>
                    <strong style="color: blue;">{{ $client->username }}</strong> created at
                    {{ $client->created_at->format('n/j/Y') }}
                  </div>
                  <div>
                    <a href="/user/{{ $client->id }}" class="text-info me-2" data-toggle="tooltip"
                      data-placement="top" title="View">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="/user/{{ $client->id }}/edit" class="text-primary me-2" data-toggle="tooltip"
                      data-placement="top" title="Edit">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="/user/{{ $client->id }}/delete" class="text-danger" data-toggle="tooltip"
                      data-placement="top" title="Delete">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <!-- Admins Tab -->
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <!-- Add Admin Button -->
        <div class="text-center">
          <a href="/create_admin_user" class="btn btn-sm btn-outline-primary mb-3">Add Admin</a>
        </div>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="list-group">
              @foreach ($admins as $admin)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                  <div>
                    <strong style="color: blue;">{{ $admin->username }}</strong> created at
                    {{ $admin->created_at->format('n/j/Y') }}
                  </div>
                  <div>
                    <a href="/admin_user/{{ $admin->id }}" class="text-info me-2" data-toggle="tooltip"
                      data-placement="top" title="View">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="/admin_user/{{ $admin->id }}/edit" class="text-primary me-2" data-toggle="tooltip"
                      data-placement="top" title="Edit">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="/admin_user/{{ $admin->id }}/delete" class="text-danger" data-toggle="tooltip"
                      data-placement="top" title="Delete">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <!-- Recommended Sources Tab -->
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <!-- Add Source Button -->
        <div class="text-center">
          <a href="/create_recommended_source" class="btn btn-sm btn-outline-primary mb-3">Add Source</a>
        </div>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="list-group">
              @foreach ($recommended_sources as $recommended_source)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                  <div style="flex: 1; min-width: 0;">
                    <strong style="color: blue; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                      {{ $recommended_source->source_address }}
                    </strong> Type: {{ $recommended_source->source_type }}
                  </div>
                  <div class="icon-container" style="flex-shrink: 0;">
                    <a href="/recommended_source/{{ $recommended_source->id }}/edit" class="text-primary me-2"
                      data-toggle="tooltip" data-placement="top" title="Edit">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:void(0);"
                      onclick="confirmDelete('/recommended_source/{{ $recommended_source->id }}')"
                      class="text-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                    <!-- Hidden Delete Form -->
                    <form id="delete-form" action="" method="POST" style="display: none;">
                      @csrf
                      @method('DELETE')
                    </form>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function confirmDelete(deleteUrl) {
      if (confirm("Are you sure you want to delete this source?")) {
        var form = document.getElementById('delete-form');
        form.action = deleteUrl;
        form.submit();
      }
    }
  </script>

</x-layout>
