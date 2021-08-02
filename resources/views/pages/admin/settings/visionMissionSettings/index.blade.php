@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan Visi Misi</h1>
    </div>

    <!-- Alert -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="my-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <form action="{{ route('vision-mission-setting.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Visi</label>
                                    <div class="col-12">
                                        <textarea name="vision" id="vision">{{ old('vission', $data->vision) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Misi</label>
                                    <div class="col-12">
                                        <textarea name="mission" id="mission">{{ old('mission', $data->mission) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <label class="col-12 control-label">Status Illustrasi</label>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="illustration_visibility" id="flexRadioDefault1" value="1" {{ $data->illustration_visibility == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                On
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="illustration_visibility" id="flexRadioDefault2" value="0" {{ $data->illustration_visibility == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Off
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <label class="col-12 control-label">Illustrasi 1</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="illustration_1" id="customFile1">
                                            <label class="custom-file-label" for="customFile1">Pilih Foto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Illustrasi 2</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="illustration_2" id="customFile2">
                                            <label class="custom-file-label" for="customFile2">Pilih Foto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block px-5"><i class="fas fa-edit"></i> Simpan Pengaturan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        CKEDITOR.replace('vision');
        CKEDITOR.replace('mission');

        $('#customFile1').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //clean fake path
            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(cleanFileName);
        });

        $('#customFile2').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //clean fake path
            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(cleanFileName);
        });
    </script>
@endpush
