<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $fillable = [
        'kode',
        'judul',
        'deskripsi',
        'penerbit',
        'tahun_terbit',
        'pengarang',
        'jumlah_halaman',
        'kondisi',
        'status',
        'foto_sampul'
    ];

}
