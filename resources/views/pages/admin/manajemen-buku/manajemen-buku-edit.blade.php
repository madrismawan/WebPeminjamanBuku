@extends('layouts.main-layout.main-layout')

@section('tittle','Detail Buku')


@push('css')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Edit Data Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.manajemen-buku.data')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.manajemen-buku.detail',$dataBuku->id)}}">Detail Data</a></li>
                    <li class="breadcrumb-item active">Edit Buku</li>
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
                        <form  method="POST" enctype="multipart/form-data" action="{{route('admin.manajemen-buku.update')}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" class="d-none" name="id" value="{{$dataBuku->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kode Buku</label>
                                        <input type="text" name="kode_buku" autocomplete="off" class="form-control @error('kode_buku') is-invalid @enderror" value="{{$dataBuku->kode}}" >
                                        @error('kode_buku')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('kode_buku') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Judul Buku</label>
                                        <input type="text" name="judul_buku" autocomplete="off" class="form-control @error('judul_buku') is-invalid @enderror"  value="{{$dataBuku->judul}}">
                                        @error('judul_buku')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('judul_buku') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Penerbit</label>
                                        <select name="penerbit" class="form-control select2bs4  @error('penerbit') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                            <option disabled>Pilihlah Penerbit</option>
                                            <option value="Balai Pustaka" @if ($dataBuku->penerbit == 'Balai Pustaka') selected @endif>Balai Pustaka</option>
                                            <option value="Tiga Serangkai" @if ($dataBuku->penerbit == 'Tiga Serangkai') selected @endif>Tiga Serangkai</option>
                                        </select>
                                        @error('penerbit')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('penerbit') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tahun Terbit</label>
                                        <input name="tahun_terbit" type="year" class="form-control @error('tahun_terbit') is-invalid @enderror" name="datepicker" id="datepicker"  value="{{$dataBuku->tahun_terbit}}"/>
                                        @error('tahun_terbit')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('tahun_terbit') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="'card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Halaman</label>
                                            <input type="text" name="jumlah_halaman" autocomplete="off" class="form-control @error('jumlah_halaman') is-invalid @enderror"  value="{{$dataBuku->jumlah_halaman}}" >
                                            @error('jumlah_halaman')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('jumlah_halaman') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"> Pengarang</label>
                                            <input type="text" name="pengarang" autocomplete="off" class="form-control @error('pengarang') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" value="{{$dataBuku->pengarang}}" >
                                            @error('pengarang')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('pengarang') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kondisi Buku</label>
                                            <select name="kondisi_buku" class="form-control select2bs4  @error('kondisi_buku') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                                <option disabled>Pilihlah Kondisi Buku</option>
                                                <option value="Baik" @if ($dataBuku->kondisi_buku == 'Baik') selected @endif>Baik</option>
                                                <option value="Sedang" @if ($dataBuku->kondisi_buku == 'Sedang') selected @endif>Sedang</option>
                                                <option value="Rusak" @if ($dataBuku->kondisi_buku == 'Rusak') selected @endif>Rusak</option>
                                            </select>
                                            @error('kondisi_buku')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('kondisi_buku') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Status Peminjaman</label>
                                            <select name="status" class="form-control select2bs4  @error('status') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                                <option disabled>Pilihlah Kondisi Buku</option>
                                                <option value="Bebas" @if ($dataBuku->kondisi_buku == 'Bebas') selected @endif>Bebas</option>
                                                <option value="Terpinjam" @if ($dataBuku->kondisi_buku == 'Terpinjam') selected @endif>Terpinjam</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('kondisi_buku') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Foto Sampul</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="file" value="{{$dataBuku->foto_sampul}}" type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile"> {{$dataBuku->foto_sampul}}</label>
                                        </div>
                                    </div>
                                    @error('file')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('file') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="exampleInputPassword1">Deskripsi Buku</label>
                                    <input name="deskripsi_buku"type="text" class="form-control mb-4" id="exampleInputPassword1" placeholder="Password" value="{{$dataBuku->deskripsi}}">
                                    @error('deskripsi_buku')
                                    <div class="invalid-feedback text-start">
                                        {{ $errors->first('deskripsi_buku') }}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="http://127.0.0.1:8000/admin/manajemen-pengguna" type="submit" class="btn btn-secondary btn-sm">Kembali</a>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary btn-sm float-right">Simpan Perubahan</button>
                                        </div>
                                    </div>
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
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>

    <<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $(function () {
                bsCustomFileInput.init();
            });
            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose:true //to close picker once year is selected
            });

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-manajemen-buku').addClass('menu-open');
            $('#side-manajemen-buku-data').addClass('active');
        });
    </script>

@endpush
