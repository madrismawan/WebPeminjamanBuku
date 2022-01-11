<?php

namespace App\Http\Controllers\admin\manajemen_buku;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\Buku;
use App\Models\Peminjams;
use App\Mover;
use Hamcrest\Core\IsEqual;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Expectation;
use PhpParser\Node\Expr\FuncCall;

class ManajemenBukuController extends Controller
{

    public function index(Request $request)
    {
        $dataBuku = Buku::all();
        return view('pages.admin.manajemen-buku.manajemen-buku-index', compact('dataBuku'));
    }

    public function create(Request $request)
    {
        return view('pages.admin.manajemen-buku.manajemen-buku-create');
    }

    // START INPUT DATA BUKU TO DATABASE
    public function store(Request $request)
    {

        // SECURITY
            $validator = Validator::make($request->all(),[
                'judul_buku' => 'required',
                'jumlah_halaman' => 'required',
                'tahun_terbit' => 'required|numeric',
                'pengarang' => 'required',
                'penerbit' => 'required|in:Balai Pustaka,Tiga Serangkai',
                'kondisi_buku' => 'required|in:Baik,Sedang,Rusak',
                'file' => 'required',

            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Buku',
                    'message' => 'Gagal menambahkan Buku ke dalam sistem, validation input form fail'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                DB::beginTransaction();
                // Move Image To Storage
                $folder = 'app/buku/foto_sampul/';
                $filename =  ImageHelper::moveImage($request->file,$folder);
                // Create Kode Buku
                $lastKodebuku = Buku::orderBy('created_at', 'desc')->first();
                if($lastKodebuku == null){
                    $newKode = "KDB1";
                }else{
                    $convert = preg_replace('/[^0-9]/', '', $lastKodebuku->kode)+1;
                    $newKode = ("KDB".$convert);
                }

                Buku::create([
                    'kode'=> $newKode,
                    'judul'=> $request->judul_buku,
                    'deskripsi'=> $request->deskripsi_buku,
                    'penerbit'=> $request->penerbit,
                    'tahun_terbit'=> $request->tahun_terbit,
                    'pengarang'=> $request->pengarang,
                    'jumlah_halaman'=> $request->jumlah_halaman,
                    'kondisi'=> $request->kondisi_buku,
                    'status'=> "Bebas",
                    'foto_sampul'=> $filename
                ]);
                DB::commit();
            }catch(ModelNotFoundException $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Membuat Data Buku',
                    'message' => 'Gagal Membuat Data Buku, apabila diperlukan mohon hubungi developer sistem`',
                ]);

            }
        // END LOGIC

