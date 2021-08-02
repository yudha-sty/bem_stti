@extends('layouts.userLayouts')

@section('content')

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: '{{ $message }}'
            });
        </script>
    @endif

    <section id="heading">
        <div class="overlay overlay_color"></div>
        <div class="heading d-flex justify-content-center align-items-center">
            <h1 class="secondary_text_color">Aspirasi, Kritik dan Saran</h1>
        </div>
        <img class="white-brush bottom-brush" src="./asset/shapes/white-brush.svg" alt="">
    </section>

    <section id="registration" class="margin-page">
        <div class="registration container px-4 mb-5">
            <div class="row d-inline text-center">
                <h1 class="primary_text_color">Form Aspirasi, Kritik Dan Saran</h1>
                <h2 class="primary_font_color mb-2 mb-md-5">#YukBicara</h2>
            </div>
            <form action="{{ route('kritik-dan-saran.store') }}" method="POST" class="registration-form">
                @csrf
                <div class="form-group">
                    <textarea class="form-control primary_text_color" id="message" name="message" rows="5">{{ old('message') }}</textarea>
                    @error('message')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="button" class="btn-custom btn-block primary_color secondary_text_color  mt-4 py-2" data-toggle="modal" data-target="#kritikDanSaran">Submit</button>

                <div class="modal fade" id="kritikDanSaran" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title primary_text_color" id="staticBackdropLabel">Validasi Simak</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form autocomplete="off">
                                    <div class="form-group">
                                        <label for="usernameSimak">{{ __('NIM') }}</label>
                                        <input id="usernameSimak" type="text" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="passwordSimak">{{ __('Password') }}</label>
                                        <input id="passwordSimak" type="password" class="form-control">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn-custom btn-block primary_color secondary_text_color">Validasi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
