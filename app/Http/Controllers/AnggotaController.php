<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        Anggota::create($request->all());
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email,' . $anggota->id,
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $anggota->update($request->all());
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }


    public function show(Anggota $anggota)
{
   // Total saldo untuk seluruh anggota (jumlah iuran)
   $totalMasuk = $anggota->transaksis
   ->where('mk', 'MASUK') 
   ->sum('jumlah');
   $totalKeluar = $anggota->transaksis
   ->where('mk', 'KELUAR') 
   ->sum('jumlah');
  
$totalSaldo = $totalMasuk-$totalKeluar;

    return view('anggota.show', compact('anggota', 'totalKeluar' , 'totalMasuk', 'totalSaldo'));
}

    
}

