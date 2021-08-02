@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendaftaran Anggota BEM</h1>
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

    <div class="delete-response">

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    @can('pendaftaran-setting')
                        <form action="{{ route('registration-setting.update', $setting->id) }}" method="post" class="mb-4">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <label class="col-12 col-md-12 col-form-label">Status Pendaftaran</label>
                                            <div class="col-12 col-md-12">
                                                <select class="form-control" name="visibility">
                                                    <option value="1" {{ $setting->visibility == 1 ? 'selected' : '' }}>Buka</option>
                                                    <option value="0" {{ $setting->visibility == 0 ? 'selected' : '' }}>Tutup</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <label class="col-12 col-md-12 col-form-label">Tahun Akademik</label>
                                            <div class="col-12 col-md-12">
                                                <select class="form-control" id="dropdownYear" name="academic_year">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <label class="col-12 col-md-12 col-form-label d-none d-md-block">&nbsp;</label>
                                            <div class="col-12 col-md-12 mt-3 mt-md-0">
                                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endcan
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap w-100 display" id="tableRegistration">
                            <thead>
                                <tr>
                                    <th width="70px">No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Program Studi</th>
                                    <th>Tahun Angkatan</th>
                                    <th width="200px">Foto</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger delete-pendaftaran" value="">
                        <strong>
                            Hapus
                        </strong>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#tableRegistration').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: '{!! url()->current() !!}',
            order: [
                [1, 'asc']
            ],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    width: '1%',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nim',
                    name: 'nim'
                },
                {
                    data: 'namaLengkap',
                    name: 'namaLengkap',
                },
                {
                    data: 'jenisKelamin',
                    name: 'jenisKelamin',
                },
                {
                    data: 'programStudi',
                    name: 'programStudi',
                },
                {
                    data: 'tahunAngkatan',
                    name: 'tahunAngkatan',
                },
                {
                    data: 'foto',
                    name: 'foto',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '1%'
                }
            ],
            sDom: '<"secondBar d-flex flex-wrap justify-content-between mb-2"lf>rt<"bottom"p>',

            "fnCreatedRow": function(nRow, data) {
                $(nRow).attr('id', 'pendaftaran' + data.id);
            },
        });

        $(document).on("click", ".delete_modal", function() {
            var id = $(this).data('id');
            $(".modal-footer .delete-pendaftaran").val(id);
        });

        $('#dropdownYear').each(function() {

            var year = (new Date()).getFullYear();
            var current = year;
            var db = {{ $setting->academic_year }};
            year -= 3;
            for (var i = 0; i < 5; i++) {
                if ((year + i) == current)
                    $(this).append(`<option value="${year+i}" ${db==(year+i) ? "selected" : ""}>${year+i}</option>`);
                else
                    $(this).append(`<option value="${year+i}" ${db==(year+i) ? "selected" : ""}>${year+i}</option>`);
            }

        })

        jQuery(document).ready(function($) {
            ////----- DELETE a link and remove from the page -----////
            jQuery('.delete-pendaftaran').click(function() {
                var pendaftaran_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: 'pendaftaran/' + pendaftaran_id,
                    success: function(data) {
                        $('#exampleModal').modal('hide');
                        $("#pendaftaran" + pendaftaran_id).remove();
                        $(".delete-response").append(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Di Hapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span></button></div>'
                        )
                    },
                    error: function(data) {
                        if (data.status === 403) {
                            $('#exampleModal').modal('hide');
                            $(".delete-response").append(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert">Unauthorized : Anda Tidak Memiliki Akses Untuk Menghapus Data<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span></button></div>'
                            )
                        }
                    }
                });
            });
        });
    </script>
@endpush
