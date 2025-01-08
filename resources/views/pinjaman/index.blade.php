
@extends('adminlte::page')

@section('title', 'Daftar Pinjaman')

@section('content_header')
    <h1>Daftar Pinjaman</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('pinjaman.create') }}" class="btn btn-primary mb-3">Tambah Pinjaman</a>
    <table class="table table-bordered table-sm" id="pinjamanTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Anggota</th>
                <th>Jumlah Pinjaman</th>
                <th>Tanggal Pinjaman</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pinjaman as $index => $pinjam)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pinjam->anggota->nama }}</td>
                    <td>Rp{{ number_format($pinjam->jumlah, 2, ',', '.') }}</td>
                    <td>{{ $pinjam->tanggal }}</td>
                    <td>{{ $pinjam->status }}</td>
                    <td>
                        <a href="{{ route('pinjaman.edit', $pinjam) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pinjaman.destroy', $pinjam) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#pinjamanTable').DataTable();
        });
    </script>
@endsection

