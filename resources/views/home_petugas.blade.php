@extends('layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Beranda Petugas</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Beranda Petugas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Total Aset Tanah</h6>
                            <h3>{{ $totalAset['totalAsetTanah'] }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="assets/img/flat_icons/playground.png" style="width: 50px;" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Total Aset Gedung</h6>
                            <h3>{{ $totalAset['totalAsetGedung'] }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="assets/img/flat_icons/residential.png" style="width: 50px;" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Total Aset Kendaraan</h6>
                            <h3>{{ $totalAset['totalAsetKendaraan'] }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="assets/img/flat_icons/motorcycle-1.png" style="width: 48px;" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Total Aset Inventaris Ruangan</h6>
                            <h3>{{ $totalAset['totalAsetInventarisRuangan'] }}</h3>
                        </div>
                        <div class="db-icon">
                            <img src="assets/img/flat_icons/product.png" style="width: 50px;" alt="Dashboard Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Grafik Peminjaman Bulanan</div>
                </div>
                <div class="card-body">
                    <!-- Year Dropdown Filter -->
                    <form action="{{ route('dashboard') }}" method="GET" class="mb-0" style="margin-top: -10px;">
                        <div class="form-group mb-0 row">
                            <label class="col-form-label col-md-1" style="font-size: 14.5px; width: 200px;">Filter Tahun
                                Peminjaman
                                :</label>
                            <div class="col-md-1" style="width: 130px;">
                                <select class="form-control form-select form-control-sm" name="year" id="year"
                                    onchange="this.form.submit()">
                                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                        <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>




                    <!-- Chart Canvas -->
                    <canvas id="monthlyChart" height="95"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Grafik Status Aset Tanah</div>
                </div>
                <div class="card-body">
                    <canvas id="chartTanah"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Grafik Status Aset Gedung</div>
                </div>
                <div class="card-body">
                    <canvas id="chartGedung"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Grafik Status Aset Kendaraan</div>
                </div>
                <div class="card-body">
                    <canvas id="chartKendaraan"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Grafik Status Aset Inventaris Ruangan</div>
                </div>
                <div class="card-body">
                    <canvas id="chartInventarisRuangan"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="{{ URL::to('assets/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/flot/jquery.flot.pie.js') }}"></script>

    <script>
        function createDonutChart(ctx, data, title) {
            return new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        data: Object.values(data),
                        backgroundColor: getColors(Object.keys(data)),
                        hoverBackgroundColor: getColors(Object.keys(data)),
                        hoverBorderColor: getHoverColors(Object.keys(data)),
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: title,
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    circumferencePercentage: 70,
                    animation: {
                        animateScale: true,
                        easing: 'easeInOutQuart',
                        animateRotate: true,
                        duration: 2000,
                        animateRotate: true,
                        animateRotateDegrees: 360,
                        animateScaleRadius: true,
                        animateScaleAngle: true,
                    },
                    elements: {
                        arc: {
                            borderColor: '#fff',
                            borderWidth: 2,
                        }
                    },

                }
            });
        }

        function getColors(labels) {
            return labels.map(function(label) {
                switch (label) {
                    case 'Tersedia':
                        return '#36A2EB';
                    case 'Dipinjam':
                        return '#FFCE56';
                    case 'Rusak':
                        return '#FF6384';
                    default:
                        return '#000000';
                }
            });
        }

        function getHoverColors(labels) {
            return labels.map(function(label) {
                switch (label) {
                    case 'Tersedia':
                        return '#2B81CC';
                    case 'Dipinjam':
                        return '#E5B451';
                    case 'Rusak':
                        return '#E75A7C';
                    default:
                        return '#000000';
                }
            });
        }

        function getHoverColors(labels) {
            return labels.map(function(label) {
                switch (label) {
                    case 'Tersedia':
                        return '#2B81CC';
                    case 'Dipinjam':
                        return '#E5B451';
                    case 'Rusak':
                        return '#E75A7C';
                    default:
                        return '#000000';
                }
            });
        }

        $(function() {
            var monthlyPeminjamanData = chartData.getMonthlyPeminjamanData();

            $.plot('#flotAreaPoints', [{
                data: monthlyPeminjamanData,
                lines: {
                    show: true
                },
                points: {
                    show: true,
                    radius: 5,
                    fill: true,
                    fillColor: '#ffffff',
                    lineWidth: 2
                }
            }], chartOptions.areaChartPoints);
        });

        var ctxTanah = document.getElementById('chartTanah').getContext('2d');
        createDonutChart(ctxTanah, @json($dataAsetTanah), 'Aset Tanah');

        var ctxGedung = document.getElementById('chartGedung').getContext('2d');
        createDonutChart(ctxGedung, @json($dataAsetGedung), 'Aset Gedung');

        var ctxKendaraan = document.getElementById('chartKendaraan').getContext('2d');
        createDonutChart(ctxKendaraan, @json($dataAsetKendaraan), 'Aset Kendaraan');

        var ctxInventarisRuangan = document.getElementById('chartInventarisRuangan').getContext('2d');
        createDonutChart(ctxInventarisRuangan, @json($dataAsetInventarisRuangan), 'Aset Inventaris Ruangan');
    </script>



    <script>
        var chartData = {!! json_encode($chartData) !!};

        // Array of Indonesian month names
        var monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        var ctx = document.getElementById('monthlyChart').getContext('2d');
        var monthlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthNames, // Use Indonesian month names
                datasets: [{
                    label: 'Peminjaman Selesai',
                    data: chartData.totals,
                    fill: true,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'category',
                        labels: monthNames, // Use Indonesian month names
                        title: {
                            display: true,
                            text: 'Bulan',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 30,
                        ticks: {
                            stepSize: 5
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Peminjaman',
                        },
                    },
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' Jumlah Peminjaman: ' + context.parsed.y;
                            },
                        },
                    },
                },
            },
        });
    </script>
@endpush
