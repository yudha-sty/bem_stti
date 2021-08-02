@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data Jadwal Kegiatan</h1>
        <div class="pull-right">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('timeline.index') }}"><i class="fas fa-caret-left"></i> Back</a>
        </div>
    </div>

    <!-- Alert -->
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
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('timeline.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Judul</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="title" placeholder="Masukan Judul" value="{{ old('title', $data->title) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Deskripsi</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="description" placeholder="Masukan Deskripsi" value="{{ old('description', $data->description) }}">
                                </div>
                            </div>
                        </div>
                        <div class=" form-group">
                            <div class="row">
                                <label class="col-12 control-label">Tanggal Kegiatan</label>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Dari :</div>
                                                </div>
                                                <input type="date" class="form-control" name="activity_date_start" value="{{ old('activity_date_start', $data->activity_date_start) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Sampai :</div>
                                                </div>
                                                <input type="date" class="form-control" name="activity_date_end" value="{{ old('activity_date_end', $data->activity_date_end) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Waktu Kegiatan</label>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Dari :</div>
                                                </div>
                                                <input type="time" class="form-control" name="activity_time_start" value="{{ old('activity_time_start', $data->activity_time_start) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Sampai :</div>
                                                </div>
                                                <input type="time" class="form-control" name="activity_time_end" value="{{ old('activity_time_end', $data->activity_time_end) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-12 control-label">Cover</label>
                                <div class="col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="cover" id="customFile">
                                        <label class="custom-file-label" for="customFile">Pilih Foto Cover</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Ubah Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $('#customFile').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //clean fake path
            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(cleanFileName);
        });
    </script>
@endpush
