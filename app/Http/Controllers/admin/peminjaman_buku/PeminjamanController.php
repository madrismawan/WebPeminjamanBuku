<?php

namespace App\Http\Controllers\admin\peminjaman_buku;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjams;
use App\Models\TrxPinjamans;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.manajemen-peminjaman.peminjaman-index');
    }


    public function create(Request $request)
    {

        $dataPeminjam = Peminjams::all();
        $dataBuku = Buku::where('status','Bebas')->get();

        return view('pages.admin.manajemen-peminjaman.peminjaman-tambah',compact(['dataPeminjam','dataBuku']));
    }


    public function store(Request $request)
    {
        $trxPeminjaman = new TrxPinjamans();
        $trxPeminjaman->peminjam_id = $request->peminjam;
        $trxPeminjaman->tanggal = now();
        $trxPeminjaman->save();

        $trxPeminjaman->bukus()->attach($request->buku,['status'=>'Sudah kembali']);

        // foreach($request->buku as $buku){
        //     $buku = Buku::findOrFail($buku)->update(['status'=>'Terpinjam']);
        // }
        // $trxPeminjaman = TrxPinjamans::find(4);
        // foreach($trxPeminjaman->bukus as $buku){
        //     echo $buku->trx_pinjaman_detail->status;
        // }


        // dd($trxPeminjaman->bukus()->pivot()->status('Sudah Kembali'));


        // $trxPeminjaman = TrxPinjamans::find(4);
        // foreach($trxPeminjaman->bukus as $buku){
        //     echo $buku->trx_pinjaman_detail->status;
        // }
    }

}
