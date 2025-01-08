@extends('adminlte::page')

@section('title', 'Daftar Utang')

@section('content_header')
    {{-- <h1>Daftar Utang</h1> --}}
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }} 
        </div>
    @endif

    
    <div class="card" style="font-size: 11px">
        <div class="card-body">
            <a href="{{ route('utang.create') }}" class="btn btn-sm btn-primary mb-3">Tambah Utang</a>
            <table id="utang-table" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Peminjam</th>
                        <th>Jumlah Utang</th>
                        <th>Tanggal Utang</th>
                        <th>Tanggal Jatuh Tempo</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($utang as $index => $utang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $utang->anggota ? $utang->anggota->nama : 'Tidak ditemukan' }}</td>
                            <td>Rp{{ number_format($utang->jumlah, 2, ',', '.') }}</td>
                            <td>{{ $utang->tanggal_utang }}</td>
                            <td>{{ $utang->tanggal_jatuh_tempo }}</td>
                            <td>{{ $utang->keterangan }}</td>
                            <td>{{ $utang->status }}</td>
                            <td>
                                <a href="{{ route('utang.edit', $utang) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('utang.destroy', $utang) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#utang-table').DataTable({
                "pageLength": 5, // Menampilkan 5 baris per halaman
                "lengthChange": false, // Menonaktifkan perubahan jumlah baris per halaman
                "searching": true, // Mengaktifkan fitur pencarian
                "ordering": true, // Mengaktifkan pengurutan
                "info": false, // Menonaktifkan informasi jumlah total data
            });
        });
    </script>
@endsection
