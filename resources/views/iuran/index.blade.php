@extends('adminlte::page')

@section('title', 'Daftar Iuran')

@section('content_header')
    {{-- <h1>Daftar Iuran</h1> --}}
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }} 
        </div>
    @endif

    <a href="{{ route('iuran.create') }}" class="btn btn-primary mb-3">Tambah Iuran</a>

    <div class="card" style="line-height : 10px;font-size: 11px" >
        <div class="card-body">
            <table id="iuran-table" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Anggota</th>
                        <th>Jenis Iuran</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($iurans as $index => $iuran)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $iuran->anggota ? $iuran->anggota->nama : 'Tidak ditemukan' }}</td>
                            <td>{{ ucfirst($iuran->jenis) }}</td>
                            <td>Rp{{ number_format($iuran->jumlah, 2, ',', '.') }}</td>
                            <td>{{ $iuran->keterangan }}</td>
                            <td>
                                <a href="{{ route('iuran.edit', $iuran) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('iuran.destroy', $iuran) }}" method="POST" style="display:inline;">
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
            $('#iuran-table').DataTable({
                "pageLength": 5, // Menampilkan 5 baris per halaman
                "lengthChange": false, // Menonaktifkan perubahan jumlah baris per halaman
                "searching": true, // Mengaktifkan fitur pencarian
                "ordering": true, // Mengaktifkan pengurutan
                "info": false, // Menonaktifkan informasi jumlah total data
            });
        });
    </script>
@endsection
