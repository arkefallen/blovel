<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="/dashboard">
        <b>Blovel App</b>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center" id="navbarTogglerDemo02">
        <div class="me-auto">
            <span></span>
        </div>
        <ul class="navbar-nav mb-2 mb-lg-0">
          @guest
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Register</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/gallery">Gallery</a>
            </li>
            @if (Auth::check() && Auth::user()->level == 'admin')
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/user">User</a>
              </li>
            @endif
            <li class="nav-item dropdown px-2">
              <button id="navbarDropdown" class="btn btn-outline-light dropdown-toggle w-100" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
              </button>

              <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>