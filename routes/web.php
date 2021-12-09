<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\auth\AdminAuthController as AuthAdminAuthController;
use App\Http\Controllers\admin\dashboard\AdminDashboardController;
use App\Http\Controllers\admin\manajemen_buku\ManajemenBukuController;
use App\Http\Controllers\admin\manajemen_pengguna\ManajemenPenggunaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('auth')->group(function () {
    Route::get('login', [AuthAdminAuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthAdminAuthController::class, 'loginPost'])->name('auth.login.post');
    Route::get('logout', [AuthAdminAuthController::class, 'logout'])->name('auth.logout');
});


Route::group(['prefix'=>'admin', 'middleware'=>'auth.admin'], function(){
    Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('manajemen-buku/data-buku', [ManajemenBukuController::class, 'index'])->name('admin.manajemen-buku.data');
    Route::get('manajemen-buku/data-buku/create', [ManajemenBukuController::class, 'create'])->name('admin.manajemen-buku.create');


    Route::get('manajemen-pengguna/data-pengguna', [ManajemenPenggunaController::class, 'index'])->name('admin.manajemen-pengguna.index');
    Route::get('manajemen-pengguna/data-pengguna/create', [ManajemenPenggunaController::class, 'create'])->name('admin.manajemen-pengguna.create');


});
