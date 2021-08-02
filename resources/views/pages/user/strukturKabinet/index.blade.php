@extends('layouts.userLayouts')

@section('content')
    <section id="heading">
        <div class="overlay overlay_color"></div>
        <div class="heading d-flex justify-content-center align-items-center">
            <h1 class="secondary_text_color">Struktur Kabinet</h1>
        </div>
        <img class="white-brush bottom-brush" src="./asset/shapes/white-brush.svg" alt="">
    </section>

    <section id="kabinet" class="margin-page">
        <div class="container">
            <div class="row my-5">
                <div class="col-12 text-center px-4">
                    {!! $data->content !!}
                </div>
            </div>

            @if (!$data->content)
                <div class="home-empty row no-gutters text-center my-5">
                    <div class="col-12">
                        <span class="iconify icon" data-icon="clarity:sad-face-line" data-inline="false"></span>
                    </div>
                    <div class="col-12">
                        <span class="message">Kabinet </span>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
