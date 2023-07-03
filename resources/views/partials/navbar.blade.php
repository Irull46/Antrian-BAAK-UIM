<nav class="navbar navbar-dark bg-success shadow-sm fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home.index') }}"><img src="{{ asset('images/BAAK Logo.png') }}" alt="BAAK Logo" height="40"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end bg-success text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Antrian BAAK</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home.index') }}">Home</a>
          </li>
          @role('admin')
            <li class="nav-item">
              <a class="nav-link {{ request()->is('role') ? 'active' : '' }}" href="{{ route('role.index') }}">Role Manajemen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('cetak') ? 'active' : '' }}" href="{{ route('cetak.index') }}">Nomor Antrian</a>
            </li>
          @endrole
          @role('teller')
            <li class="nav-item">
              <a class="nav-link {{ request()->is('panggil') ? 'active' : '' }}" href="{{ route('panggil.index') }}">Panggil Antrian</a>
            </li>
          @endrole
          <li class="nav-item">
            <a class="nav-link {{ request()->is('traffic') ? 'active' : '' }}" href="{{ route('traffic.index') }}">Traffic</a>
          </li>
          @guest
          @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
              </li>
          @endif

          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">Daftar</a>
              </li>
          @endif
          @else
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ Auth::user()->name }}
                  </a>

                  <ul class="dropdown-menu">
                    {{-- <li><a class="dropdown-item" href="{{ route('profil.index') }}">Profil</a></li> --}}
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </div>
              </li>
          @endguest
        </ul>
      </div>
    </div>
  </div>
</nav>