
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin-template/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('admin-template/img/favicon.png') }}">
  <title>
    @if (isset($profilSekolah) && $profilSekolah->nama_sekolah)
        {{ $profilSekolah->nama_sekolah }} - @yield('title', 'Dashboard Guru')
    @else
        @yield('title', 'Dashboard Guru')
    @endif
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('admin-template/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin-template/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('admin-template/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
  {{-- Custom CSS for overrides --}}
  <link href="{{ asset('admin-template/css/custom.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin-template/css/loading.css') }}" rel="stylesheet" />
  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('styles')
</head>

<body class="g-sidenav-show  bg-gray-200">

  <div class="global-progress-bar" id="global-progress-bar">
    <div class="progress"></div>
  </div>

  <div class="loading-overlay" id="loading-overlay">
      <div class="loading-spinner"></div>
  </div>
  
  {{-- Sidebar --}}
  @include('guru.partials.sidebar')
  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    {{-- Navbar --}}
    @include('guru.partials.navbar')

    <div class="container-fluid py-4">
      
      {{-- Content --}}
      @yield('content')

      {{-- Footer --}}
      @include('admin.partials.footer')

    </div>
  </main>

  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="{{ asset('admin-template/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('admin-template/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin-template/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('admin-template/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('admin-template/js/plugins/chartjs.min.js') }}"></script>
  
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('admin-template/js/material-dashboard.min.js?v=3.0.0') }}"></script>

  <!-- Custom UI Settings -->
  <script src="{{ asset('admin-template/js/custom-ui-settings.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const progressBar = document.getElementById('global-progress-bar');
        const loadingOverlay = document.getElementById('loading-overlay');

        const showLoading = () => {
            if (progressBar) progressBar.style.display = 'block';
            if (loadingOverlay) loadingOverlay.style.display = 'flex';
        };

        const hideLoading = () => {
            if (progressBar) progressBar.style.display = 'none';
            if (loadingOverlay) loadingOverlay.style.display = 'none';
        };

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', showLoading);
        });

        document.querySelectorAll('a[href]').forEach(link => {
            if (link.target === '_blank' || link.href.startsWith('javascript:') || link.href.includes('#')) {
                return;
            }
            
            link.addEventListener('click', (event) => {
                if (link.getAttribute('data-bs-toggle') !== null) {
                    return;
                }
                showLoading();
            });
        });

        window.addEventListener('pageshow', function(event) {
            hideLoading();
        });
        
        hideLoading();
    });
  </script>
  
  {{-- SweetAlert Notification Script --}}
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          @if (session('success'))
              Swal.fire({
                  icon: 'success',
                  title: 'Berhasil!',
                  text: '{{ session("success") }}',
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true
              });
          @endif

          @if (session('error'))
              Swal.fire({
                  icon: 'error',
                  title: 'Gagal!',
                  text: '{{ session("error") }}',
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000,
                  timerProgressBar: true
              });
          @endif
      });
  </script>

  @stack('scripts')

</body>

</html>
