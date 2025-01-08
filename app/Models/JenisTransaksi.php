<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisTransaksi extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'jenis_transaksis';

    // Tentukan field yang bisa diisi (mass-assignment)
    protected $fillable = ['nama', 'mk'];

    /**
     * Relasi satu ke banyak dengan model Transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
