
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('siswa.dashboard') }}" target="_blank">
      <img src="https://demos.creative-tim.com/material-dashboard/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold text-white">
        Dasbor Siswa
      </span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('siswa.dashboard') ? 'active bg-gradient-success' : '' }}" href="{{ route('siswa.dashboard') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('siswa.absensi.create') ? 'active bg-gradient-success' : '' }}" href="{{ route('siswa.absensi.create') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">checklist_rtl</i>
          </div>
          <span class="nav-link-text ms-1">Absensi</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('siswa.absensi.riwayat') ? 'active bg-gradient-success' : '' }}" href="{{ route('siswa.absensi.riwayat') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">history</i>
          </div>
          <span class="nav-link-text ms-1">Riwayat Absensi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('siswa.tugas.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('siswa.tugas.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">assignment</i>
          </div>
          <span class="nav-link-text ms-1">Tugas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('siswa.materi.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('siswa.materi.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">book_online</i>
          </div>
          <span class="nav-link-text ms-1">Materi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('siswa.rapor.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('siswa.rapor.show') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
          </div>
          <span class="nav-link-text ms-1">Rapor</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('siswa.kalender.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('siswa.kalender.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">event</i>
          </div>
          <span class="nav-link-text ms-1">Kalender Akademik</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Akun</h6>
      </li>
       <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('siswa.profil.show') ? 'active bg-gradient-success' : '' }}" href="{{ route('siswa.profil.show') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">person</i>
          </div>
          <span class="nav-link-text ms-1">Profil</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-siswa').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        <form id="logout-form-siswa" action="{{ route('auth.siswa.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
  </div>
</aside>
