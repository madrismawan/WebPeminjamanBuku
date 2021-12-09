<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-2">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-decoration-none mt-1">
        {{-- <img src="{{asset('base-template/dist/img/logo-01.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light fw-bold">
           <div class="h6 mb-0 mx-2">(SPB) <br>Sistem Peminjaman Buku TI</div>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li id="side-pengaturan-akun" class="user-panel nav-item">
                    <a href="#" class="nav-link mb-2 p-2">
                        <img src="{{asset('base-template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2 mr-2 mb-1" alt="User Image">
                        <p>
                            Mukidi
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-konfirmasi-sulinggih" href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item ml-3">
                            <a id="side-konfirmasi-sulinggih" href="{{route('auth.logout')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- SidebarSearch Form -->
                <div class="form-inline m-0 mt-3">
                    <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                    </div>
                </div>

                <li  class="nav-header font-weight-bold pl-2">DASHBOARD</li>
                <li id="side-dashboard" class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link p-2">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold pl-2">MENU UTAMA</li>

                <li id="side-manajemen-buku" class="nav-item">
                    <a href="#" class="nav-link p-2 ">
                        <i class="fa fa-book nav-icon mr-1"></i>
                        <p>
                            Manajemen Buku
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-manajemen-buku-data" href="{{route('admin.manajemen-buku.data')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data List Buku</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-manajemen-buku-tambah" href="{{route('admin.manajemen-buku.create')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Buku</p>
                            </a>
                        </li>
                    </ul>

                </li>

                <li id="side-peminjaman-buku" class="nav-item">
                    <a href="#" class="nav-link p-2">
                        <i class="fas fa-book-open nav-icon mr-1"></i>
                        <p >
                            Peminjaman Buku
                            <i class="fas fa-angle-left right ml-lg-4"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-peminjaman-buku-data" href="#" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Peminjaman</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-peminjaman-buku-tambah" href="#" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Peminjaman</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li id="side-manajemen-pengguna" class="nav-item">
                    <a href="#" class="nav-link p-2 ">
                        <i class="fa fa-users nav-icon mr-1"></i>
                        <p>
                            Manajemen Pengguna
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-manajemen-pengguna-data" href="{{route('admin.manajemen-pengguna.index')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Pengguna</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-manajemen-pengguna-tambah" href="{{route('admin.manajemen-pengguna.create')}}" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header font-weight-bold pl-2">LAPORAN</li>
                <li id="side-laporan" class="nav-item">
                    <a href="#" class="nav-link p-2 ">
                        <i class="fa fa-file-alt nav-icon mr-1"></i>
                        <p>
                            Laporan Peminjaman
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-3">
                            <a id="side-laporan-data" href="#" class="nav-link p-2">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lap. Buku</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
