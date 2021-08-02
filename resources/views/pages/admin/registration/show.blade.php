@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail : {{ $data->namaLengkap }}</h1>
        <div class="pull-right">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('pendaftaran.index') }}"><i class="fas fa-caret-left"></i> Back</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row details-pendaftaran">
                        <div class="col-12 col-md-2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="title mb-2">Foto</div>
                                </div>
                                <div class="col-12 image-wrapper mb-3">
                                    <div class="image" style="background-image : url('{{ Storage::exists('public/' . $data->foto) && $data->foto ? Storage::url($data->foto) : asset('images/user.png') }}')"></div>
                                </div>
                                <div class="col-12">
                                    <div class="title mb-2">Swafoto</div>
                                </div>
                                <div class="col-12 image-wrapper">
                                    <div class="image" style="background-image : url('{{ Storage::exists('public/' . $data->swafoto) && $data->swafoto ? Storage::url($data->swafoto) : asset('images/user.png') }}')"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-10">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="title">Nama Lengkap</div>
                                    <div class="subtitle">{{ $data->namaLengkap }}</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="title">NIM</div>
                                    <div class="subtitle">{{ $data->nim }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="title">Tempat Lahir</div>
                                    <div class="subtitle">{{ $data->tempatLahir }}</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="title">Tanggal Lahir</div>
                                    <div class="subtitle">{{ \Carbon\Carbon::parse($data->tanggalLahir)->format('d/m/Y') }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="title">Jenis Kelamin</div>
                                    <div class="subtitle">{{ $data->jenisKelamin }}</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="title">Program Studi</div>
                                    <div class="subtitle">{{ $data->programStudi }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="title">Semester</div>
                                    <div class="subtitle">{{ $data->semester }}</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="title">Tahun Angkatan</div>
                                    <div class="subtitle">{{ $data->tahunAngkatan }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="title">No. HP / WA</div>
                                    <div class="subtitle">{{ $data->noTelepon }}</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="title">Email</div>
                                    <div class="subtitle">{{ $data->email }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="title">Asal Sekolah</div>
                                    <div class="subtitle">{{ $data->asalSekolah }}</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="title">Motto Hidup</div>
                                    <div class="subtitle">{{ $data->mottoHidup }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="title">Motivasi BEM</div>
                                    <div class="subtitle">{{ $data->motivasiBEM }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="title">Pengalaman Organisasi</div>
                                    <div class="subtitle">{{ $data->pengalamanOrganisasi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-4">
                <div class="row">
                    @if ($data->statusTerima == null)
                        <div class="col-12 col-md-6">
                            <button type="button" class="btn btn-success btn-block px-5" data-toggle="modal" data-target="#modalTerima"><i class="fas fa-check"></i> Terima</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="button" class="btn btn-danger btn-block px-5" data-toggle="modal" data-target="#modalTolak"><i class="fas fa-times"></i> Tolak</button>
                        </div>
                    @else
                        <div class="col-12">
                            <button type="button" class="btn btn-{{ $data->statusTerima == 1 ? 'success' : 'danger' }} btn-block px-5" disabled><i class="fas fa-{{ $data->statusTerima == 1 ? 'check' : 'times' }}"></i>
                                {{ $data->statusTerima == 1 ? 'Telah Di Terima' : 'Telah Di Tolak' }}</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTerima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('penerimaan.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penerimaan Anggota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="statusTerima" value="1">
                        <p>Apakah Anda Yakin Ingin Menerima <strong> {{ $data->namaLengkap }} </strong> Untuk Menjadi Anggota BEM ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <strong>Terima</strong>
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('penerimaan.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penolakan Anggota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="statusTerima" value="0">
                        <p>Apakah Anda Yakin Ingin Menolak <strong> {{ $data->namaLengkap }} </strong> Untuk Menjadi Anggota BEM ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            <strong>Tolak</strong>
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
