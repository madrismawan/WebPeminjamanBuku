<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TrxPinjamanDetails extends Pivot
{
    use HasFactory;

    protected $table = 'trx_pinjaman_details';

    protected $fillable = [
        'id',
        'trx_id',
        'buku_id',
        'status',
    ];

    public function trxpeminjaman() {
        return $this->belongsTo(TrxPinjamans::class,'trx_id','id');
    }

    public function bukus() {
        return $this->belongsTo(Buku::class,'buku_id','id');
    }

}
