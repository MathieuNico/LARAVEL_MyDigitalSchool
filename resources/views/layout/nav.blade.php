<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block px-2">
        <a type="button" href="{{route('dashboard.index')}}" class="nav-link"> Acceuil </a>
      </li>
      <li class="nav-item px-2">
        <a type="button" href="{{route('categories.index')}}" class="btn btn-block bg-gradient-primary "><i class="fas fa-folder"></i> Catégories</a>
      </li>
      <li class="nav-item">
        <a type="button" href="{{route('categories.flux')}}" class="btn btn-block bg-gradient-success "><i class="fas fa-rss"></i> Mes flux RSS</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item me-auto">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-block bg-gradient-primary "><i class="fas fa-door-open"></i> Déconnexion</button>
        </form>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>


</nav>