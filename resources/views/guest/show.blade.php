@extends('guest.layout.template')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0">
                
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ $kendaraan->nama }}</h4>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($kendaraan->foto)
                            <img src="{{ asset('images/' . $kendaraan->foto) }}"
                                 alt="{{ $kendaraan->nama }}"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 300px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/no-image.png') }}"
                                 alt="Tidak ada foto"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 300px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="35%">Nama Kendaraan</th>
                                    <td>{{ $kendaraan->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Plat Nomor</th>
                                    <td>{{ $kendaraan->plat_nomor }}</td>
                                </tr>
                                <tr>
                                    <th>Merek</th>
                                    <td>{{ $kendaraan->merek }}</td>
                                </tr>
                                <tr>
                                    <th>Warna</th>
                                    <td>{{ $kendaraan->warna }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td>{{ $kendaraan->tahun }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis BBM</th>
                                    <td>{{ $kendaraan->jenis_bbm }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if(!$peminjaman || $peminjaman->status == 'selesai')
                                            <span class="badge badge-success px-3 py-2">
                                                Tersedia
                                            </span>
                                        @elseif($peminjaman->status == 'dipinjam')
                                            <span class="badge badge-warning px-3 py-2">
                                                Dipinjam     {{ $peminjaman->nama_peminjam ?? '-'}}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
    
                        @if($peminjaman && $peminjaman->status == 'dipinjam')
                            <button type="button"
                                class="btn btn-success mr-2"
                                data-toggle="modal"
                                data-target="#addPengembalianModal">
                                <i class="fa fa-undo-o"></i> Kembalikan
                            </button>
                        @else
                            <button type="button"
                                class="btn btn-primary mr-2"
                                data-toggle="modal"
                                data-target="#addPeminjamanModal">
                                <i class="fa fa-handshake-o"></i> Pinjam
                            </button>
                        @endif

                    </div>
                </div>
                

            </div>
        </div>
        <!-- Modal Pinjam -->
        <div class="modal fade" id="addPeminjamanModal" tabindex="-1" role="dialog" aria-labelledby="addPeminjamanModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="addPeminjamanModalLabel">Pinjam Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('guest.store') }}" method="POST">
                        @csrf

                        <div class="modal-body">
                            <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

                            <div class="form-group">
                                <label>Nama Peminjam</label>
                                <input type="text" class="form-control" name="nama_peminjam" required>
                            </div>

                            <div class="form-group">
                                <label>Kendaraan</label>
                                <input type="text" class="form-control" value="{{ $kendaraan->nama }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Tujuan</label>
                                <input type="text" class="form-control" name="tujuan" required>
                            </div>

                            <div class="form-group">
                                <label>Keperluan</label>
                                <textarea class="form-control" name="keperluan" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>KM Berangkat</label>
                                <input type="number" class="form-control" name="km_berangkat" min="0" required>
                            </div>

                            <div class="form-group">
                                <label>Waktu Pinjam</label>
                                <input type="datetime-local" class="form-control" name="waktu_pinjam" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Pinjam
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                <!-- Modal Kembalikan -->
        <div class="modal fade" id="addPengembalianModal" tabindex="-1" role="dialog" aria-labelledby="addPengembalianModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="addPengembalianModalLabel">Tambah Pengembalian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="addPengembalianForm"
                            action="{{ route('guest.kembali') }}"
                            method="POST"
                            onsubmit="showLoading()">
                            @csrf

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="peminjaman_id">Peminjam </label>
                                    <input type="hidden"
                                    name="peminjaman_id"
                                    value="{{ optional($peminjaman)->id }}">

                                <input type="text"
                                    class="form-control"
                                    value="{{ $peminjaman->nama_peminjam ?? '-'}}"
                                    readonly>
                                </div>

                                <div class="form-group">
                                    <label for="km_kembali">KM Kembali</label>
                                    <input type="number"
                                        class="form-control"
                                        id="km_kembali"
                                        name="km_kembali"
                                        min="0"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control"
                                            id="catatan"
                                            name="catatan"
                                            rows="3"
                                            placeholder="Masukkan catatan pengembalian"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="waktu_kembali">Waktu Kembali</label>
                                    <input type="datetime-local"
                                        class="form-control"
                                        id="waktu_kembali"
                                        name="waktu_kembali"
                                        required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                    Batal
                                </button>

                                <button type="submit"
                                        class="btn btn-primary">
                                    Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        showConfirmButton: true
    });
</script>
@endif
<script>
function showLoading() {
    Swal.fire({
        title: 'Loading...',
        text: 'Sedang diproses',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });
}
</script>