@extends('adminlte::page')

@section('title', 'Transaksi')

@section('content_header')
    {{-- <h1>Transaksi</h1> --}}
@endsection

@section('content')
<div class="row" style="font-size: 11px">
    <div class="col-md">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Modal Tambah Transaksi --}}
        <div class="modal fade" id="tambahTransaksiModal" tabindex="-1" aria-labelledby="tambahTransaksiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahTransaksiModalLabel">Tambah Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="line-height: 5px">
                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="kode_transaksi">Kode Transaksi</label>
                                <input type="text" value="{{ date('Ymdhis') }}" name="kode_transaksi" id="kode_transaksi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="1"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Transaksi</label>
                                        <select name="jenis" id="jenis" class="form-control" required>
                                            @foreach($jenisTransaksi as $jenis)
                                                <option value="{{ $jenis->nama }}-{{ $jenis->mk }}">{{ ucfirst($jenis->nama) }}-{{ $jenis->mk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="anggota_id">Nama Anggota</label>
                                <select name="anggota_id" id="anggota_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Anggota</option>
                                    @foreach($anggota as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                                <input type="date" name="tanggal_jatuh_tempo" value="{{ date('Y-m-d') }}" id="tanggal_jatuh_tempo" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit Transaksi --}}
        <div class="modal fade" id="editTransaksiModal" tabindex="-1" aria-labelledby="editTransaksiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTransaksiModalLabel">Edit Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="line-height: 5px">
                        <form action="#" method="POST" id="editTransaksiForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_kode_transaksi">Kode Transaksi</label>
                                <input type="text" name="kode_transaksi" id="edit_kode_transaksi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_keterangan">Keterangan</label>
                                <textarea name="keterangan" id="edit_keterangan" class="form-control" rows="1"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="edit_jumlah">Jumlah</label>
                                        <input type="number" name="jumlah" id="edit_jumlah" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="edit_jenis">Jenis Transaksi</label>
                                        <select name="jenis" id="edit_jenis" class="form-control" required>
                                            @foreach($jenisTransaksi as $jenis)
                                                <option value="{{ $jenis->nama }}-{{ $jenis->mk }}">{{ ucfirst($jenis->nama) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_anggota_id">Nama Anggota</label>
                                <select name="anggota_id" id="edit_anggota_id" class="form-control" required>
                                    @foreach($anggota as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                                <input type="date" name="tanggal_jatuh_tempo" id="edit_tanggal_jatuh_tempo" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Transaksi --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Transaksi</h3>
            </div>
            <div class="card-body">
                {{-- Tombol untuk Membuka Modal Tambah Transaksi --}}
                <button type="button" class="btn btn-xs btn-primary mb-3" data-toggle="modal" data-target="#tambahTransaksiModal">
                    Tambah Transaksi
                </button>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Kode Transaksi</th>
                            <th>Jenis</th>
                            <th>Anggota</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $index => $transaksi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $transaksi->tanggal }}</td>
                                <td>{{ $transaksi->kode_transaksi }}</td>
                                <td>{{ ucfirst($transaksi->jenis) }}</td>
                                <td>{{ $transaksi->anggota->nama }}</td>
                                <td>{{ $transaksi->keterangan }}</td>
                                <td>Rp{{ number_format($transaksi->jumlah, 2, ',', '.') }}</td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-warning edit-transaksi-btn" 
                                    data-id="{{ $transaksi->id }}"
                                    data-kode-transaksi="{{ $transaksi->kode_transaksi }}"
                                    data-tanggal="{{ $transaksi->tanggal }}"
                                    data-keterangan="{{ $transaksi->keterangan }}"
                                    data-jenis="{{ $transaksi->jenis }}"
                                    data-jumlah="{{ $transaksi->jumlah }}"
                                    data-anggota-id="{{ $transaksi->anggota_id }}"
                                    data-tanggal-jatuh-tempo="{{ $transaksi->tanggal_jatuh_tempo }}">
                                        Edit
                                    </a>
                                    <a href="#" class="btn btn-xs btn-danger" 
                                        onclick="if(confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                                            document.getElementById('delete-form-{{ $transaksi->id }}').submit();
                                        }">
                                        Hapus
                                    </a>
                                    <form id="delete-form-{{ $transaksi->id }}" 
                                        action="{{ route('transaksi.destroy', $transaksi->id) }}" 
                                        method="POST" 
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Tidak ada data transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.edit-transaksi-btn').on('click', function() {
                let id = $(this).data('id');
                let kodeTransaksi = $(this).data('kode-transaksi');
                let tanggal = $(this).data('tanggal');
                let keterangan = $(this).data('keterangan');
                let jenis = $(this).data('jenis');
                let jumlah = $(this).data('jumlah');
                let anggotaId = $(this).data('anggota-id');
                let tanggalJatuhTempo = $(this).data('tanggal-jatuh-tempo');

                $('#edit_kode_transaksi').val(kodeTransaksi);
                $('#edit_tanggal').val(tanggal);
                $('#edit_keterangan').val(keterangan);
                $('#edit_jenis').val(jenis);
                $('#edit_jumlah').val(jumlah);
                $('#edit_anggota_id').val(anggotaId);
                $('#edit_tanggal_jatuh_tempo').val(tanggalJatuhTempo);

                $('#editTransaksiForm').attr('action', `/transaksi/${id}`);
                $('#editTransaksiModal').modal('show');
            });
        });
    </script>
@endsection
