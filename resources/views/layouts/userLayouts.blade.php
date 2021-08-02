<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BEM - STTI Tanjungpinang') }}</title>
    <!-- Scripts -->
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    @stack('prepend-style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('addon-style')

    <style>
        #heading {
            background-image: url({{ Storage::exists('public/' . $globalSetting->page_banner) && $globalSetting->page_banner ? Storage::url($globalSetting->page_banner) : asset('asset/images/landing2.png') }}) !important;
        }

        .overlay_color {
            opacity: 0.6;
            background: {{ $globalSetting->primary_color }};
        }

        .primary_text_color {
            color: {{ $globalSetting->primary_text_color }};
        }

        .secondary_text_color {
            color: {{ $globalSetting->secondary_text_color }};
        }

        .primary_font_color {
            color: {{ $globalSetting->primary_color }} !important;
        }

        .primary_color {
            background: {{ $globalSetting->primary_color }};
        }

    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-xl">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('asset/logo/icon.png') }}" class="d-inline-block align-items-center mr-3" alt="">
                    <span>Badan Eksekutif Mahasiswa</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ request()->is('/') ? 'is-active' : '' }}">
                            <a class="nav-link {{ request()->is('/') ? 'primary_font_color' : '' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('visi-misi*', 'kabinet*') ? 'is-active' : '' }}">
                            <a class="nav-link {{ request()->is('visi-misi*', 'kabinet*') ? 'primary_font_color' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profil <span class="iconify" data-inline="false" data-icon="dashicons:arrow-down-alt2"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('visi-misi.index') }}">Visi - Misi</a>
                                <a class="dropdown-item" href="{{ route('kabinet.index') }}">Struktur Kabinet</a>
                            </div>
                        </li>
                        @if ($registrationSetting->visibility == 1)
                            <li class="nav-item {{ request()->is('pendaftaran-anggota') ? 'is-active' : '' }}">
                                <a class="nav-link {{ request()->is('pendaftaran-anggota') ? 'primary_font_color' : '' }}" href="{{ route('pendaftaran-anggota') }}">Pendaftaran BEM</a>
                            </li>
                        @endif
                        <li class="nav-item dropdown {{ request()->is('kritik-dan-saran*', 'dokumentasi-kegiatan*', 'kegiatan*') ? 'is-active' : '' }}">
                            <a class="nav-link {{ request()->is('kritik-dan-saran*', 'dokumentasi-kegiatan*', 'kegiatan*') ? 'primary_font_color' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Lainnya
                                <span class="iconify" data-inline="false" data-icon="dashicons:arrow-down-alt2"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('kritik-dan-saran.index') }}">Aspirasi, Kritik Dan Saran</a>
                                <a class="dropdown-item" href="{{ route('dokumentasi-kegiatan.index') }}">Dokumentasi Kegiatan</a>
                                <a class="dropdown-item" href="{{ route('kegiatan.index') }}">Timeline Kegiatan</a>
                            </div>
                        </li>
                        @guest
                            <li class="nav-item">

                                <a href="{{ route('login') }}">
                                    <button class="btn-custom my-2 my-lg-0 primary_color secondary_text_color">{{ __('Login') }}</button>
                                </a>

                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif

                            </li>
                        @else
                            <li class="nav-item dropdown mb-2">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        @if (!Request::is('login'))
            <footer class="primary_color secondary_text_color">
                <img class="white-brush top-brush rotate" src="{{ asset('asset/shapes/white-brush.svg') }}" alt="">
                <section class="footer container-md px-4 px-md-3">
                    <img class="wave-line-background wave-line-background-footer" src="{{ asset('asset/shapes/background-wave-3.svg') }}" alt="">
                    <div class="row my-5">
                        <div class="col-12 col-lg-7">
                            <div class="row">
                                <div class="col d-flex align-items-center">
                                    <img class="footer-logo" src="{{ Storage::exists('public/' . $footerSetting->footer_logo) && $footerSetting->footer_logo ? Storage::url($footerSetting->footer_logo) : asset('asset/logo/stti-white.png') }}" alt="">
                                    <h1 class="ml-3">{{ $footerSetting->footer_title }}</h1>
                                </div>
                            </div>
                            <div class="row d-inline">
                                <p><a href="{{ $footerSetting->footer_link }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none secondary_text_color">{{ $footerSetting->footer_link }}</a></p>
                                <p>{{ $footerSetting->footer_address }}</p>
                                <p>{{ $footerSetting->footer_telepon }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-lg-5">
                            {!! $footerSetting->footer_map !!}
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-center text-center">
                        <p>{!! $footerSetting->footer_copyright !!}</p>
                    </div>
                </section>
            </footer>
        @endif
    </div>

    <!-- Custom scripts for all pages-->
    @stack('prepend-script')
    @stack('addon-script')
</body>

</html>
