@extends('layouts.main-layout.main-layout')

@section('tittle','Data Peminjam')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('base-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <script src="{{asset('base-template\dist\js\sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('base-template\dist\css\sweetalert2.min.css')}}">

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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Status Peminjaman</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="nav flex-column nav-pills card-body p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a id="peminjam-tabs" href="#peminjam-table" class="nav-link active" data-toggle="pill" role="tab" aria-controls="peminjam-table" aria-selected="true">
                                    Masih dipinjam
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="kembali-tabs"  href="#kembali-table" class="nav-link" data-toggle="pill" role="tab" aria-controls="kembali-table" aria-selected="false">
                                    Sudah Kembali
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-primary card-outline tab-content" id="v-pills-tabContent">
                    <div class="card-header my-auto">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-title my-auto">List Data Peminjaman Buku TI</h3>
                            </div>
                            <div class="col-6">
                                <a href="{{route('admin.trx-peminjaman.create')}}" class="btn btn-primary float-right" type="button" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>

                    {{-- Start Data Table Sulinggih --}}
                    <div class="tab-pane fade show active" id="peminjam-table" role="tabpanel" aria-labelledby="peminjam-tabs">
                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages p-2">
                                <table id="tb-dipinjam" class="table table-bordered table-hover ">
                                    <thead >
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Peminjam</th>
                                            <th>Buku dipinjam</th>
                                            <th>Tanggal Pinjam</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Tindakan</th>
                                            {{-- <input id="kondisiBuku" name='kondisi'> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataTransaksi as $data )
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$data->peminjams->nama}}</td>
                                                <td>
                                                    @foreach ($data->bukus as $buku)
                                                        <li>{{$buku->kode}} - {{$buku->judul}}</li>
                                                    @endforeach
                                                </td>
                                                <td>{{date('d-m-Y',strtotime($data->tanggal))}}</td>
                                                <td>
                                                    <a href="{{route('admin.trx-peminjaman.detail',$data->id)}}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a onclick="konfirmasiKembali({{$data->id}})" href="#" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                                    <a onclick="deleteTransaksi({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                </td>
                                                <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.trx-peminjaman.delete')}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                                </form>
                                            </tr>
                                        @endforeach

                                        {{-- @foreach ($dataTransaksiDetail->where('status','Masih dipinjam') as $data )
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$data->bukus->kode}}</td>
                                                <td>{{$data->bukus->judul}}</td>
                                                <td>{{date('d-m-Y',strtotime($data->trxpeminjaman->tanggal))}}</td>
                                                <td>
                                                    <a href="{{route('admin.trx-peminjaman.detail',$data->id)}}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a onclick="konfirmasiKembali({{$data->id}})" href="#" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                                    <a onclick="deleteTransaksi({{$data->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                </td>
                                                <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.trx-peminjaman.delete')}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" class="d-none" name="id" value="{{$data->id}}">
                                                </form>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                    <tfoot >
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Peminjam</th>
                                            <th>Buku dipinjam</th>
                                            <th>Tanggal Pinjam</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Tindakan</th>
                                            {{-- <input id="kondisiBuku" name='kondisi'> --}}
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="kembali-table" role="tabpanel" aria-labelledby="kembali-tabs">
                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages p-2">
                                <table id="tb-kembali" class="table table-bordered table-hover ">
                                    <thead >
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Judul Buku</th>
                                            <th>Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Tindakan</th>
                                            {{-- <input id="kondisiBuku" name='kondisi'> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($dataTransaksiDetail->where('status','Sudah kembali') as $data )
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$data->bukus->kode}}</td>
                                                <td>{{$data->bukus->judul}}</td>
                                                <td>{{$data->trxpeminjaman->peminjams->nama}}</td>
                                                <td>{{date('d-m-Y',strtotime($data->trxpeminjaman->tanggal))}}</td>
                                                <td>{{$data->status}}</td>
                                                <td>
                                                    <a href="{{route('admin.trx-peminjaman.detail',$data->id)}}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                    <tfoot >
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Tindakan</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- END Data Table Pemangku --}}

                </div>
            </div>


        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title align-content-lg-center" id="exampleModalLabel">Konfirmasi Pengembalian Buku</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kondisi Buku Setelah diPinjam <span class="text-danger">*</span></label>
                                <select name="kondisi" class="form-control select2bs4  @error('kondisi') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                    <option disabled selected>Pilihlah Kondisi Buku</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                                @error('kondisi')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('kondisi') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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

        function konfirmasiKembali(index){
            document.getElementById("form").action = "trx-peminjaman/buku-kembali/"+index;
            $('#exampleModal').modal('show');
        }

        function deleteTransaksi(index){
            Swal.fire({
                title: 'Peringatan',
                text : 'Apakah anda yakin akan menghapus transaksi peminjaman?',
                icon:'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Hapus`,
                denyButtonText: `Batal`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-'+index).submit();
                } else if (result.isDenied) {

                }
            })
        }



        $(function () {
            $("#tb-kembali").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Peminjaman",
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

            $("#tb-dipinjam").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "emptyTable": "Tidak Terdapat Data Transaksi Peminjaman",
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
            $('#side-peminjaman-buku').addClass('menu-open');
            $('#side-peminjaman-buku-data').addClass('active');
        });
    </script>

    <script src="{{asset('base-template\dist\js\sweetalert2.all.min.js')}}"></script>

    <script>
        @if(Session::has('status'))
            Swal.fire({
                icon:  @if(Session::has('icon')){!! '"'.Session::get('icon').'"' !!} @else 'question' @endif,
                title: @if(Session::has('title')){!! '"'.Session::get('title').'"' !!} @else 'Oppss...'@endif,
                text: @if(Session::has('message')){!! '"'.Session::get('message').'"' !!} @else 'Oppss...'@endif,
            });
        @endif
    </script>

@endpush

