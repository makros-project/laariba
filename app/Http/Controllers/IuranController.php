<?php
namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Utang;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IuranController extends Controller
{
    public function index()
    {
        $iurans = Iuran::with('anggota')->get();
        return view('iuran.index', compact('iurans'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        return view('iuran.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        Iuran::create($request->all());

        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil ditambahkan!');
    }

    public function edit(Iuran $iuran)
    {
        $anggota = Anggota::all();
        return view('iuran.edit', compact('iuran', 'anggota'));
    }

    public function update(Request $request, Iuran $iuran)
    {
        $request->validate([
            'anggota_id' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        $iuran->update($request->all());

        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil diperbarui!');
    }

    public function destroy(Iuran $iuran)
    {
        $iuran->delete();

        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil dihapus!');
    }




   public function home()
{
    // Rekap iuran berdasarkan jenis
    $rekapIuran = DB::table('iurans')
        ->select('jenis', DB::raw('SUM(jumlah) as total'))
        ->groupBy('jenis')
        ->get();

    // Rekap iuran berdasarkan anggota
    $rekapIuranAnggota = DB::table('iurans')
        ->join('anggotas', 'iurans.anggota_id', '=', 'anggotas.id')
        ->select('anggotas.nama as nama_anggota', DB::raw('SUM(iurans.jumlah) as total'))
        ->groupBy('iurans.anggota_id', 'anggotas.nama')
        ->get();

    // Total saldo untuk seluruh anggota (jumlah iuran)
    $totalSaldo = DB::table('iurans')->sum('jumlah');

    // Total utang untuk seluruh anggota, hanya yang statusnya belum dilunasi
    $totalUtang = DB::table('utangs')
        ->where('status', 'belum_lunas') // Anda dapat menyesuaikan status sesuai kebutuhan
        ->sum('jumlah');

    // Riwayat utang tiap anggota beserta statusnya
    $riwayatUtangAnggota = DB::table('utangs')
        ->join('anggotas', 'utangs.anggota_id', '=', 'anggotas.id')
        ->select('anggotas.nama as nama_anggota', 'utangs.jumlah', 'utangs.tanggal_utang', 'utangs.tanggal_jatuh_tempo', 'utangs.status')
        ->orderBy('utangs.tanggal_utang', 'desc') // Menampilkan yang terbaru terlebih dahulu
        ->get();

    return view('home', compact('rekapIuranAnggota', 'rekapIuran', 'totalSaldo', 'totalUtang', 'riwayatUtangAnggota'));
}

}
