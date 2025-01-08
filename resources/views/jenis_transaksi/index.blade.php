@extends('adminlte::page').

@section('title', 'Transaksi')

@section('content')
<div class="card" >
    <div class="mx-2 my-2">
    <h4 class="mb-4">Pengaturan Jenis Transaksi</h4>

    {{-- Tampilkan Pesan Sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Tambah Jenis Transaksi --}}
    <form action="{{ route('jenis-transaksi.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="nama" class="form-control" placeholder="Nama Jenis Transaksi" required>
            <select name="mk" id="mk" class="form-control">
                <option value="MASUK">MASUK KAS</option>
                <option value="KELUAR">KELUAR KAS</option>
            </select>
            <button type="submit" class="btn btn-xs btn-primary">Tambah</button>
        </div>
        @error('nama')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </form>

    {{-- Daftar Jenis Transaksi --}}
    <table class="table table-sm table-bordered" style="font-size: 12px">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>ARAH KAS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenisTransaksi as $index => $jenis)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jenis->nama }}</td>
                    <td>{{ $jenis->mk }}</td>
                    <td>
                        <form action="{{ route('jenis-transaksi.destroy', $jenis->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
