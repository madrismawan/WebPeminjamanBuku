@extends('layouts.main-layout.main-layout')

@section('tittle','Report Peminjaman')

@push('css')

@endpush

@section('content')
    <div class=" container-fluid">
        <section class="content-header">
            <div class="container-fluid border-bottom">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Report Transaksi Peminjaman Buku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Report Transaksi Peminjaman</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Bar chart -->
        <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="far fa-chart-bar"></i>
                Total List Buku Terpinjam
              </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div>
                <canvas id="myChart"></canvas>
            </div>

            <!-- /.card-body-->
        </div>
        <!-- /.card -->
    </div>

@endsection

@push('js')
    <!-- jQuery -->
    <script src="{{asset('base-template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- FLOT CHARTS -->
    <script src="{{asset('base-template/plugins/flot/jquery.flot.js')}}"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="{{asset('base-template/plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="{{asset('base-template/plugins/flot/plugins/jquery.flot.pie.js')}}"></script>

    <script src="{{asset('base-template/dist/js/chart.js')}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var date = new Date().getFullYear()
        const labels = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Peminjaman Tahun ' +date ,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    @foreach ($data as $jumlah)
                        {{$jumlah}},
                    @endforeach
                ],
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-laporan').addClass('menu-open');
            $('#side-laporan-peminjaman').addClass('active');
        });
    </script>
@endpush
