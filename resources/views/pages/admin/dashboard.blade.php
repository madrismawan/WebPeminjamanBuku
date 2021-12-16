@extends('layouts.main-layout.main-layout')

@section('tittle', 'Dashboard')

@push('css')

    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/fullcalendar/main.css')}}">

@endpush


@section('content')

    <div class=" container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($jumlahBuku)}}</h3>
                        <p>Jumlah Buku</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="{{route('admin.manajemen-buku.data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$jumlahPengguna}}</h3>
                        <p>Jumlah Anggota</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{route('admin.manajemen-pengguna.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$jumlahBukuTerpinjam}}</h3>
                        <p>Buku Terpinjam</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="{{route('admin.manajemen-buku.data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{$jumlahBukuTersedia}}</h3>
                        <p>Buku Tersedia</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-archive"></i>
                    </div>
                    <a href="{{route('admin.manajemen-buku.data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-8">
                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                    <h3 class="card-title">Penerbit Buku</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Buku Terpinjam</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    @foreach ($dataPeminjam as $data)
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <!-- /.item -->
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{route('get-image-sampul-buku',$data->buku_id)}}" alt="Product Image" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="{{route('admin.manajemen-buku.detail',$data->buku_id)}}" class="product-title ">{{$data->bukus->kode}} - {{$data->bukus->judul}}
                                            <span class="badge badge-secondary float-right">{{date('d-m-Y',strtotime($data->trxpeminjaman->tanggal))}}</span>
                                        </a>
                                        <span class="product-description">
                                           {{$data->bukus->deskripsi}}
                                        </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                            </ul>
                        </div>
                    @endforeach
                    <div class="card-footer text-center">
                        <a href="{{route('admin.trx-peminjaman.index')}}" class="uppercase">Lihat Semua Peminjaman</a>
                    </div>
                         <!-- /.card-footer -->

                    <!-- /.card-body -->


                </div>
            </div>

        </div>

    </div>

@endsection

@push('js')

    <!-- ChartJS -->
    <script src="{{asset('base-template/plugins/chart.js/Chart.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-dashboard').addClass('menu-open');
        });
    </script>

    {{-- LOGIC BAR MENGHITUNG BERDASARKAN JUMLAH BUKU PENERBITNYA  --}}
    <script>
        $(function () {
            // NAMPILIN DI ID #donutChart
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData        = {
            labels: [
                'Balai Pustaka ',
                'Tiga Serangkai',
            ],
            datasets: [
                {
                data: [
                    {{count($jumlahBuku->where('penerbit','Balai Pustaka'))}},
                    {{count($jumlahBuku->where('penerbit','Tiga Serangkai'))}}
                ],
                backgroundColor : ['#f56954', '#00c0ef', '#f39c12', '#3c8dbc', '#d2d6de'],
                }
            ]
            }
            var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            }
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
        })
    </script>
    {{-- LOGIC BAR MENGHITUNG BERDASARKAN JUMLAH BUKU PENERBITNYA  --}}

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if(Session::has('login'))
            Toast.fire({
                icon:  @if(Session::has('iconLog')){!! '"'.Session::get('iconLog').'"' !!} @else 'question' @endif,
                title: @if(Session::has('titleLog')){!! '"'.Session::get('titleLog').'"' !!} @else 'Oppss...'@endif,
            });
        @endif

    </script>



@endpush


