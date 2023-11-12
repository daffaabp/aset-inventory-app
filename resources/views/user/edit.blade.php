@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah User</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="roles" class="col-lg-3 col-form-label">Role:</label>

                            {{-- {!! Form::select('roles[]', $roles, $userRole, [
                                    'class' => 'form-control',
                                    'multiple',
                                ]) !!} --}}

                            @if ($isSuperadmin)
                                {{-- <input type="text" name="role" class="form-control" value="Superadmin" readonly> --}}
                                <div class="col-lg-9">
                                    <input type="text" name="role" class="form-control" value="Superadmin" readonly>
                                </div>
                            @else
                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                                {{-- <div class="col-lg-9">
                                    <select name="roles[]" class="form-select" multiple>
                                        @foreach ($roles as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ in_array($key, $userRole) ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            @endif

                        </div>


                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password</label>
                            <div class="col-lg-9">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-lg-9">
                                <input type="password" name="confirm-password" class="form-control">
                            </div>
                        </div>

                        @can('user.update')
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        @endcan

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
