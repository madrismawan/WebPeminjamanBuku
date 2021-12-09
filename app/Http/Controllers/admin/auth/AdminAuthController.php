<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        return view('pages.auth.login');
    }

    public function loginPost(Request $request){

        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => "Email tidak boleh kosong",
                'email.email' => "Masukan email yang sesuai",
                'password.required' => "Password tidak boleh kosong",
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Login',
                    'message' => 'Gagal melakukan login ke dalam sistem, validation input form fail'
                ])->withInput($request->all());
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect()->route('admin.dashboard');
                }else{
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Gagal Login',
                        'message' => 'Gagal melakukan login ke dalam sistem, email atau password yang anda masukan salah!'
                    ]);
                }
            }catch(ModelNotFoundException | PDOException | ErrorException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Login',
                    'message' => $err->getMessage()
                ]);
            }
        // END MAIN
    }


}
