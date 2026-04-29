<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'RESPIORA'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root { --respi-dark-blue: #102C57; }
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: white;
            border-right: 1px solid #ddd;
            position: fixed;
            left: 0; top: 0;
            z-index: 1000;
        }
        .sidebar .logo { font-weight: bold; font-size: 1.2rem; padding: 20px; border-bottom: 1px solid #ddd; }
        .sidebar .menu-label { font-size: 0.75rem; color: #6c757d; font-weight: bold; margin: 20px 20px 10px; text-transform: uppercase; }
        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #495057;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            border-radius: 8px;
            margin: 2px 15px;
        }
        .sidebar a:hover { background-color: #E4EFFF; color: var(--respi-dark-blue); }
        .sidebar a.active { background-color: var(--respi-dark-blue); color: white; border-radius: 8px; }

        /* ===== LAYOUT ===== */
        .main-content { margin-left: 250px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar {
            background-color: white;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky; top: 0;
            z-index: 999;
        }
        .avatar-circle {
            width: 42px; height: 42px;
            background-color: #DDEE84;
            color: #111;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; font-weight: 500;
        }
        .content-body { padding: 30px; flex: 1; }

        /* ===== UTILITY ===== */
        .header-card {
            background: linear-gradient(to right, #0a1e3f 0%, #4a82d8 100%);
            color: white; border-radius: 10px; padding: 25px;
            margin-bottom: 25px; display: flex; align-items: center;
        }
        .header-card .icon-box {
            background: rgba(255,255,255,0.2);
            width: 50px; height: 50px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; margin-right: 15px;
        }
        .cursor-pointer { cursor: pointer; }

        /* ===== CHART CARD ===== */
        .chart-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        .chart-header h5 {
            font-weight: 700;
            color: #102C57;
            margin: 0;
        }
        .btn-toggle button {
            padding: 7px 20px;
            border-radius: 20px;
            border: 1.5px solid #102C57;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            background: transparent;
            color: #102C57;
            margin-left: 8px;
            transition: all 0.2s;
        }
        .btn-toggle button.active {
            background: #102C57;
            color: white;
        }
        .btn-toggle button:hover:not(.active) {
            background: #E4EFFF;
        }
    </style>
</head>
<body>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">
    <div class="logo text-center">
        <img src="/logo_nama.png" alt="Logo RESPIORA" style="max-width: 160px; height: auto;">
    </div>

    <div class="menu-label">Home</div>
    <a href="#" class="active"><i class="fa-solid fa-border-all me-2"></i> Dashboard</a>

    <div class="menu-label">Fitur</div>
    <a href="#"><i class="fa-solid fa-map me-2"></i> Peta Sebaran</a>
    <a href="#"><i class="fa-solid fa-chart-line me-2"></i> Kasus</a>

    <div class="menu-label">Manajemen Data</div>
    <a href="/pasien"><i class="fa-solid fa-clipboard-user me-2"></i> Data Pasien</a>

    <div class="menu-label">Informasi</div>
    <a href="#"><i class="fa-solid fa-book-open me-2"></i> Artikel</a>
    <a href="#"><i class="fa-regular fa-newspaper me-2"></i> Berita</a>
    <a href="#"><i class="fa-regular fa-user me-2"></i> Profil</a>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="main-content">

    <!-- Topbar -->
    <div class="topbar">
        <div><i class="fa-solid fa-bars fs-4 cursor-pointer text-dark"></i></div>
        <div class="d-flex align-items-center">
            <div class="text-end me-3">
                <div class="fw-bold text-dark" style="font-size: 0.95rem; line-height: 1.2;">Rora</div>
                <small class="text-muted" style="font-size: 0.8rem;">Admin</small>
            </div>
            <div class="avatar-circle">RO</div>
        </div>
    </div>

    <!-- Content Body -->
    <div class="content-body">

        <!-- Header Banner -->
        <div class="header-card">
            <div class="icon-box"><i class="fa-solid fa-chart-line"></i></div>
            <div>
                <h5 class="mb-1 fw-bold">Dashboard</h5>
                <small>Selamat datang di RESPIORA — Sistem Pemantauan TBC</small>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-card">
            <div class="chart-header">
                <h5><i class="fa-solid fa-chart-area me-2"></i>Tren Kasus TBC</h5>
                <div class="btn-toggle">
                    <button id="btnTahunan" class="active">Tahunan</button>
                    <button id="btnBulanan">Bulanan</button>
                </div>
            </div>
            <canvas id="tbChart" height="100"></canvas>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    <script>
    const tahunan = <?= json_encode($tahunan ?? []) ?>;
    const bulanan = <?= json_encode($bulanan ?? []) ?>;

    // Aman dari error
    const tahunanLabels = tahunan.map(d => d.tahun ?? '');
    const tahunanData   = tahunan.map(d => d.jumlah ?? 0);

    const bulananLabels = bulanan.map(d => {
        if (!d.bulan) return '';
        return new Date(0, d.bulan - 1).toLocaleString('id-ID', { month: 'long' });
    });

    const bulananData = bulanan.map(d => d.jumlah ?? 0);

    const ctx = document.getElementById('tbChart').getContext('2d');

    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: tahunanLabels,
            datasets: [{
                label: 'Jumlah Kasus',
                data: tahunanData,
                borderColor: '#102C57',
                backgroundColor: 'rgba(16, 44, 87, 0.08)',
                tension: 0.4,
                fill: true
            }]
        }
    });

    document.getElementById('btnTahunan').onclick = function () {
        chart.data.labels = tahunanLabels;
        chart.data.datasets[0].data = tahunanData;
        chart.update();
    };

    document.getElementById('btnBulanan').onclick = function () {
        chart.data.labels = bulananLabels;
        chart.data.datasets[0].data = bulananData;
        chart.update();
    };
</script>
</body>
</html>