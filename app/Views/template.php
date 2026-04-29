<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'RESPIORA'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root { --respi-dark-blue: #102C57; }
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; }
        /* Sidebar Styling */
        .sidebar { 
            width: 250px; 
            height: 100vh; 
            background-color: white; 
            border-right: 1px solid #ddd; 
            position: fixed; 
            left: 0;
            top: 0;
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
        .sidebar a:hover { 
            background-color: #E4EFFF; 
            color: var(--respi-dark-blue); 
        }
        /* Perbaikan Proporsi di Active */
        .sidebar a.active { 
            background-color: var(--respi-dark-blue); 
            color: white; 
            border-radius: 8px; 
        }
        .main-content { 
            margin-left: 250px; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar { 
            background-color: white; 
            padding: 15px 30px; 
            border-bottom: 1px solid #ddd; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            position: sticky; 
            top: 0; 
            z-index: 999; 
        }
        .avatar-circle { 
            width: 42px; 
            height: 42px; 
            background-color: #DDEE84; 
            color: #111; 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 1.1rem; 
            font-weight: 500; 
        }
        .content-body { padding: 30px; flex: 1; }
        /* Utility Classes */
        .header-card { background: linear-gradient(to right, #0a1e3f 0%, #4a82d8 100%); color: white; border-radius: 10px; padding: 25px; margin-bottom: 25px; display: flex; align-items: center; }
        .header-card .icon-box { background: rgba(255,255,255,0.2); width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 15px; }
        .table-container { background: white; border-radius: 10px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .btn-dark-blue { background-color: var(--respi-dark-blue); color: white; }
        .btn-dark-blue:hover { background-color: #0a1e3d; color: white; }
        .cursor-pointer { cursor: pointer; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo text-center">
            <img src="/logo_nama.png" alt="Logo RESPIORA" style="max-width: 160px; height: auto;">
        </div>

        <div class="menu-label">Home</div>
        <a href="#"><i class="fa-solid fa-border-all me-2"></i> Dashboard</a>
        
        <div class="menu-label">Fitur</div>
        <a href="#"><i class="fa-solid fa-map me-2"></i> Peta Sebaran</a>
        <a href="#"><i class="fa-solid fa-chart-line me-2"></i> Kasus</a>
        
        <div class="menu-label">Manajemen Data</div>
        <a href="/pasien" class="active"><i class="fa-solid fa-clipboard-user me-2"></i> Data Pasien</a>
        
        <div class="menu-label">Informasi</div>
        <a href="#"><i class="fa-solid fa-book-open me-2"></i> Artikel</a>
        <a href="#"><i class="fa-regular fa-newspaper me-2"></i> Berita</a>
        <a href="#"><i class="fa-regular fa-user me-2"></i> Profil</a>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div><i class="fa-solid fa-bars fs-4 cursor-pointer text-dark"></i></div>
            <div class="d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold text-dark" style="font-size: 0.95rem; line-height: 1.2;">Rora</div>
                    <small class="text-muted" style="font-size: 0.8rem;">Admin</small>
                </div>
                <div class="avatar-circle">
                    RO
                </div>
            </div>
        </div>

        <div class="content-body">
            <?= $this->renderSection('content'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
