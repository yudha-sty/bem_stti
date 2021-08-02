@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan Keseluruhan</h1>
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
            <form action="{{ route('global-setting.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Logo Dasar Navbar</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="navbar_logo" id="customFile1">
                                            <label class="custom-file-label" for="customFile">Pilih..</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Judul Navbar</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="navbar_title" placeholder="Masukan Title.." value="{{ old('navbar_title', $data->navbar_title) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-3 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Warna Dasar Pertama</label>
                                    <div class="col-12">
                                        <input type="color" class="form-control" name="primary_color" value="{{ old('primary_color', $data->primary_color) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Warna Dasar Kedua</label>
                                    <div class="col-12">
                                        <input type="color" class="form-control" name="secondary_color" value="{{ old('secondary_color', $data->secondary_color) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Warna Pertama Tulisan</label>
                                    <div class="col-12">
                                        <input type="color" class="form-control" name="primary_text_color" value="{{ old('primary_text_color', $data->primary_text_color) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Warna Kedua Tulisan</label>
                                    <div class="col-12">
                                        <input type="color" class="form-control" name="secondary_text_color" value="{{ old('secondary_text_color', $data->secondary_text_color) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-2">
                    <!-- Card Body -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="row">
                                    <label class="col-12 control-label">Banner Atas Halaman</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="page_banner" id="customFile2">
                                            <label class="custom-file-label" for="customFile">Pilih..</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mb-md-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="banner-image-wrapper">
                                            <div class="image" style="background-image: url({{ Storage::exists('public/' . $data->page_banner) && $data->page_banner ? Storage::url($data->page_banner) : asset('asset/images/landing2.png') }})"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 mt-2">
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
