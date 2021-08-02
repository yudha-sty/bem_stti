@extends('layouts.adminLayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Role</h1>
        <div class="pull-right">
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('role.index') }}"><i class="fas fa-caret-left"></i> Back</a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row details-pendaftaran">
                        <div class="col-12 col-md-10">
                            <div class="row">
                                <div class="col-12">
                                    <div class="title">Nama Role</div>
                                    <div class="subtitle mb-2">{{ $data->name }}</div>
                                </div>
                                <div class="col-12">
                                    <div class="title mb-2">Permissions</div>
                                    <div>
                                        @if (!empty($rolePermissions))
                                            @foreach ($rolePermissions as $v)
                                                <label class="label label-success">{{ $v->name }}</label>
                                                <br>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
