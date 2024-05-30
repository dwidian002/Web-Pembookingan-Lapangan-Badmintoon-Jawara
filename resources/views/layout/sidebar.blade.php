<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">GOR JAWARA</span>
    </a>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @can('admin')
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            @endcan
            @can('pelanggan')
                <li class="nav-item">
                    <a href="{{ url('/booking/list') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Pesanan</p>
                    </a>
                </li>
            @endcan
            @can('admin')
                <li class="nav-item">
                    <a href="{{ route('galeri.list') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Galeri</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('lapangan.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Lapangan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('menu.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Menu</p>
                    </a>
                </li>
            @endcan
        </ul>
    </nav>
</aside>
