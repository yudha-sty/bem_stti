@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan Halaman Utama</h1>
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
            <form action="{{ route('homepage-setting.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Title Bagian Header</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="header_title" placeholder="Masukan Title.." value="{{ old('header_title', $data->header_title) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Title Font Size</label>
                                    <div class="col-12 input-group">
                                        <input type="number" class="form-control" name="header_title_font_size" placeholder="Masukan Font Size.." value="{{ old('header_title_font_size', $data->header_title_font_size) }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">px</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Subtitle Bagian Header</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="header_subtitle" placeholder="Masukan Subtitle.." value="{{ old('header_subtitle', $data->header_subtitle) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Subtitle Font Size</label>
                                    <div class="col-12 input-group">
                                        <input type="number" class="form-control" name="header_subtitle_font_size" placeholder="Masukan Font Size.." value="{{ old('header_subtitle_font_size', $data->header_subtitle_font_size) }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">px</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Banner Bagian Header</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="header_cover" id="customFile1">
                                            <label class="custom-file-label" for="customFile">Pilih..</label>
                                        </div>
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
                            <div class="col-12 col-md-4 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Subtitle Bagian Kabinet</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="section_cabinet_subtitle" placeholder="Masukan Subtitle.." value="{{ old('section_cabinet_subtitle', $data->section_cabinet_subtitle) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Subtitle Font Size</label>
                                    <div class="col-12 input-group">
                                        <input type="number" class="form-control" name="section_cabinet_subtitle_font_size" placeholder="Masukan Font Size.." value="{{ old('section_cabinet_subtitle_font_size', $data->section_cabinet_subtitle_font_size) }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">px</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Title Bagian Kabinet</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="section_cabinet_title" placeholder="Masukan Subtitle.." value="{{ old('section_cabinet_title', $data->section_cabinet_title) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Title Font Size</label>
                                    <div class="col-12 input-group">
                                        <input type="number" class="form-control" name="section_cabinet_title_font_size" placeholder="Masukan Font Size.." value="{{ old('section_cabinet_title_font_size', $data->section_cabinet_title_font_size) }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">px</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Logo Bagian Kabinet</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="section_cabinet_logo" id="customFile2">
                                            <label class="custom-file-label" for="customFile">Pilih..</label>
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
