<?php

namespace App\Http\Controllers\admin\report;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjams;
use App\Models\TrxPinjamanDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportBuku(Request $request)
    {

        $detailTransaksi = TrxPinjamanDetails::all();
        $buku = Buku::all();
        return view('pages.admin.report.report-buku',compact(['detailTransaksi','buku']));

    }

    public function reportPengguna(Request $request)
    {


    }




}
