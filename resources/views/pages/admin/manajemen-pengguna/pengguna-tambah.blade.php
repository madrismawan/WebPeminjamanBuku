@extends('layouts.main-layout.main-layout')

@section('tittle','Tambah Pengguna')

@push('css')

@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Pengguna Peminjam Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Pengguna</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header bg-white text-center">
                        {{-- <img class="rounded mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100"> --}}
                        <div class="div p-3">
                            <a href="" class="h3 fw-bold mb-1 text-dark">Sistem Peminjaman Buku</a>
                            <p class="mt-1 fs-5 mb-1">Form Penambahan Anggota Perpus</p>
                            <p class="text-center mb-1">Silahkan lengkapi data di bawah ini</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row px-lg-4">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan Nama lengkap">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            @error('nama')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan E-Mail">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Alamat Lengkap <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan Alamat Lengkap">
                                            @error('email')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> --}}

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>E-Mail <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan E-Mail">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor HP <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="number" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan Nomor HP">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone-alt"></span>
                                                </div>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Alamat Lengkap</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end mt-1 p-lg-2">
                                <div class="col-7 col-sm-4">
                                    <button type="submit" class="btn btn-primary btn-block">Daftarkan Pengguna Baru</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-manajemen-pengguna').addClass('menu-open');
            $('#side-manajemen-pengguna-tambah').addClass('active');
        });
    </script>
@endpush


