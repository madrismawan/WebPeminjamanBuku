<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->string('email',50)->unique();
            $table->string('password',255);
            $table->enum('jabatan',['kepala perpustakaan','pegelola','staff administrasi','instansi']);
            $table->timestamps();
        });

        User::create([
            'nama' => 'kepala perpustakaan',
            'email' => 'kepalaperpus@gmail.com',
            'password' => Hash::make('kepalaperpus1234'),
            'jabatan' => 'kepala perpustakaan'
        ]);
        User::create([
            'nama' => 'pengelola',
            'email' => 'pengelola@gmail.com',
            'password' => Hash::make('pengelola1234'),
            'jabatan' => 'pegelola'
        ]);
        User::create([
            'nama' => 'staff administrasi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'jabatan' => 'pegelola'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
