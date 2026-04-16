@extends('guest.layout.template')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .guest-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f5f7fa;
        min-height: 100vh;
        padding: 36px 24px;
    }

    /* ── Header ── */
    .guest-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .guest-header .page-eyebrow {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #3b82f6;
        background: #eff6ff;
        border-radius: 20px;
        padding: 5px 14px;
        margin-bottom: 12px;
    }

    .guest-header h2 {
        font-size: 30px;
        font-weight: 800;
        color: #1a202c;
        letter-spacing: -0.8px;
        margin: 0 0 8px;
    }

    .guest-header p {
        font-size: 15px;
        color: #718096;
        margin: 0;
    }

    /* ── Vehicle Card ── */
    .vehicle-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #e8edf2;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none !important;
        color: inherit !important;
    }

    .vehicle-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.10);
    }

    /* Image wrapper */
    .vehicle-card .img-wrap {
        position: relative;
        overflow: hidden;
        height: 210px;
    }

    .vehicle-card .img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
    }

    .vehicle-card:hover .img-wrap img {
        transform: scale(1.05);
    }

    /* Status badge floating */
    .vehicle-card .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 5px 12px;
        border-radius: 20px;
        backdrop-filter: blur(6px);
    }

    .status-badge.available {
        background: rgba(16, 185, 129, 0.9);
        color: #fff;
    }

    .status-badge.borrowed {
        background: rgba(245, 158, 11, 0.9);
        color: #fff;
    }

    /* Card body */
    .vehicle-card .v-body {
        padding: 18px 18px 8px;
        flex: 1;
    }

    .vehicle-card .v-name {
        font-size: 16px;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .vehicle-card .v-meta {
        font-size: 12.5px;
        color: #a0aec0;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Card footer */
    .vehicle-card .v-footer {
        padding: 12px 18px 16px;
        border-top: 1px solid #f0f4f8;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .vehicle-card .v-footer .status-text {
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-text.available { color: #10b981; }
    .status-text.borrowed  { color: #f59e0b; }

    .status-text .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
    }

    .status-text.available .dot { background: #10b981; }
    .status-text.borrowed  .dot { background: #f59e0b; animation: blink 1.2s infinite; }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.35; }
    }

    .vehicle-card .v-footer .arrow-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f0f4f8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #718096;
        transition: background 0.2s, color 0.2s;
    }

    .vehicle-card:hover .arrow-btn {
        background: #3b82f6;
        color: #fff;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state .empty-icon {
        font-size: 60px;
        color: #e2e8f0;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        font-size: 18px;
        font-weight: 700;
        color: #4a5568;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
        color: #a0aec0;
    }

    /* Row gap */
    .vehicle-row {
        --bs-gutter-x: 1.25rem;
        --bs-gutter-y: 1.25rem;
    }
</style>

<div class="guest-wrapper">

    {{-- Header --}}
    <div class="guest-header">
        <span class="page-eyebrow">Sistem Peminjaman</span>
        <h2>Pilih Kendaraan</h2>
        <p>Temukan kendaraan yang tersedia dan ajukan peminjaman dengan mudah</p>
    </div>

    {{-- Vehicle Grid --}}
    @if($data->count())
    <div class="row vehicle-row">
        @foreach($data as $k)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <a href="{{ route('guest.show', $k->id) }}" class="vehicle-card d-flex flex-column">

                {{-- Image + floating badge --}}
                <div class="img-wrap">
                    <img
                        src="{{ $k->foto ? asset('images/' . $k->foto) : asset('images/no-image.png') }}"
                        alt="{{ $k->nama }}">

                    @if($k->peminjamanTerakhir && $k->peminjamanTerakhir->status == 'dipinjam')
                        <span class="status-badge borrowed">
                            <i class="fa fa-clock-o me-1"></i> Dipinjam
                        </span>
                    @else
                        <span class="status-badge available">
                            <i class="fa fa-check me-1"></i> Tersedia
                        </span>
                    @endif
                </div>

                {{-- Body --}}
                <div class="v-body">
                    <h5 class="v-name">{{ $k->nama }}</h5>
                    <p class="v-meta">
                        <i class="fa fa-car" style="font-size:11px;"></i>
                        Klik untuk lihat detail
                    </p>
                </div>

                {{-- Footer --}}
                <div class="v-footer">
                    @if($k->peminjamanTerakhir && $k->peminjamanTerakhir->status == 'dipinjam')
                        <span class="status-text borrowed">
                            <span class="dot"></span> Sedang dipinjam
                        </span>
                    @else
                        <span class="status-text available">
                            <span class="dot"></span> Siap dipinjam
                        </span>
                    @endif

                    <span class="arrow-btn">
                        <i class="fa fa-arrow-right"></i>
                    </span>
                </div>

            </a>
        </div>
        @endforeach
    </div>

    @else
    {{-- Empty State --}}
    <div class="empty-state">
        <div class="empty-icon"><i class="fa fa-car"></i></div>
        <h5>Belum Ada Kendaraan</h5>
        <p>Data kendaraan belum tersedia. Silahkan cek kembali nanti.</p>
    </div>
    @endif

</div>
@endsection