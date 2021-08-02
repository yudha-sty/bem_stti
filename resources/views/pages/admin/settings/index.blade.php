@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-4">
                            <a href="{{ route('homepage-setting.index') }}" class="btn btn-block btn-primary" data-toggle="tooltip" data-placement="bottom" title="Untuk Mengubah Beberapa Komponen Pada Halaman Utama">
                                Halaman Utama
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('vision-mission-setting.index') }}" class="btn btn-block btn-primary" data-toggle="tooltip" data-placement="bottom" title="Untuk Mengubah Visi Dan Misi">Visi Dan Misi</a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('cabinet-setting.index') }}" class="btn btn-block btn-primary" data-toggle="tooltip" data-placement="bottom" title="Untuk Mengubah Struktur Kabinet BEM">Struktur Kabinet</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <a href="{{ route('global-setting.index') }}" class="btn btn-block btn-primary" data-toggle="tooltip" data-placement="bottom" title="Untuk Mengubah Pengaturan Dasar. Seperti Navbar, Banner, Serta Warna Website">Pengaturan Dasar</a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('footer-setting.index') }}" class="btn btn-block btn-primary" data-toggle="tooltip" data-placement="bottom" title="Untuk Mengubah Data Pada Footer (Logo, Detail, Serta Map)">Footer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