        //  RETURN
            return redirect()->route('admin.manajemen-buku.data')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Data Buku',
                'message' => 'Berhasil Membuat Data Buku, buku sudah dapat di pinjam`',
            ]);
        // END RETURN
    }
    // END INPUT DATA BUKU TO DATABASE


    // START GET DATA SAMPUL BUKU
    public function getSampulBuku (Request $request)
    {
        // SECURITY
        $validator = Validator::make(['id' =>$request->id],[
            'id' => 'required|exists:bukus,id',
        ]);

        if($validator->fails()){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Mengambil Sampul Buku',
                'message' => 'Gagal Mengambil Sampul Buku, Terdapat kendala pada sistem !!',
            ]);
        }
        // END SECURITY

        // MAIN LOGIC
        try{
            $path = Buku::findOrFail($request->id)->foto_sampul;
            return ImageHelper::getImage($path);
        }catch(Expectation | ModelNotFoundException $err){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Mengambil Sampul Buku',
                'message' => 'Gagal Membuat Data Buku, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }

        // END LOGIC

    }
    // END GET DATA SAMPUL BUKU


    public function detail(Request $request)
    {
        // SECURITY
        $validator = Validator::make(['id' =>$request->id],[
            'id' => 'required|exists:bukus,id',
        ]);

        if($validator->fails()){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Mengambil Data Buku',
                'message' => 'Gagal Mengambil Data Buku, Terdapat kendala pada sistem !!',
            ]);
        }
         // END SECURITY

        //  MAIN LOGIC
         try{
            $dataBuku = Buku::findOrFail($request->id);
        }catch(Expectation | ModelNotFoundException $err){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Mengambil Data Buku',
                'message' => 'Gagal Membuat Data Buku, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }
        // END LOGIC

        // RETURN
            return view('pages.admin.manajemen-buku.manajemen-buku-detail',compact('dataBuku'));
        // END RETURN

    }


    public function edit(Request $request)
    {
        // SECURITY
        $validator = Validator::make(['id' =>$request->id],[
            'id' => 'required|exists:bukus,id',
        ]);

        if($validator->fails()){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Mengambil Data Buku',
                'message' => 'Gagal Mengambil Data Buku, Terdapat kendala pada sistem !!',
            ]);
        }
         // END SECURITY

        //  MAIN LOGIC
         try{
            $dataBuku = Buku::findOrFail($request->id);
        }catch(Expectation | ModelNotFoundException $err){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Mengambil Data Buku',
                'message' => 'Gagal Membuat Data Buku, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }
        // END LOGIC

        // RETURN
            return view('pages.admin.manajemen-buku.manajemen-buku-edit',compact('dataBuku'));
        // END RETURN

    }


    public function update(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id'=> 'required',
                'kode_buku' => 'required',
                'judul_buku' => 'required',
                'jumlah_halaman' => 'required',
                'tahun_terbit' => 'required|numeric',
                'pengarang' => 'required',
                'penerbit' => 'required|in:Balai Pustaka,Tiga Serangkai',
                'kondisi_buku' => 'required|in:Baik,Sedang,Rusak',
                'deskripsi_buku' => 'required',
                'status' => 'required'

            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Buku',
                    'message' => 'Gagal menambahkan Buku ke dalam sistem, validation input form fail'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY


        // MAIN LOGIC
            try{
                if($request->file != null){
                    $dataBuku = Buku::findOrFail($request->id);
                    File::delete(storage_path($dataBuku->foto_sampul));
                    $folder = 'app/buku/foto_sampul/';
                    $filename = ImageHelper::moveImage($request->file, $folder);
                    Buku::findOrFail($request->id)->update([
                        'kode'=> $request->kode_buku,
                        'judul'=> $request->judul_buku,
                        'deskripsi'=> $request->deskripsi_buku,
                        'penerbit'=> $request->penerbit,
                        'tahun_terbit'=> $request->tahun_terbit,
                        'pengarang'=> $request->pengarang,
                        'jumlah_halaman'=> $request->jumlah_halaman,
                        'kondisi'=> $request->kondisi_buku,
                        'status'=> $request->status,
                        'foto_sampul'=> $filename
                    ]);
                } else {
                    Buku::findOrFail($request->id)->update([
                        'kode'=> $request->kode_buku,
                        'judul'=> $request->judul_buku,
                        'deskripsi'=> $request->deskripsi_buku,
                        'penerbit'=> $request->penerbit,
                        'tahun_terbit'=> $request->tahun_terbit,
                        'pengarang'=> $request->pengarang,
                        'jumlah_halaman'=> $request->jumlah_halaman,
                        'kondisi'=> $request->kondisi_buku,
                        'status'=> $request->status
                    ]);
                }
            }catch(Expectation | ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Data Buku',
                    'message' => 'Gagal Membuat Data Buku, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }

        // END LOGIC

        // RETRUN
            return redirect()->route('admin.manajemen-buku.detail',$request->id)->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Data Buku',
                'message' => 'Data Buku Berhasil diubah, perubahan data dapat dilihat pada detail buku ',
            ]);
        // END RETURN

    }

    public function delete(Request $request){
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:bukus,id',
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
                $dataBuku = Buku::findOrFail($request->id);
                File::delete(storage_path($dataBuku->foto_sampul));
                $dataBuku->delete();
            }catch(ModelNotFoundException $err){
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
                'title' => 'Berhasil Menghapus Data Buku',
                'message' => 'Data buku berhasil terhapus dari sistem'
            ]);
        // END RETURN
    }


    public function searchBuku (Request $request)
    {
        $buku = Buku::where('judul','like','%'.$request->search.'%')->get();
        return json_encode($buku);
    }


}
