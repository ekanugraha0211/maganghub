@extends('template')

@section('content')
<div class="content-custom">
    <!-- Header -->
        <div class="row mt-4">
            <div class="col-12 text-center mt-4">
                <!-- <h2 class="fw-bold mb-1">Dashboard</h2> -->
                <!-- <p class="text-secondary">Ringkasan data sistem SIMOPAS</p> -->
            </div>
        </div>

        <!-- CARD STATS -->
        <div class="row">
            <!-- Kendaraan -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card-custom">
                    <div class="card-icon bg-blue">
                        <i class="nc-icon nc-delivery-fast"></i>
                    </div>
                    <div>
                        <p class="card-label">Data Kendaraan</p>
                        <h3 class="card-value">{{ $totalKendaraan }}</h3>
                        <span class="card-desc">Total kendaraan terdaftar</span>
                    </div>
                </div>
            </div>

            <!-- Dipinjam -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card-custom">
                    <div class="card-icon bg-orange">
                        <i class="nc-icon nc-share-66"></i>
                    </div>
                    <div>
                        <p class="card-label">Data Dipinjam</p>
                        <h3 class="card-value">{{ $totalDipinjam }}</h3>
                        <span class="card-desc">Sedang dipinjam</span>
                    </div>
                </div>
            </div>

            <!-- Pengembalian -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card-custom">
                    <div class="card-icon bg-green">
                        <i class="nc-icon nc-refresh-69"></i>
                    </div>
                    <div>
                        <p class="card-label">Data Pengembalian</p>
                        <h3 class="card-value">{{ $totalPengembalian }}</h3>
                        <span class="card-desc">Sudah dikembalikan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION BAWAH -->
        <div class="row">

            <!-- PROGRESS -->
            <div class="col-lg-6 mb-4">
                <div class="card-box">
                    <h5 class="card-title">Progress Keseluruhan</h5>

                    <p class="mb-1">Kendaraan Digunakan</p>
                    <div class="progress-custom">
                        <div class="progress-fill" style="width:75%"></div>
                    </div>

                    <p class="mb-1">Pengembalian</p>
                    <div class="progress-custom">
                        <div class="progress-fill bg-green" style="width:50%"></div>
                    </div>

                    <p class="mb-1">Aktivitas Sistem</p>
                    <div class="progress-custom">
                        <div class="progress-fill bg-orange" style="width:90%"></div>
                    </div>
                </div>
            </div>

            <!-- INFO -->
            <div class="col-lg-6 mb-4">
                <div class="card-box">
                    <h5 class="card-title">Informasi Tambahan</h5>

                    <ul class="info-list">
                        <li>
                            <span>Total Kendaraan</span>
                            <strong>{{ $totalKendaraan }}</strong>
                        </li>
                        <li>
                            <span>Data Dipinjam</span>
                            <strong>{{ $totalDipinjam }}</strong>
                        </li>
                        <li>
                            <span>Pengembalian</span>
                            <strong>{{ $totalPengembalian }}</strong>
                        </li>
                    </ul>

                </div>
            </div>

        </div>

    </div>
</div>
<style>
    /* CONTENT */
.content-custom {
  padding: 20px;
  background: #f5f7fb;
  min-height: 100vh;
}

/* CARD */
.card-custom {
  background: #ffffff;
  border-radius: 12px;
  padding: 20px;
  display: flex;
  align-items: center;
  gap: 15px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  transition: 0.2s;
}

.card-custom:hover {
  transform: translateY(-4px);
}

/* ICON */
.card-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 20px;
}

/* WARNA */
.bg-blue { background: #4a9eff; }
.bg-green { background: #22c55e; }
.bg-orange { background: #f59e0b; }

/* TEXT */
.card-label {
  font-size: 13px;
  color: #64748b;
  margin-bottom: 4px;
}

.card-value {
  font-size: 22px;
  font-weight: bold;
  margin: 0;
  color: #1e293b;
}

.card-desc {
  font-size: 12px;
  color: #94a3b8;
}

/* BOX */
.card-box {
  background: #ffffff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* PROGRESS */
.progress-custom {
  width: 100%;
  height: 8px;
  background: #e5e7eb;
  border-radius: 10px;
  margin-bottom: 15px;
}

.progress-fill {
  height: 100%;
  background: #4a9eff;
  border-radius: 10px;
}

/* LIST */
.info-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.info-list li {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid #e5e7eb;
  font-size: 14px;
}

.info-list li strong {
  color: #1e293b;
}

/* TEXT */
.text-secondary {
  color: #64748b;
}
</style>
@endsection