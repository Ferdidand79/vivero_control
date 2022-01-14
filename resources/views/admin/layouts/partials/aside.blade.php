<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Nursey Data</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
            </li>
            {{-- <li class="nav-item">
                <a href="{{url('/admin/user')}}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Usuarios</p>
                </a>
            </li> --}}
            <li class="nav-item">
                <a href="{{url('/admin/parametros')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Parametros</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/admin/plantas')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Plantas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/admin/plagas')}}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Plagas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/admin/vincular')}}" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Vincular parametros</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/admin/muestras')}}" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Muestras</p>
                </a>
            </li>
            {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Categorias
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('/admin/category')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Listar Categorias</p>
                    </a>
                </li>
            </ul>
            </li> --}}
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>
