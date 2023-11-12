@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Peran dan Izin</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah Peran dan Izin</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <form method="POST" action="{{ route('role.update', ['id' => $role->id]) }}">
                    @csrf

                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title"></h3>
                                </div>

                                <div class="col-auto text-end ms-auto download-grp">
                                    <a href="{{ route('role.getRoutesAllJson') }}" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-undo"></i></i>
                                        Refresh Permissions</a>

                                    <a href="{{ route('role.getRefreshAndDeleteJson') }}"
                                        class="btn btn-warning btn-outline-warning me-2" style="color: white;"><i
                                            class="fas fa-undo"></i></i>
                                        Refresh & Delete Permissions</a>

                                    <button type="submit" class="btn btn-success btn-outline-success me-2"
                                        style="color: white"><i class="fas fa-save"></i> Simpan</button>

                                </div>
                            </div>
                        </div>

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $role->name }}">
                            </div>
                            <strong>Permission:</strong>
                            <br> <br>
                            @foreach ($permission as $value)
                                {{-- <label class="form-check">
                                    <input type="checkbox" name="permission[]" value="{{ $value->id }}"
                                        class="form-check-input"
                                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                    {{ $value->name }}
                                </label><br> --}}
                                <label class="form-check">
                                    <input type="checkbox" name="permission[]" value="{{ $value->id }}"
                                        class="form-check-input"
                                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                    {{ $value->name }}
                                </label><br>
                            @endforeach
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


{{-- @extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <!-- ... -->

            <div class="col-auto text-end ms-auto download-grp">
                <!-- Tombol untuk refreshing permissions -->
                <a href="{{ route('role.getRoutesAllJson') }}" class="btn btn-outline-primary me-2">
                    <i class="fas fa-undo"></i> Refresh Permissions
                </a>

                <!-- Tombol untuk refresh & delete permissions -->
                <a href="{{ route('role.getRefreshAndDeleteJson') }}" class="btn btn-warning btn-outline-warning me-2"
                    style="color: white;">
                    <i class="fas fa-undo"></i> Refresh & Delete Permissions
                </a>

                <!-- Tombol simpan untuk menyimpan perubahan pada role -->
                <button type="submit" class="btn btn-success btn-outline-success me-2" style="color: white">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="col-xs-12 col-sm-12 col-md-12">
        <form method="POST" action="{{ route('role.update', ['id' => $role->id]) }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}">
            </div>
            <strong>Permission:</strong>
            <br> <br>
            @foreach ($permission as $value)
                <label class="form-check">
                    <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="form-check-input"
                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                    {{ $value->name }}
                </label><br>
            @endforeach
    </div>
    </form>
    </div>
@endsection --}}
