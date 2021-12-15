@extends('layouts.main-layout.main-layout')

@section('tittle','Data Desa')
@push('css')
    <style>
        .sampul{
            width: 210px;
            height: 290px;
            object-fit: cover;
        }
    </style>
    <script src="{{asset('base-template\dist\js\sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('base-template\dist\css\sweetalert2.min.css')}}">


@endpush


@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data List Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data List Buku</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="row">
        <div class="col-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter Pencarian Buku</h4>
                    </div>
                    <div class="card-body">
                        <!-- SidebarSearch Form -->
                        <div class="form-inline m-0 mt-3">
                            <div class="input-group" data-widget="">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append bg-white border">
                                <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

        </div>
        <div class="col-9">
            <div class="row">
                @foreach ($dataBuku as $data )
                    <div class="col-12 col-sm-3" data-category="1" data-sort="white sample">
                        <div class="card p-2 shadow cursor" role="button">
                            <img  src="{{route('get-image-sampul-buku',$data->id)}}" style="height:290px; object-fit:cover;" alt="white sample"/>
                            <div class="text-center text-dark p-1 fs-4">
                                <label class="m-0 text-dark">{{$data->kode}}</label>
                                <p class="text-center text-dark m-0 font-weight-bold">{{$data->judul}}</p>
                                <div class="row justify-content-center text-dark">
                                    Oleh :<p class="text-center text-dark m-0"> {{$data->penerbit}}</p>
                                </div>
                                <p class="text-center text-dark m-0">{{$data->tahun_terbit}}</p>
                            </div>
                            <div class="btn-group btn-group-sm" style="object-fit: ">
                                <a href="{{route('admin.manajemen-buku.detail',$data->id)}}" class="btn btn-secondary bg-white"><i class="fas fa-eye"></i></a>
                                <a href="{{route('admin.manajemen-buku.edit',$data->id)}}" class="btn btn-secondary bg-white"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteData({{$data->id}})" class="btn btn-secondary bg-white"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                        <form id="{{"delete-".$data->id}}" class="d-none" action="{{route('admin.manajemen-buku.delete',[$data->id])}}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                @endforeach

            </div>

        </div>
    </div>






@endsection

@push('js')

    <script type="text/javascript">
        function deleteData(index){
            Swal.fire({
                title: 'Peringatan',
                text : 'Apakah anda yakin akan menghapus buku tersebut?',
                icon:'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Hapus`,
                denyButtonText: `Batal`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-'+index).submit();
                    } else if (result.isDenied) {

                    }
                })
        }
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#side-manajemen-buku').addClass('menu-open');
            $('#side-manajemen-buku-data').addClass('active');
        });
    </script>

@endpush
