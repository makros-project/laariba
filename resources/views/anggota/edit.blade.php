@extends('adminlte::page')

@section('title', 'Edit Anggota')

@section('content_header')
    <h1>Edit Anggota</h1>
@endsection

@section('content')
    <form action="{{ route('anggota.update', $anggota) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $anggota->nama }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $anggota->email }}" required>
        </div>
        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $anggota->no_hp }}" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ $anggota->alamat }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
