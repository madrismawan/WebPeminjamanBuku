@extends('layouts.main-layout.main-layout')

@section('tittle', 'Transaksi Peminjaman Detail')

@push('css')

@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Data Transaksi Peminjam</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detatil Data Transaksi Detail</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    @foreach ($dataTransaksiDetail as $data)
        <div class="container-fluid">
            <div class="card card-outline">
                <div class="card-header">
                    <strong>
                        Transaksi Peminjaman
                    </strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Transaksi Peminjaman Buku <span class="text-danger">*</span></label>
                                <input name="tanggal" value="{{date('d-m-Y'), strtotime($data->tanggal)}}" type="text" class="form-control" id="exampleInputEmail1"  disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Jumlah Peminjaman Buku <span class="text-danger">*</span></label>
                                <input name="tanggal" value="{{count($data->bukus)}}" type="text" class="form-control" id="exampleInputEmail1"  disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Peminjam</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12 mb-0">
                            <label>Nama Lengkap</label>
                            <div class="input-group mb-3">
                                <input type="text" name="nama" value="{{$data->peminjams->nama}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" value="{{$data->peminjams->email}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama"  value="{{$data->peminjams->alamat}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" value="{{$data->peminjams->telepon}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama"  value="{{date('d-m-Y'), strtotime($data->peminjams->tanggal_lahir)}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>NIM</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama"  value="{{$data->peminjams->nim}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Program Studi</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="nama"  value="{{$data->peminjams->program_studi}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                @foreach ($data->bukus as $dataBuku)
                    <div class="col-6">
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Data Buku</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card p-2 shadow cursor" role="button">
                                                <img  src="{{route('get-image-sampul-buku',$dataBuku->id)}}" style="height:340px; object-fit:cover;" alt="white sample"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="align-items-center">
                                            <h5>{{$dataBuku->kode}} - {{$dataBuku->judul}}</h5>
                                            <p class="m-0 mb-2">{{$dataBuku->deskripsi}}</p>
                                            <p class="m-0">Penerbit : {{$dataBuku->penerbit}}</p>
                                            <p class="m-0">Pengarang : {{$dataBuku->pengarang}}</p>
                                            <p class="m-0">Tahun Terbit : {{$dataBuku->tahun_terbit}}</p>
                                            <p class="m-0">Jumlah Halaman : {{$dataBuku->jumlah_halaman}}</p>
                                            <p class="m-0">kondisi: {{$dataBuku->kondisi}}</p>
                                            <a onclick="konfirmasiKembali({{$dataBuku->trx_pinjaman_detail->id}})" class="btn btn-primary btn-sm mt-4">Kembalikan Buku</i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mb-lg-3">
                <div class="col-6">
                    <a class="btn btn-primary" href="{{route('admin.trx-peminjaman.index')}}">Kembali</a>
                </div>
                <div class="col-6">
                    {{-- <a class="btn btn-primary float-right" href="">Edit</a> --}}
                </div>
            </div>
        </div>
    @endforeach


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

@endsection


@push('js')
    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script type="text/javascript">

        function konfirmasiKembali(index){
            var route = '{{route("admin.trx-peminjaman.buku-kembali",":id")}}';
            route = route.replace(':id', index);
            document.getElementById("form").action = route;
            $('#exampleModal').modal('show');
        }

        $(document).ready(function(){
            $('#side-peminjaman-buku').addClass('menu-open');
            $('#side-peminjaman-buku-data').addClass('active');
        });
    </script>



@endpush
