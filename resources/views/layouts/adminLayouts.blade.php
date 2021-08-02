<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BEM - STTI Tanjungpinang') }}</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template-->
    @stack('prepend-style')
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}" />
    @stack('addon-style')
    <!-- Script -->
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

    @if ($message = Session::get('berhasilGantiPassword'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ $message }}'
            });
        </script>
    @endif

    @if ($message = Session::get('gagalGantiPassword'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ $message }}'
            });
        </script>
    @endif

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('asset/logo/bem-80px.png') }}" height="50" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">BEM STTI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Dokumentasi -->
            @can('dokumentasi-list')
                <li class="nav-item {{ request()->is('dokumentasi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dokumentasi.index') }}">
                        <i class="fas fa-fw fa-camera"></i>
                        <span>Kelola Dokumentasi</span></a>
                </li>
            @endcan

            <!-- Nav Item - Timeline -->
            @can('jadwal-list')
                <li class="nav-item {{ request()->is('timeline*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('timeline.index') }}">
                        <i class="fas fa-fw fa-clock"></i>
                        <span>Kelola Jadwal</span></a>
                </li>
            @endcan

            <!-- Nav Item - Rapat -->
            @can('rapat-list')
                <li class="nav-item {{ request()->is('rapat*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('rapat.index') }}">
                        <i class="fas fa-fw fa-handshake"></i>
                        <span>Kelola Rapat</span></a>
                </li>
            @endcan

            @can('user-list')
                <!-- Nav Item - User -->
                <li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Kelola User</span></a>
                </li>
            @endcan

            <!-- Nav Item - Role -->
            @can('role-list')
                <li class="nav-item {{ request()->is('role*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('role.index') }}">
                        <i class="fas fa-fw fa-user-tag"></i>
                        <span>Kelola Roles</span></a>
                </li>
            @endcan

            @can('kritikDanSaran-list')
                <!-- Nav Item - Aspirasi, Kritik Dan Saran -->
                <li class="nav-item {{ request()->is('aspirasi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('aspirasi.index') }}">
                        <i class="fas fa-fw fa-inbox"></i>
                        <span>Aspirasi, Kritik Dan Saran</span></a>
                </li>
            @endcan

            @can('pendaftaran-list')
                <!-- Nav Item - Pendaftaran Anggota -->
                <li class="nav-item {{ request()->is('pendaftaran*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pendaftaran.index') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pendaftaran Anggota</span></a>
                </li>
            @endcan

            <!-- Nav Item - Quote -->
            @can('quotes-list')
                <li class="nav-item {{ request()->is('quotes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('quotes.index') }}">
                        <i class="fas fa-fw fa-quote-left"></i>
                        <span>Quote</span></a>
                </li>
            @endcan

            <!-- Nav Item - Pengaturan -->
            @can('pengaturan-list')
                <li class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('list.index') }}">
                        <i class="fas fa-fw fa-cogs"></i>
                        <span>Pengaturan</span></a>
                </li>
            @endcan
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang, {{ Auth::user()->name }}</span>
                                <i class="fas fa-angle-down fa-sm fa-fw mr-2 text-gray-400"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <button class="dropdown-item" data-toggle="modal" data-target="#gantiPassword">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </button>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

                <!-- Modal -->
                <div class="modal fade" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('ganti-password.update', Auth::id()) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input type="password" name="password" class="form-control" placeholder="" value="{{ old('password') }}">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password Baru</label>
                                        <input type="password" name="confirm_password" class="form-control" placeholder="" value="{{ old('confirm_password') }}">
                                        @error('confirm_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password Lama</label>
                                        <input type="password" name="old_password" class="form-control" placeholder="" value="{{ old('old_password') }}">
                                        @error('old_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit">
                                        <strong>
                                            Ganti
                                        </strong>
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    @stack('prepend-script')
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    @stack('addon-script')
</body>

</html>
