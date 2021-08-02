@extends('layouts.userLayouts')

@section('content')

    <section id="heading">
        <div class="overlay overlay_color"></div>
        <div class="heading d-flex justify-content-center align-items-center">
            <h1 class="secondary_text_color">
                Dokumentasi Kegiatan
            </h1>
        </div>
        <img class="white-brush bottom-brush" src="{{ asset('asset/shapes/white-brush.svg') }}" alt="">
    </section>

    <section id="dokumentasi" class="margin-page">
        <div class="dokumentasi container">
            <div class="row">
                @forelse ($documentations as $documentation)
                    <div class="dokumentasi-item col-12 col-md-6 col-lg-4 mb-4 px-4 px-md-3">
                        <a href="{{ route('dokumentasi-kegiatan.show', $documentation->slug) }}">
                            <div class="dokumentasi-image" style="background-image: url({{ Storage::exists('public/' . $documentation->cover) && $documentation->cover ? Storage::url($documentation->cover) : asset('asset/images/imagePlaceholder.png') }})"></div>
                            <p class="dokumentasi-title primary_text_color">{{ $documentation->title }}</p>
                            <p class="dokumentasi-date primary_text_color">{{ $documentation->publish_date->format('d M Y') }}</p>
                        </a>
                    </div>
                @empty
                    <div class="home-empty w-100 text-center mx-4">
                        <div class="col-12">
                            <span class="iconify icon" data-icon="clarity:sad-face-line" data-inline="false"></span>
                        </div>
                        <div class="col-12">
                            <span class="message">Belum Ada Dokumentasi Kegiatan</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
