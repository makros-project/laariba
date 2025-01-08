<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utang extends Model
{
    use HasFactory;

    protected $fillable = ['anggota_id', 'jumlah', 'tanggal_utang', 'tanggal_jatuh_tempo', 'status'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }


}
