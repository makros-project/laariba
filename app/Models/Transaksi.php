<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'keterangan',
        'jenis',
        'mk',
        'jumlah',
        'anggota_id',
        'tanggal_jatuh_tempo',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
    
    public function jenisTransaksi()
    {
        return $this->belongsTo(JenisTransaksi::class, 'jenis', 'nama', 'mk');


    }
}
