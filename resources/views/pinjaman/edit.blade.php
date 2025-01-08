@extends('adminlte::page')

@section('title', 'Edit Pinjaman')

@section('content_header')
    <h1>Edit Pinjaman</h1>
@endsection

@section('content')
    <form action="{{ route('pinjaman.update', $pinjaman) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="anggota_id" class="form-label">Nama Anggota</label>
            <select name="anggota_id" id="anggota_id" class="form-select select2" required>
                <option value="">Pilih Anggota</option>
                @foreach ($anggota as $a)
                    <option value="{{ $a->id }}" {{ $a->id == $pinjaman->anggota_id ? 'selected' : '' }}>
                        {{ $a->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Pinjaman</label>
            <input type="number" class="form-control" name="jumlah" value="{{ $pinjaman->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Pinjaman</label>
            <input type="date" class="form-control" name="tanggal" value="{{ $pinjaman->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="Lunas" {{ $pinjaman->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Belum Lunas" {{ $pinjaman->status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
