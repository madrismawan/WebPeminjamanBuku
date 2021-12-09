<?php

namespace App\Http\Controllers\admin\manajemen_buku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManajemenBukuController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.manajemen-buku.manajemen-buku-index');
    }

    public function create(Request $request)
    {
        return view('pages.admin.manajemen-buku.manajemen-buku-create');
    }

}
