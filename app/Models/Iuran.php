<?php
namespace App\Models;

use App\Models\Anggota;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Iuran extends Model
{
    use HasFactory;

    protected $fillable = ['anggota_id', 'jenis', 'jumlah', 'keterangan'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function home()
    {
        $rekapIuran = DB::table('iurans')
            ->select('jenis', DB::raw('SUM(jumlah) as total'))
            ->groupBy('jenis')
            ->get();

        return view('home', compact('rekapIuran'));
    }

}


