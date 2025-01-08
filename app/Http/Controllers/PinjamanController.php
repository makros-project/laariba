<?php

// app/Http/Controllers/PinjamanController.php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        // Ambil data pinjaman beserta anggota yang terkait
        $pinjaman = Pinjaman::with('anggota')->get();
        return view('pinjaman.index', compact('pinjaman'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        return view('pinjaman.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'jumlah' => 'required|numeric',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        Pinjaman::create($request->all());
        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil ditambahkan.');
    }

    public function edit(Pinjaman $pinjaman)
    {
        $anggota = Anggota::all();
        return view('pinjaman.edit', compact('pinjaman', 'anggota'));
    }

    public function update(Request $request, Pinjaman $pinjaman)
    {
        $request->validate([
        'anggota_id' => 'required|exists:anggota,id',
            'jumlah' => 'required|numeric',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $pinjaman->update($request->all());
        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil diperbarui.');
    }

    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->delete();
        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil dihapus.');
    }
}

