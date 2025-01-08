<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjamans';

    protected $fillable = ['anggota_id', 'jumlah', 'tanggal_pinjam', 'tanggal_jatuh_tempo', 'status'];

    // Relasi ke anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
 