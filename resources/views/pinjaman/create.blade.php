@extends('adminlte::page')

@section('title', 'Tambah Pinjaman')

@section('content_header')
    <h1>Tambah Pinjaman</h1>
@endsection

@section('content')
<div class="card">
    <div class="mx-2 my-2">
 
    <form action="{{ route('pinjaman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="anggota_id" class="form-label">Nama Anggota</label>
            <select name="anggota_id" id="anggota_id" class="form-select form-control" required>
                <option value="">Pilih Anggota</option>
                @foreach ($anggota as $a)
                    <option value="{{ $a->id }}">{{ $a->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Pinjaman</label>
            <input type="number" class="form-control" name="jumlah" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Pinjaman</label>
            <input type="date" class="form-control" name="tanggal" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select form-control" required>
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Lunas">Lunas</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
           
</div>
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
