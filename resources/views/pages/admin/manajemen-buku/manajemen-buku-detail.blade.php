@extends('layouts.main-layout.main-layout')

@section('tittle','Detail Buku')


@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detail Buku</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fuild">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Foto Sampul Buku</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="nav flex-column nav-pills card-body p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <div class="card p-2 shadow cursor col-6 col-sm-12" role="button">
                            <img src="{{route('get-image-sampul-buku',$dataBuku->id)}}" style="object-fit:cover;" alt="white sample"/>
                            {{-- <div class="text-center text-dark p-1 fs-4">
                                <label class="m-0">BK01</label>
                                <p class="text-center text-dark m-0 font-weight-bold">Percy Jakson</p>
                                <div class="row justify-content-center">
                                    Oleh :<p class="text-center text-dark m-0"> Tiga Serangkai</p>
                                </div>
                                <p class="text-center text-dark m-0">2021</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card card-primary">
                    <div class="card-header bg-white">
                        Detail Atribut Buku
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Buku</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataBuku->kode}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Judul Buku</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="{{$dataBuku->judul}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Penerbit</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="{{$dataBuku->penerbit}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tahun Terbit</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataBuku->tahun_terbit}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="'card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jumlah Halaman</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$dataBuku->jumlah_halaman}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> Pengarang</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{$dataBuku->pengarang}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Kondisi Buku</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataBuku->kondisi}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Status Peminjaman</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataBuku->status}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="exampleInputPassword1">Deskripsi Buku</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="{{$dataBuku->deskripsi}}">
                            </div>
                            <div class="form-group col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{route('admin.manajemen-buku.data')}}" type="submit" class="btn btn-secondary btn-sm">Kembali</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{route('admin.manajemen-buku.edit',$dataBuku->id)}}" type="submit" class="btn btn-primary btn-sm float-right">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




@endsection
