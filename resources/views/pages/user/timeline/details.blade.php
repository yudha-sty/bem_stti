@extends('layouts.userLayouts')

@section('content')

    <section id="heading">
        <div class="overlay overlay_color"></div>
        <div class="heading d-flex justify-content-center align-items-center">
            <h1 class="secondary_text_color">
                Detail Kegiatan yang Akan Datang
            </h1>
        </div>
        <img class="white-brush bottom-brush" src="{{ asset('asset/shapes/white-brush.svg') }}" alt="">
    </section>

    <section id="kegiatan" class="margin-page">
        <div class="kegiatan container">
            <div class="col-12">
                <img class="kegiatan-detail-image w-100" src="{{ Storage::exists('public/' . $timeline->cover) && $timeline->cover ? Storage::url($timeline->cover) : asset('asset/images/imagePlaceholder.png') }}" alt="">
                <p class="kegiatan-date primary_font_color">
                    {{ \Carbon\Carbon::parse($timeline->activity_date_start)->format('d M Y') }} - {{ \Carbon\Carbon::parse($timeline->activity_date_end)->format('d M Y') }}
                    <br>
                    ( {{ \Carbon\Carbon::createFromFormat('H:i:s', $timeline->activity_time_start)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $timeline->activity_time_end)->format('H:i') }} )
                </p>
                <p class="kegiatan-title primary_text_color">{{ $timeline->title }}</p>
                <p class="kegiatan-description primary_text_color">{{ $timeline->description }}</p>

                <a href="{{ route('kegiatan.index') }}">
                    <button class="btn-custom px-5 primary_color secondary_text_color">Kembali</button>
                </a>
            </div>


        </div>
    </section>

@endsection
