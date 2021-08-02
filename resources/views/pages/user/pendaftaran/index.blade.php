@extends('layouts.userLayouts')

@section('content')

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Validasi Berhasil',
                text: '{{ $message }}'
            });
        </script>
    @endif

    <section id="heading">
        <div class="overlay overlay_color"></div>
        <div class="heading d-flex justify-content-center align-items-center">
            <h1 class="secondary_text_color">Pendaftaran BEM</h1>
        </div>
        <img class="white-brush bottom-brush" src="./asset/shapes/white-brush.svg" alt="">
    </section>

    <section id="registration" class="my-0 my-md-5 mx-3">
        <div class="registration container">
            <div class="row d-inline text-center">
                <h1 class="primary_text_color">Pendaftaran Keanggotaan BEM</h1>
                <h2 class="primary_font_color mb-md-4">Tahun Akademik {{ $registrationSetting->academic_year }}</h2>
            </div>
            <form action="{{ route('storePendaftaran') }}" class="registration-form mb-5" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" class="form-control @error('namaLengkap') is-invalid @enderror" id="namaLengkap" name="namaLengkap" value="{{ old('namaLengkap') }}">

                    @error('namaLengkap')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="col-12 col-md-8">
                        <label for="tempatLahir">Tempat Lahir</label>
                        <input type="text" class="form-control @error('tempatLahir') is-invalid @enderror" name="tempatLahir" value="{{ old('tempatLahir') }}">

                        @error('tempatLahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4 my-3 my-md-0">
                        <label for="tempatLahir">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggalLahir') is-invalid @enderror" name="tanggalLahir" value="{{ old('tanggalLahir') }}">

                        @error('tanggalLahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="mt-3">
                        <label for="jenisKelamin">Jenis Kelamin</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenisKelamin" id="lakilaki" value="Laki - Laki" @if (old('jenisKelamin') == 'Laki - Laki') checked @endif>
                        <label class="form-check-label" for="lakilaki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" value="Perempuan" @if (old('jenisKelamin') == 'Perempuan') checked @endif>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>

                    <input type="hidden" class="@error('jenisKelamin') is-invalid @enderror">
                    @error('jenisKelamin')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="tel" min="0" maxlength="10" pattern="\d*" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}">

                    @error('nim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="col-8">
                        <label for="programStudi">Program Studi</label>
                        <select class="form-control @error('programStudi') is-invalid @enderror" id="programStudi" name="programStudi" value="{{ old('programStudi') }}">
                            <option @if (!old('programStudi')) selected @endif disabled></option>
                            <option @if (old('programStudi') == 'Komputer Akuntansi') selected @endif value="Komputer Akuntansi">Komputer Akuntansi</option>
                            <option @if (old('programStudi') == 'Sistem Informasi') selected @endif value="Sistem Informasi">Sistem Informasi</option>
                            <option @if (old('programStudi') == 'Teknik Informatika') selected @endif value="Teknik Informatika">Teknik Informatika</option>
                        </select>

                        @error('programStudi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="semester">Semester</label>
                        <input type="number" min="1" max="8" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" value="{{ old('semester') }}">

                        @error('semester')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="tahunAngkatan">Tahun Angkatan</label>
                    <select class="form-control @error('tahunAngkatan') is-invalid @enderror" id="tahunAngkatan" name="tahunAngkatan" value="{{ old('tahunAngkatan') }}">
                        {{-- Javascript Insert 5 Years between --}}
                    </select>

                    @error('tahunAngkatan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="noTelepon">Nomor HP / Whatsapp</label>
                    <input type="tel" class="form-control @error('noTelepon') is-invalid @enderror" id="noTelepon" name="noTelepon" value="{{ old('noTelepon') }}">

                    @error('noTelepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mottoHidup">Motto Hidup</label>
                    <textarea class="form-control @error('mottoHidup') is-invalid @enderror" id="mottoHidup" name="mottoHidup" rows="3">{{ old('mottoHidup') }}</textarea>

                    @error('mottoHidup')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="motivasiBEM">Motivasi Mengikuti BEM</label>
                    <textarea class="form-control @error('motivasiBEM') is-invalid @enderror" id="motivasiBEM" name="motivasiBEM" rows="3">{{ old('motivasiBEM') }}</textarea>

                    @error('motivasiBEM')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Alamat E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="asalSekolah">Asal Sekolah</label>
                    <input type="text" class="form-control @error('asalSekolah') is-invalid @enderror" id="asalSekolah" name="asalSekolah" value="{{ old('asalSekolah') }}">

                    @error('asalSekolah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto">Pas foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" name="foto" id="foto" value="{{ old('foto') }}">
                        <label class="custom-file-label" for="foto">Pilih pasfoto</label>

                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="swafoto">Swafoto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('swafoto') is-invalid @enderror" name="swafoto" id="swafoto" value="{{ old('swafoto') }}">
                        <label class="custom-file-label" for="swafoto">Pilih swafoto</label>

                        @error('swafoto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="pengalamanOrganisasi">Pengalaman Organisasi</label>
                    <textarea class="form-control @error('pengalamanOrganisasi') is-invalid @enderror" id="pengalamanOrganisasi" name="pengalamanOrganisasi" rows="3">{{ old('pengalamanOrganisasi') }}</textarea>

                    @error('pengalamanOrganisasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="button" class="btn-custom btn-block primary_color secondary_text_color  mt-4 py-2" data-toggle="modal" data-target="#staticBackdrop">Submit</button>

                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

@push('addon-script')

    <script>
        let years = new Date().getFullYear() - 3;
        for (let i = 0; i < 5; i++) {
            $('#tahunAngkatan').append(
                `<option value="${years+i}" ${i==3 ? "selected" : ""}>${years+i}</option>`
            )
        }

        $('#foto').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //clean fake path
            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(cleanFileName);
        });

        $('#swafoto').on('change', function() {
            //get the file name
            var fileName = $(this).val();
            //clean fake path
            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(cleanFileName);
        });
    </script>

@endpush
