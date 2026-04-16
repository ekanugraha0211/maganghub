<!-- <div class="sidebar" > -->
  {{-- Logo --}}
  <div class="logo d-flex justify-content-center align-item-center">    
    <!-- Logo Image -->
      <img src="../assets/img/simopasbiru.png" 
      alt="SIMOPAS Logo"
      style="width: 140px; height: auto; object-fit: contain;">
  </div>

  <div class="sidebar-wrapper" id="sidebar">
    <div style="padding: 16px 12px 4px;">
      <p style="font-size: 10px; font-weight: 600; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 0.1em; padding: 0 8px; margin: 0 0 4px;">Main Menu</p>
    </div>
    <ul class="nav" style="padding: 0 12 0 12px; margin-top: 0px; display: flex; flex-direction: column; gap: 2px;">
      <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
        <a href="{{ route('dashboard.index') }}" class="nav-link-custom">
          <span class="nav-icon-wrap">
            <i class="nc-icon nc-bank"></i>
          </span>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="{{ request()->routeIs('kendaraan.index') ? 'active' : '' }}">
        <a href="{{ route('kendaraan.index') }}" class="nav-link-custom">
          <span class="nav-icon-wrap">
            <i class="nc-icon nc-delivery-fast"></i>
          </span>
          <p>Data Kendaraan</p>
        </a>
      </li>
      <li class="{{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
        <a href="{{ route('peminjaman.index') }}" class="nav-link-custom">
          <span class="nav-icon-wrap">
            <i class="nc-icon nc-share-66"></i>
          </span>
          <p>Data Peminjaman</p>
        </a>
      </li>
      <li class="{{ request()->routeIs('pengembalian.index') ? 'active' : '' }}">
        <a href="{{ route('pengembalian.index') }}" class="nav-link-custom">
          <span class="nav-icon-wrap">
            <i class="nc-icon nc-refresh-69"></i>
          </span>
          <p>Data Pengembalian</p>
        </a>
      </li>
      <li class="{{ request()->routeIs('perawatan.index') ? 'active' : '' }}">
        <a href="{{ route('perawatan.index') }}" class="nav-link-custom">
          <span class="nav-icon-wrap">
            <i class="nc-icon nc-settings-gear-65"></i>
          </span>
          <p>Data Perawatan</p>
        </a>
      </li>
      <li>
  <a href="{{ route('logout') }}" class="nav-link-custom"
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

    <span class="nav-icon-wrap">
      <i class="nc-icon nc-button-power"></i>
    </span>

    <p>Logout</p>
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</li>
    </ul>

    {{-- User info di bawah --}}
    
  </div>
<!-- </div> -->

<style>
  .sidebar {
    background: #1a2744 !important;
  }

  .nav-link-custom {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 9px 10px !important;
    border-radius: 8px !important;
    color: #1e293b !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    transition: background 0.15s, color 0.15s !important;
  }

  .nav-link-custom:hover {
    background: #f1f5f9 !important;
    color: #0f172a !important;
  }

  .nav-link-custom p {
    margin: 0 !important;
    font-size: 13px !important;
  }

  .nav-icon-wrap {
    width: 32px;
    height: 32px;
    border-radius: 7px;
    background: rgba(255,255,255,0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background 0.15s;
  }

  .nav-icon-wrap i {
    font-size: 15px !important;
    color: inherit !important;
    position: relative !important;
    top: 0 !important;
  }

  .sidebar .nav li.active .nav-link-custom {
    background: rgba(74,158,255,0.18) !important;
    color: #4a9eff !important;
  }

  .sidebar .nav li.active .nav-icon-wrap {
    background: #e0edff !important;
    color: #1e293b !important;

  }

  .user-card-sidebar:hover {
    background: rgba(255,255,255,0.05) !important;
  }

  /* Pastikan sidebar-wrapper flex agar user card turun ke bawah */
  .sidebar .sidebar-wrapper {
    display: flex;
    flex-direction: column;
    height: calc(100% - 80px);
  }

  .sidebar .nav {
    flex-shrink: 0;
  }

  /* HAPUS SEMUA OVERLAY TEMPLATE */
.sidebar::before,
.sidebar::after {
  display: none !important;
  content: none !important;
}

/* HILANGKAN GRADASI DI LOGO */
.sidebar .logo {
  background: transparent !important;
}

/* PASTIKAN FULL WARNA SOLID */
.sidebar {
  background: white!important;
  background-image: none !important;
}
</style>