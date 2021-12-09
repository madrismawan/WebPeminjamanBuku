@extends('layouts.main-layout.main-layout')

@section('tittle', 'Dashboard')

@section('content')

    {{-- {{Auth::user()->nama}} --}}
    {{-- @guest
    <li class="nav-item">
        <a class="nav-link" href="#login') }}">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#register-user') }}">Register</a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link" href="#signout') }}">Logout</a>

    </li>
    @endguest

    <li class="nav-item">
        <a class="nav-link" href="#signout') }}">Logout</a>

    </li> --}}

@endsection

@push('js')

@endpush


