<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\JenisTransaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('anggota')->get(); // Memuat data anggota
        $anggota = Anggota::all(); // Ambil semua data anggota
        $jenisTransaksi = JenisTransaksi::all();
        return view('transaksi.index', compact('transaksis', 'anggota', 'jenisTransaksi'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_transaksi' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'jenis' => 'required|string', // Tetap diperlukan untuk validasi awal
            'jumlah' => 'required|numeric',
            'anggota_id' => 'required|integer',
            'tanggal_jatuh_tempo' => 'nullable|date',
        ]);
        
        // Pisahkan nilai `jenis` menggunakan explode
        $jenisExploded = explode('-', $request->jenis);
        
        // Ambil index 0 sebagai jenis dan index 1 sebagai mk
        $validated['jenis'] = $jenisExploded[0] ?? null;
        $validated['mk'] = $jenisExploded[1] ?? null;
        
        // Simpan data ke dalam tabel transaksi
        Transaksi::create($validated);
        
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
        
    }

    public function create()
    {
        $anggota = Anggota::all(); // Ambil semua data anggota
        return view('transaksi.create', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_transaksi' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric|min:1',
            'jenis' => 'required|string',
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal_jatuh_tempo' => 'nullable|date',
        ]);
    
        // Pisahkan jenis menjadi dua bagian
        $jenisParts = explode('-', $request->jenis);
        $jenis = $jenisParts[0]; // Index ke-0 untuk jenis
        $mk = $jenisParts[1] ?? null; // Index ke-1 untuk mk (null jika tidak ada)
    
        // Ambil data transaksi
        $transaksi = Transaksi::findOrFail($id);
    
        // Perbarui data transaksi
        $transaksi->update([
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
            'jenis' => $jenis,
            'mk' => $mk, // Pastikan field ini ada di model Transaksi
            'anggota_id' => $request->anggota_id,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        ]);
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }
    

    

    public function home()
    {
            // Total saldo untuk seluruh anggota (jumlah iuran)
            $totalMasuk = DB::table('transaksis')
            ->where('mk', 'MASUK') 
            ->sum('jumlah');
            $totalKeluar = DB::table('transaksis')
            ->where('mk', 'KELUAR') 
            ->sum('jumlah');

            $transaksi = Transaksi::get()->where('jenis', 'Iuran Wajib');

            $countiuran = DB::table('transaksis')
            ->where('jenis', 'Iuran Wajib') 
            ->count('jumlah');
           
        $totalSaldo = $totalMasuk-$totalKeluar;
        
          // Total utang untuk seluruh anggota, hanya yang statusnya belum dilunasi
        $totalUtang = DB::table('transaksis')
            ->where('jenis', 'Pinjaman') // Anda dapat menyesuaikan status sesuai kebutuhan
            ->sum('jumlah');

    
        // Rekap iuran berdasarkan jenis
        $rekapIuran = DB::table('transaksis')
            ->select('jenis', DB::raw('SUM(jumlah) as total'))
            // ->where('jenis', '!=','Pinjaman') // Anda dapat menyesuaikan status sesuai kebutuhan
            ->groupBy('jenis')
            ->get();

    
        // Rekap iuran berdasarkan anggota
        $rekapIuranAnggota = DB::table('transaksis')
            ->join('anggotas', 'transaksis.anggota_id', '=', 'anggotas.id')
            ->select('anggotas.nama as nama_anggota', DB::raw('SUM(transaksis.jumlah) as total'))
            ->groupBy('transaksis.anggota_id', 'anggotas.nama')
            ->get();


        $riwayatcicilan = DB::table('transaksis')
            ->join('anggotas', 'transaksis.anggota_id', '=', 'anggotas.id')
            ->select('anggotas.nama as nama_anggota', 'transaksis.anggota_id')
            ->where('transaksis.jenis', 'Iuran Wajib')
            ->groupBy('transaksis.anggota_id', 'anggotas.nama')
            ->get();

        $riwayatcicilan1 = DB::table('transaksis')
            ->join('anggotas', 'transaksis.anggota_id', '=', 'anggotas.id')
            ->select('anggotas.nama as nama_anggota', 'transaksis.anggota_id')
            ->where('transaksis.jenis', 'Iuran Wajib')
            ->get();


        // Riwayat utang tiap anggota beserta statusnya
        $riwayatUtangAnggota = DB::table('transaksis')
            ->join('anggotas', 'transaksis.anggota_id', '=', 'anggotas.id')
            ->select('anggotas.nama as nama_anggota', 'transaksis.anggota_id', 'transaksis.jumlah', 'transaksis.tanggal', 'transaksis.tanggal_jatuh_tempo','transaksis.jenis','transaksis.keterangan')
            ->where('transaksis.jenis', 'Pinjaman') 
            ->orderBy('transaksis.tanggal', 'desc') 
            ->get();
    
        return view('home', compact('rekapIuranAnggota', 'riwayatcicilan1', 'riwayatcicilan', 'countiuran', 'transaksi','rekapIuran', 'totalSaldo', 'totalUtang', 'riwayatUtangAnggota'));
    }

    public function destroy($id)
        {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->delete();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
        }

}
