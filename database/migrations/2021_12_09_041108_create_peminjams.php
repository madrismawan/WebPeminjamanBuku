<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->string('alamat',100);
            $table->string('telepon',100);
            $table->date('tanggal_lahir');
            $table->string('nim',10);
            $table->enum('program_studi',['Teknologi Informasi','Teknik Sipil','Teknik Elektro','Teknik Arsitek','Teknik Mesin']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjams');
    }
}
