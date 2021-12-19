<?php

use App\Models\Peminjams;
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
            $table->string('email',150)->unique();
            $table->string('telepon',100)->unique();
            $table->date('tanggal_lahir');
            $table->string('nim',10)->unique();
            $table->enum('program_studi',['Teknologi Informasi','Teknik Sipil','Teknik Elektro','Teknik Arsitek','Teknik Mesin']);
            $table->string('foto_ktp',255);
            $table->timestamps();
        });

        Peminjams::create([
            'nama' => 'alexsander',
            'alamat' => 'Jalan Nakula Sadewa',
            'telepon' => '081244123214',
            'tanggal_lahir' => now(),
            'email' => 'alex@gmail.com',
            'nim' => '1804452817',
            'program_studi' => 'Teknik Sipil',
            'foto_ktp'=> 'app/pengguna/foto_ktp/ktp.jpg'
        ]);

        Peminjams::create([
            'nama' => 'bobi',
            'alamat' => 'Jalan Nakula Sadewa guntur',
            'telepon' => '08124412214',
            'tanggal_lahir' => now(),
            'email' => 'bobi@gmail.com',
            'nim' => '1904452817',
            'program_studi' => 'Teknologi Informasi',
            'foto_ktp'=> 'app/pengguna/foto_ktp/ktp.jpg'
        ]);

        Peminjams::create([
            'nama' => 'kadeksancita',
            'alamat' => 'Jalan Nakula Sadewa 12',
            'telepon' => '081241223219',
            'tanggal_lahir' => now(),
            'email' => 'kadesancita@gmail.com',
            'nim' => '1804412817',
            'program_studi' => 'Teknik Mesin',
            'foto_ktp'=> 'app/pengguna/foto_ktp/ktp.jpg'
        ]);

    }



    public function down()
    {
        Schema::dropIfExists('peminjams');
    }
}
