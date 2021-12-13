@extends('layouts.main-layout.main-layout')
@section('tittle','Tambah Peminjaman')

@push('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/dropzone/min/dropzone.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">


@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.trx-peminjaman.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Peminjaman</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{route('admin.trx-peminjaman.store')}}">
                        @csrf
                        @method('POST')
                        <div class="callout callout-info container-fluid">
                            <h5><i class="fas fa-info"></i> Catatan:</h5>
                            Pastikan data peminjaman yang dimasukan sudah benar!
                        </div>
                        <div class="card">
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
                                            <input name="tanggal" value="{{date('d-m-Y')}}" type="text" class="form-control" id="exampleInputEmail1" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Peminjam <span class="text-danger">*</span></label>
                                            <select name="peminjam" class="form-control select2bs4  @error('peminjam') is-invalid @enderror" style="width: 100%;" aria-placeholder="Pilihlah Program Studi">
                                                <option disabled selected>Pilihlah Data Peminjam</option>
                                                @foreach ($dataPeminjam as $data)
                                                    <option value="{{$data->id}}">{{$data->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('peminjam')
                                                <div class="invalid-feedback text-start">
                                                    {{$errors->first('peminjam') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-outline">
                            <div class="card-header bg-primary">
                                <strong>
                                    Daftar Buku
                                </strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Buku yang di Pinjam</label>
                                            <select multiple name="buku[]" class="select2bs4 @error('buku') is-invalid @enderror" multiple="multiple" data-placeholder="Pilihlah List Buku"
                                                style="width: 100%;">
                                                @foreach ($dataBuku as $data)
                                                <option value="{{$data->id}}">{{$data->kode}} - {{$data->judul}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('buku')
                                        <div class="invalid-feedback text-start">
                                            {{$errors->first('buku')}}
                                        </div>
                                    @enderror
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Submit Peminjaman</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>


@endsection

@push('js')


    <!-- BS-Stepper -->
    <script src="{{asset('base-template/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset('base-template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('base-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>


    <script type="text/javascript">
        $('#mySelect2').select2('data');

        $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'dd-mm-yyyy' })
        $('[data-mask]').inputmask()
    </script>

    <script>
        $(function () {
            $('#side-peminjaman-buku').addClass('menu-open');
            $('#side-peminjaman-buku-tambah').addClass('active');

            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

    </script>


@endpush
