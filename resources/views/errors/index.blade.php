<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Error 403</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
</head>

<body class="error-page">

    <div class="main-wrapper">
        <div class="error-box">
            <h1>404</h1>
            <h3 class="mb-3 h2"><i class="fas fa-exclamation-triangle"></i> Oops! {{ __('Errors') }}</h3>
            <p class="h4 font-weight-normal"> {{ __($exception) }}</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Home</a>
        </div>
    </div>


    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
</body>

</html>
