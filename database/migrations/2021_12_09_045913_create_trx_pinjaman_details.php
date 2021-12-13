<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPinjamanDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_pinjaman_details', function (Blueprint $table) {
            $table->id();
             $table->foreignId("trx_id")->references("id")->on("trx_pinjamans")->onDelete("cascade");
             $table->foreignId("buku_id")->references("id")->on("bukus")->onDelete("cascade");
             $table->enum('status',['Masih dipinjam','Sudah kembali']);
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
        Schema::dropIfExists('trx_pinjaman_details');
    }
}
