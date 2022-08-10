<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="{{  url('') }}/">ACES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Blog") ? 'active' : '' }}" href="{{  url('') }}/blog">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Labs") ? 'active' : '' }}" href="{{  url('') }}/labs">Labs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "About") ? 'active' : '' }}" href="{{  url('') }}/about">About</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hi, {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{  url('') }}/dashboard"><i class="bi bi-layout-sidebar-inset"></i> My dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{  url('') }}/logout" method="POST">
                    @csrf
                    <button class="dropdown-item"><i class="bi bi-box-arrow-left"></i> Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          @else
              <li class="nav-item">
                <a href="{{  url('') }}/login" class="nav-link btn btn-light text-dark"><i class="bi bi-box-arrow-in-right"></i> Login</a>
              </li>
          @endauth
        </ul>
      </div>
    </div>
</nav>