@extends('adminlte::page')

@section('title', 'Tambah Iuran')

@section('content_header')
    <h1>Tambah Iuran</h1>
@endsection

@section('content')
    <form action="{{ route('iuran.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="anggota_id" class="form-label">Nama Anggota</label>
                    <select name="anggota_id" id="anggota_id" class="form-select select2 form-control" required>
                        <option value="">Pilih Anggota</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Iuran</label>
                    <select name="jenis" class="form-select form-control" required>
                        <option value="" disabled selected>Pilih Jenis Iuran</option>
                        <option value="cicilan">Iuran cicilan</option>
                        <option value="wajib">Iuran Wajib</option>
                        <option value="sukarela">Iuran Sukarela</option>
                        <option value="operasonal">Operasonal</option>
                        <option value="infak">Infak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Iuran</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>


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
            $('.select2').select2({
                placeholder: "Pilih Anggota",
                allowClear: true
            });

            $('#iuran-table').DataTable({
                "pageLength": 5, // Menampilkan 5 baris per halaman
                "lengthChange": false, // Menonaktifkan perubahan jumlah baris per halaman
                "searching": true // Mengaktifkan fitur pencarian
            });
        });
    </script>
@endsection
