
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('guru.dashboard') }}" target="_blank">
      <img src="https://demos.creative-tim.com/material-dashboard/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold text-white">
        Dasbor Guru
      </span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('guru.dashboard') ? 'active bg-gradient-success' : '' }}" href="{{ route('guru.dashboard') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('guru.absensi.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('guru.absensi.create') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">checklist_rtl</i>
          </div>
          <span class="nav-link-text ms-1">Absensi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('guru.izin.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('guru.izin.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">mail</i>
          </div>
          <span class="nav-link-text ms-1">Izin & Cuti</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('guru.tugas.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('guru.tugas.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">assignment</i>
          </div>
          <span class="nav-link-text ms-1">Manajemen Tugas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('guru.materi.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('guru.materi.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">book_online</i>
          </div>
          <span class="nav-link-text ms-1">Manajemen Materi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('guru.rapor.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('guru.rapor.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
          </div>
          <span class="nav-link-text ms-1">Manajemen Rapor</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('guru.kalender.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('guru.kalender.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">event</i>
          </div>
          <span class="nav-link-text ms-1">Kalender Akademik</span>
        </a>
      </li>

      @if(Auth::guard('guru')->user()->is_kepala_sekolah)
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Kepala Sekolah</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('kepala-sekolah.izin.index') ? 'active bg-gradient-success' : '' }}" href="{{ route('kepala-sekolah.izin.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">rule</i>
            </div>
            <span class="nav-link-text ms-1">Persetujuan Izin</span>
            </a>
        </li>
      @endif


      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Akun</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('guru.profil.*') ? 'active bg-gradient-success' : '' }}" href="{{ route('guru.profil.show') }}">
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
      <a class="btn bg-gradient-primary mt-4 w-100" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-guru').submit();">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
      </a>
      <form id="logout-form-guru" action="{{ route('auth.guru.logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </div>
  </div>
</aside>
