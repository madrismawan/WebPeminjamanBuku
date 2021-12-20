<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxPinjamans extends Model
{
    use HasFactory;

    protected $table = 'trx_pinjamans';

    protected $fillable = [
        'peminjam_id',
        'tanggal',
        'status',
    ];

    public function peminjams()
    {
        return $this->belongsTo(Peminjams::class,'peminjam_id','id');
    }

    public function bukus()
    {
        return $this->belongsToMany(Buku::class,'trx_pinjaman_details','trx_id','buku_id')
            ->as('trx_pinjaman_detail')
            ->withPivot('status','id')
            ->withTimestamps();
    }




}
