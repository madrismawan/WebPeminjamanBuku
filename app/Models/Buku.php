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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function trxpeminjams()
    {
        return $this->belongsToMany(TrxPinjamans::class,'trx_pinjaman_details','buku_id','trx_id')
            ->as('trx_pinjaman_detail')
            ->withPivot('status')
            ->withTimestamps();

    }


}
