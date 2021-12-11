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


    Route::prefix('manajemen-buku')->group(function(){
        Route::get('', [ManajemenBukuController::class, 'index'])->name('admin.manajemen-buku.data');
        Route::get('create', [ManajemenBukuController::class, 'create'])->name('admin.manajemen-buku.create');
        Route::post('store', [ManajemenBukuController::class, 'store'])->name('admin.manajemen-buku.store');
        Route::get('detail/{id?}', [ManajemenBukuController::class, 'detail'])->name('admin.manajemen-buku.detail');
        Route::get('show', [ManajemenBukuController::class, 'show'])->name('admin.manajemen-buku.show');

        Route::get('get-image-sampul/{id?}', [ManajemenBukuController::class, 'getSampulBuku'])->name('get-image-sampul-buku');

    });


    Route::prefix('manajemen-pengguna')->group(function(){
        Route::get('', [ManajemenPenggunaController::class, 'index'])->name('admin.manajemen-pengguna.index');
        Route::get('create', [ManajemenPenggunaController::class, 'create'])->name('admin.manajemen-pengguna.create');
        Route::post('store', [ManajemenPenggunaController::class, 'store'])->name('admin.manajemen-pengguna.store');
        Route::get('detail/{id?}', [ManajemenPenggunaController::class, 'detail'])->name('admin.manajemen-pengguna.detail');
        Route::get('edit/{id?}', [ManajemenPenggunaController::class, 'edit'])->name('admin.manajemen-pengguna.edit');
        Route::put('update', [ManajemenPenggunaController::class, 'update'])->name('admin.manajemen-pengguna.update');
        Route::delete('delete/{id?}', [ManajemenPenggunaController::class, 'delete'])->name('admin.manajemen-pengguna.delete');

    });



});

