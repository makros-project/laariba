@extends('adminlte::page')

@section('title', 'Edit Utang')

@section('content_header')
    <h1>Edit Utang</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('utang.update', $utang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="anggota">Nama Anggota</label>
                    <select name="anggota_id" id="anggota" class="form-control select2">
                        <option value="">Pilih Anggota</option>
                        @foreach($anggotas as $anggota)
                            <option value="{{ $anggota->id }}" {{ old('anggota_id', $utang->anggota_id) == $anggota->id ? 'selected' : '' }}>{{ $anggota->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah Utang</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah', $utang->jumlah) }}">
                </div>

                <div class="form-group">
                    <label for="tanggal_utang">Tanggal Utang</label>
                    <input type="date" name="tanggal_utang" id="tanggal_utang" class="form-control" value="{{ old('tanggal_utang', $utang->tanggal_utang) }}">
                </div>

                <div class="form-group">
                    <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                    <input type="date" name="tanggal_jatuh_tempo" id="jatuh_tempo" class="form-control" value="{{ old('tanggal_jatuh_tempo', $utang->tanggal_jatuh_tempo) }}">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Pilih Status</option>
                        <option value="belum_lunas" {{ old('status', $utang->status) == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="lunas" {{ old('status', $utang->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $utang->keterangan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('utang.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
