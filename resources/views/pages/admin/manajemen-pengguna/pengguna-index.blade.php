@extends('layouts.main-layout.main-layout')

@section('tittle','Data Peminjam')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endpush


@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Data Peminjam TI</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Peminjaman Buku TI</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                    <div class="card-header my-auto">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-title my-auto">List Data Peminjaman Buku TI</h3>
                            </div>
                            <div class="col-6">
                                <a href="{{route('admin.manajemen-pengguna.create')}}" class="btn btn-primary float-right" type="button" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>

                    {{-- Start Data Table Sulinggih --}}
                    <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages p-2">
                                <table id="peminjam" class="table table-striped table-hover mx-auto table-responsive-sm">
                                    <thead >
                                        <tr>
                                            <th>No</th>
                                            <th>No KTP</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>51030601022045201</td>
                                            <td>Made Rismawan</td>
                                            <td>Perumahan Cemara Giri Dalung, Kuta Utara, Dalung</td>
                                            <td>081236452642</td>
                                            <td>2-June-2021</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>51030601022045201</td>
                                            <td>Made Rismawan</td>
                                            <td>Perumahan Cemara Giri Dalung, Kuta Utara, Dalung</td>
                                            <td>081236452642</td>
                                            <td>2-June-2021</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End Data Table Sulinggih --}}


                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTablbase-template Plugins -->
    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-master-data').addClass('menu-open');
            $('#side-upacara').addClass('active');
        });

        $(function () {
            $("#peminjam").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Akun Sulinggih",
                    "sSearchPlaceholder": "Cari data....",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ data)",
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-manajemen-pengguna').addClass('menu-open');
            $('#side-manajemen-pengguna-data').addClass('active');
        });
    </script>

@endpush
