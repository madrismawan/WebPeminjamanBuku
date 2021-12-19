@extends('layouts.main-layout.main-layout')

@section('tittle','Detail Pengguna')

@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">

    <script src="{{asset('base-template\dist\js\sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('base-template\dist\css\sweetalert2.min.css')}}">


@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pengguna Peminjam Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Pengguna</a></li>
                    <li class="breadcrumb-item active">{{$dataPeminjam->nama}}</li>
                </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header bg-white">
                        <label class="mb-0 text-center justify-content-center">Foto KTP Pengguna</label>
                        <div class="card p-2 shadow cursor mx-lg-5 mt-4" role="button">
                            <img  src="{{route('get-image-ktp',$dataPeminjam->id)}}" style="height:280px; object-fit:cover;" alt="white sample"/>
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
                                            <input type="text" name="nama" autocomplete="off" class="form-control @error('nama') is-invalid @enderror" value="{{$dataPeminjam->nama}}" placeholder="Masukan Nama lengkap" disabled>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            @error('nama')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('nama') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor HP <span class="text-danger"> *</span></label>
                                        <div class="input-group mb-3">
                                            <input type="number" name="tlpn" autocomplete="off" class="form-control @error('tlpn') is-invalid @enderror" value="{{$dataPeminjam->telepon}}" placeholder="Masukan Nomor HP" disabled>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone-alt"></span>
                                                </div>
                                            </div>
                                            @error('tlpn')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('tlpn') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>E-Mail <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="email" name="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{$dataPeminjam->email}}" placeholder="Masukan E-Mail" disabled>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('tlpn') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="date" name="nim" autocomplete="off" class="form-control @error('nim') is-invalid @enderror" value="{{$dataPeminjam->tanggal_lahir}}" placeholder="Masukan NIM Peminjam" disabled>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-id-card"></span>
                                                </div>
                                            </div>
                                            @error('nim')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('nim') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Program Studi <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="nim" autocomplete="off" class="form-control @error('nim') is-invalid @enderror" value="{{$dataPeminjam->program_studi}}" placeholder="Masukan NIM Peminjam" disabled>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-id-card"></span>
                                                </div>
                                            </div>
                                            @error('nim')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('nim') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>NIM <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" name="nim" autocomplete="off" class="form-control @error('nim') is-invalid @enderror" value="{{$dataPeminjam->nim}}" placeholder="Masukan NIM Peminjam" disabled>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-id-card"></span>
                                                </div>
                                            </div>
                                            @error('nim')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('nim') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group col-12">
                                    <label>Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control  @error('email') is-invalid @enderror" rows="3" disabled>{{$dataPeminjam->alamat}}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback text-start">
                                        {{$errors->first('alamat') }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4 px-lg-4">
                                <div class="float-lg-left">
                                    <a href="{{route('admin.manajemen-pengguna.index')}}" type="submit" class="btn btn-secondary btn-sm">Kembali</a>
                                </div>
                                <div class="float-lg-right">
                                    <a href="{{route('admin.manajemen-pengguna.edit',[$dataPeminjam->id])}}" type="submit" class="btn btn-primary btn-sm ">Edit</a>
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
    <!-- InputMask -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#side-manajemen-pengguna').addClass('menu-open');
            $('#side-manajemen-pengguna-data').addClass('active');
        });
    </script>

    <script>

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
            format: 'MM/DD/YYYY hh:mm A'
            }
        })
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


