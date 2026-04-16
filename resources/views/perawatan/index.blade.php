
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Perawatan
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
                        <h4 class="card-title">Rekap Perawatan</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPerawatanModal">
                            <i class="nc-icon nc-simple-add"></i>&nbsp; Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-perawatan" class="table table-striped">
                                <thead class="text-primary">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Kendaraan</th>
                                        <!-- <th class="text-center">Pemeriksa</th> -->
                                        <th class="text-center">Jenis Perawatan</th>
                                        <th class="text-center">Waktu Perawatan</th>
                                        <!-- <th class="text-center">Biaya</th> -->
                                        <!-- <th class="text-center">Catatan</th> -->
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $index => $perawatan)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>

                                            <td class="text-center">
                                                {{ $perawatan->nama_kendaraan ?? '-' }}
                                            </td>

                                            <!-- <td class="text-center">
                                                {{ $perawatan->pemeriksa ?? '-' }}
                                            </td> -->

                                            <td class="text-center">
                                                {{ $perawatan->jenis_perawatan ?? '-' }}
                                            </td>

                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($perawatan->waktu_perawatan)->format('d-m-Y') }}<br>
                                                <small>
                                                    {{ \Carbon\Carbon::parse($perawatan->waktu_perawatan)->format('H:i:s') }}
                                                </small>
                                            </td>

                                            <!-- <td class="text-center">
                                                Rp {{ number_format($perawatan->biaya, 0, ',', '.') }}
                                            </td>

                                            <td class="text-center">
                                                {{ $perawatan->catatan ?? '-' }}
                                            </td> -->

                                            <td class="text-center">
                                                <a href="#"
                                                    class="btn btn-info btn-sm"
                                                    title="Detail"
                                                    data-toggle="modal"
                                                    data-target="#detailPerawatan{{ $perawatan->id }}">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>

                                                <a href="#"
                                                    class="btn btn-warning btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#editPerawatanModal{{ $perawatan->id }}"
                                                    title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>

                                                <form id="delete-form-{{ $perawatan->id }}"
                                                    action="{{ route('perawatan.destroy', $perawatan->id) }}"
                                                    method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $perawatan->id }})"
                                                        title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                Tidak ada data perawatan.
                                            </td>
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
    <div class="modal fade" id="addPerawatanModal" tabindex="-1" role="dialog" aria-labelledby="addPerawatanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="addPerawatanModalLabel">Tambah Data Perawatan Kendaraan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('perawatan.store') }}" method="POST" onsubmit="showLoading()">
                    @csrf

                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="nama_kendaraan">Nama Kendaraan</label>
                            <select class="form-control"
                                id="nama_kendaraan"
                                name="nama_kendaraan"
                                required>
                                <option value="">Pilih Kendaraan</option>
                                @foreach($kendaraan as $k)
                                <option value="{{$k->nama}}">{{$k->nama ?? '-'}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pemeriksa">Pemeriksa</label>
                            <input type="text"
                                class="form-control"
                                id="pemeriksa"
                                name="pemeriksa"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="jenis_perawatan">Jenis Perawatan</label>
                            <select class="form-control"
                                id="jenis_perawatan"
                                name="jenis_perawatan"
                                required>
                                <option value="">Pilih Jenis Perawatan</option>
                                <option value="Servis Berkala">Servis Berkala</option>
                                <option value="Ganti Oli">Ganti Oli</option>
                                <option value="Tune Up">Tune Up</option>
                                <option value="Perbaikan Mesin">Perbaikan Mesin</option>
                                <option value="Perbaikan Ban">Perbaikan Ban</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="waktu_perawatan">Waktu Perawatan</label>
                            <input type="datetime-local"
                                class="form-control"
                                id="waktu_perawatan"
                                name="waktu_perawatan"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="biaya">Biaya</label>
                            <input type="number"
                                class="form-control"
                                id="biaya"
                                name="biaya"
                                min="0"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control"
                                id="catatan"
                                name="catatan"
                                rows="3"
                                placeholder="Masukkan catatan perawatan"></textarea>
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
    <!-- Modal Edit Peminjaman -->
    @foreach ($data as $perawatan)
        <div class="modal fade"
            id="editPerawatanModal{{ $perawatan->id }}"
            tabindex="-1"
            role="dialog"
            aria-labelledby="editPerawatanModalLabel{{ $perawatan->id }}"
            aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"
                            id="editPerawatanModalLabel{{ $perawatan->id }}">
                            Edit Data Perawatan
                        </h5>

                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('perawatan.update', $perawatan->id) }}"
                        method="POST"
                        onsubmit="showLoading()">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_kendaraan{{ $perawatan->id }}">Nama Kendaraan</label>
                                <!-- <input type="text"
                                    class="form-control"
                                    id="nama_kendaraan{{ $perawatan->id }}"
                                    name="nama_kendaraan"
                                    value="{{ $perawatan->nama_kendaraan }}"
                                    required> -->
                                <select class="form-control" name="nama_kendaraan" id="nama_kendaraan" required>
                                    <option value="">{{ $perawatan->nama_kendaraan}}</option>
                                    @foreach($kendaraan as $k)
                                    <option value="{{$k->nama}}">{{$k->nama ?? '-'}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pemeriksa{{ $perawatan->id }}">Pemeriksa</label>
                                <input type="text"
                                    class="form-control"
                                    id="pemeriksa{{ $perawatan->id }}"
                                    name="pemeriksa"
                                    value="{{ $perawatan->pemeriksa }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="jenis_perawatan{{ $perawatan->id }}">Jenis Perawatan</label>
                                <select class="form-control"
                                    id="jenis_perawatan{{ $perawatan->id }}"
                                    name="jenis_perawatan"
                                    required>
                                    <option value="Servis Berkala" {{ $perawatan->jenis_perawatan == 'Servis Berkala' ? 'selected' : '' }}>
                                        Servis Berkala
                                    </option>
                                    <option value="Ganti Oli" {{ $perawatan->jenis_perawatan == 'Ganti Oli' ? 'selected' : '' }}>
                                        Ganti Oli
                                    </option>
                                    <option value="Tune Up" {{ $perawatan->jenis_perawatan == 'Tune Up' ? 'selected' : '' }}>
                                        Tune Up
                                    </option>
                                    <option value="Perbaikan Mesin" {{ $perawatan->jenis_perawatan == 'Perbaikan Mesin' ? 'selected' : '' }}>
                                        Perbaikan Mesin
                                    </option>
                                    <option value="Perbaikan Ban" {{ $perawatan->jenis_perawatan == 'Perbaikan Ban' ? 'selected' : '' }}>
                                        Perbaikan Ban
                                    </option>
                                    <option value="Lainnya" {{ $perawatan->jenis_perawatan == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="waktu_perawatan{{ $perawatan->id }}">Waktu Perawatan</label>
                                <input type="datetime-local"
                                    class="form-control"
                                    id="waktu_perawatan{{ $perawatan->id }}"
                                    name="waktu_perawatan"
                                    value="{{ \Carbon\Carbon::parse($perawatan->waktu_perawatan)->format('Y-m-d\TH:i') }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="biaya{{ $perawatan->id }}">Biaya</label>
                                <input type="number"
                                    class="form-control"
                                    id="biaya{{ $perawatan->id }}"
                                    name="biaya"
                                    value="{{ $perawatan->biaya }}"
                                    min="0"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="catatan{{ $perawatan->id }}">Catatan</label>
                                <textarea class="form-control"
                                    id="catatan{{ $perawatan->id }}"
                                    name="catatan"
                                    rows="3">{{ $perawatan->catatan }}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit"
                                class="btn btn-warning">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal Detail Peminjaman -->
    @foreach ($data as $perawatan)
        <div class="modal fade"
            id="detailPerawatan{{ $perawatan->id }}"
            tabindex="-1"
            role="dialog">

            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <strong>Detail Perawatan Kendaraan</strong>
                        </h5>

                        <button type="button"
                            class="close"
                            data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="mt-2">
                            <p>
                                <strong>Nama Kendaraan:</strong>
                                {{ $perawatan->nama_kendaraan }}
                            </p>

                            <p>
                                <strong>Pemeriksa:</strong>
                                {{ $perawatan->pemeriksa }}
                            </p>

                            <p>
                                <strong>Jenis Perawatan:</strong>
                                {{ $perawatan->jenis_perawatan }}
                            </p>

                            <p>
                                <strong>Waktu Perawatan:</strong>
                                {{ \Carbon\Carbon::parse($perawatan->waktu_perawatan)->translatedFormat('d F Y H:i') }}
                            </p>

                            <p>
                                <strong>Biaya:</strong>
                                Rp {{ number_format($perawatan->biaya, 0, ',', '.') }}
                            </p>

                            <p>
                                <strong>Catatan:</strong><br>
                                {{ $perawatan->catatan ?: '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
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
