<?php

namespace App\Http\Controllers\admin\manajemen_pengguna;

use App\Http\Controllers\Controller;
use App\Models\Peminjams;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenPenggunaController extends Controller
{

    public function index(Request $request)
    {
        //getAll Data Peminjams
        $dataPengguna = Peminjams::all();

        return view('pages.admin.manajemen-pengguna.pengguna-index', compact('dataPengguna'));
    }

    //Start halaman buat pengguna baru
    public function create(Request $request)
    {
        return view('pages.admin.manajemen-pengguna.pengguna-tambah');
    }
    //END halaman buat pengguna baru


    // Start Fungsi Add Data Pengguna
    public function store(Request $request)
    {

        //SECURITY
            $validator = Validator::make($request->all(),[
                'nama' => 'required',
                'tanggal_lahir' => 'required',
                'tlpn' => 'required',
                'program_studi' => 'required|in:Teknologi Informasi,Teknik Mesin,Teknik Sipil,Teknik Arsitektur,Teknik Elektro',
                'nim' => 'required',
                'email' => 'required',
                'alamat' => 'required'

            ],
            [
                'nama.required' => "Email tidak boleh kosong",
                'password.required' => "Password tidak boleh kosong",
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Pengguna',
                    'message' => 'Gagal menambahkan pengguna ke dalam sistem, validation input form fail'
                ])->withInput($request->all());
            }
        //END SECURITY

        // MAIN LOGIC
        try{
            DB::beginTransaction();
            Peminjams::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->tlpn,
                'tanggal_lahir' =>$request->tanggal_lahir,
                'nim' => $request->nim,
                'program_studi' => $request->program_studi
            ]);
            DB::commit();
        }catch(ModelNotFoundException $err){
            DB::rollBack();
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Membuat Pengguna Baru',
                'message' => 'Gagal membuat Pengguna Baru, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }
        // END

        // RETURN
            return redirect()->route('admin.manajemen-pengguna.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Pengguna Baru',
                'message' => 'Pengumuman telah berhasil dibuat, sekarang pengguna dapat meminjam buku di perpustakaan`',
            ]);
        // END

    }
    //  Fungsi Add Data Pengguna


    public function detail(Request $request){
        // dd($request->id);
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:peminjams,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Peminjam Tidak Ditemukan',
                    'message' => 'Data Peminjam tidak ditemukan di dalam sistem',
                ]);
            }
        // END

        // MAIN LOGIC
            try{
                $dataPeminjam = Peminjams::findOrFail($request->id);
            }catch(ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Peminjam Tidak Ditemukan',
                    'message' => 'Data Peminjam tidak ditemukan di dalam sistem',
                ]);
            }
        // END

        // RETURN
            return view('pages.admin.manajemen-pengguna.pengguna-detail', compact('dataPeminjam'));
        // END
    }


    public function edit(Request $request){
        return view('pages.admin.manajemen-pengguna.pengguna-edit');

    }


}
