@extends('layouts.main-layout.main-layout')

@section('tittle','Tambah Pengguna')

@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <script src="{{asset('base-template\dist\js\sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('base-template\dist\css\sweetalert2.min.css')}}">

@endpush

@section('content')
    *

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header bg-white text-center">
                        {{-- <img class="rounded mx-auto d-block" src="{{ asset('base-template/dist/img/logo-01.png') }}" alt="sipandu logo" width="100" height="100"> --}}
                        <div class="div p-3">
                            <a href="" class="h3 fw-bold mb-1 text-dark">Form Penambahan Buku</a>
                            <p class="mt-1 fs-2 mb-1 h5">Sistem Peminjaman Buku</p>
                            <p class="text-center mb-1">Silahkan lengkapi data di bawah ini</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.manajemen-buku.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row px-lg-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Kode Buku <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="kode_buku" autocomplete="off" class="form-control @error('kode_buku') is-invalid @enderror" value="{{ old('kode_buku') }}" placeholder="Masukan Kode Buku">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-book"></span>
                                                </div>
                                            </div>
                                            @error('kode_buku')
                                                <div class="invalid-feedback text-start">
                                                    {{ $$errors->first('kode_buku') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Judul <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="judul_buku" autocomplete="off" class="form-control @error('judul_buku') is-invalid @enderror" value="{{ old('judul_buku') }}" placeholder="Masukan Judul Buku">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-book"></span>
                                                </div>
                                            </div>
                                            @error('judul_buku')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('judul_buku') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Halaman <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="number" name="jumlah_halaman" autocomplete="off" class="form-control @error('jumlah_halaman') is-invalid @enderror" value="{{ old('jumlah_halaman') }}" placeholder="Masukan Jumlah Halaman">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-book"></span>
                                                </div>
                                            </div>
                                            @error('jumlah_halaman')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('jumlah_halaman') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Terbit <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input name="tahun_terbit" type="year" class="form-control @error('tahun_terbit') is-invalid @enderror" name="datepicker" id="datepicker" />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-book"></span>
                                                </div>
                                            </div>
                                            @error('tahun_terbit')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('tahun_terbit') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Pengarang <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="pengarang" autocomplete="off" class="form-control @error('pengarang') is-invalid @enderror" value="{{ old('pengarang') }}" placeholder="Masukan Pengarang Buku">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-address-card"></span>
                                                </div>
                                            </div>
                                            @error('pengarang')
                                                <div class="invalid-feedback text-start">
                                                    {{ $errors->first('pengarang') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Penerbit <span class="text-danger">*</span></label>
                                        <select name="penerbit" class="form-control select2bs4  @error('penerbit') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                            <option disabled selected>Pilihlah Penerbit</option>
                                            <option value="Balai Pustaka">Balai Pustaka</option>
                                            <option value="Tiga Serangkai">Tiga Serangkai</option>
                                        </select>
                                        @error('penerbit')
                                            <div class="invalid-feedback text-start">
                                                {{$errors->first('penerbit') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kondisi <span class="text-danger">*</span></label>
                                        <select name="kondisi_buku" class="form-control select2bs4  @error('kondisi_buku') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                            <option disabled selected>Pilihlah Kondisi Buku</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                        @error('kondisi_buku')
                                            <div class="invalid-feedback text-start">
                                                {{$errors->first('kondisi_buku') }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group col-12">
                                    <label>Foto Sampul</label>
                                    <div class="input-group mb-2">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="exampleInputFile2" >
                                            <label class="custom-file-label " for="exampleInputFile2">Upload Foto Sampul</label>
                                        </div>
                                        @error('file')
                                            <div class="invalid-feedback text-start">
                                                {{ $errors->first('file') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Deskripsi Buku</label>
                                    <textarea  name="deskripsi_buku" class="form-control @error('deskripsi_buku') is-invalid @enderror" rows="3" placeholder="Masukan Deskripsi Buku"></textarea>
                                    @error('deskripsi_buku')
                                        <div class="invalid-feedback text-start">
                                            {{ $errors->first('deskripsi_buku') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end mt-1 p-lg-2">
                                <div class="col-7 col-sm-4">
                                    <button type="submit" class="btn btn-primary btn-block">Buat Buku Baru</button>
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

    <script type="text/javascript">
        $(document).ready(function(){

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
            $('#side-manajemen-buku-tambah').addClass('active');
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


