@extends('adminlte::page')

@section('title', 'Detail Anggota')

@section('content_header')
    {{-- <h1>Detail Anggota</h1> --}}
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h2 class="">Detail Anggota: <strong > {{ $anggota->nama }}</strong> </h2>
            <hr>

            <div class="row">
                <div class="col-sm">
                    <table>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: {{ $anggota->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nomor HP</strong> </td>
                            <td>: {{ $anggota->no_hp }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>: {{ $anggota->alamat }}</td>
                        </tr>
                    </table>
                    
                </div>
                <div class="col-sm">
                    <table>
                        <tr>
                            <td><strong>SALDO</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>Pengeluaran</strong> </td>
                            <td>: Rp. {{ number_format($totalKeluar, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Saldo</strong></td>
                            <td>: Rp. {{ number_format($totalSaldo, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                   
                </div>
            </div>
           
            <hr>

            <!-- Tabel Riwayat Iuran -->
            <h4>Riwayat Transaksi {{ $anggota->nama }}</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="iuranTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Jumlah Iuran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota->transaksis as $index => $iuran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($iuran->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ number_format($iuran->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $iuran->keterangan }} ({{ $iuran->jenis }})</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('anggota.index') }}" class="btn btn-primary mt-3 d-print-none">Kembali ke Daftar Anggota</a>
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
            $('#iuranTable').DataTable({
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
