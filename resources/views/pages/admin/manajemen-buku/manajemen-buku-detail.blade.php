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
                        <h3 class="card-title">Foto Sampul Buku </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="nav flex-column nav-pills card-body p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <div class="card p-2 shadow cursor col-6 col-sm-12" role="button">
                            <img src="{{asset('base-template/dist/img/sampul/percy.jpg')}}" style="object-fit:cover;" alt="white sample"/>
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
                                    <label for="exampleInputEmail1">Nama Walaka</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="I Wayan Sutama" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" disabled value="Denpasar, 31 Desember 1950">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pendidikan</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled value="SMA">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Pekerjaan Walaka</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="Petani">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="'card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Sulinggih</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="Ida Begawan Agre Segening" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nama Istri</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" value="Ida Pedanda Istri Stiti Yogi" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Pekerjaan Walaka</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="Petani">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Pekerjaan Walaka</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="Petani">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="exampleInputPassword1">Pekerjaan Walaka</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password"disabled value="Petani">
                            </div>
                            <div class="form-group col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="http://127.0.0.1:8000/admin/manajemen-pengguna" type="submit" class="btn btn-secondary btn-sm">Kembali</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="http://127.0.0.1:8000/admin/manajemen-pengguna/edit/1" type="submit" class="btn btn-primary btn-sm float-right">Edit</a>
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
