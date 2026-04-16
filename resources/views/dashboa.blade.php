@extends('template')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .dashboard-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f0f4f8;
        min-height: 100vh;
        padding: 28px 24px;
    }

    /* Header */
    .dash-header {
        margin-bottom: 32px;
    }

    .dash-header .greeting {
        font-size: 22px;
        font-weight: 800;
        color: #1a202c;
        margin: 0 0 4px;
        letter-spacing: -0.5px;
    }

    .dash-header .subtitle {
        font-size: 14px;
        color: #718096;
        margin: 0;
    }

    .dash-header .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 13px;
        color: #4a5568;
        font-weight: 500;
    }

    /* Stat Cards */
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid #e8edf2;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.08);
    }

    .stat-card .card-bg-icon {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 80px;
        opacity: 0.04;
        pointer-events: none;
    }

    .stat-card .icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
    }

    .icon-wrap.orange  { background: #fff7ed; color: #f97316; }
    .icon-wrap.red     { background: #fff1f2; color: #f43f5e; }
    .icon-wrap.blue    { background: #eff6ff; color: #3b82f6; }

    .stat-card .stat-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #a0aec0;
        margin-bottom: 6px;
    }

    .stat-card .stat-value {
        font-size: 36px;
        font-weight: 800;
        color: #1a202c;
        letter-spacing: -1px;
        line-height: 1;
        margin-bottom: 14px;
    }

    .stat-card .stat-footer {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #718096;
        border-top: 1px solid #f7fafc;
        padding-top: 12px;
        margin-top: 12px;
    }

    .stat-card .stat-footer i { font-size: 11px; }

    /* Progress mini in card */
    .mini-progress {
        height: 5px;
        background: #f0f4f8;
        border-radius: 99px;
        overflow: hidden;
        margin-bottom: 4px;
    }

    .mini-progress-bar {
        height: 100%;
        border-radius: 99px;
        background: #f97316;
    }

    .mini-progress-label {
        font-size: 11px;
        color: #a0aec0;
    }

    /* Bottom Cards */
    .section-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e8edf2;
        overflow: hidden;
    }

    .section-card .section-header {
        padding: 18px 22px 14px;
        border-bottom: 1px solid #f0f4f8;
    }

    .section-card .section-header h5 {
        font-size: 15px;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 2px;
    }

    .section-card .section-header p {
        font-size: 12px;
        color: #a0aec0;
        margin: 0;
    }

    .section-card .section-body {
        padding: 20px 22px;
    }

    /* Progress rows */
    .progress-row {
        margin-bottom: 18px;
    }

    .progress-row:last-child { margin-bottom: 0; }

    .progress-row-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 7px;
    }

    .progress-row-header span:first-child {
        font-size: 13px;
        font-weight: 600;
        color: #2d3748;
    }

    .progress-row-header span:last-child {
        font-size: 12px;
        font-weight: 700;
        color: #4a5568;
    }

    .progress-track {
        height: 8px;
        background: #f0f4f8;
        border-radius: 99px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 99px;
        position: relative;
    }

    .progress-fill.green  { background: linear-gradient(90deg, #10b981, #34d399); }
    .progress-fill.cyan   { background: linear-gradient(90deg, #0ea5e9, #38bdf8); }
    .progress-fill.rose   { background: linear-gradient(90deg, #f43f5e, #fb7185); }

    /* Info list */
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 0;
        border-bottom: 1px solid #f7fafc;
        font-size: 13.5px;
    }

    .info-list li:last-child { border-bottom: none; }

    .info-list .info-left {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #4a5568;
        font-weight: 500;
    }

    .info-list .info-left .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .dot.green  { background: #10b981; }
    .dot.blue   { background: #3b82f6; }
    .dot.yellow { background: #f59e0b; }

    .info-list .info-right {
        font-weight: 700;
        color: #1a202c;
        background: #f7fafc;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    /* Status badge */
    .status-online {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        color: #10b981;
    }

    .status-online::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #10b981;
        display: inline-block;
        animation: pulse-dot 1.5s infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }
</style>

<div class="dashboard-wrapper">

    {{-- Header --}}
    <div class="dash-header d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <h2 class="greeting">Dashboard Overview</h2>
            <p class="subtitle">Ringkasan data peminjaman kendaraan terbaru</p>
        </div>
        <div class="date-badge">
            <i class="fa fa-calendar-o"></i>
            <span>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
        </div>
    </div>

    {{-- Stat Cards Row --}}
    <div class="row g-3 mb-4">

        {{-- Kendaraan --}}
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="icon-wrap orange">
                    <i class="nc-icon nc-globe"></i>
                </div>
                <p class="stat-label">Data Kendaraan</p>
                <p class="stat-value">{{ $totalKendaraan }}</p>
                <div class="mini-progress">
                    <div class="mini-progress-bar" style="width: 60%; background: #f97316;"></div>
                </div>
                <p class="mini-progress-label">60% dari target stok</p>
                <div class="stat-footer">
                    <i class="fa fa-refresh"></i> Diperbarui hari ini
                </div>
                <i class="nc-icon nc-globe card-bg-icon"></i>
            </div>
        </div>

        {{-- Dipinjam --}}
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="icon-wrap red">
                    <i class="nc-icon nc-vector"></i>
                </div>
                <p class="stat-label">Sedang Dipinjam</p>
                <p class="stat-value">{{ $totalDipinjam }}</p>
                <p style="font-size:12px; color:#a0aec0; margin:0 0 8px;">Jumlah peminjaman aktif saat ini</p>
                <div class="stat-footer">
                    <span class="status-online">Live</span>
                    <span style="margin-left:4px;">Update terbaru 1 jam lalu</span>
                </div>
                <i class="nc-icon nc-vector card-bg-icon"></i>
            </div>
        </div>

        {{-- Pengembalian --}}
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="icon-wrap blue">
                    <i class="nc-icon nc-favourite-28"></i>
                </div>
                <p class="stat-label">Data Pengembalian</p>
                <p class="stat-value">{{ $totalPengembalian }}</p>
                <p style="font-size:12px; color:#a0aec0; margin:0 0 8px;">Total kendaraan sudah dikembalikan</p>
                <div class="stat-footer">
                    <i class="fa fa-refresh"></i> Update sekarang
                </div>
                <i class="nc-icon nc-favourite-28 card-bg-icon"></i>
            </div>
        </div>

    </div>

    {{-- Bottom Row --}}
    <div class="row g-3">

        {{-- Progress Section --}}
        <div class="col-lg-6">
            <div class="section-card">
                <div class="section-header">
                    <h5>Progress Keseluruhan</h5>
                    <p>Statistik kinerja dari berbagai aspek operasional</p>
                </div>
                <div class="section-body">

                    <div class="progress-row">
                        <div class="progress-row-header">
                            <span>Barang Terdistribusi</span>
                            <span>75%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill green" style="width: 75%;"></div>
                        </div>
                    </div>

                    <div class="progress-row">
                        <div class="progress-row-header">
                            <span>Pengembalian Kendaraan</span>
                            <span>50%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill cyan" style="width: 50%;"></div>
                        </div>
                    </div>

                    <div class="progress-row">
                        <div class="progress-row-header">
                            <span>Petugas Aktif</span>
                            <span>90%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill rose" style="width: 90%;"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Info List --}}
        <div class="col-lg-6">
            <div class="section-card">
                <div class="section-header">
                    <h5>Informasi Tambahan</h5>
                    <p>Ringkasan data operasional terkini</p>
                </div>
                <div class="section-body">
                    <ul class="info-list">
                        <li>
                            <div class="info-left">
                                <span class="dot green"></span>
                                Total Kendaraan di Gudang
                            </div>
                            <span class="info-right">{{ $totalKendaraan }}</span>
                        </li>
                        <li>
                            <div class="info-left">
                                <span class="dot blue"></span>
                                Peminjaman Aktif
                            </div>
                            <span class="info-right">{{ $totalDipinjam }}</span>
                        </li>
                        <li>
                            <div class="info-left">
                                <span class="dot yellow"></span>
                                Pengembalian Tertunda
                            </div>
                            <span class="info-right">{{ $totalDipinjam }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection