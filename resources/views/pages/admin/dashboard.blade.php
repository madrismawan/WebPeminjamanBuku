@extends('layouts.main-layout.main-layout')

@section('tittle', 'Dashboard')

@section('content')

    <div class=" container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$jumlahBuku}}</h3>
                <p>Jumlah Buku</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{route('admin.manajemen-buku.data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                <h3>{{$jumlahPengguna}}</h3>

                <p>Jumlah Anggota</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{route('admin.manajemen-pengguna.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                <h3>{{$jumlahBukuTerpinjam}}</h3>

                <p>Buku Terpinjam</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="{{route('admin.manajemen-buku.data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                <h3>{{$jumlahBukuTersedia}}</h3>

                <p>Buku Tersedia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-archive"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
        </div>
    </div>

@endsection

@push('js')

<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    @if(Session::has('login'))
        Toast.fire({
            icon:  @if(Session::has('iconLog')){!! '"'.Session::get('iconLog').'"' !!} @else 'question' @endif,
            title: @if(Session::has('titleLog')){!! '"'.Session::get('titleLog').'"' !!} @else 'Oppss...'@endif,
        });
    @endif

</script>



@endpush


