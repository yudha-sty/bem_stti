@extends('layouts.userLayouts')

@section('content')

    <section id="heading">
        <div class="overlay overlay_color"></div>
        <div class="heading d-flex justify-content-center align-items-center">
            <h1 class="secondary_text_color">
                Kegiatan yang Akan Datang
            </h1>
        </div>
        <img class="white-brush bottom-brush" src="{{ asset('asset/shapes/white-brush.svg') }}" alt="">
    </section>

    <section id="kegiatan" class="margin-page">
        <div class="kegiatan container">
            <div class="row">
                @forelse ($timelines as $timeline)
                    <div class="kegiatan-item col-12 col-md-4 mb-4 px-4 px-md-3">
                        <a href="{{ route('kegiatan.show', $timeline->slug) }}">
                            <div class="kegiatan-image" style="background-image: url({{ Storage::exists('public/' . $timeline->cover) && $timeline->cover ? Storage::url($timeline->cover) : asset('asset/images/imagePlaceholder.png') }})">
                            </div>
                            <p class="kegiatan-date primary_font_color">{{ \Carbon\Carbon::parse($timeline->activity_date_start)->format('d M Y') }} - {{ \Carbon\Carbon::parse($timeline->activity_date_end)->format('d M Y') }}</p>
                            <p class="kegiatan-title line-clamp primary_text_color">{{ $timeline->title }}</p>
                            <p class="kegiatan-description line-clamp primary_text_color">{{ $timeline->description }}</p>
                        </a>
                    </div>
                @empty
                    <div class="home-empty w-100 text-center mx-4">
                        <div class="col-12">
                            <span class="iconify icon" data-icon="clarity:sad-face-line" data-inline="false"></span>
                        </div>
                        <div class="col-12">
                            <span class="message">Belum Ada Jadwal Kegiatan</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
