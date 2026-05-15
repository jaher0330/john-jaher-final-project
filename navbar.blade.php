<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1a1a2e;">
  <div class="container">

    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
      <span style="font-size:1.3rem;">🔍</span>
      <span>Lost <span style="color:#e94560;">&</span> Found</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto gap-1">

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded {{ request()->is('/') ? 'active-link' : '' }}"
             href="{{ url('/') }}">🏠 Home</a>
        </li>

        @auth
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('items.index') ? 'active-link' : '' }}"
             href="{{ route('items.index') }}">📋 View Records</a>
        </li>

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('items.create') ? 'active-link' : '' }}"
             href="{{ route('items.create') }}">➕ Add Record</a>
        </li>

        @if(auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('admin.*') ? 'active-link' : '' }}"
             href="{{ route('admin.dashboard') }}">🛡️ Admin Panel</a>
        </li>
        @endif

        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('about') ? 'active-link' : '' }}"
             href="{{ route('about') }}">ℹ️ About</a>
        </li>
        @endauth

      </ul>

      <ul class="navbar-nav ms-3">
        @guest
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('login') ? 'active-link' : '' }}"
             href="{{ route('login') }}">🔑 Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('register') ? 'active-link' : '' }}"
             href="{{ route('register') }}">📝 Register</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3 py-2" href="#" data-bs-toggle="dropdown">
            👤 {{ auth()->user()->name }}
           <span class="badge ms-1" style="background-color:{{ auth()->user()->isAdmin() ? '#e94560' : '#0f9b8e' }}; font-size:0.7rem;">
            {{ auth()->user()->isAdmin() ? 'Admin' : 'Student' }}
          </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><span class="dropdown-item-text text-muted small">{{ auth()->user()->email }}</span></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">🚪 Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @endguest
      </ul>
    </div>

  </div>
</nav>
