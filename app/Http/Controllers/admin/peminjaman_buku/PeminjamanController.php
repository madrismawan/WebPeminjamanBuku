<?php

namespace App\Http\Controllers\admin\peminjaman_buku;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjams;
use App\Models\TrxPinjamanDetails;
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
        $dataTransaksiDetail = TrxPinjamanDetails::with(['trxpeminjaman','bukus'])->get();
        return view('pages.admin.manajemen-peminjaman.peminjaman-index',compact('dataTransaksiDetail'));
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


    public function get (Request $request)
    {
        $data = TrxPinjamanDetails::with(['trxpeminjaman','bukus'])->get();


        // $data3 = TrxPinjamanDetails::whereHas(['trxpeminjaman'=>function($query){
        //     $query->where('peminjam_id', '=', '1');
        // }])->get();
        // $data4 = TrxPinjamanDetails::whereHas('bukus', function($q){
        //     $q->where('trx_id','=>','1');
        // })->get();

        // foreach ($data->bukus as $data){
        //     echo $data;
        // }
        // dd($data->peminjam_id);
        // foreach ($data as $x){
        //     // echo $x->bukus->kode;
        //     foreach ($x->bukus as $data){
        //         echo $data->judul;
        //     }

        // }
            // foreach($data as $x){
            //     foreach( $x->bukus as $data ){
            //         // dd($data->trx_pinjaman_detail->status);
            //     }
            //     echo ($data->kode);
            //     echo ($data->judul);
            //     echo ($x->peminjams->nama);
            //     echo ($x->tanggal);
            //     echo ($data->trx_pinjaman_detail->status);
            //     // dd ($data->trx_pinjaman_detail);

            //     // echo ($y->status);
            //     // echo ($y->id);

            // }
            foreach ($data as $data ){
                dd($data->id);
                // dd($data->trxpeminjaman->peminjams);
            }

            // dd($data);
            // dd($data->peminjams);
        // dd($data->bukus as $data);
    }


    public function bukuKembali (Request $request){
        echo "risaman";
    }


}
