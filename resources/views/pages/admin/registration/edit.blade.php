@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data Pendaftar</h1>
        <div class="pull-right">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('pendaftaran.index') }}"><i class="fas fa-caret-left"></i> Back</a>
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
            <form action="{{ route('pendaftaran.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Nama Lengkap</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="namaLengkap" value="{{ old('namaLengkap', $data->namaLengkap) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Tempat Lahir</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tempatLahir" value="{{ old('tempatLahir', $data->tempatLahir) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Tanggal Lahir</label>
                                    <div class="col-12">
                                        <input type="date" class="form-control" name="tanggalLahir" value="{{ old('tanggalLahir', $data->tanggalLahir) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Jenis Kelamin</label>
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenisKelamin" id="lakilaki" value="Laki - Laki" {{ $data->jenisKelamin == 'Laki - Laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lakilaki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" value="Perempuan" {{ $data->jenisKelamin == 'Perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">NIM</label>
                                    <div class="col-12">
                                        <input type="tel" min="0" maxlength="10" pattern="\d*" class="form-control" name="nim" value="{{ old('nim', $data->nim) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Program Studi</label>
                                    <div class="col-12">
                                        <select class="form-control" id="programStudi" name="programStudi">
                                            <option selected disabled></option>
                                            <option value="Komputer Akuntansi" {{ $data->programStudi == 'Komputer Akuntansi' ? 'selected' : '' }}>Komputer Akuntansi</option>
                                            <option value="Sistem Informasi" {{ $data->programStudi == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                            <option value="Teknik Informatika" {{ $data->programStudi == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Semester</label>
                                    <div class="col-12">
                                        <input type="number" min="0" max="8" onkeydown="return false" class="form-control" name="semester" value="{{ old('semester', $data->semester) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Tahun Angkatan</label>
                                    <div class="col-12">
                                        <select class="form-control" id="tahunAngkatan" name="tahunAngkatan">
                                            {{-- Javascript Insert 5 Years between --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Email</label>
                                    <div class="col-12">
                                        <input type="email" class="form-control" name="email" value="{{ old('email', $data->email) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Nomor HP / Whatsapp</label>
                                    <div class="col-12">
                                        <input type="tel" class="form-control" id="noTelepon" name="noTelepon" value="{{ old('noTelepon', $data->noTelepon) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Asal Sekolah</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="asalSekolah" value="{{ old('asalSekolah', $data->asalSekolah) }}">
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
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Motto Hidup</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="mottoHidup" rows="5">{{ $data->mottoHidup }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Motivasi Mengikuti BEM</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="motivasiBEM" rows="5">{{ $data->motivasiBEM }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <label class="col-12 control-label">Motto Hidup</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="pengalamanOrganisasi" rows="5">{{ $data->pengalamanOrganisasi }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Foto</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="foto" id="customFile1">
                                            <label class="custom-file-label" for="customFile">Pilih..</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <div class="row">
                                    <label class="col-12 control-label">Swafoto</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="swafoto" id="customFile2">
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
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary btn-block px-5"><i class="fas fa-edit"></i> Ubah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        let years = new Date().getFullYear() - 3;
        let data = {{ $data->tahunAngkatan }}
        for (let i = 0; i < 5; i++) {
            $('#tahunAngkatan').append(
                `<option value="${years+i}" ${years+i==data ? "selected" : ""}>${years+i}</option>`
            )
        }

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
