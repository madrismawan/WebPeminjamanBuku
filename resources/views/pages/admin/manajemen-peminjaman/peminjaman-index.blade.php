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
            <div class="col-md-12">
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
                    <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages p-2">
                                <table id="peminjam" class="table table-bordered table-hover ">
                                    <thead >
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                            {{-- <input id="kondisiBuku" name='kondisi'> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataTransaksiDetail as $data )
                                            {{-- {{$data->trxpeminjaman->peminjams-<}} --}}
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$data->bukus->kode}}</td>
                                                <td>{{$data->bukus->judul}}</td>
                                                <td>{{$data->trxpeminjaman->peminjams->nama}}</td>
                                                <td>{{date('d-m-Y',strtotime($data->trxpeminjaman->tanggal))}}</td>
                                                <td>{{$data->status}}</td>
                                                <td>
                                                    <a href="#" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a onclick="konfirmasiKembali({{$data->id}})" href="#" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></a>
                                                    <a class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot >
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Buku</th>
                                            <th>Judul Buku</th>
                                            <th>Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form id="form" action="" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="message-text"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Send message</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
        // function peringatanPendaftaran(index){
        //     Swal.fire({
        //         title: 'Pengembalian Buku',
        //         text: 'Cek Kondisi Pengembalian Buku?',
        //         // html : '@csrf',
        //         // <form id="{{"kembali-".$data->id}}" class="d-none" method="POST" action="{{route('admin.trx-peminjaman.buku-kembali')}}">
        //         //     @method('PUT')
        //         //     @csrf
        //         //     <input  name="asdsd" value="risaman">
        //         //     <button id="{{"btn-".$data->id}}" type="submit"></button>

        //         //     {{-- <div id="{{"kondisiBuku".$data->id}}">
        //         //         <input value="risaman">
        //         //     </div> --}}
        //         // </form>
        //         icon: 'question',
        //         input: 'select',
        //         inputOptions: {
        //             Baik : 'Baik',
        //             Sedang : 'Sedang',
        //             Rusak : 'Rusak'
        //         },
        //         inputPlaceholder: 'Kondisi Pengembalian Buku',
        //         confirmButtonColor: '#3085d6',
        //         confirmButtonText: `Submit`,
        //         denyButtonText: `Batal`,
        //         denyButtonColor: '#d33',
        //         showCancelButton: true,
        //         inputValidator: (value) => {
        //             let _token = $("input[name=_token]").val();
        //             // alert(_token);
        //             $.ajax({
        //                 url: "/admin/trx-peminjaman/buku-kembali"+index,
        //                 type : "PUT",
        //                 data : {
        //                     _token : _token,
        //                     kondisi : value,
        //                 },
        //                 success:function(response){
        //                     alert(response);
        //                 }
        //             });
        //             // document.getElementById('kondisiBuku'+index).setAttribute("value", value);
        //             // $('#kondisiBuku'+index).html('<input name="kondisi" value="kadek"></input>');
        //             // $('#kembali-'+index).submit();
        //         }
        //     })
        // }


        function konfirmasiKembali(index){
            document.getElementById("form").action = "trx-peminjaman/buku-kembali/"+index;
            $('#exampleModal').modal('show');
        }


        $(function () {
            $("#peminjam").DataTable({
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

