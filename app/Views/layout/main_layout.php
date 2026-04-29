<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard</title>
    <?= $this->renderSection('style') ?>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        /* SIDEBAR */
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
            padding: 8px;
            border-radius: 6px;
        }

        .sidebar a:hover {
            background: #1d3b6b;
        }

        /* NAVBAR */
        .navbar {
            margin-left: 220px;
            background: white;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* CONTENT */
        .main {
            margin-left: 240px;
            padding: 20px;
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
    <!-- Render Content Section -->
    <?= $this->renderSection('content') ?>
</div>

<!-- Render Scripts (for JS, Chart.js, etc.) -->
<?= $this->renderSection('script') ?>

</body>
</html>