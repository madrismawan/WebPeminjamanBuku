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
            $table->integer("semester")->length(11);
            $table->foreignId("peminjam_id")->references("id")->on("peminjams")->onDelete("cascade");
            $table->date('tanggal');
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
