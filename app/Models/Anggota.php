<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
    ];

    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }

    public function utangs()
    {
        return $this->hasMany(Utang::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'anggota_id');
    }
}
