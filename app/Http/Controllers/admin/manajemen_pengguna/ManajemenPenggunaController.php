<?php

namespace App\Http\Controllers\admin\manajemen_pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManajemenPenggunaController extends Controller
{

    public function index(Request $request)
    {
        return view('pages.admin.manajemen-pengguna.pengguna-index');
    }

    public function create(Request $request)
    {
        return view('pages.admin.manajemen-pengguna.pengguna-tambah');
    }
}
