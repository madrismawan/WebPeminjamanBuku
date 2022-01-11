<?php

namespace App\Http\Controllers\admin\report;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjams;
use App\Models\TrxPinjamanDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportBuku(Request $request)
    {

        $detailTransaksi = TrxPinjamanDetails::all();
        $buku = Buku::all();
        return view('pages.admin.report.report-buku',compact(['detailTransaksi','buku']));

    }


    public function reportPeminjaman(Request $request)
    {

        $record = TrxPinjamanDetails::select(DB::raw('COUNT(*) as count'),DB::raw("MONTH (created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();


        $data =[0,0,0,0,0,0,0,0,0,0,0,0];

        foreach($record as $row)
        {
            $data[((int)$row->month-1)]= (int) $row->count;
        }

        return view('pages.admin.report.report-peminjaman',compact('data'));

    }



}
