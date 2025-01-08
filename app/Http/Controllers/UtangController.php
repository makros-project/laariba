<?php
namespace App\Http\Controllers;

use App\Models\Utang;
use App\Models\Anggota;
use Illuminate\Http\Request;

class UtangController extends Controller
{
    public function index()
    {
        $utang = Utang::with('anggota')->get();
        return view('utang.index', compact('utang'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        return view('utang.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah' => 'required|integer',
            'tanggal_utang' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'status' => 'required|in:belum_lunas,lunas',
        ]);

        Utang::create($request->all());
        return redirect()->route('utang.index')->with('success', 'Data utang berhasil disimpan.');
    }

    public function edit(Utang $utang)
    {
        $anggotas = Anggota::all();
        return view('utang.edit', compact('utang', 'anggotas'));
    }

    public function update(Request $request, Utang $utang)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah' => 'required|integer',
            'tanggal_utang' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'status' => 'required|in:belum_lunas,lunas',
        ]);

        $utang->update($request->all());
        return redirect()->route('utang.index')->with('success', 'Data utang berhasil diperbarui.');
    }

    public function destroy(Utang $utang)
    {
        $utang->delete();
        return redirect()->route('utang.index')->with('success', 'Data utang berhasil dihapus.');
    }
}

