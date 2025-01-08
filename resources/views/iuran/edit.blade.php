@extends('adminlte::page')

@section('title', 'Edit Iuran')

@section('content_header')
    <h1>Edit Iuran</h1>
@endsection

@section('content')
    <form action="{{ route('iuran.update', $iuran) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="anggota_id" class="form-label">Nama Anggota</label>
            <select name="anggota_id" id="anggota_id" class="form-select select2 form-control" required>
                <option value="">Pilih Anggota</option>
                @foreach ($anggota as $a)
                    <option value="{{ $a->id }}" {{ $iuran->anggota_id == $a->id ? 'selected' : '' }}>
                        {{ $a->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Iuran</label>
            <input type="text" class="form-control" disabled name="jenis" id="jenis" value="{{ $iuran->jenis }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Iuran</label>
            <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{ $iuran->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan">{{ $iuran->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Anggota",
                allowClear: true
            });
        });
    </script>
@endsection
