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

        // $detailTransaksi = TrxPinjamanDetails::with('peminjams')->groupBy('created_at')->get();

        // dd($detailTransaksi);

        // $monthly_uploaded_product = DB::table('trx_pinjaman_details')
        //     ->select(DB::raw('count(id) as total'), DB::raw('MONTH(created_at) as month'))
        //     ->groupBy('month')
        //     ->get();
        // dd($monthly_uploaded_product);

        // $users = Peminjams::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
        // ->get();

        $record = TrxPinjamanDetails::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH (created_at) as day_name"),DB::raw("MONTH(created_at) as day"))
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
            ->groupBy('day_name','day')
            ->orderBy('day')
            ->get();

        $data = [];

        foreach($record as $row) {
            $data[ $row->day_name] =(int) $row->count;
            // $data['data'][] = (int) $row->count;
        }

        // // $data['chart_data'] = ;
        //one month / 30 days
        // $date = Carbon::now()->subDays(30)->startOfDay;

        // $test= Carbon::today()->subDay(6);
        // dd($data->12);

        $record = TrxPinjamanDetails::select(DB::raw('COUNT(*) as count'),DB::raw("MONTH (created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();

        $data =[0,0,0,0,0,0,0,0,0,0,0,0];


        foreach($record as $row)
        {
            $data[((int) $row->month-1)]= (int) $row->count;
        }

        // dd($data);
        return view('pages.admin.report.report-peminjaman',compact('data'));

    }



}
