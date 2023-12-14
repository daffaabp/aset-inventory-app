{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Responsive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style_login.css') }}">
</head>

<body>

    <section class="wrapper">
        <div class="container">
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
                <div class="logo" style="margin-top: 50px; margin-bottom: 10px;">
                    <img src="{{ URL::to('assets/img/logo_lengkap_sip_aset.png') }}" class="img-fluid" alt="logo">
                </div>

                <form method="POST" action="{{ route('login') }}" class="bg-white p-5"
                    style="border-radius: 15px; box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);">
                    @csrf

                    <img src="{{ URL::to('assets/img/kwarcab_bms_logo.png') }}"
                        style="width: 110px; margin-top: -25px; margin-bottom: 10px" class="img-fluid" alt="logo">

                    <div class="fw-normal text-muted mb-2">
                        <a href="#" class="text-primary fw-bold text-decoration-none">Selamat Datang</a>
                    </div>

                    <h3 class="text-dark fw-bolder fs-4 mb-2">Sistem Pengelolaan Aset Kwarcab Banyumas</h3>
                    <br>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="Masukkan email"
                            name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                        <label for="floatingInput">{{ __('Email') }}</label>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword"
                            placeholder="Masukkan password" name="password" required autocomplete="current-password">
                        <label for="floatingPassword">{{ __('Password') }}</label>
                        <span class="profile-views feather-eye toggle-password"></span>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary submit_btn w-100 my-4">Masuk</button>
                </form>
            </div>
        </div>
    </section>

</body>

</html>
