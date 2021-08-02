@extends('layouts.userLayouts')

@section('content')

    <section id="heading">
        <div class="overlay overlay_color"></div>
        <div class="heading d-flex justify-content-center align-items-center">
            <h1 class="secondary_text_color">Visi Dan Misi</h1>
        </div>
        <img class="white-brush bottom-brush" src="./asset/shapes/white-brush.svg" alt="">
    </section>

    <section id="visi">
        <div class="visi container-md">
            <div class="row text-center">
                <div class="col">
                    <h1 class="visi-title primary_text_color">Visi</h1>
                </div>
            </div>
            <div class="row my-5">
                <div class="col mx-3">
                    <p class="visi-text primary_text_color">
                        {!! $data->vision !!}
                    </p>
                </div>
            </div>
            @if ($data->illustration_visibility == 1)
                <div class="row mt-5 text-center mx-5">
                    <div class="col">
                        <img class="visi-image" src="{{ Storage::exists('public/' . $data->illustration_1) && $data->illustration_1 ? Storage::url($data->illustration_1) : asset('asset/images/visi.png') }}" alt="">
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="misi">
        <div class="visi container-md">
            <div class="row">
                <div class="col text-center">
                    <h1 class="visi-title primary_text_color">Misi</h1>
                </div>
            </div>
            <div class="row my-5">
                <div class="col mx-3">
                    <p class="visi-text primary_text_color">
                        {!! $data->mission !!}
                    </p>
                </div>
            </div>
            @if ($data->illustration_visibility == 1)
                <div class="row mt-5 text-center mx-5">
                    <div class="col">
                        <img class="visi-image" src="{{ Storage::exists('public/' . $data->illustration_2) && $data->illustration_2 ? Storage::url($data->illustration_2) : asset('asset/images/misi.png') }}" alt="">
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection
