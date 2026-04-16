<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Kendaraan
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
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





    <style>
        table td, table th {
            padding: 10px 15px; /* Tambahkan padding sesuai kebutuhan */
        }
        .btn:hover {
            transform: scale(1.01);
            transition: transform 0.2s;
        }
    </style>
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
                                <h4 class="card-title">Data Kendaraan</h4>
                                <button type="button" class="btn btn-primary mr-4" data-toggle="modal" data-target="#addKendaraanModal">
                                    <i class="nc-icon nc-simple-add"></i>
                                    &nbsp; Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table-perawatan" class="table table-striped">
                                        <thead class=" text-primary">
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Plat Nomor</th>
                                            <th class="text-center">Merek</th>
                                            <!-- <th class="text-center">Warna</th> -->
                                            <!-- <th class="text-center">Tahun</th> -->
                                            <th class="text-center">Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $index => $kendaraan)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td class="text-center">{{ $kendaraan->nama }}</td>
                                                <td class="text-center">{{ $kendaraan->plat_nomor }}</td>
                                                <td class="text-center">{{ $kendaraan->merek }}</td>
                                                <td class="text-center">
                                                    <a href="#"
                                                    class="btn btn-info btn-sm"
                                                    title="Detail"
                                                    data-toggle="modal"
                                                    data-target="#detailKendaraan{{ $kendaraan->id }}">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>

                                                    <a href="#"
                                                    class="btn btn-warning btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#editKendaraanModal{{ $kendaraan->id }}"
                                                    title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $kendaraan->id }}" action="{{ route('kendaraan.destroy', $kendaraan->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $kendaraan->id }})" title="Delete">
                                                            <i class="fas fa-trash-alt"></i> <!-- Ikon trash-alt -->
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Kendaraan -->
            <div class="modal fade" id="addKendaraanModal" tabindex="-1" role="dialog" aria-labelledby="addKendaraanModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="addKendaraanModalLabel">Tambah Kendaraan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="addKendaraanForm" action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Kendaraan</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="form-group">
                                    <label for="plat_nomor">Plat Nomor</label>
                                    <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" required>
                                </div>

                                <div class="form-group">
                                    <label for="merek">Merek</label>
                                    <input type="text" class="form-control" id="merek" name="merek" required>
                                </div>

                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input type="text" class="form-control" id="warna" name="warna" required>
                                </div>

                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" class="form-control" id="tahun" name="tahun" min="1900" max="2100" required>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_bbm">Jenis BBM</label>
                                    <select class="form-control" id="jenis_bbm" name="jenis_bbm" required>
                                        <option value="">Pilih Jenis BBM</option>
                                        <option value="Bensin">Bensin</option>
                                        <option value="Solar">Solar</option>
                                        <option value="Pertalite">Pertalite</option>
                                        <option value="Pertamax">Pertamax</option>
                                        <option value="Listrik">Listrik</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ketersediaan">Ketersediaan</label>
                                    <select class="form-control" id="ketersediaan" name="ketersediaan" required>
                                        <option value="">Pilih Ketersediaan</option>
                                        <option value="tersedia">Tersedia</option>
                                        <option value="tidak tersedia">Tidak Tersedia</option>
                                        <!-- <option value="perawatan">Perawatan</option> -->
                                    </select>
                                </div>

                                <div class="form-group-file">
                                    <label for="foto">Foto Kendaraan</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*">
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
            <!-- Modal Edit Barang -->
            @foreach ($data as $kendaraan)
            <div class="modal fade" id="editKendaraanModal{{ $kendaraan->id }}" tabindex="-1" role="dialog" aria-labelledby="editKendaraanModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="editKendaraanModalLabel">Edit Kendaraan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                            @csrf
                            @method('PUT')

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Kendaraan</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $kendaraan->nama }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="plat_nomor">Plat Nomor</label>
                                    <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="{{ $kendaraan->plat_nomor }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="merek">Merek</label>
                                    <input type="text" class="form-control" id="merek" name="merek" value="{{ $kendaraan->merek }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input type="text" class="form-control" id="warna" name="warna" value="{{ $kendaraan->warna }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $kendaraan->tahun }}" min="1900" max="2100" required>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_bbm">Jenis BBM</label>
                                    <select class="form-control" id="jenis_bbm" name="jenis_bbm" required>
                                        <option value="Bensin" {{ $kendaraan->jenis_bbm == 'Bensin' ? 'selected' : '' }}>Bensin</option>
                                        <option value="Solar" {{ $kendaraan->jenis_bbm == 'Solar' ? 'selected' : '' }}>Solar</option>
                                        <option value="Pertalite" {{ $kendaraan->jenis_bbm == 'Pertalite' ? 'selected' : '' }}>Pertalite</option>
                                        <option value="Pertamax" {{ $kendaraan->jenis_bbm == 'Pertamax' ? 'selected' : '' }}>Pertamax</option>
                                        <option value="Listrik" {{ $kendaraan->jenis_bbm == 'Listrik' ? 'selected' : '' }}>Listrik</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ketersediaan">Ketersediaan</label>
                                    <select class="form-control" id="ketersediaan" name="ketersediaan" required>
                                        <option value="tersedia" {{ $kendaraan->ketersediaan == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="dipinjam" {{ $kendaraan->ketersediaan == 'tidak tersedia' ? 'selected' : '' }}>Tidak tersedia</option>
                                        <!-- <option value="perawatan" {{ $kendaraan->ketersediaan == 'perawatan' ? 'selected' : '' }}>Perawatan</option> -->
                                    </select>
                                </div>

                                <div class="form-group-file">
                                    <label for="foto">Foto Kendaraan</label><br>

                                    @if ($kendaraan->foto)
                                        <img src="{{ asset('images/' . $kendaraan->foto) }}" alt="{{ $kendaraan->nama }}" style="width: 100px; height: auto;"><br>
                                    @endif

                                    <input type="file" class="form-control-file mt-2" id="foto" name="foto" accept="image/*">
                                    <small>*Unggah jika ingin mengganti foto</small>
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
            <!-- Modal Detail Barang -->
                    @foreach ($data as $kendaraan)
                        <div class="modal fade" id="detailKendaraan{{ $kendaraan->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title"><strong>Detail Kendaraan</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="text-center">
                                            @if($kendaraan->foto)
                                                <img src="{{ asset('images/' . $kendaraan->foto) }}"
                                                    alt="Foto Kendaraan"
                                                    class="img-fluid"
                                                    style="max-height: 200px;">
                                            @else
                                                <p>Tidak ada foto</p>
                                            @endif
                                        </div>

                                        <div class="mt-3">
                                            <p><strong>Nama Kendaraan:</strong> {{ $kendaraan->nama }}</p>
                                            <p><strong>Plat Nomor:</strong> {{ $kendaraan->plat_nomor }}</p>
                                            <p><strong>Merek:</strong> {{ $kendaraan->merek }}</p>
                                            <p><strong>Warna:</strong> {{ $kendaraan->warna }}</p>
                                            <p><strong>Tahun:</strong> {{ $kendaraan->tahun }}</p>
                                            <p><strong>Jenis BBM:</strong> {{ $kendaraan->jenis_bbm }}</p>
                                            <p><strong>Ketersediaan:</strong> {{ $kendaraan->ketersediaan }}</p>
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
                <!-- </div>
            </div> -->




            {{-- footer --}}
            @include('footer')
        </div>
    </div>
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
