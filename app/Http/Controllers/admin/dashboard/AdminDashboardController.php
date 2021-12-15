<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjams;
use App\Models\TrxPinjamanDetails;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $jumlahBuku = Buku::all();
        $jumlahPengguna = Peminjams::count();
        $jumlahBukuTerpinjam = TrxPinjamanDetails::where('status','Masih dipinjam')->count();
        $jumlahBukuTersedia = Buku::where('status','Bebas')->count();
        $dataPeminjam = TrxPinjamanDetails::where('status','Masih dipinjam')->with(['bukus','trxpeminjaman'])->get();


        return view('pages.admin.dashboard', compact(['jumlahBuku','jumlahPengguna','jumlahBukuTerpinjam','jumlahBukuTersedia','dataPeminjam']));
    }
}
