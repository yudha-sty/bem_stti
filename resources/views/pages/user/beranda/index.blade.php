@extends('layouts.userLayouts')

@push('addon-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('prepend-style')
    <style>
        .title-wrapper {
            font-size: {{ $homepageSetting->header_title_font_size }}px !important;
        }

        .subtitle-wrapper {
            font-size: {{ $homepageSetting->header_subtitle_font_size }}px !important;
        }

        .cabinet-title-wrapper {
            font-size: {{ $homepageSetting->section_cabinet_title_font_size }}px !important;
        }

        .cabinet-subtitle-wrapper {
            font-size: {{ $homepageSetting->section_cabinet_subtitle_font_size }}px !important;
        }

        .overlay_gradient {
            opacity: 0.8;
            background: linear-gradient(to right,
                    {{ $globalSetting->primary_color }} 0,
                    {{ $globalSetting->primary_color }}80 60%,
                    rgba(255, 255, 255, 0) 100%)
        }

        .gradient_background {
            background: linear-gradient(to right,
                    {{ $globalSetting->primary_color }} 0,
                    {{ $globalSetting->primary_color }}8C 55%,
                    rgba(255, 255, 255, 0) 100%);
        }

        @media (max-width: 992px) {
            .gradient_background {
                background: linear-gradient(to bottom,
                        {{ $globalSetting->primary_color }} 0,
                        {{ $globalSetting->secondary_color }} 70%,
                        rgba(255, 255, 255, 0) 100%);
            }
        }

    </style>
@endpush

@section('content')

    <section id="landing" class="landing d-flex align-items-center secondary_text_color"
             style="background-image: url({{ Storage::exists('public/' . $homepageSetting->header_cover) && $homepageSetting->header_cover ? Storage::url($homepageSetting->header_cover) : asset('asset/images/landing2.png') }})">
        <div class="overlay overlay_gradient"></div>
        <div class="container-md">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="title-wrapper">
                        <h1 class="landing-title">{{ $homepageSetting->header_title }}</h1>
                    </div>
                    <div class="subtitle-wrapper primary_text_color">
                        <h2 class="landing-subtitle">{{ $homepageSetting->header_subtitle }}</h2>
                    </div>
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($quotes as $quote)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <p class="home-quotes landing-quotes mt-5">
                                        "{{ $quote->quote }}"
                                        <br><br>
                                        - {{ $quote->author }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <img class="white-brush bottom-brush" src="{{ asset('asset/shapes/white-brush.svg') }}" alt="">
            </div>
        </div>
    </section>

    <section id="home-timeline">
        <img class="wave-line-background-1" src="{{ asset('asset/shapes/background-wave-1.svg') }}" alt="">
        <div class="home-timeline container-md">
            <div class="home-title d-flex">
                <div>
                    <span class="iconify home-icon primary_text_color" data-icon="ant-design:clock-circle-outlined" data-inline="false"></span>
                </div>
                <div class="ml-3">
                    <h2 class="primary_font_color">DAFTAR</h2>
                    <h1 class="primary_text_color">Kegiatan Yang Akan Datang</h1>
                </div>
            </div>

            <div class="home-timeline-grid home-timeline-grid-{{ $timelines->count() }} my-4">
                @forelse ($timelines as $timeline)
                    <div class="home-timeline-item">
                        <a href="{{ route('kegiatan.show', $timeline->slug) }}">
                            <img class="home-timeline-image" src="{{ Storage::exists('public/' . $timeline->cover) && $timeline->cover ? Storage::url($timeline->cover) : asset('asset/images/imagePlaceholder.png') }}" alt="">
                            <div class="home-timeline-text secondary_text_color">
                                <div class="home-timeline-background primary_color"></div>
                                <h3 class="line-clamp">{{ $timeline->title }}</h3>
                                <p class="home-timeline-date">
                                    <span class="iconify timeline-icon-sm" data-inline="false" data-icon="ic:outline-date-range"></span>
                                    {{ \Carbon\Carbon::parse($timeline->activity_date_start)->format('d/m/Y') }}
                                </p>
                                <p class="home-timeline-time">
                                    <span class="iconify timeline-icon-sm" data-inline="false" data-icon="ant-design:clock-circle-outlined"></span>
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $timeline->activity_time_start)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $timeline->activity_time_end)->format('H:i') }}
                                </p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="home-empty w-100 text-center">
                        <div class="col-12">
                            <span class="iconify icon" data-icon="clarity:sad-face-line" data-inline="false"></span>
                        </div>
                        <div class="col-12">
                            <span class="message">Belum Ada Jadwal Kegiatan</span>
                        </div>
                    </div>
                @endforelse
            </div>


            <a href="{{ route('kegiatan.index') }}">
                <button class="btn-custom primary_color secondary_text_color px-5 py-2">Lihat Semua Kegiatan</button>
            </a>
        </div>
    </section>

    <section id="home-kabinet" class="gradient_background secondary_text_color">
        <img class="white-brush top-brush rotate" src="{{ asset('asset/shapes/white-brush.svg') }}" alt="">

        <svg class="wave-background" viewBox="0 0 1440 267" fill="{{ $globalSetting->secondary_color }}" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d)">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M0 43.1667L60 64.75C120 86.3333 240 129.5 360 143.889C480 158.278 600 143.889 720 115.111C840 86.3333 960 43.1667 1080 21.5833C1200 0 1320 0 1380 0H1440V259H1380C1320 259 1200 259 1080 259C960 259 840 259 720 259C600 259 480 259 360 259C240 259 120 259 60 259H0V43.1667Z"
                      fill="{{ $globalSetting->secondary_color }}" />
            </g>
            <defs>
                <filter id="filter0_d" x="-4" y="0" width="1448" height="267" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="2" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                </filter>
            </defs>
        </svg>

        <div class="home-kabinet container px-4 px-md-3">
            <div class="row">
                <div class="col">
                    <div class="cabinet-subtitle-wrapper">
                        <h2>{{ $homepageSetting->section_cabinet_subtitle }}</h2>
                    </div>
                    <div class="cabinet-title-wrapper">
                        <h1>{{ $homepageSetting->section_cabinet_title }}</h1>
                    </div>
                </div>
                <img class="logo-desktop" src="{{ Storage::exists('public/' . $homepageSetting->section_cabinet_logo) && $homepageSetting->section_cabinet_logo ? Storage::url($homepageSetting->section_cabinet_logo) : asset('asset/logo/icon.png') }}" alt="">
            </div>

            <div class="row logo-mobile py-5">
                <div class="col">
                    <img src="{{ Storage::exists('public/' . $homepageSetting->section_cabinet_logo) && $homepageSetting->section_cabinet_logo ? Storage::url($homepageSetting->section_cabinet_logo) : asset('asset/logo/icon.png') }}" alt="">
                </div>
            </div>
        </div>

        <img class="white-brush bottom-brush" src="{{ asset('asset/shapes/white-brush.svg') }}" alt="">

    </section>

    <section id="home-documentation">
        <section class="home-documentation container-md">
            <img class="wave-line-background-2" src="{{ asset('asset/shapes/background-wave-2.svg') }}" alt="">
            <div class="home-title d-flex">
                <div>
                    <span class="iconify home-icon primary_text_color" data-icon="ant-design:camera-outlined" data-inline="false"></span>
                </div>
                <div class="ml-3">
                    <h2 class="primary_font_color">DAFTAR</h2>
                    <h1 class="primary_text_color">Dokumentasi Kegiatan</h1>
                </div>
            </div>

            <div class="my-4 @if ($documentations->count() > 0) owl-carousel @endif">
                @forelse ($documentations as $documentation)
                    <div>
                        <a href="{{ route('dokumentasi-kegiatan.show', $documentation->slug) }}">
                            <div class="home-documentation-image" style="background-image: url({{ Storage::exists('public/' . $documentation->cover) && $documentation->cover ? Storage::url($documentation->cover) : asset('asset/images/imagePlaceholder.png') }})"></div>
                            <span class="home-documentation-date primary_color secondary_text_color">{{ \Carbon\Carbon::parse($documentation->publish_date)->format('d/m/Y') }}</span>
                            <p class="home-documentation-text line-clamp my-2">{{ $documentation->title }}</p>
                        </a>
                    </div>
                @empty
                    <div class="home-empty w-100 text-center">
                        <div class="col-12">
                            <span class="iconify icon" data-icon="clarity:sad-face-line" data-inline="false"></span>
                        </div>
                        <div class="col-12">
                            <span class="message">Belum Ada Dokumentasi Kegiatan</span>
                        </div>
                    </div>
                @endforelse
            </div>

            <a href="{{ route('dokumentasi-kegiatan.index') }}">
                <button class="btn-custom primary_color secondary_text_color px-5 py-2">Lihat Semua Kegiatan</button>
            </a>
        </section>
    </section>

    <section id="home-quotes">
        <div class="container px-5 px-md-3 my-5">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="quotes-title">
                        <img class="quotes-icon" src="{{ asset('asset/shapes/quotes.svg') }}" alt="">
                        Motivasi
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($quotes as $quote)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <p class="home-quotes mt-5">
                                        "{{ $quote->quote }}"
                                        <br><br>
                                        - {{ $quote->author }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 550 * 10
            });

            $('.carouselMobile').carousel({
                interval: 550 * 10
            });
        });

        $(".owl-carousel").owlCarousel({
            responsiveClass: true,
            margin: 20,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            loop: true,

            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3,
                }
            }
        });
    </script>
@endpush
