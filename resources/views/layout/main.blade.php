<!DOCTYPE html>
<html lang="en">
<!-- DEBUT HEADER -->
@include('layout.head')
<!-- FIN HEADER -->

<!-- DEBUT NAV -->


<body class=" hold-transition sidebar-mini layout-fixed">


  <!-- Navbar -->
  @include('layout.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layout.menu')

  <!-- Content Wrapper. Contains page content -->
  <div class="wrapper">
    @yield('main')
  </div>
  <!-- /.content-wrapper -->
  
  <!-- FOOTER -->
  @include('layout.footer')
<!-- ./wrapper -->

  @include('layout.scripts')
  @yield('scripts')
</body>
</html>