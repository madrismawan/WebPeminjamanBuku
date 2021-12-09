<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->string('email',50)->unique();
            $table->string('password',255);
            $table->enum('jabatan',['kepala perpustakaan','pegelola','staff administrasi','instansi']);
            $table->timestamps();
        });

        Admin::create([
            'nama' => 'Admin Made',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'),
            'jabatan' => 'staff administrasi'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
