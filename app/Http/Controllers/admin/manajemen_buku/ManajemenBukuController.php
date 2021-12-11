<?php

namespace App\Http\Controllers\admin\manajemen_buku;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\Buku;
use App\Models\Peminjams;
use App\Mover;
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
                'kode_buku' => 'required',
                'judul_buku' => 'required',
                'jumlah_halaman' => 'required',
                'tahun_terbit' => 'required|numeric',
                'pengarang' => 'required',
                'penerbit' => 'required|in:Balai Pustaka,Tiga Serangkai',
                'kondisi_buku' => 'required|in:Baik,Sedang,Rusak',
                'file' => 'required',
                'deskripsi_buku' => 'required',

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
                $folder = 'app/buku/foto_sampul/';
                $filename =  ImageHelper::moveImage($request->file,$folder);

                Buku::create([
                    'kode'=> $request->kode_buku,
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
        // // END RETURN
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
                'title' => 'Gagal Mengambil Sampul Buku',
                'message' => 'Gagal Mengambil Sampul Buku, Terdapat kendala pada sistem !!',
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
                'title' => 'Gagal Mengambil Sampul Buku',
                'message' => 'Gagal Membuat Data Buku, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }

        // END LOGIC

        // RETURN
            return view('pages.admin.manajemen-buku.manajemen-buku-detail',compact('dataBuku'));
        // END RETURN

    }


}
