
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Peminjaman
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">


</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">


      @include('sidebar')

    </div>
    <div class="main-panel">
      <!-- Navbar -->
      @include('navbar')
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Rekap Peminjaman</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPeminjamanModal">
                            <i class="nc-icon nc-simple-add"></i>&nbsp; Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-perawatan" class="table table-striped">
                                <thead class="text-primary">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Peminjam</th>
                                    <th class="text-center">Kendaraan</th>
                                    <th class="text-center">Tujuan</th>
                                    <!-- <th class="text-center">KM Berangkat</th> -->
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse($data as $index => $peminjaman)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>

                                            <td class="text-center">
                                                {{ $peminjaman->nama_peminjam ?? '-' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $peminjaman->kendaraan->nama ?? '-' }}
                                            </td>

                                            <td class="text-center">
                                                {{ $peminjaman->tujuan }}
                                            </td>

                                            <!-- <td class="text-center">
                                                {{ $peminjaman->km_saat_ini }} KM
                                            </td> -->

                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($peminjaman->waktu_pinjam)->format('d-m-Y') }}<br>
                                                <small>{{ \Carbon\Carbon::parse($peminjaman->waktu_pinjam)->format('H:i:s') }}</small>
                                            </td>

                                            <td class="text-center">
                                                @if($peminjaman->status == 'dipinjam')
                                                    <span class="badge badge-danger text-white">Dipinjam</span>
                                                @elseif($peminjaman->status == 'kembali')
                                                    <span class="badge badge-success text-white">Kembali</span>
                                                @else
                                                    <span class="badge badge-secondary text-white">
                                                        {{ $peminjaman->status }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                    <a href="#"
                                                    class="btn btn-info btn-sm"
                                                    title="Detail"
                                                    data-toggle="modal"
                                                    data-target="#detailPeminjaman{{ $peminjaman->id }}">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>

                                                    <a href="#"
                                                    class="btn btn-warning btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#editPeminjamanModal{{ $peminjaman->id }}"
                                                    title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $peminjaman->id }}" action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $peminjaman->id }})" title="Delete">
                                                            <i class="fas fa-trash-alt"></i> <!-- Ikon trash-alt -->
                                                        </button>
                                                    </form>
                                                </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data peminjaman.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Peminjaman -->
    <div class="modal fade" id="addPeminjamanModal" tabindex="-1" role="dialog" aria-labelledby="addPeminjamanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="addPeminjamanModalLabel">Tambah Peminjaman Kendaraan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('peminjaman.store') }}" method="POST" onsubmit="showLoading()">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_peminjam">Nama Peminjam</label>
                            <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" required>
                        </div>

                        <div class="form-group">
                            <label for="kendaraan_id">Kendaraan</label>
                            <select class="form-control" id="kendaraan_id" name="kendaraan_id" required>
                                <option value="">Pilih Kendaraan</option>
                                @foreach ($kendaraan as $item)
                                <option value="{{ $item->id }}"
                                    {{ $peminjaman->kendaraan_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }} - {{ $item->plat_nomor }}
                                </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
                        </div>

                        <div class="form-group">
                            <label for="keperluan">Keperluan</label>
                            <textarea class="form-control" id="keperluan" name="keperluan" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="km_berangkat">KM Berangkat</label>
                            <input type="number" class="form-control" id="km_berangkat" name="km_berangkat" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="waktu_pinjam">Waktu Pinjam</label>
                            <input type="datetime-local" class="form-control" id="waktu_pinjam" name="waktu_pinjam" required>
                        </div>

                        <div class="form-group">
                            <label for="kondisi_kendaraan">Kondisi Kendaraan</label>
                            <textarea class="form-control" id="kondisi_kendaraan" name="kondisi_kendaraan" rows="2" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="dipinjam">Dipinjam</option>
                                <option value="selesai">Selesai</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit Peminjaman -->
    @foreach ($data as $peminjaman)
    <div class="modal fade" id="editPeminjamanModal{{ $peminjaman->id }}" tabindex="-1" role="dialog" aria-labelledby="editPeminjamanModalLabel{{ $peminjaman->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="editPeminjamanModalLabel{{ $peminjaman->id }}">
                        Edit Peminjaman
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" onsubmit="showLoading()">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_peminjam{{ $peminjaman->id }}">Nama Peminjam</label>
                            <input type="text"
                                class="form-control"
                                id="nama_peminjam{{ $peminjaman->id }}"
                                name="nama_peminjam"
                                value="{{ $peminjaman->nama_peminjam }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="kendaraan_id{{ $peminjaman->id }}">Kendaraan</label>
                            <select class="form-control"
                                id="kendaraan_id{{ $peminjaman->id }}"
                                name="kendaraan_id"
                                required>
                            <option value="">Pilih Kendaraan</option>

                            @foreach ($kendaraan as $item)
                                <option value="{{ $item->id }}"
                                    {{ $peminjaman->kendaraan_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }} - {{ $item->plat_nomor }}
                                </option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group">
                            <label for="tujuan{{ $peminjaman->id }}">Tujuan</label>
                            <input type="text"
                                class="form-control"
                                id="tujuan{{ $peminjaman->id }}"
                                name="tujuan"
                                value="{{ $peminjaman->tujuan }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="keperluan{{ $peminjaman->id }}">Keperluan</label>
                            <textarea class="form-control"
                                    id="keperluan{{ $peminjaman->id }}"
                                    name="keperluan"
                                    rows="3"
                                    required>{{ $peminjaman->keperluan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="km_berangkat{{ $peminjaman->id }}">KM Berangkat</label>
                            <input type="number"
                                class="form-control"
                                id="km_berangkat{{ $peminjaman->id }}"
                                name="km_berangkat"
                                value="{{ $peminjaman->km_berangkat }}"
                                min="0"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="waktu_pinjam{{ $peminjaman->id }}">Waktu Pinjam</label>
                            <input type="datetime-local"
                                class="form-control"
                                id="waktu_pinjam{{ $peminjaman->id }}"
                                name="waktu_pinjam"
                                value="{{ \Carbon\Carbon::parse($peminjaman->waktu_pinjam)->format('Y-m-d\TH:i') }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="kondisi_kendaraan{{ $peminjaman->id }}">Kondisi Kendaraan</label>
                            <textarea class="form-control"
                                    id="kondisi_kendaraan{{ $peminjaman->id }}"
                                    name="kondisi_kendaraan"
                                    rows="2"
                                    required>{{ $peminjaman->kondisi_kendaraan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status{{ $peminjaman->id }}">Status</label>
                            <select class="form-control"
                                    id="status{{ $peminjaman->id }}"
                                    name="status"
                                    required>
                                <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>
                                    Dipinjam
                                </option>
                                <option value="selesai" {{ $peminjaman->status == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="dibatalkan" {{ $peminjaman->status == 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Modal Detail Peminjaman -->
@foreach ($data as $peminjaman)
    <div class="modal fade" id="detailPeminjaman{{ $peminjaman->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><strong>Detail Peminjaman</strong></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="mt-2">
                        <p><strong>Nama Peminjam:</strong> {{ $peminjaman->nama_peminjam }}</p>

                        <p><strong>Kendaraan:</strong>
                            @if($peminjaman->kendaraan)
                                {{ $peminjaman->kendaraan->nama }} - {{ $peminjaman->kendaraan->plat_nomor }}
                            @else
                                -
                            @endif
                        </p>

                        <p><strong>Tujuan:</strong> {{ $peminjaman->tujuan }}</p>

                        <p><strong>Keperluan:</strong><br>
                            {{ $peminjaman->keperluan }}
                        </p>

                        <p><strong>KM Berangkat:</strong> {{ $peminjaman->km_berangkat }} KM</p>

                        <p><strong>Waktu Pinjam:</strong>
                            {{ \Carbon\Carbon::parse($peminjaman->waktu_pinjam)->translatedFormat('d F Y H:i') }}
                        </p>

                        <!-- <p><strong>Kondisi Kendaraan:</strong><br>
                            {{ $peminjaman->kondisi_kendaraan }}
                        </p> -->

                        <p><strong>Status:</strong>
                            @if($peminjaman->status == 'dipinjam')
                                <span class="badge badge-warning">Dipinjam</span>
                            @elseif($peminjaman->status == 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @elseif($peminjaman->status == 'dibatalkan')
                                <span class="badge badge-danger">Dibatalkan</span>
                            @else
                                <span class="badge badge-secondary">{{ $peminjaman->status }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>
@endforeach

  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    // Kirim form setelah menampilkan loading
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    <script>
        function showLoading() {
            Swal.fire({
                title: 'Menambahkan...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        }
    </script>

    <script>
        function showLoading() {
            Swal.fire({
                title: 'Mengupdate...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        }
    </script>


    <!-- <script>
    $(document).on('click', '[data-toggle="modal"][data-target="#detailKendaraanModal"]', function () {
        $('#kendaraanNama').text($(this).data('nama'));
        $('#kendaraanPlatNomor').text($(this).data('plat_nomor'));
        $('#kendaraanMerek').text($(this).data('merek'));
        $('#kendaraanWarna').text($(this).data('warna'));
        $('#kendaraanTahun').text($(this).data('tahun'));
        $('#kendaraanJenisBbm').text($(this).data('bbm'));
        $('#kendaraanStatus').text($(this).data('status'));
        $('#kendaraanFoto').attr('src', $(this).data('foto'));
    }); -->
</script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    new DataTable('#table-perawatan', {
        pageLength: 10,
        ordering: true,
        searching: true,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Data tidak ditemukan",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "Next",
                previous: "Prev"
            }
        }
    });
});
</script>

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
</body>

</html>
