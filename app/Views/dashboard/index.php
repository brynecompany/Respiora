<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard TBC — Kota Jember</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:    #f3f6fb;
            --navy2:   #e8eef8;
            --navy3:   #dde5f3;
            --teal:    #00a688;
            --teal2:   #008f74;
            --blue:    #1a56db;
            --orange:  #f97316;
            --pink:    #e879a0;
            --purple:  #7c3aed;
            --amber:   #d97706;
            --red:     #dc2626;
            --text:    #1e2a3b;
            --text2:   #6b7a99;
            --border:  rgba(0,0,0,0.08);
            --card:    #ffffff;
            --card2:   #f8fafd;
            --shadow:  0 1px 8px rgba(26,86,219,0.07), 0 0 0 1px rgba(0,0,0,0.06);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--navy);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(26,86,219,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(26,86,219,0.025) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none; z-index: 0;
        }

        /* ── HEADER ── */
        header {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            padding: 14px 32px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
        }
        .header-left { display: flex; align-items: center; gap: 14px; }
        .header-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--teal), var(--blue));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; flex-shrink: 0;
            box-shadow: 0 0 20px rgba(0,166,136,0.25);
        }
        .header-title { font-size: 1rem; font-weight: 600; color: var(--text); letter-spacing: -0.01em; }
        .header-sub   { font-size: 0.72rem; color: var(--text2); margin-top: 1px; }
        .header-right { display: flex; align-items: center; gap: 10px; }
        .header-badge {
            display: flex; align-items: center; gap: 6px;
            background: rgba(0,166,136,0.08);
            border: 1px solid rgba(0,166,136,0.25);
            border-radius: 20px; padding: 5px 12px;
            font-size: 0.72rem; color: var(--teal);
            font-family: 'Space Mono', monospace; white-space: nowrap;
        }
        .pulse {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--teal); animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.5; transform: scale(0.8); }
        }

        /* ── BUTTONS ── */
        .btn-unduh {
            display: flex; align-items: center; gap: 8px;
            background: var(--blue); color: #fff;
            border: none; border-radius: 8px;
            padding: 9px 18px;
            font-size: 0.82rem; font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 2px 12px rgba(26,86,219,0.25);
            white-space: nowrap;
        }
        .btn-unduh:hover { background: #1442b5; box-shadow: 0 4px 20px rgba(26,86,219,0.35); transform: translateY(-1px); }
        .btn-unduh svg { width: 16px; height: 16px; flex-shrink: 0; }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed; inset: 0; z-index: 999;
            background: rgba(15,25,50,0.45);
            backdrop-filter: blur(6px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none;
            transition: opacity 0.25s;
        }
        .modal-overlay.open { opacity: 1; pointer-events: all; }
        .modal {
            background: #fff;
            border-radius: 16px;
            padding: 32px;
            width: 420px; max-width: calc(100vw - 32px);
            box-shadow: 0 24px 80px rgba(26,86,219,0.18), 0 4px 20px rgba(0,0,0,0.12);
            transform: translateY(16px) scale(0.97);
            transition: transform 0.25s, opacity 0.25s;
            opacity: 0;
        }
        .modal-overlay.open .modal { transform: translateY(0) scale(1); opacity: 1; }
        .modal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
        .modal-title  { font-size: 1.1rem; font-weight: 700; color: var(--text); }
        .modal-close  {
            width: 32px; height: 32px; border-radius: 8px;
            border: 1px solid var(--border); background: var(--navy);
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: var(--text2); transition: background 0.15s;
        }
        .modal-close:hover { background: var(--navy3); }
        .modal-sub { font-size: 0.78rem; color: var(--text2); margin-bottom: 24px; }
        .modal-section { margin-bottom: 20px; }
        .modal-section-label {
            font-size: 0.7rem; font-weight: 600; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--text2); margin-bottom: 10px;
        }
        .format-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .format-btn {
            display: flex; align-items: center; gap: 12px;
            background: var(--navy); border: 1.5px solid var(--border);
            border-radius: 10px; padding: 14px 16px;
            cursor: pointer; transition: all 0.2s;
            font-family: 'DM Sans', sans-serif; text-align: left;
        }
        .format-btn:hover  { border-color: var(--blue); background: rgba(26,86,219,0.04); }
        .format-btn.selected { border-color: var(--blue); background: rgba(26,86,219,0.07); }
        .format-icon { width: 38px; height: 38px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
        .format-icon.pdf   { background: rgba(220,38,38,0.10); }
        .format-icon.excel { background: rgba(0,166,136,0.10); }
        .format-name { font-size: 0.85rem; font-weight: 600; color: var(--text); }
        .format-ext  { font-size: 0.7rem; color: var(--text2); margin-top: 1px; }
        .section-opts { display: flex; flex-direction: column; gap: 8px; }
        .opt-row {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px; background: var(--navy);
            border: 1px solid var(--border); border-radius: 8px;
            cursor: pointer; transition: background 0.15s;
        }
        .opt-row:hover { background: var(--navy2); }
        .opt-row input[type="checkbox"] { width: 16px; height: 16px; cursor: pointer; accent-color: var(--blue); }
        .opt-label { font-size: 0.82rem; color: var(--text); font-weight: 500; flex: 1; }
        .opt-badge { font-size: 0.65rem; background: var(--navy3); color: var(--text2); border-radius: 6px; padding: 2px 7px; font-family: 'Space Mono', monospace; }
        .modal-actions { display: flex; gap: 10px; margin-top: 24px; }
        .btn-cancel {
            flex: 1; padding: 11px;
            background: var(--navy); border: 1px solid var(--border);
            border-radius: 8px; font-size: 0.85rem; font-weight: 600;
            color: var(--text2); cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: background 0.15s;
        }
        .btn-cancel:hover { background: var(--navy2); }
        .btn-confirm {
            flex: 2; padding: 11px;
            background: var(--blue); color: #fff;
            border: none; border-radius: 8px;
            font-size: 0.85rem; font-weight: 600;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 2px 10px rgba(26,86,219,0.3);
        }
        .btn-confirm:hover     { background: #1442b5; transform: translateY(-1px); }
        .btn-confirm:disabled  { background: #93a3d6; cursor: not-allowed; transform: none; }

        /* ── TOAST ── */
        .toast {
            position: fixed; bottom: 28px; right: 28px; z-index: 9999;
            background: #1e2a3b; color: #fff;
            border-radius: 12px; padding: 14px 20px;
            display: flex; align-items: center; gap: 12px;
            font-size: 0.82rem; font-weight: 500;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            transform: translateY(80px); opacity: 0;
            transition: transform 0.3s, opacity 0.3s;
            max-width: 320px;
        }
        .toast.show { transform: translateY(0); opacity: 1; }
        .toast-icon { font-size: 1.1rem; flex-shrink: 0; }
        .toast-progress {
            position: absolute; bottom: 0; left: 0; height: 3px;
            background: var(--teal); border-radius: 0 0 12px 12px;
            width: 100%; transform-origin: left;
            animation: progress 3s linear forwards;
        }
        @keyframes progress { from { transform: scaleX(1); } to { transform: scaleX(0); } }

        /* ── CONTAINER ── */
        .container {
            position: relative; z-index: 1;
            max-width: 1280px; margin: 0 auto;
            padding: 28px 24px 48px;
        }

        /* ── SECTION LABELS ── */
        .section-label {
            font-size: 0.7rem; font-weight: 600;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--text2); margin-bottom: 14px; margin-top: 32px;
            display: flex; align-items: center; gap: 8px;
        }
        .section-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }
        .section-label-bar {
            font-size: 0.7rem; font-weight: 600;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--text2); margin-bottom: 14px; margin-top: 32px;
            display: flex; align-items: center; gap: 8px;
        }
        .section-label-bar .label-line { flex: 1; height: 1px; background: var(--border); }
        .section-label-bar .btn-unduh-sm {
            display: flex; align-items: center; gap: 7px;
            background: var(--blue); color: #fff;
            border: none; border-radius: 8px;
            padding: 7px 14px;
            font-size: 0.75rem; font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 2px 10px rgba(26,86,219,0.22);
            white-space: nowrap; letter-spacing: 0; text-transform: none;
        }
        .section-label-bar .btn-unduh-sm:hover { background: #1442b5; transform: translateY(-1px); }
        .section-label-bar .btn-unduh-sm svg { width: 14px; height: 14px; flex-shrink: 0; }

        /* ── STAT CARDS ── */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 14px; margin-bottom: 8px;
        }
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 12px; padding: 20px 22px;
            position: relative; overflow: hidden;
            transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
            box-shadow: var(--shadow);
        }
        .stat-card:hover { border-color: rgba(0,0,0,0.12); transform: translateY(-2px); box-shadow: 0 4px 16px rgba(26,86,219,0.1); }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; }
        .stat-card.teal::before   { background: var(--teal); }
        .stat-card.blue::before   { background: var(--blue); }
        .stat-card.pink::before   { background: var(--pink); }
        .stat-card.orange::before { background: var(--orange); }
        .stat-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1rem; margin-bottom: 14px; }
        .stat-card.teal .stat-icon   { background: rgba(0,166,136,0.10); }
        .stat-card.blue .stat-icon   { background: rgba(26,86,219,0.10); }
        .stat-card.pink .stat-icon   { background: rgba(232,121,160,0.10); }
        .stat-card.orange .stat-icon { background: rgba(249,115,22,0.10); }
        .stat-label { font-size: 0.7rem; font-weight: 500; letter-spacing: 0.06em; text-transform: uppercase; color: var(--text2); margin-bottom: 4px; }
        .stat-value { font-family: 'Space Mono', monospace; font-size: 2rem; font-weight: 700; line-height: 1; }
        .stat-card.teal .stat-value   { color: var(--teal); }
        .stat-card.blue .stat-value   { color: var(--blue); }
        .stat-card.pink .stat-value   { color: var(--pink); }
        .stat-card.orange .stat-value { color: var(--orange); }
        .stat-sub { font-size: 0.72rem; color: var(--text2); margin-top: 4px; }

        /* ── CHART CARDS — background putih, kotak bersih ── */
        .chart-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 22px 24px;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: var(--shadow);
        }
        .chart-card:hover { border-color: rgba(0,0,0,0.12); box-shadow: 0 4px 16px rgba(26,86,219,0.09); }
        .chart-head {
            display: flex; align-items: center; justify-content: space-between;
            gap: 12px; margin-bottom: 20px; flex-wrap: wrap;
        }
        .chart-title {
            font-size: 0.85rem; font-weight: 600; color: var(--text);
            display: flex; align-items: center; gap: 8px;
        }
        .dot-badge { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
        .toggle-group {
            display: flex; background: var(--navy2);
            border: 1px solid var(--border); border-radius: 8px; padding: 3px; gap: 2px;
        }
        .toggle-btn {
            padding: 5px 14px; border: none; border-radius: 6px;
            font-size: 0.75rem; font-weight: 600; font-family: 'DM Sans', sans-serif;
            cursor: pointer; background: transparent; color: var(--text2); transition: all 0.2s;
        }
        .toggle-btn.active { background: var(--blue); color: #fff; }
        .toggle-btn:hover:not(.active) { background: var(--border); color: var(--text); }
        .chart-wrap { position: relative; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* ── LEGEND USIA — sesuai gambar referensi ── */
        .usia-legend {
            display: flex; flex-wrap: wrap; gap: 8px 20px;
            margin-top: 14px; padding-top: 14px;
            border-top: 1px solid var(--border);
        }
        .usia-legend-item { display: flex; align-items: center; gap: 6px; font-size: 0.72rem; color: var(--text2); }
        .usia-legend-dot  { width: 12px; height: 12px; border-radius: 3px; flex-shrink: 0; }

        /* ── PIE LEGEND ── */
        .pie-legend {
            display: flex; flex-wrap: wrap; gap: 8px 16px;
            margin-top: 14px; padding-top: 14px;
            border-top: 1px solid var(--border);
            justify-content: center;
        }
        .pie-legend-item { display: flex; align-items: center; gap: 6px; font-size: 0.72rem; color: var(--text2); }
        .pie-legend-dot  { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

        footer {
            position: relative; z-index: 1; text-align: center;
            padding: 20px; font-size: 0.72rem; color: var(--text2);
            border-top: 1px solid var(--border);
        }

        @media (max-width: 768px) {
            header { padding: 12px 16px; }
            .container { padding: 18px 14px 36px; }
            .grid-2 { grid-template-columns: 1fr; }
            .stat-value { font-size: 1.6rem; }
            .header-badge { display: none; }
            .modal { padding: 24px 18px; }
            .format-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- ─── HEADER ─── -->
<header>
    <div class="header-left">
        <div class="header-icon">🫁</div>
        <div>
            <div class="header-title">Dashboard Surveilans TBC</div>
            <div class="header-sub">Sistem Informasi Tuberkulosis — Kota Jember</div>
        </div>
    </div>
    <div class="header-right">
        <div class="header-badge">
            <div class="pulse"></div>
            Live Data
        </div>
    </div>
</header>

<!-- ─── MODAL UNDUH ─── -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
    <div class="modal" id="modalBox">
        <div class="modal-header">
            <div class="modal-title">Unduh Laporan</div>
            <button class="modal-close" onclick="closeModal()">✕</button>
        </div>
        <div class="modal-sub">Pilih format dan konten laporan yang ingin diunduh.</div>

        <div class="modal-section">
            <div class="modal-section-label">Format File</div>
            <div class="format-grid">
                <button class="format-btn selected" id="btnPDF" onclick="selectFormat('pdf')">
                    <div class="format-icon pdf">📄</div>
                    <div>
                        <div class="format-name">PDF</div>
                        <div class="format-ext">.pdf — Laporan visual</div>
                    </div>
                </button>
                <button class="format-btn" id="btnExcel" onclick="selectFormat('excel')">
                    <div class="format-icon excel">📊</div>
                    <div>
                        <div class="format-name">Excel</div>
                        <div class="format-ext">.xlsx — Data tabular</div>
                    </div>
                </button>
            </div>
        </div>

        <div class="modal-section">
            <div class="modal-section-label">Konten Laporan</div>
            <div class="section-opts">
                <label class="opt-row"><input type="checkbox" id="chkRingkasan" checked><span class="opt-label">Ringkasan Statistik</span><span class="opt-badge">4 metrik</span></label>
                <label class="opt-row"><input type="checkbox" id="chkTren" checked><span class="opt-label">Tren Kasus</span><span class="opt-badge">Tahunan + Bulanan</span></label>
                <label class="opt-row"><input type="checkbox" id="chkWilayah" checked><span class="opt-label">Distribusi Wilayah</span><span class="opt-badge">Per Kelurahan</span></label>
                <label class="opt-row"><input type="checkbox" id="chkDemografi" checked><span class="opt-label">Distribusi Demografis</span><span class="opt-badge">Usia + Jenis Kelamin</span></label>
                <label class="opt-row"><input type="checkbox" id="chkPengobatan" checked><span class="opt-label">Status Pengobatan</span><span class="opt-badge">4 kategori</span></label>
            </div>
        </div>

        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeModal()">Batal</button>
            <button class="btn-confirm" id="btnConfirm" onclick="unduhLaporan()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 15V3M12 15l-4-4M12 15l4-4"/>
                    <path d="M2 17l.621 2.485A2 2 0 004.561 21h14.878a2 2 0 001.94-1.515L22 17"/>
                </svg>
                Unduh Sekarang
            </button>
        </div>
    </div>
</div>

<!-- ─── TOAST ─── -->
<div class="toast" id="toast">
    <span class="toast-icon" id="toastIcon">⏳</span>
    <span id="toastMsg">Memproses laporan...</span>
    <div class="toast-progress" id="toastProgress" style="display:none"></div>
</div>

<!-- ─── DASHBOARD CONTENT ─── -->
<div class="container" id="dashboardContent">

    <div class="section-label">Ringkasan</div>
    <div class="stats" id="sectionRingkasan">
        <div class="stat-card teal">
            <div class="stat-icon">🫁</div>
            <div class="stat-label">Total Pasien</div>
            <div class="stat-value">1,284</div>
            <div class="stat-sub">Kasus terdaftar</div>
        </div>
        <div class="stat-card blue">
            <div class="stat-icon">👨</div>
            <div class="stat-label">Laki-laki</div>
            <div class="stat-value">742</div>
            <div class="stat-sub">Pasien pria</div>
        </div>
        <div class="stat-card pink">
            <div class="stat-icon">👩</div>
            <div class="stat-label">Perempuan</div>
            <div class="stat-value">542</div>
            <div class="stat-sub">Pasien wanita</div>
        </div>
        <div class="stat-card orange">
            <div class="stat-icon">📍</div>
            <div class="stat-label">Kelurahan</div>
            <div class="stat-value">31</div>
            <div class="stat-sub">Wilayah terdampak</div>
        </div>
    </div>

    <div class="section-label-bar">
        Tren Kasus
        <span class="label-line"></span>
        <button class="btn-unduh-sm" onclick="openModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 15V3M12 15l-4-4M12 15l4-4"/>
                <path d="M2 17l.621 2.485A2 2 0 004.561 21h14.878a2 2 0 001.94-1.515L22 17"/>
            </svg>
            Unduh Laporan
        </button>
    </div>
    <div class="chart-card" style="margin-bottom:14px" id="sectionTren">
        <div class="chart-head">
            <div class="chart-title">
                <div class="dot-badge" style="background:var(--teal)"></div>
                Jumlah Kasus TBC
            </div>
            <div class="toggle-group">
                <button class="toggle-btn active" id="btnTahunan" onclick="switchTren('tahunan')">Tahunan</button>
                <button class="toggle-btn"        id="btnBulanan" onclick="switchTren('bulanan')">Bulanan</button>
            </div>
        </div>
        <div class="chart-wrap" style="height:260px">
            <canvas id="chartTren"></canvas>
        </div>
    </div>

    <div class="section-label">Distribusi Wilayah</div>
    <div class="chart-card" style="margin-bottom:14px" id="sectionWilayah">
        <div class="chart-head">
            <div class="chart-title">
                <div class="dot-badge" style="background:var(--blue)"></div>
                Kasus Berdasarkan Kelurahan
            </div>
        </div>
        <div class="chart-wrap" style="height:280px">
            <canvas id="chartKelurahan"></canvas>
        </div>
    </div>

    <div class="section-label">Distribusi Demografis</div>
    <!-- Chart Usia — sesuai referensi gambar -->
    <div class="chart-card" style="margin-bottom:14px" id="sectionDemografi">
        <div class="chart-head">
            <div class="chart-title">
                <div class="dot-badge" style="background:var(--orange)"></div>
                Kasus Berdasarkan Kelompok Umur
            </div>
        </div>
        <!-- Custom horizontal bar chart sesuai referensi UI -->
        <div id="usiaChart" style="padding: 8px 0 4px;">
            <!-- Dirender via JS -->
        </div>
        <div class="usia-legend" id="usiaLegend"></div>
    </div>

    <div class="grid-2">
        <div class="chart-card" id="sectionPengobatan">
            <div class="chart-head">
                <div class="chart-title">
                    <div class="dot-badge" style="background:var(--amber)"></div>
                    Status Pengobatan
                </div>
            </div>
            <div class="chart-wrap" style="height:220px">
                <canvas id="chartPengobatan"></canvas>
            </div>
            <div class="pie-legend">
                <div class="pie-legend-item"><div class="pie-legend-dot" style="background:#1a56db"></div>Dalam Pengobatan</div>
                <div class="pie-legend-item"><div class="pie-legend-dot" style="background:#00a688"></div>Sembuh</div>
                <div class="pie-legend-item"><div class="pie-legend-dot" style="background:#f97316"></div>Drop Out</div>
                <div class="pie-legend-item"><div class="pie-legend-dot" style="background:#dc2626"></div>Meninggal</div>
            </div>
        </div>

        <div class="chart-card" id="sectionJK">
            <div class="chart-head">
                <div class="chart-title">
                    <div class="dot-badge" style="background:var(--pink)"></div>
                    Jenis Kelamin
                </div>
            </div>
            <div class="chart-wrap" style="height:220px">
                <canvas id="chartJenisKelamin"></canvas>
            </div>
            <div class="pie-legend">
                <div class="pie-legend-item"><div class="pie-legend-dot" style="background:#1a56db"></div>Laki-laki</div>
                <div class="pie-legend-item"><div class="pie-legend-dot" style="background:#e879a0"></div>Perempuan</div>
            </div>
        </div>
    </div>

</div>

<footer>
    &copy; 2025 Dinas Kesehatan Kota Jember &mdash; Sistem Surveilans TBC
</footer>

<script>
/* ═══════════════════════════════════════════
   DATA
═══════════════════════════════════════════ */
const trendLabels     = [1999,2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015,2016,2017,2018,2019,2020,2021,2022,2023,2024];
const trendValues     = [52,98,125,200,240,180,110,85,130,160,200,155,115,90,140,170,210,185,130,100,155,65,85,170,145,90];
const bulanLabels     = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
const bulanValues     = [95,80,110,125,115,90,105,130,88,72,95,179];
const kelurahanLabels = ['Sumbersari','Kaliwates','Patrang','Gebang','Antirogo','Tegalbesar','Kepatihan','Jember','Mangli','Kebonsari'];
const kelurahanValues = [145,132,118,105,98,87,76,65,58,42];
const usiaLabelsRaw   = [1,2,3,4,5];
const usiaValues      = [48,72,195,756,213];
const lakiLaki        = 742;
const perempuan       = 542;
const dalamPengobatan = 423;
const sembuh          = 698;
const dropOut         = 112;
const meninggal       = 51;
const totalUsia       = usiaValues.reduce((a,b)=>a+b,0);

const usiaMap    = {'1':'0-4 tahun','2':'5-9 tahun','3':'10-18 tahun','4':'19-59 tahun','5':'>60 tahun'};
const usiaLabels = usiaLabelsRaw.map(u => usiaMap[String(u)] || u);

/* Warna usia sesuai referensi gambar */
const USIA_COLORS = ['#3b82f6','#22d3ee','#2dd4bf','#86efac','#818cf8'];
const COLORS_BAR  = ['#1a56db','#00a688','#f97316','#7c3aed','#d97706','#e879a0','#dc2626','#0891b2'];

Chart.defaults.font.family = "'DM Sans', sans-serif";
Chart.defaults.font.size   = 12;
Chart.defaults.color       = '#6b7a99';
const tooltipStyle = {
    backgroundColor: '#1e2a3b', titleColor: '#94a3b8', bodyColor: '#ffffff',
    borderColor: 'rgba(0,0,0,0.1)', borderWidth: 1, padding: 12,
    cornerRadius: 10, displayColors: false,
    titleFont: { size: 11, weight: '500' }, bodyFont: { size: 14, weight: '700' },
};

/* ═══════════════════════════════════════════
   CHART TREN
═══════════════════════════════════════════ */
const trenChart = new Chart(document.getElementById('chartTren'), {
    type: 'line',
    data: {
        labels: trendLabels,
        datasets: [{
            label: 'Jumlah Kasus', data: trendValues,
            borderColor: '#102C57', backgroundColor: 'rgba(0,166,136,0.07)',
            borderWidth: 2.5, pointRadius: 5, pointBackgroundColor: '#102C57',
            pointBorderColor: '#fff', pointBorderWidth: 2, tension: 0.4, fill: true,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: { ...tooltipStyle, callbacks: { title: i => i[0].label, label: i => ` ${i.raw} kasus` } }
        },
        scales: {
            x: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { color: '#6b7a99' } },
            y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { color: '#6b7a99' }, beginAtZero: true }
        }
    }
});

function switchTren(mode) {
    if (mode === 'tahunan') {
        trenChart.data.labels = trendLabels;
        trenChart.data.datasets[0].data = trendValues;
        document.getElementById('btnTahunan').classList.add('active');
        document.getElementById('btnBulanan').classList.remove('active');
    } else {
        trenChart.data.labels = bulanLabels;
        trenChart.data.datasets[0].data = bulanValues;
        document.getElementById('btnBulanan').classList.add('active');
        document.getElementById('btnTahunan').classList.remove('active');
    }
    trenChart.update();
}

/* ═══════════════════════════════════════════
   CHART KELURAHAN
═══════════════════════════════════════════ */
new Chart(document.getElementById('chartKelurahan'), {
    type: 'bar',
    data: {
        labels: kelurahanLabels,
        datasets: [{
            label: 'Jumlah Kasus', data: kelurahanValues,
            backgroundColor: COLORS_BAR, borderRadius: 6, borderSkipped: false
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: { ...tooltipStyle, callbacks: { title: i => i[0].label, label: i => ` ${i.raw} kasus` } }
        },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#6b7a99' } },
            y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { color: '#6b7a99' }, beginAtZero: true }
        }
    }
});

/* ═══════════════════════════════════════════
   CHART USIA — custom HTML sesuai referensi
   Background abu muda, bar berwarna, persentase
   di dalam bar (bold putih), label di luar kanan
═══════════════════════════════════════════ */
function renderUsiaChart() {
    const container = document.getElementById('usiaChart');
    const maxVal    = Math.max(...usiaValues);

    let html = '<div style="display:flex;flex-direction:column;gap:10px;">';
    usiaValues.forEach((val, i) => {
        const pct     = Math.round(val / totalUsia * 100);
        const barPct  = Math.round(val / maxVal * 100); /* lebar relatif terhadap max */
        const color   = USIA_COLORS[i];
        const label   = usiaLabels[i];
        const showPct = barPct >= 18; /* tampilkan teks di dalam jika bar cukup lebar */

        html += `
        <div style="display:flex;align-items:center;gap:12px;position:relative;">
            <!-- Track abu-muda -->
            <div style="
                flex:1;
                background:#eef2fb;
                border-radius:6px;
                height:38px;
                position:relative;
                overflow:hidden;
            ">
                <!-- Bar berwarna -->
                <div style="
                    position:absolute;left:0;top:0;bottom:0;
                    width:${barPct}%;
                    background:${color};
                    border-radius:6px;
                    display:flex;align-items:center;
                    padding: 0 12px;
                    transition:width 0.8s ease;
                    min-width:${showPct?0:0}px;
                ">
                    ${showPct ? `<span style="color:#fff;font-weight:700;font-size:0.82rem;font-family:'DM Sans',sans-serif;white-space:nowrap;">${pct}%</span>` : ''}
                </div>
                ${!showPct ? `<span style="position:absolute;left:calc(${barPct}% + 8px);top:50%;transform:translateY(-50%);color:${color};font-weight:700;font-size:0.82rem;font-family:'DM Sans',sans-serif;">${pct}%</span>` : ''}
            </div>
            <!-- Label di luar kanan -->
            <div style="width:100px;font-size:0.78rem;color:#6b7a99;font-family:'DM Sans',sans-serif;white-space:nowrap;flex-shrink:0;">${label}</div>
        </div>`;
    });
    html += '</div>';
    container.innerHTML = html;
}
renderUsiaChart();

/* Legend usia */
const legendEl = document.getElementById('usiaLegend');
usiaLabels.forEach((label, i) => {
    legendEl.innerHTML += `<div class="usia-legend-item"><div class="usia-legend-dot" style="background:${USIA_COLORS[i]}"></div>${label}</div>`;
});

/* ═══════════════════════════════════════════
   CHART PENGOBATAN
═══════════════════════════════════════════ */
const totalPengobatanSum = dalamPengobatan + sembuh + dropOut + meninggal;
new Chart(document.getElementById('chartPengobatan'), {
    type: 'doughnut',
    data: {
        labels: ['Dalam Pengobatan','Sembuh','Drop Out','Meninggal'],
        datasets: [{
            data: [dalamPengobatan, sembuh, dropOut, meninggal],
            backgroundColor: ['#1a56db','#00a688','#f97316','#dc2626'],
            borderColor: '#ffffff', borderWidth: 3, hoverOffset: 8
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false, cutout: '68%',
        plugins: {
            legend: { display: false },
            tooltip: { ...tooltipStyle, callbacks: { title: i => i[0].label, label: i => ` ${i.raw} pasien (${Math.round(i.raw/totalPengobatanSum*100)}%)` } }
        }
    }
});

/* ═══════════════════════════════════════════
   CHART JENIS KELAMIN
═══════════════════════════════════════════ */
new Chart(document.getElementById('chartJenisKelamin'), {
    type: 'doughnut',
    data: {
        labels: ['Laki-laki','Perempuan'],
        datasets: [{
            data: [lakiLaki, perempuan],
            backgroundColor: ['#1a56db','#e879a0'],
            borderColor: '#ffffff', borderWidth: 3, hoverOffset: 8
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false, cutout: '68%',
        plugins: {
            legend: { display: false },
            tooltip: { ...tooltipStyle, callbacks: { title: i => i[0].label, label: i => ` ${i.raw} pasien (${Math.round(i.raw/(lakiLaki+perempuan)*100)}%)` } }
        }
    }
});

/* ═══════════════════════════════════════════
   MODAL
═══════════════════════════════════════════ */
let selectedFormat = 'pdf';
function openModal()  { document.getElementById('modalOverlay').classList.add('open'); }
function closeModal() { document.getElementById('modalOverlay').classList.remove('open'); }
function closeModalOutside(e) { if (e.target === document.getElementById('modalOverlay')) closeModal(); }
function selectFormat(fmt) {
    selectedFormat = fmt;
    document.getElementById('btnPDF').classList.toggle('selected', fmt === 'pdf');
    document.getElementById('btnExcel').classList.toggle('selected', fmt === 'excel');
}

/* ═══════════════════════════════════════════
   TOAST
═══════════════════════════════════════════ */
function showToast(msg, icon='⏳', withProgress=false) {
    const t    = document.getElementById('toast');
    const prog = document.getElementById('toastProgress');
    document.getElementById('toastMsg').textContent  = msg;
    document.getElementById('toastIcon').textContent = icon;
    prog.style.display = withProgress ? 'block' : 'none';
    if (withProgress) { prog.style.animation = 'none'; void prog.offsetWidth; prog.style.animation = 'progress 3s linear forwards'; }
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3400);
}

/* ═══════════════════════════════════════════
   UNDUH
═══════════════════════════════════════════ */
async function unduhLaporan() {
    const sections = {
        ringkasan:  document.getElementById('chkRingkasan').checked,
        tren:       document.getElementById('chkTren').checked,
        wilayah:    document.getElementById('chkWilayah').checked,
        demografi:  document.getElementById('chkDemografi').checked,
        pengobatan: document.getElementById('chkPengobatan').checked,
    };
    if (!Object.values(sections).some(Boolean)) { alert('Pilih minimal satu konten laporan.'); return; }
    closeModal();
    const btn = document.getElementById('btnConfirm');
    btn.disabled = true;
    if (selectedFormat === 'pdf') await unduhPDF(sections);
    else unduhExcel(sections);
    btn.disabled = false;
}

async function unduhPDF(sections) {
    showToast('Memproses laporan PDF...', '⏳');
    try {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
        const pw = pdf.internal.pageSize.getWidth();
        const margin = 16;
        let y = margin;

        pdf.setFillColor(26,86,219);
        pdf.roundedRect(margin, y, pw-margin*2, 22, 3, 3, 'F');
        pdf.setTextColor(255,255,255);
        pdf.setFontSize(13); pdf.setFont('helvetica','bold');
        pdf.text('Dashboard Surveilans TBC — Kota Jember', margin+6, y+9);
        pdf.setFontSize(8); pdf.setFont('helvetica','normal');
        const today = new Date().toLocaleDateString('id-ID',{day:'2-digit',month:'long',year:'numeric'});
        pdf.text('Dinas Kesehatan Kota Jember  |  ' + today, margin+6, y+16);
        y += 28;

        if (sections.ringkasan) {
            pdf.setTextColor(107,122,153); pdf.setFontSize(7); pdf.setFont('helvetica','bold');
            pdf.text('RINGKASAN', margin, y); y += 5;
            const cards = [
                {label:'Total Pasien',value:'1.284',color:[0,166,136]},
                {label:'Laki-laki',value:'742',color:[26,86,219]},
                {label:'Perempuan',value:'542',color:[232,121,160]},
                {label:'Kelurahan',value:'31',color:[249,115,22]},
            ];
            const cw = (pw-margin*2-9)/4;
            cards.forEach((c,i) => {
                const cx = margin+i*(cw+3);
                pdf.setFillColor(...c.color);
                pdf.roundedRect(cx,y,cw,16,2,2,'F');
                pdf.setTextColor(255,255,255);
                pdf.setFontSize(6); pdf.setFont('helvetica','normal'); pdf.text(c.label.toUpperCase(),cx+4,y+5);
                pdf.setFontSize(12); pdf.setFont('helvetica','bold'); pdf.text(c.value,cx+4,y+13);
            });
            y += 22;
        }

        const chartSectionMap = [
            {key:'tren',       id:'sectionTren',      label:'TREN KASUS'},
            {key:'wilayah',    id:'sectionWilayah',   label:'DISTRIBUSI WILAYAH'},
            {key:'demografi',  id:'sectionDemografi', label:'DISTRIBUSI DEMOGRAFIS'},
            {key:'pengobatan', id:'sectionPengobatan',label:'STATUS PENGOBATAN'},
            {key:'pengobatan', id:'sectionJK',        label:'JENIS KELAMIN', noLabel:true},
        ];
        const processedLabels = new Set();
        for (const sec of chartSectionMap) {
            if (!sections[sec.key]) continue;
            const el = document.getElementById(sec.id);
            if (!el) continue;
            if (!sec.noLabel && !processedLabels.has(sec.label)) {
                if (y+60>280) { pdf.addPage(); y=margin; }
                pdf.setTextColor(107,122,153); pdf.setFontSize(7); pdf.setFont('helvetica','bold');
                pdf.text(sec.label,margin,y); y+=4;
                processedLabels.add(sec.label);
            }
            try {
                const canvas = await html2canvas(el,{scale:2,useCORS:true,backgroundColor:'#ffffff',logging:false});
                const imgData = canvas.toDataURL('image/png');
                const ratio   = canvas.height/canvas.width;
                const imgW    = pw-margin*2;
                const imgH    = Math.min(imgW*ratio,90);
                if (y+imgH+6>285) { pdf.addPage(); y=margin; }
                pdf.addImage(imgData,'PNG',margin,y,imgW,imgH);
                y += imgH+8;
            } catch(e) { console.warn('Canvas error',e); }
        }

        const pages = pdf.internal.getNumberOfPages();
        for (let i=1;i<=pages;i++) {
            pdf.setPage(i);
            pdf.setFontSize(7); pdf.setFont('helvetica','normal'); pdf.setTextColor(150,160,180);
            pdf.text(`© ${new Date().getFullYear()} Dinas Kesehatan Kota Jember`,margin,292);
            pdf.text(`Hal ${i} / ${pages}`,pw-margin,292,{align:'right'});
        }
        pdf.save(`Laporan_TBC_Jember_${new Date().toISOString().slice(0,10)}.pdf`);
        showToast('PDF berhasil diunduh!','✅',true);
    } catch(err) { console.error(err); showToast('Gagal membuat PDF. Coba lagi.','❌'); }
}

function unduhExcel(sections) {
    showToast('Menyiapkan file Excel...','⏳');
    try {
        const wb = XLSX.utils.book_new();
        if (sections.ringkasan) {
            const ws = XLSX.utils.aoa_to_sheet([
                ['Dashboard Surveilans TBC — Kota Jember'],
                ['Dinas Kesehatan Kota Jember','','',new Date().toLocaleDateString('id-ID')],
                [],['RINGKASAN STATISTIK'],['Metrik','Nilai'],
                ['Total Pasien',1284],['Laki-laki',742],['Perempuan',542],['Kelurahan Terdampak',31],
            ]);
            ws['!merges']=[{s:{r:0,c:0},e:{r:0,c:3}}];
            ws['!cols']=[{wch:28},{wch:16},{wch:16},{wch:20}];
            XLSX.utils.book_append_sheet(wb,ws,'Ringkasan');
        }
        if (sections.tren) {
            const rows=[['Tahun','Jumlah Kasus']];
            trendLabels.forEach((t,i)=>rows.push([t,trendValues[i]]));
            rows.push([],['Bulan','Jumlah Kasus (Tahun Ini)']);
            bulanLabels.forEach((b,i)=>rows.push([b,bulanValues[i]]));
            const ws=XLSX.utils.aoa_to_sheet(rows); ws['!cols']=[{wch:14},{wch:20}];
            XLSX.utils.book_append_sheet(wb,ws,'Tren Kasus');
        }
        if (sections.wilayah) {
            const rows=[['Kelurahan','Jumlah Kasus','% dari Total']];
            const total=kelurahanValues.reduce((a,b)=>a+b,0);
            kelurahanLabels.forEach((k,i)=>rows.push([k,kelurahanValues[i],(kelurahanValues[i]/total*100).toFixed(1)+'%']));
            const ws=XLSX.utils.aoa_to_sheet(rows); ws['!cols']=[{wch:22},{wch:16},{wch:16}];
            XLSX.utils.book_append_sheet(wb,ws,'Distribusi Wilayah');
        }
        if (sections.demografi) {
            const rows=[['Kelompok Usia','Jumlah Pasien','Persentase']];
            usiaLabels.forEach((u,i)=>rows.push([u,usiaValues[i],(usiaValues[i]/totalUsia*100).toFixed(1)+'%']));
            rows.push([],['Jenis Kelamin','Jumlah Pasien','Persentase']);
            rows.push(['Laki-laki',lakiLaki,(lakiLaki/(lakiLaki+perempuan)*100).toFixed(1)+'%']);
            rows.push(['Perempuan',perempuan,(perempuan/(lakiLaki+perempuan)*100).toFixed(1)+'%']);
            const ws=XLSX.utils.aoa_to_sheet(rows); ws['!cols']=[{wch:22},{wch:16},{wch:16}];
            XLSX.utils.book_append_sheet(wb,ws,'Demografi');
        }
        if (sections.pengobatan) {
            const totalP=dalamPengobatan+sembuh+dropOut+meninggal;
            const rows=[
                ['Status Pengobatan','Jumlah Pasien','Persentase'],
                ['Dalam Pengobatan',dalamPengobatan,(dalamPengobatan/totalP*100).toFixed(1)+'%'],
                ['Sembuh',sembuh,(sembuh/totalP*100).toFixed(1)+'%'],
                ['Drop Out',dropOut,(dropOut/totalP*100).toFixed(1)+'%'],
                ['Meninggal',meninggal,(meninggal/totalP*100).toFixed(1)+'%'],
                [],['Total',totalP,'100%'],
            ];
            const ws=XLSX.utils.aoa_to_sheet(rows); ws['!cols']=[{wch:24},{wch:16},{wch:16}];
            XLSX.utils.book_append_sheet(wb,ws,'Status Pengobatan');
        }
        XLSX.writeFile(wb,`Laporan_TBC_Jember_${new Date().toISOString().slice(0,10)}.xlsx`);
        showToast('Excel berhasil diunduh!','✅',true);
    } catch(err) { console.error(err); showToast('Gagal membuat Excel. Coba lagi.','❌'); }
}

</script>

</body>
</html>