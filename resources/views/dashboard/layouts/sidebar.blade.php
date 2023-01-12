<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand">
    <a class="navbar-brand fs-5 fw-bold" href="/">
      <span class="merek">GAMPONG</span> GEUTANYO
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    {{-- Dashboard --}}
    <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
      <a href="/dashboard" class="menu-link">
        <i class="fa-duotone fa-grid-2 me-3"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    @can('admin')
      {{-- Berita --}}
      <li class="menu-item {{ Request::is('dashboard/berita*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="fa-duotone fa-newspaper me-3"></i>
          <div data-i18n="Layouts">Berita</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('dashboard/berita/data-berita*') ? 'active' : '' }}">
            <a href="/dashboard/berita/data-berita" class="menu-link">
              <div data-i18n="solusi">Data Berita</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('dashboard/berita/kategori-berita*') ? 'active' : '' }}">
            <a href="/dashboard/berita/kategori-berita" class="menu-link">
              <div data-i18n="data surat">Kategori Berita</div>
            </a>
          </li>
        </ul>
      </li>
    @endcan

    @canany(['admin', 'sekdes'])
      {{-- Administrasi --}}
      <li class="menu-item {{ Request::is('dashboard/administrasi*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="fa-duotone fa-envelope me-3"></i>
          <div data-i18n="Layouts">Administrasi</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('dashboard/administrasi/solusi*') ? 'active' : '' }}">
            <a href="/dashboard/administrasi/solusi" class="menu-link">
              <div data-i18n="solusi">Solusi</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('dashboard/administrasi/data-surat*') ? 'active' : '' }}">
            <a href="/dashboard/administrasi/data-surat" class="menu-link">
              <div data-i18n="data-surat">Data Surat</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('dashboard/administrasi/perizinan*') ? 'active' : '' }}">
            <a href="/dashboard/administrasi/perizinan" class="menu-link">
              <div data-i18n="perizinan">Perizinan Tamu</div>
            </a>
          </li>
        </ul>
      </li>
    @endcanany

    {{-- Laporan --}}
    <li class="menu-item {{ Request::is('dashboard/laporan*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="fa-duotone fa-chart-mixed me-3"></i>
        <div data-i18n="Layouts">Laporan</div>
      </a>
      <ul class="menu-sub">
        @canany(['admin', 'sekdes'])
          <li class="menu-item {{ Request::is('dashboard/laporan/administrasi*') ? 'active' : '' }}">
            <a href="/dashboard/laporan/administrasi" class="menu-link">
              <div data-i18n="laporan-administrasi">Laporan Administrasi</div>
            </a>
          </li>
        @endcanany

        @canany(['admin', 'bendes'])
          <li class="menu-item {{ Request::is('dashboard/laporan/keuangan*') ? 'active' : '' }}">
            <a href="/dashboard/laporan/keuangan" class="menu-link">
              <div data-i18n="laporan-keuangan">Laporan Keuangan</div>
            </a>
          </li>
        @endcanany
      </ul>
    </li>

    @can('admin')
      {{-- Perangkat Gampong --}}
      <li class="menu-item {{ Request::is('dashboard/struktur*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="fa-duotone fa-list-tree me-3"></i>
          <div data-i18n="Layouts">Struktur Pengurus</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('dashboard/struktur/perangkat-gampong*') ? 'active' : '' }}">
            <a href="/dashboard/struktur/perangkat-gampong" class="menu-link">
              <div data-i18n="Analytics">Perangkat Gampong</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('dashboard/struktur/jabatan*') ? 'active' : '' }}">
            <a href="/dashboard/struktur/jabatan" class="menu-link">
              <div data-i18n="data surat">Kelola Jabatan</div>
            </a>
          </li>
        </ul>
      </li>

      {{-- User --}}
      <li class="menu-item {{ Request::is('dashboard/user*') ? 'active' : '' }}">
        <a href="/dashboard/user" class="menu-link">
          <i class="fa-duotone fa-user-group fa-sm me-3"></i>
          <div data-i18n="Analytics">User</div>
        </a>
      </li>
    @endcan
  </ul>
</aside>
