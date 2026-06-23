<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>SIJA PARKING - @yield('title', 'Dashboard')</title>

  <link href="{{ asset('assets/css/font.css') }}" rel="stylesheet" />
  <style>
    body {
      font-family: 'Open Sans:300,400,600,700', sans-serif;
    }
  </style>

  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

  <script src="{{ asset('assets/js/plugins/all.js') }}" crossorigin="anonymous"></script>

  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main" style="z-index: 999;">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0 d-flex align-items-center" href="{{ route('transaction.index') }}">
        <img src="{{ asset('assets/img/parkir.png') }}" alt="SIJA PARKING" class="navbar-brand-img me-2" style="width: 32px; height: 32px; object-fit: cover; border-radius: 0.45rem;">
        <span class="ms-1 font-weight-bold">SIJA PARKING</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main" style="height: auto;">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link {{ Route::is('location.*') ? 'active' : '' }}" href="{{ route('location.index') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-map-marker-alt {{ Route::is('location.*') ? 'text-white' : 'text-dark' }} text-xs"></i>
            </div>
            <span class="nav-link-text ms-1">Location</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Route::is('transaction.*') ? 'active' : '' }}" href="{{ route('transaction.index') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-exchange-alt {{ Route::is('transaction.*') ? 'text-white' : 'text-dark' }} text-xs"></i>
            </div>
            <span class="nav-link-text ms-1">Transaction</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Route::is('vehicle-type.*') ? 'active' : '' }}" href="{{ route('vehicle-type.index') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-car {{ Route::is('vehicle-type.*') ? 'text-white' : 'text-dark' }} text-xs"></i>
            </div>
            <span class="nav-link-text ms-1">Vehicle Type</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">REPORTS</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('report.location') ? 'active' : '' }}" href="{{ route('report.location') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-chart-bar {{ Route::is('report.location') ? 'text-white' : 'text-dark' }} text-xs"></i>
            </div>
            <span class="nav-link-text ms-1">Location Report</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('report.transaction') ? 'active' : '' }}" href="{{ route('report.transaction') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-file-invoice {{ Route::is('report.transaction') ? 'text-white' : 'text-dark' }} text-xs"></i>
            </div>
            <span class="nav-link-text ms-1">Transaction Report</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('page_title', 'Dashboard')</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">@yield('page_title', 'Dashboard')</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav justify-content-end">

            @yield('header_actions')

            <li class="nav-item d-flex align-items-center ms-3">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign Out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid py-4">
      @if (session('success'))
        <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
          <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
          <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">
          <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
          <span class="alert-text"><strong>Error!</strong> {{ session('error') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">
          <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
          <span class="alert-text">
            <strong>Validation Error:</strong>
            <ul class="mb-0 mt-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @yield('content')

      <footer class="footer pt-3 mt-4">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12 mb-lg-0 mb-4 text-center text-lg-start">
              <div class="copyright text-center text-sm text-muted">
                &copy; <script>document.write(new Date().getFullYear())</script>, made with by <strong>fadlan</strong> for ASAS Ganjil Web And Mobile Development - SMKN 1 Cibinong.
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>

  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  @yield('scripts')
</body>
</html>
