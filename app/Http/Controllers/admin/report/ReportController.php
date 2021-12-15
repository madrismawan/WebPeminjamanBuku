<?php

namespace App\Http\Controllers\admin\report;

use App\Http\Controllers\Controller;
use App\Models\Peminjams;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportBuku(Request $request)
    {


        return view('pages.admin.report.report-buku');

    }

    public function reportPengguna(Request $request)
    {


    }




}
