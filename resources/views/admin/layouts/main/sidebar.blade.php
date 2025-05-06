<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main" style="z-index: 0; important">
    <div class="sidenav-header text-center">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="/" target="_blank">
        <img src="{{  asset('storage/images/publicImg/icons/lambang_kabupaten_bangka.png') }}" class="navbar-brand-img" width="35" height="40" alt="">
        <h1 class="ms-1 text-lg font-bold text-dark">Admin</h1>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard'. '*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('dashboard') }}">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('show.article'. '*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('show.article') }}">
            <i class="material-symbols-rounded opacity-5">info</i>
            <span class="nav-link-text ms-1">Info</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('show.downloadfile'. '*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('show.downloadfile.form') }}">
            <i class="material-symbols-rounded opacity-5">picture_as_pdf</i>
            <span class="nav-link-text ms-1">File Download</span>
          </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.kota.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.kota.index') }}">
            <i class="material-symbols-rounded opacity-5">picture_as_pdf</i>
            <span class="nav-link-text ms-1">Daftar Kota</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.maskapai.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="maskapai">
            <i class="material-symbols-rounded opacity-5">picture_as_pdf</i>
            <span class="nav-link-text ms-1">Daftar Maskapai</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.kelas_pesawat.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.kelas_pesawat.index') }}">
            <i class="material-symbols-rounded opacity-5">flight_class</i>
            <span class="nav-link-text ms-1">Kelas Pesawat</span>
          </a>
        </li>
        <!-- Maskapai -->
        {{-- <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.maskapai.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.maskapai.index') }}">
              <i class="material-symbols-rounded opacity-5">airplane_ticket</i>
              <span class="nav-link-text ms-1">Maskapai</span>
          </a>
      </li> --}}
      

          <!-- Promo -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.promo.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.promo.index') }}">
                  <i class="material-symbols-rounded opacity-5">local_offer</i>
                  <span class="nav-link-text ms-1">Promo</span>
              </a>
          </li>

          <!-- Penerbangan -->
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.penerbangan.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.penerbangan.index') }}">
                  <i class="material-symbols-rounded opacity-5">flight</i>
                  <span class="nav-link-text ms-1">Penerbangan</span>
              </a>
          </li>

          <!-- Bandara -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.bandara.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.bandara.index') }}">
                <i class="material-symbols-rounded opacity-5">airport_shuttle</i>
                <span class="nav-link-text ms-1">Bandara</span>
            </a>
        </li>
        
        {{-- <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('show.populations') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('show.populations') }}">
            <i class="material-symbols-rounded opacity-5">groups</i>
            <span class="nav-link-text ms-1">Masyarakat</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('show.populations.statistics') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('show.populations.statistics') }}">
            <i class="material-symbols-rounded opacity-5">area_chart</i>
            <span class="nav-link-text ms-1">Statistik Masyarakat</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Complaints list</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">public</i>
            <span class="nav-link-text ms-1">Social Media</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">info</i>
            <span class="nav-link-text ms-1">Village Info</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">checklist</i>
            <span class="nav-link-text ms-1">Rice Data</span>
          </a>
        </li> --}}

        <li class="nav-item">
          <a class="nav-link text-dark {{ request()->routeIs('show.profile'. '*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('show.profile') }}">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1 ">About US</span>
          </a>
        </li>
{{-- 
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-in.html">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-up.html">
            <i class="material-symbols-rounded opacity-5">assignment</i>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li> --}}
      </ul>

    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        @if (Auth::check())
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn bg-dark text-white w-100 mb-3 rounded">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
        @else
          <a class="btn bg-dark text-white w-100 mb-3 rounded" href="{{ route('login') }}" type="button">Login</a>
        @endif
      </div>
    </div>
  </aside>

 