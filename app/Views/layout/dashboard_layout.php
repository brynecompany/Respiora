<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Respiora</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f6fa;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px 15px;
            border-right: 1px solid #eee;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .sidebar .logo img {
            width: 40px;
            margin-right: 10px;
        }

        .sidebar h6 {
            font-size: 12px;
            font-weight: 700;
            color: #888;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border-radius: 10px;
            color: #555;
            text-decoration: none;
            margin-bottom: 5px;
            transition: 0.2s;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar a:hover {
            background: #f1f3f9;
        }

        .sidebar a.active {
            background: #1e2a5a;
            color: #fff;
        }

        /* CONTENT */
        .content {
            margin-left: 240px;
            padding: 25px;
        }
    </style>
    <style>
.step {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #eaeaea;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.step.active {
    background: #1e2a5a;
    color: white;
}

.line-step {
    width: 80px;
    height: 2px;
    background: #ccc;
    margin: 0 15px;
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <!-- LOGO -->
    <div class="logo">
        <img src="https://cdn-icons-png.flaticon.com/512/3063/3063822.png">
        <h5 class="mb-0 fw-bold text-primary">RESPIORA</h5>
    </div>

    <!-- MENU -->
    <h6>HOME</h6>
    <a href="#">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <h6>FITUR</h6>
    <a href="#">
        <i class="bi bi-map"></i> Peta Sebaran
    </a>
    <a href="#">
        <i class="bi bi-graph-up"></i> Kasus
    </a>

    <h6>MANAJEMEN DATA</h6>
    <a href="/admin/data_pasien" class="active">
        <i class="bi bi-clipboard-data"></i> Data Pasien
    </a>

    <h6>INFORMASI</h6>
    <a href="#">
        <i class="bi bi-book"></i> Artikel
    </a>
    <a href="#">
        <i class="bi bi-file-earmark-text"></i> Berita
    </a>
    <a href="#">
        <i class="bi bi-person"></i> Profil
    </a>

</div>

<!-- CONTENT -->
<div class="content">
    <?= $this->renderSection('content') ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>