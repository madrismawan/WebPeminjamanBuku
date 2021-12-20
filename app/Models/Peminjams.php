<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjams extends Model
{
    use HasFactory;

    protected $table = 'peminjams';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'tanggal_lahir',
        'nim',
        'program_studi',
        'email',
        'foto_ktp'
    ];

    public function trxpeminjams()
    {
        return $this->hasMany(TrxPinjamans::class, 'peminjam_id','id');
    }




}
