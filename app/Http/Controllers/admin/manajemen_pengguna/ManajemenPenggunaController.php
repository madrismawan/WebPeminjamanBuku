<?php

namespace App\Http\Controllers\admin\manajemen_pengguna;

use App\Http\Controllers\Controller;
use App\Models\Peminjams;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ManajemenPenggunaController extends Controller
{

    public function index(Request $request)
    {
        return view('pages.admin.manajemen-pengguna.pengguna-index');
    }

    public function create(Request $request)
    {
        return view('pages.admin.manajemen-pengguna.pengguna-tambah');
    }

    public function store(Request $request)
    {
        //SECURITY
            $validator = Validator::make($request->all(),[
                'nama' => 'required',
                'tanggal_lahir' => 'required',
                'tlpn' => 'required',
                'program_studi' => 'required',
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
            Peminjams::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->tlpn,
                'tanggal_lahir' =>now(),
                'nim' => $request->nim,
                'program_studi' => $request->program_studi
            ]);
        }catch(ModelNotFoundException $err){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Membuat Pengumuman',
                'message' => 'Gagal membuat pengumuman, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }
        // END

        // RETURN
            return redirect()->route('admin.manajemen-pengguna.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Pengumuman',
                'message' => 'Pengumuman telah berhasil dibuat, sekarang user dapat melihat pengumuman anda`',
            ]);
        // END

    }
}
