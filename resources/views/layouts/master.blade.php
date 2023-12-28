<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>Admin Dashboard</title> --}}
    <title>Sistem Peminjaman Aset Kwarcab</title>
    <link rel="shortcut icon" href="{{ URL::to('assets/img/logo_sip_aset.png') }}">
    <link href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins//toastr/toatr.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/form-wizard.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/c3-chart/c3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<style>
    .submenu:hover ul {
        display: block;
    }

    .badge-custom {
        display: inline-block;
        padding: 5px 10px;
        background-color: blue;
        color: white;
        border-radius: 5px;
    }
</style>


<body>
    @stack('css')
    <div class="main-wrapper">

        @include('layouts.header')
        @include('layouts.sidebar')

        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('content')

            </div>
            @include('layouts.footer')
        </div>
    </div>

    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ URL::to('assets/js/sweetalert2.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/toastr/toastr.js') }}"></script>
    {{-- <script src="{{ URL::to('assets/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/select2.min.js') }}"></script> --}}
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/twitter-bootstrap-wizard/form-wizard.js') }}"></script>

    <script src="{{ URL::to('assets/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/flot/chart-data.js') }}"></script>

    <script src="{{ URL::to('assets/plugins/c3-chart/d3.v5.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/c3-chart/c3.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/c3-chart/chart-data.js') }}"></script>
    <script src="{{ URL::to('assets/js/chart.umd.js') }}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
    <script type="text/javascript">
        $('.confirm-buttons').click(function(e) {
            var form = $(this).closest("form");
            var gambarId = $(this).attr('gambar-caption')
            e.preventDefault();

            Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure to delete title " + '"' + gambarId + '"' + " ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
        });
    </script>
    @stack('js')
</body>

</html>
