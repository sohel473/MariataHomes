<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>OurApp</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"
    integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="/main.css" />
</head>

<body>
  <header class="header-bar mb-3">
    <div class="container d-flex flex-column flex-md-row align-items-center p-3">
      <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">Mariata Homes</a></h4>

      @auth
        <div class="flex-row my-3 my-md-0">
          <a href="#" class="text-white mr-2 header-search-icon" title="Search" data-toggle="tooltip"
            data-placement="bottom"><i class="fas fa-search"></i></a>
          <span class="mr-2">
            {{ auth()->user()->username }}
          </span>
          @can('admin-access')
            <a href="/admin" class="btn btn-sm btn-success" title="Add User" data-toggle="tooltip" data-placement="bottom">
              Admin Dashboard
            </a>
          @endcan

          <form action="/logout" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-secondary">Sign Out</button>
          </form>
        </div>
      @else
        <div class="row align-items-center">
          <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
            <a href="/login" class="btn btn-sm btn-info mr-2">Login</a>
          </div>
          <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
            <a href="/register" class="btn btn-sm btn-secondary">Sign Up</a>
          </div>
        </div>
      @endauth


    </div>
  </header>
  <!-- header ends here -->

  @if (session()->has('success'))
    <div class="container container--narrow">
      <div class="alert alert-success text-center">
        {{ session('success') }}
      </div>
    </div>
  @endif

  @if (session()->has('failure'))
    <div class="container container--narrow">
      <div class="alert alert-danger text-center">
        {{ session('failure') }}
      </div>
    </div>
  @endif

  <div class="container py-md-5">
    {{ $slot }}
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script>
    $('[data-toggle="tooltip"]').tooltip()
  </script>
</body>

</html>
