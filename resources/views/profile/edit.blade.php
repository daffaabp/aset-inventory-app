{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Profil Pribadi</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profil Pribadi</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image position-relative">
                        @if (Auth::user()->foto)
                            <a href="{{ asset('storage/' . Auth::user()->foto) }}" target="_blank">
                                <div class="rounded-circle overflow-hidden" style="width: 100px; height: 100px;">
                                    <img class="w-100 h-100 object-cover"
                                        src="{{ asset('storage/' . Auth::user()->foto) }}">
                                </div>
                            </a>
                        @else
                            <img class="rounded-circle" src="{{ asset('assets/img/male_avatar.jpg') }}" width="31">
                        @endif
                    </div>
                    <div class="col ms-md-n2 profile-user-info">
                        <h4 class="user-name mb-0">{{ Auth::user()->name }}</h4>

                        @if (Auth::user()->hasRole(['Sekretaris Kwarcab', 'Sekretaris Bidang', 'Petugas', 'Superadmin']))
                            <h6 class="text-muted badge"
                                style="background-color: rgb(169, 241, 251); color: black; font-size: 12px;"> Peran
                                :
                                {{ Auth::user()->bidang->nama }}
                            </h6>
                            <div class="user-Location" style="font-size: 15px; margin-top: -5px;">Detail :
                                {{ Auth::user()->keterangan_bidang }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">Tentang Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                </li>
            </ul>
        </div>

        <div class="tab-content profile-tab-cont">
            <div class="tab-pane fade show active" id="per_details_tab">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')

                                    <h5 class="card-title d-flex justify-content-between" style="margin-bottom: 20px;">
                                        <span>Personal Detail</span>
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit" data-bs-toggle="modal"><i
                                                    class="far fa-edit me-1"></i>Edit</button>
                                        </div>
                                    </h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group local-forms" style="margin-top: -15px;">
                                                <label for="name">Nama <span class="login-danger">*</span></label>
                                                <input id="name" name="name" class="form-control form-control-lg"
                                                    type="text"value="{{ old('name', $user->name) }}" required autofocus
                                                    autocomplete="name">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-800">
                                                            {{ __('Your email address is unverified.') }}

                                                            <button form="send-verification"
                                                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                {{ __('Click here to re-send the verification email.') }}
                                                            </button>
                                                        </p>

                                                        @if (session('status') === 'verification-link-sent')
                                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                                {{ __('A new verification link has been sent to your email address.') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group local-forms" style="margin-top: -15px;">
                                                <label for="email">Email <span class="login-danger">*</span></label>
                                                <input id="email" name="email" class="form-control form-control-lg"
                                                    type="email" value="{{ old('email', $user->email) }}" required
                                                    autocomplete="email">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group local-forms" style="margin-top: -15px;">
                                                <label for="foto">Perbarui Foto <span class="login-danger"
                                                        style="font-size: 10px;">opsional</span></label>
                                                <input id="foto" name="foto" class="form-control form-control-lg"
                                                    type="file" accept="image/*">
                                                @error('foto')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            @if (Auth::user()->hasRole(['Sekretaris Kwarcab', 'Sekretaris Bidang']))
                                                <div class="form-group local-forms" style="margin-top: -15px;">
                                                    <label>Bidang <span class="login-danger"></span></label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        value="{{ Auth::user()->bidang->nama }}" readonly>
                                                </div>

                                                <div class="form-group local-forms" style="margin-top: -15px;">
                                                    <label>Keterangan <span class="login-danger">*</span></label>
                                                    <textarea name="keterangan_bidang" id="keterangan_bidang" rows="4" cols="5" class="form-control"
                                                        placeholder="Masukkan Keterangan..." readonly>{{ Auth::user()->keterangan_bidang }}</textarea>
                                                </div>
                                            @endif


                                            @if (session('status') === 'profile-updated')
                                                <p x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                    {{ __('Saved.') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="password_tab" class="tab-pane fade">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')

                                    <h5 class="card-title d-flex justify-content-between" style="margin-bottom: 20px;">
                                        <span>Ubah Password</span>
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit" data-bs-toggle="modal"><i
                                                    class="fas fa-save me-1"></i>Simpan</button>
                                        </div>
                                    </h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group local-forms" style="margin-top: -15px;">
                                                <label for="current_password">Password Lama <span
                                                        class="login-danger">*</span></label>
                                                <input id="current_password" name="current_password"
                                                    class="form-control form-control-lg" type="password"
                                                    autocomplete="current-password">
                                                @error('current_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group local-forms" style="margin-top: -15px;">
                                                <label for="password">Password Baru <span
                                                        class="login-danger">*</span></label>
                                                <input id="password" name="password"
                                                    class="form-control form-control-lg" type="password"
                                                    autocomplete="new-password">
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group local-forms" style="margin-top: -15px;">
                                                <label for="password_confirmation">Konfirmasi Password <span
                                                        class="login-danger">*</span></label>
                                                <input id="password_confirmation" name="password_confirmation"
                                                    class="form-control form-control-lg" type="password"
                                                    autocomplete="new-password">
                                                @error('password_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if (session('status') === 'password-updated')
                                                <p x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
