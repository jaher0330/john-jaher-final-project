<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #1a1a2e, #16213e); box-shadow: 0 2px 15px rgba(0,0,0,0.3);">
  <div class="container">

    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
      <div style="background: linear-gradient(135deg, #c0392b, #e74c3c); border-radius: 8px; width:34px; height:34px; display:flex; align-items:center; justify-content:center; font-size:1.1rem;">🔍</div>
      <span style="font-size:1.1rem; font-weight:800; letter-spacing:-0.3px;">Lost <span style="color:#e74c3c;">&</span> Found</span>
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto gap-1 align-items-center">

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-2 {{ request()->is('/') ? 'active-link' : '' }}"
             href="{{ url('/') }}">
            <i class="bi bi-house-fill me-1"></i>Home
          </a>
        </li>

        @auth
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-2 {{ request()->routeIs('items.index') ? 'active-link' : '' }}"
             href="{{ route('items.index') }}">
            <i class="bi bi-list-ul me-1"></i>View Records
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-2 {{ request()->routeIs('items.create') ? 'active-link' : '' }}"
             href="{{ route('items.create') }}">
            <i class="bi bi-plus-circle me-1"></i>Add Record
          </a>
        </li>

        @if(auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-2 {{ request()->routeIs('admin.*') ? 'active-link' : '' }}"
             href="{{ route('admin.dashboard') }}">
            <i class="bi bi-shield-lock-fill me-1"></i>Admin Panel
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-2 {{ request()->routeIs('about') ? 'active-link' : '' }}"
             href="{{ route('about') }}">
            <i class="bi bi-info-circle me-1"></i>About
          </a>
        </li>
        @endauth

      </ul>

      <ul class="navbar-nav ms-3 align-items-center">
        @guest
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-2 {{ request()->routeIs('login') ? 'active-link' : '' }}"
             href="{{ route('login') }}">
            <i class="bi bi-box-arrow-in-right me-1"></i>Login
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-2 {{ request()->routeIs('register') ? 'active-link' : '' }}"
             href="{{ route('register') }}">
            <i class="bi bi-person-plus me-1"></i>Register
          </a>
        </li>
        @else
        <li class="nav-item dropdown ms-2">
          <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3 py-2"
             href="#" data-bs-toggle="dropdown">
            <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#c0392b,#e74c3c); display:flex; align-items:center; justify-content:center; font-size:0.85rem; font-weight:700; color:#fff;">
              {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span>{{ auth()->user()->name }}</span>
            <span class="badge ms-1" style="background-color:{{ auth()->user()->isAdmin() ? '#c0392b' : '#0f9b8e' }}; font-size:0.68rem; border-radius:20px; padding:3px 8px;">
              {{ auth()->user()->isAdmin() ? 'Admin' : 'Student' }}
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:12px; min-width:200px;">
            <li class="px-3 py-2">
              <div class="fw-600 text-dark" style="font-size:0.9rem;">{{ auth()->user()->name }}</div>
              <div class="text-muted" style="font-size:0.78rem;">{{ auth()->user()->email }}</div>
            </li>
            <li><hr class="dropdown-divider my-1"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger py-2" style="font-size:0.88rem; font-weight:600;">
                  <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
        @endguest
      </ul>
    </div>

  </div>
</nav>
