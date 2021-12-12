<?php

use App\Models\Buku;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('kode',10);
            $table->string('judul',100);
            $table->string('deskripsi',255);
            $table->enum('penerbit',['Tiga Serangkai','Balai Pustaka']);
            $table->year('tahun_terbit',4);
            $table->string('pengarang',100);
            $table->integer('jumlah_halaman')->length(11);
            $table->enum('kondisi',['Baik','Sedang','Rusak']);
            $table->enum('status',['Bebas','Terpinjam']);
            $table->string('foto_sampul',255);
            $table->timestamps();

        });

        Buku::create([
            'kode'=> 'K01',
            'judul'=> 'Titanic',
            'deskripsi'=> 'Titanic adalah sebuah film epik, roman, dan bencana Amerika Serikat produksi tahun 1997 yang diskenarioi sekaligus disutradarai oleh James Cameron. Film ini bercerita tentang kisah cinta antara Jack dan Rose (diperankan oleh Leonardo DiCaprio dan Kate Winslet) yang berasal dari status sosial berbeda di atas kapal RMS Titanic yang tenggelam dalam pelayaran perdananya pada tanggal 15 April 1912.',
            'penerbit'=> 'Balai Pustaka',
            'tahun_terbit'=> 1997,
            'pengarang'=> 'James Cameron',
            'jumlah_halaman'=> 234,
            'kondisi'=> 'Baik',
            'status'=> "Bebas",
            'foto_sampul'=> 'app/buku/foto_sampul/titanic.png'
        ]);

        Buku::create([
            'kode'=> 'K02',
            'judul'=> 'Koala Kumal',
            'deskripsi'=> 'Koala Kumal merupakan film komedi romantis Indonesia yang dirilis 5 Juli 2016. Film ini dibintangi oleh Raditya Dika dan Acha Septriasa, serta menjadi film debut bagi penyanyi Sheryl Sheinafia. Diadaptasi dari novel berjudul sama karya Raditya Dika.',
            'penerbit'=> 'Tiga Serangkai',
            'tahun_terbit'=> 2012,
            'pengarang'=> 'Raditya Dika',
            'jumlah_halaman'=> 212,
            'kondisi'=> 'Baik',
            'status'=> "Bebas",
            'foto_sampul'=> 'app/buku/foto_sampul/koala-kumal.jpg'
        ]);

        Buku::create([
            'kode'=> 'K03',
            'judul'=> 'Percy Jackson ',
            'deskripsi'=> 'Perseus "Percy" Jackson adalah tokoh protagonis utama di serial novel Percy Jackson & Dewa-Dewi Olympia serta sekuelnya, The Heroes of Olympus. Karena format novel yang menggunakan sudut pandang orang pertama, Percy juga adalah narator cerita. Percy adalah putra dari dewa laut, Poseidon, dan seorang manusia fana yang bisa melihat menembus "Kabut", Sally Jackson. Karena adanya ramalan yang menyebutkan bahwa anak-anak dari "Tiga Dewa Besar" (yang termasuk Poseidon) akan memerankan peran penting untuk Olympus, Percy terlibat dalam berbagai petualangan yang berbahaya, ditemani oleh sahabat-sahabatnya.',
            'penerbit'=> 'Tiga Serangkai',
            'tahun_terbit'=> 1982,
            'pengarang'=> 'Rick Riordan',
            'jumlah_halaman'=> 384,
            'kondisi'=> 'Baik',
            'status'=> "Bebas",
            'foto_sampul'=> 'app/buku/foto_sampul/percy.jpg'
        ]);


        Buku::create([
            'kode'=> 'K04',
            'judul'=> 'Marvel Comics',
            'deskripsi'=> 'Marvel Comics Group adalah nama suatu perusahaan dari Amerika Serikat yang memproduksi buku komik dan media lain yang berkaitan. Marvel pertama kali didirikan dengan nama "Timely Publications" pada tahun 1939 dan sempat berganti nama menjadi "Atlas Comics" sebelum akhirnya menjadi Marvel Comics pada tahun 1961. Sekarang, Marvel telah menjadi salah satu penerbit buku komik terbesar bersama dengan perusahaan saingan lamanya DC Comics.',
            'penerbit'=> 'Balai Pustaka',
            'tahun_terbit'=> 1982,
            'pengarang'=> 'Stan Lee',
            'jumlah_halaman'=> 4212,
            'kondisi'=> 'Baik',
            'status'=> "Bebas",
            'foto_sampul'=> 'app/buku/foto_sampul/marvel.jpg'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
}
