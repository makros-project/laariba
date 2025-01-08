@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <div class="mb-"></div>
@endsection

@section('content')
 <!-- Menampilkan Total Saldo dan Total Utang -->
 <div class="row ">
    <div class="col-sm-6">
        <div class="card bg-success">
            <div class="card-header">
                <h3 class="card-title">Saldo</h3>
            </div>
            <div class="card-body">
                <p class="h5">Rp{{ number_format($totalSaldo, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card bg-danger">
            <div class="card-header">
                <h3 class="card-title">Total Piutang</h3>
            </div>
            <div class="card-body">
                <p class="h5">Rp{{ number_format($totalUtang, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

    <div class="card">
        <div class="row">
            <!-- Tabel Rekap Iuran Berdasarkan Jenis -->
            <div class="col-sm">
                <div class="card-header">
                    <h3 class="card-title">Rekap Transaksi Berdasarkan Jenis</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm" id="rekapIuranTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Iuran</th>
                                <th>Total Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekapIuran as $index => $iuran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucfirst($iuran->jenis) }}</td>
                                    <td>Rp{{ number_format($iuran->total, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data iuran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Rekap Iuran Berdasarkan Anggota -->
            <div class="col-sm">
                <div class="card-header">
                    <h3 class="card-title">Rekap Transaksi Berdasarkan Anggota</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm" id="rekapIuranAnggotaTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anggota</th>
                                <th>Saldo Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekapIuranAnggota as $index => $iurana)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $iurana->nama_anggota }}</td>
                                    <td>Rp{{ number_format($iurana->total, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data iuran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

 <!-- Tabel Riwayat Utang Tiap Anggota -->
 <div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Riwayat Iuran Wajib</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-sm" id="riwayatUtangTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 15%">Nama Anggota</th>
                    <th>Progress Iuran</th>
                    
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayatcicilan as $index => $utang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $utang->nama_anggota }}</td>
                        <td>
                            <div class="progress">
                                @php
                                    $jumlahCicilan = $riwayatcicilan1
                                        ->where('anggota_id', $utang->anggota_id)
                                        ->count();
                                @endphp


                                <div class="progress-bar bg-success" role="progressbar" 
                                     style="width: {{ $jumlahCicilan/12*100 }}%" 
                                     aria-valuenow="{{ $jumlahCicilan/12*100 }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    {{ $jumlahCicilan }} Bulan
                                </div>
                            </div>
                            
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada riwayat utang</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

         <!-- Tabel Riwayat Utang Tiap Anggota -->
         <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pinjaman</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm" id="riwayatUtangTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Anggota</th>
                            <th>Jumlah Utang</th>
                            <th>Tanggal Utang</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayatUtangAnggota as $index => $utang)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $utang->nama_anggota }}</td>
                                <td>Rp{{ number_format($utang->jumlah, 2, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($utang->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($utang->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>
                                <td>{{ $utang->keterangan }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada riwayat utang</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

       <hr><hr>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#rekapIuranTable').DataTable();
            $('#rekapIuranAnggotaTable').DataTable();
        });


        
    </script>
@endsection
