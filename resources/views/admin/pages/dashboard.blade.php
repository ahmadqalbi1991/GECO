@extends('admin.main')

@section('content')
    @include('admin.layout.sidebar')
    <main class="main-content mt-1 border-radius-lg">
        @include('admin.layout.navbar')
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Sales by categories</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Sales in {{ \Carbon\Carbon::now()->format('M Y') }}</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line1" class="chart-canvas" height="300px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        <script>

            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors


            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["console", "headphones", "gamepad", "gamrcontroller", "games"],
                    datasets: [{
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        data: {{ $sales }},
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        enabled: true,
                        mode: "index",
                        intersect: false,
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                borderDash: [2],
                                borderDashOffset: [2],
                                color: '#dee2e6',
                                zeroLineColor: '#dee2e6',
                                zeroLineWidth: 1,
                                zeroLineBorderDash: [2],
                                drawBorder: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                // suggestedMax: 500,
                                beginAtZero: true,
                                padding: 10,
                                fontSize: 11,
                                fontColor: '#adb5bd',
                                lineHeight: 3,
                                fontStyle: 'normal',
                                fontFamily: "Open Sans",
                            },
                        }, ],
                        xAxes: [{
                            gridLines: {
                                zeroLineColor: 'rgba(0,0,0,0)',
                                display: false,
                            },
                            ticks: {
                                padding: 10,
                                fontSize: 11,
                                fontColor: '#adb5bd',
                                lineHeight: 3,
                                fontStyle: 'normal',
                                fontFamily: "Open Sans",
                            },
                        }, ],
                    },
                },
            });


            var ctx = document.getElementById("chart-line1").getContext("2d");

            var gradientStroke1 = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(9,148,41,0.61)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors


            new Chart(ctx, {
                type: "line",
                data: {
                    labels: {{ '[' . $dates . ']' }},
                    datasets: [{
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#00832b",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        data: {{ $monthly_sales }},
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        enabled: true,
                        mode: "index",
                        intersect: false,
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                borderDash: [2],
                                borderDashOffset: [2],
                                color: '#dee2e6',
                                zeroLineColor: '#dee2e6',
                                zeroLineWidth: 1,
                                zeroLineBorderDash: [2],
                                drawBorder: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                // suggestedMax: 500,
                                beginAtZero: true,
                                padding: 10,
                                fontSize: 11,
                                fontColor: '#adb5bd',
                                lineHeight: 3,
                                fontStyle: 'normal',
                                fontFamily: "Open Sans",
                            },
                        }, ],
                        xAxes: [{
                            gridLines: {
                                zeroLineColor: 'rgba(0,0,0,0)',
                                display: false,
                            },
                            ticks: {
                                padding: 10,
                                fontSize: 11,
                                fontColor: '#adb5bd',
                                lineHeight: 3,
                                fontStyle: 'normal',
                                fontFamily: "Open Sans",
                            },
                        }, ],
                    },
                },
            });
        </script>
    @endpush
@endsection
