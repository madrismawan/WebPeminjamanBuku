<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxPinjamanDetails extends Model
{
    use HasFactory;

    protected $table = 'trx_pinjaman_details';

    protected $fillable = [
        'trx_id',
        'buku_id',
        'status',
    ];
}
