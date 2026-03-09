
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('admin.dashboard') }}" target="_blank">
      
      {{-- PERBAIKAN FINAL: Menggunakan asset() untuk path publik langsung --}}
      @if (isset($profilSekolah) && $profilSekolah->logo_path)
          <img src="{{ asset($profilSekolah->logo_path) }}" class="navbar-brand-img h-100" alt="Logo Sekolah">
      @else
          {{-- Logo default jika tidak ada logo yang di-upload --}}
          <img src="{{ asset('admin-template/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
      @endif

      <span class="ms-1 font-weight-bold text-white">
        @if (isset($profilSekolah) && $profilSekolah->nama_sekolah)
            {{ $profilSekolah->nama_sekolah }}
        @else
            Admin Panel
        @endif
      </span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.dashboard') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.pendaftaran.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.pendaftaran.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">person_add</i>
          </div>
          <span class="nav-link-text ms-1">Pendaftaran</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.keuangan.pembayaran.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.keuangan.pembayaran.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">payment</i>
          </div>
          <span class="nav-link-text ms-1">Pembayaran</span>
        </a>
      </li>
      
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Master Data</h6>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.master.jurusan.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.master.jurusan.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">school</i>
          </div>
          <span class="nav-link-text ms-1">Jurusan</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.master.guru.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.master.guru.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">hail</i>
          </div>
          <span class="nav-link-text ms-1">Guru</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.master.siswa.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.master.siswa.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">face</i>
          </div>
          <span class="nav-link-text ms-1">Siswa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.master.kelas.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.master.kelas.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">class</i>
          </div>
          <span class="nav-link-text ms-1">Kelas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.master.mapel.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.master.mapel.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">book</i>
          </div>
          <span class="nav-link-text ms-1">Mata Pelajaran</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.master.tahun-ajaran.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.master.tahun-ajaran.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">date_range</i>
          </div>
          <span class="nav-link-text ms-1">Tahun Ajaran</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.master.jadwal-pelajaran.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.master.jadwal-pelajaran.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">schedule</i>
          </div>
          <span class="nav-link-text ms-1">Jadwal Pelajaran</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.master.fasilitas.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.master.fasilitas.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">build</i>
          </div>
          <span class="nav-link-text ms-1">Fasilitas</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pengaturan</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.profil-sekolah.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.profil-sekolah.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">account_balance</i>
          </div>
          <span class="nav-link-text ms-1">Profil Sekolah</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.kalender-sekolah.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.kalender-sekolah.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">event</i>
          </div>
          <span class="nav-link-text ms-1">Kalender Akademik</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('admin.user-admin.*') ? 'active bg-gradient-primary' : '' }}" href="{{ route('admin.user-admin.index') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">manage_accounts</i>
          </div>
          <span class="nav-link-text ms-1">User Management</span>
        </a>
      </li>

    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
      <a class="btn bg-gradient-primary mt-4 w-100" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
      <form id="logout-form-admin" action="{{ route('auth.admin.logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </div>
  </div>
</aside>
