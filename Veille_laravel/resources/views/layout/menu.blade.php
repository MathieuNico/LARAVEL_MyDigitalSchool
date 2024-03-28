<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.index')}}" class="brand-link">
      <img src="{{ asset('dist/img/LogoVeilleRSS.png') }}" alt="VeilleRSS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">VeilleRSS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      
        <div class="info">
          <a href="{{route('dashboard.index')}}" class="d-block"><h3>{{auth()->user()->name}}</h3></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('dashboard.index')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Acceuil
              </p>
            </a>
           

          </li>
          
          <li class="nav-header">CATEGORIES</li>
            @foreach($categories as $category)
              <li class="nav-item menu-close">
                <a href="{{ $category->id ? route('categories.show', $category->id) : '#' }}" class="nav-link">
        
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    {{ $category->name }}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @if($category->children)
                    @foreach($category->children as $child)
                    <li class="nav-item">
                      <a href="{{ $child->id ? route('categories.show', $child->id) : '#' }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $child->name }}</p>
                      </a>
                    </li>
                    @endforeach
                  @endif
                </ul>
              </li>
            @endforeach    
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>