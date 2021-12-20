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
        // $dataTransaksi = TrxPinjamans::with(['peminjams','bukus'])->get();

        $dataTransaksi = TrxPinjamans::where('status','masih meminjam')->with(['bukus'=>function($q){
            $q->wherePivot('status','Masih dipinjam');
        },'peminjams'])->get();

        // dd( $dataTransaksi);
        // dd($dataTransaksi);

        // foreach ($dataTransaksi as $data){
        //     echo $data->peminjams->nama;
        //     foreach($data->bukus as $x){
        //         echo $x->judul;
        //         echo $x->trx_pinjaman_detail->buku_id;
        //     //    dd($data);
        //     }
        // }

        // dd($dataTransaksi->bukus);
        // dd($dataTransaksiDetail->where('status','Sudah kembali'));

        return view('pages.admin.manajemen-peminjaman.peminjaman-index',compact(['dataTransaksi','dataTransaksiDetail']));
    }


    public function create(Request $request)
    {
        $dataPeminjam = Peminjams::all();
        $dataBuku = Buku::where('status','Bebas')->whereNotIn('kondisi',['Rusak'])->get();

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
                    'stauts' =>'masih meminjam',
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


    public function bukuKembali (Request $request){

        //SECURITY
            $validator = Validator::make($request->all(),[
                'kondisi' => 'required|in:Baik,Sedang,Rusak',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengembalikan Buku',
                    'message' => 'Gagal Mengembalikan Buku, Cek kembali form input yang anda!'
                ])->withInput($request->all());
            }
        //END SECURITY

         // MAIN LOGIC
            try{
                $trxpinjaman = TrxPinjamanDetails::findOrFail($request->id);
                $jumlahTrxPinjaman = TrxPinjamanDetails::where('trx_id',$trxpinjaman->trx_id)->where('status','Masih dipinjam')->count();
                if((int) $jumlahTrxPinjaman <= 1){
                    Buku::findOrFail($trxpinjaman->buku_id)->update([
                        'kondisi'=> $request->kondisi,
                        'status' => 'Bebas'
                    ]);
                    TrxPinjamans::findOrFail($trxpinjaman->trx_id)->update([
                        'status'=>'peminjaman selesai'
                    ]);
                    $trxpinjaman->update([
                        'status' => 'Sudah kembali'
                    ]);
                }else{
                    Buku::findOrFail($trxpinjaman->buku_id)->update([
                        'kondisi'=> $request->kondisi,
                        'status' => 'Bebas'
                    ]);
                    // TrxPinjamans::findOrFail($trxpinjaman->trx_id)->update([
                    //     'status'=>'peminjaman selesai'
                    // ]);
                    $trxpinjaman->update([
                        'status' => 'Sudah kembali'
                    ]);
                }
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengembalikan Buku',
                    'message' => 'Gagal Mengembalikan Buku, mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->back()->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil mengemblikan buku',
                'message' => 'Pengembalian Buku berhasil dilakukan',
            ]);
        // END RETURN
    }

    public function delete(Request $request){
         // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:trx_pinjaman_details,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Hapus Data Gagal',
                    'message' => 'Hapus data gagal, mohon hubungi developer untuk lebih lanjut!!',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                DB::beginTransaction();
                $dataTransaksi = TrxPinjamans::findOrFail($request->id);
                foreach($dataTransaksi->bukus as $data){
                    Buku::findOrFail($data->trx_pinjaman_detail->buku_id)->update([
                        'status'=>'Bebas'
                    ]);
                }
                $dataTransaksi->delete();
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'success',
                    'icon' => 'success',
                    'tittle' => 'Hapus Data Gagal!',
                    'message' => 'Hapus data gagal, mohon hubungi developer untuk lebih lanjut!!'
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->back()->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menghapus Transaksi',
                'message' => 'Data transaksi peminjaman berhasil terhapus dari sistem'
            ]);
        // // END RETURN
    }


    public function detail(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'View Detail Data Gagal',
                    'message' => 'View detail data gagal, mohon hubungi developer untuk lebih lanjut!!',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
             try{
                $dataTransaksiDetail = TrxPinjamans::where('id',$request->id)->with(['bukus'=>function($q){
                    $q->wherePivot('status','Masih dipinjam');
                },'peminjams'])->get();
                // dd($dataTransaksiDetail);
                // $dataTransaksiDetail = TrxPinjamans::where('id',$request->id)->with(['peminjams','bukus'])->get();
            }catch(ModelNotFoundException | PDOException | QueryException | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'View Detail Data Gagal',
                    'message' => 'View detail data gagal, mohon hubungi developer untuk lebih lanjut!!',
                ]);
            }
        // END LOGIC

        // RETURN
            return view('pages.admin.manajemen-peminjaman.peminjaman-detail',compact('dataTransaksiDetail'));
        // END RETURN

    }

}
