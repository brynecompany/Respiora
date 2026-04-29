<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #102C57;
            color: white;
            position: fixed;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            margin: 10px 0;
            text-decoration: none;
        }

        .main {
            margin-left: 240px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h3>MENU</h3>
    <a href="<?= base_url('kasus') ?>">Kasus</a>
</div>

<div class="navbar">
    <b>Dashboard Monitoring</b>
</div>

<div class="main">
    <!-- Tempat konten dari index.php akan tampil -->
    <?= $this->renderSection('content') ?>
</div>

<!-- Tempat script (seperti Chart.js) akan muncul -->
<?= $this->renderSection('script') ?>

</body>
</html>