<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>SIMOPAS</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <style>
    html, body {
      height: 100%;
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .main-content {
      flex: 1;
    }

    /* ===== FOOTER ===== */
    .site-footer {
      background-color: #2c3e6b;
      color: #c8d0e0;
      font-family: 'Montserrat', sans-serif;
      padding: 36px 40px 20px;
    }
    .site-footer .footer-grid {
      display: grid;
      grid-template-columns: 1.4fr 1fr;
      gap: 40px;
      padding-bottom: 24px;
      border-bottom: 1px solid rgba(255,255,255,0.12);
    }
    .site-footer .footer-logo-name {
      font-size: 22px;
      font-weight: 700;
      color: #ffffff;
      letter-spacing: 2px;
      margin-bottom: 4px;
    }
    .site-footer .footer-subtitle {
      font-size: 11px;
      font-weight: 400;
      color: #8da3c4;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      margin-bottom: 16px;
    }
    .site-footer .footer-instansi {
      font-size: 13px;
      font-weight: 700;
      color: #e0e8f5;
      margin-bottom: 14px;
    }
    .site-footer .footer-contact-item {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 9px;
      font-size: 13px;
      color: #a8b8cc;
      line-height: 1.5;
    }
    .site-footer .footer-contact-item i {
      color: #5b8fd4;
      margin-top: 2px;
      width: 14px;
      flex-shrink: 0;
    }
    .site-footer .footer-dev-col {
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      align-items: flex-end;
      text-align: right;
    }
    .site-footer .footer-dev-badge {
      background-color: rgba(91, 143, 212, 0.15);
      border: 1px solid rgba(91, 143, 212, 0.3);
      border-radius: 8px;
      padding: 14px 18px;
      display: inline-block;
    }
    .site-footer .footer-dev-label {
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #5b8fd4;
      margin-bottom: 4px;
    }
    .site-footer .footer-dev-name {
      font-size: 13px;
      font-weight: 700;
      color: #e0e8f5;
    }
    .site-footer .footer-dev-sub {
      font-size: 11px;
      color: #8da3c4;
      margin-top: 2px;
    }
    .site-footer .footer-bottom {
      padding-top: 16px;
      font-size: 11px;
      color: #5e7590;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 8px;
    }

    @media (max-width: 640px) {
      .site-footer .footer-grid {
        grid-template-columns: 1fr;
      }
      .site-footer .footer-dev-col {
        align-items: flex-start;
        text-align: left;
      }
    }
  </style>
</head>

<body>

  <!-- Main Content -->
  <div class="main-content">
    <div class="container-fluid py-4">
      @yield('content')
    </div>
  </div>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="footer-grid">

      <!-- Kolom Kiri: Identitas & Kontak -->
      <div>
        <!-- <div class="footer-logo-name">SIMOPAS</div> -->
         <img src="../assets/img/simopas.png" 
      alt="SIMOPAS Logo"
      style="width: 160px; height: auto; object-fit: contain;">
        <div class="footer-subtitle">Sistem Monitoring Transportasi Lapas</div>
        <div class="footer-instansi">Lembaga Pemasyarakatan Kelas II B Pasuruan</div>

        <div class="footer-contact-item">
          <i class="fa fa-map-marker"></i>
          <span>Jl. Panglima Sudirman No.4, Purworejo, Kec. Purworejo,<br>Kota Pasuruan, Jawa Timur 67115</span>
        </div>
        <div class="footer-contact-item">
          <i class="fa fa-phone"></i>
          <span>0812-2226-3737</span>
        </div>
        <div class="footer-contact-item">
          <i class="fa fa-envelope"></i>
          <span>info@lapaspasuruan.id</span>
        </div>
      </div>

      <!-- Kolom Kanan: Developer Info -->
      <div class="footer-dev-col">
        <div class="footer-dev-badge">
          <div class="footer-dev-label">Developed by</div>
          <div class="footer-dev-name">MagangHub Batch 2</div>
          <div class="footer-dev-sub">Bagian Umum</div>
        </div>
      </div>

    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <span>&copy; {{ date('Y') }} SIMOPAS &mdash; Lapas Kelas II B Pasuruan. All rights reserved.</span>
      <span>Sistem Monitoring Transportasi Lapas</span>
    </div>
  </footer>

  <!-- Core JS Files -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      demo.initChartsPages();
    });
  </script>
</body>
</html>