<?php

namespace App\Http\Controllers\admin\peminjaman_buku;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjams;
use App\Models\TrxPinjamans;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDOException;

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

        //SECURITY
            $validator = Validator::make($request->all(),[
                'peminjam' => 'required',
                'buku' => 'required',
            ],
            [
                'peminjam.required' => "Peminjaman tidak boleh kosong",
                'buku.required' => "Buku tidak boleh kosong",
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Transaksi Peminjaman',
                    'message' => 'Gagal menambahkan transaksi peminjaman ke dalam sistem, Cek kembali validation form input'
                ])->withInput($request->all());
            }
        //END SECURITY


        // MAIN LOGIC
            try{
                DB::beginTransaction();
                TrxPinjamans::create([
                    'peminjam_id' => $request->peminjam,
                    'tanggal' =>now()
                ])->bukus()->attach($request->buku,['status'=>'Masih dipinjam']);
                // Update Status Buku Menjadi Terpinjam
                $dataListbuku = $request->buku;
                foreach($dataListbuku as $buku){
                    $buku = Buku::findOrFail($buku)->update(['status'=>'Terpinjam']);
                }
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Transaksi Peminjaman',
                    'message' => 'Gagal Gagal Menambahkan Transaksi Peminjaman, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->route('admin.trx-peminjaman.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menambahkan Peminjaman',
                'message' => 'Peminjaman berhasil dilakukan, Silakan ambil buku yang telah dipinjam',
            ]);
        // END RETURN
    }

}
