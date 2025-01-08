@extends('adminlte::page')

@section('title', 'Daftar Anggota')

@section('content_header')
    <h1>Daftar Anggota</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<div class="card" style="font-size: 11px">
    <div class="mx-2 my-2">
    <a href="{{ route('anggota.create') }}" class="btn btn-xs btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Tambah Anggota
    </a>

    <div class="table-responsive">
        <table id="anggotaTable" class="table table-striped table-bordered table-sm" >
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $index => $a)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $a->nama }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->no_hp }}</td>
                        <td>{{ $a->alamat }}</td>
                        <td>
                            <a href="{{ route('anggota.edit', $a) }}" class="btn btn-xs btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('anggota.destroy', $a) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                            <a href="{{ route('anggota.show', $a->id) }}" class="btn btn-xs btn-info btn-sm">Detail</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection

@section('css')
    <!-- Tambahkan CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    <!-- Tambahkan JS DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#anggotaTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
