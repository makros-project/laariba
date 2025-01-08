<?php

namespace App\Http\Controllers;

use App\Models\JenisTransaksi;
use Illuminate\Http\Request;

class JenisTransaksiController extends Controller
{
    public function index()
    {
        $jenisTransaksi = JenisTransaksi::all();
        return view('jenis_transaksi.index', compact('jenisTransaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:jenis_transaksis|max:50',
            'mk' => 'required',
        ]);

        JenisTransaksi::create([
            'nama' => $request->input('nama'),
            'mk' => $request->input('mk'),
        ]);
        return redirect()->route('jenis-transaksi.index')->with('success', 'Jenis transaksi berhasil ditambahkan.');
    }

    public function destroy(JenisTransaksi $jenisTransaksi)
    {
        $jenisTransaksi->delete();

        return redirect()->route('jenis-transaksi.index')->with('success', 'Jenis transaksi berhasil dihapus.');
    }
}
