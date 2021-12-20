<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPinjamans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_pinjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("peminjam_id")->references("id")->on("peminjams")->onDelete("cascade");
            $table->date('tanggal');
            $table->enum('status',['masih meminjam','peminjaman selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_pinjamans');
    }
}
