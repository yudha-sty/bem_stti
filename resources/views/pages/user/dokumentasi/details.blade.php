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

    <section id="dokumentasi">
        <div class="dokumentasi container">
            <div class="col-12">
                <img class="dokumentasi-detail-image w-100" src="{{ Storage::exists('public/' . $documentation->cover) && $documentation->cover ? Storage::url($documentation->cover) : asset('asset/images/imagePlaceholder.png') }}" alt="">
                <h1 class="dokumentasi-title dokumentasi-detail-title primary_text_color">{{ $documentation->title }}</h1>
                <p class="dokumentasi-date dokumentasi-detail-date primary_text_color">{{ $documentation->publish_date->format('d M Y') }} | Dilihat : {{ $documentation->views }}</p>
                <p class="dokumentasi-description primary_text_color">{{ $documentation->description }}</p>
            </div>

            <hr>

            <div class="col-12 primary_text_color">
                {!! $documentation->content !!}
            </div>
        </div>
    </section>

@endsection
