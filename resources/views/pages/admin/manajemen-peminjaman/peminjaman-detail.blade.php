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
                                <input name="tanggal" value="{{date('d-m-Y'), strtotime($data->trxpeminjaman->tanggal)}}" type="text" class="form-control" id="exampleInputEmail1"  disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Status Peminjaman <span class="text-danger">*</span></label>
                                <input name="tanggal" value="{{$data->status}}" type="text" class="form-control" id="exampleInputEmail1"  disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
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
                                            <img  src="{{route('get-image-sampul-buku',$data->buku_id)}}" style="height:290px; object-fit:cover;" alt="white sample"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="align-items-center">
                                        <h5>{{$data->bukus->kode}} - {{$data->bukus->judul}}</h5>
                                        <p class="m-0 mb-2">{{$data->bukus->deskripsi}}</p>
                                        <p class="m-0">Penerbit : {{$data->bukus->penerbit}}</p>
                                        <p class="m-0">Pengarang : {{$data->bukus->pengarang}}</p>
                                        <p class="m-0">Tahun Terbit : {{$data->bukus->tahun_terbit}}</p>
                                        <p class="m-0">Jumlah Halaman : {{$data->bukus->jumlah_halaman}}</p>
                                        <p class="m-0">kondisi: {{$data->bukus->kondisi}}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card collapsed-card">
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
                                        <input type="text" name="nama" value="{{$data->trxpeminjaman->peminjams->nama}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="nama" value="{{$data->trxpeminjaman->peminjams->email}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="nama"  value="{{$data->trxpeminjaman->peminjams->alamat}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="nama" value="{{$data->trxpeminjaman->peminjams->telepon}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="nama"  value="{{date('d-m-Y'), strtotime($data->trxpeminjaman->peminjams->tanggal_lahir)}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="nama"  value="{{$data->trxpeminjaman->peminjams->nim}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Program Studi</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="nama"  value="{{$data->trxpeminjaman->peminjams->program_studi}}" autocomplete="off" class="form-control " value="" placeholder="Masukan Nama lengkap" disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
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


@endsection


@push('js')

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-peminjaman-buku').addClass('menu-open');
            $('#side-peminjaman-buku-data').addClass('active');
        });
    </script>



@endpush
