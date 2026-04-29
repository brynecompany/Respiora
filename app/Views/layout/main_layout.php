<?php  
$uri = service('uri'); 
$segment = $uri->getSegment(1);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>RESPIORA</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root { --respi-dark-blue: #102C57; }

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f6f9;
    overflow-x: hidden;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    height: 100vh;
    background: #fff;
    border-right: 1px solid #ddd;
    position: fixed;
    top: 0;
    left: 0;
    transition: 0.3s;
}

/* CONTENT */
.content {
    padding: 15px 20px;
    
}

/* LOGO FLEX (SEJAJAR) */
.logo {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 20px;
}

/* logo kecil (icon) */
.logo-icon {
    width: 40px;
}

/* logo tulisan */
.logo-text {
    width: 120px;
    transition: 0.3s;
}

/* saat sidebar collapse */
.sidebar.hide .logo {
    justify-content: center;
}

.sidebar.hide .logo-text {
    display: none;
}

/* menu title */
.menu-title {
    font-size: 12px;
    color: #6c757d;
    margin: 20px 20px 10px;
    font-weight: bold;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
}

.sidebar-menu li a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    margin: 2px 15px;
    border-radius: 8px;
    color: #495057;
    text-decoration: none;
    transition: 0.2s;
    margin-top: 5px;
}

.sidebar-menu li a:hover {
    background-color: #E4EFFF;
    color: var(--respi-dark-blue);
}

.sidebar-menu li.active a {
    background-color: var(--respi-dark-blue);
    color: white;
}

/* MAIN */
.main {
    margin-left: 250px;
    width: calc(100% - 250px);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    transition: 0.3s;
}

/* TOPBAR */
.topbar {
    background: white;
    padding: 10px 25px;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.menu-toggle {
    font-size: 20px;
    cursor: pointer;
}

/* USER */
.user-info {
    display: flex;
    align-items: center;
    text-align: right;
    gap: 15px;
    cursor: pointer;
}

.user-info img {
    width: 40px;
    border-radius: 50%;
}

/* FIX ROW BIAR GA OVERFLOW - layl*/
.row {
    margin-left: 0px;
    margin-right: 0px;
}

/* COLLAPSE */
.sidebar.hide {
    width: 70px;
}

.main.full {
    margin-left: 70px;
    width: calc(100% - 70px);
}

.sidebar.hide .menu-title,
.sidebar.hide span {
    display: none;
}

.sidebar.hide a {
    justify-content: center;
    margin-top: 20px;
}

/* FIX MAP & KOMPAS */
#map {
    width: 100%;
    height: 60vh;
    min-height: 400px;
}

.compass-wrapper {
    width: 80px;
    height: 80px;
}

.compass-wrapper svg {
    width: 100%;
    height: 100%;
}

.map-container {
    overflow: hidden;
}

.leaflet-control {
    transform: scale(0.8);
}

/* POPUP PROFIL */
.profile-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
    align-items: flex-start;
    justify-content: flex-end;
    padding: 5px 5px;
    background: rgba(0,0,0,0.2);
    z-index: 999;
}

.profile-card {
    background: white;
    width: 350px;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    animation: slideIn 0.3s ease;
}

/* TITLE */
.popup-title {
    font-weight: bold;
    margin-bottom: 20px;
}

/* HEADER */
.profile-header {
    display: flex;
    align-items: center;
    gap: 15px;
}

.profile-avatar {
    width: 70px;
    border-radius: 50%;
}

/* BUTTON AKUN */
.btn-akun {
    display: flex;
    align-items: center;
    gap: 10px;
    border: 2px solid #2563eb;
    border-radius: 10px;
    padding: 10px;
    margin-top: 20px;
    text-decoration: none;
    color: #2563eb;
    font-weight: 500;
    justify-content: center;
}

.btn-akun:hover {
    background: #2563eb;
    color: white;
}

/* BUTTON LOGOUT */
.btn-logout {
    width: 100%;
    margin-top: 15px;
    padding: 10px;
    border: none;
    background: #e11d1d;
    color: white;
    border-radius: 10px;
    font-weight: bold;
}

/* ANIMASI */
@keyframes slideIn {
    from {
        transform: translateY(-20px) translateX(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0) translateX(0);
        opacity: 1;
    }
}
</style>

<?= $this->renderSection('style') ?>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <!-- LOGO DIGANTI JADI 2 GAMBAR (SEJAJAR) -->
    <div class="logo">
        <img src="<?= base_url('assets/images/logo1.png') ?>" class="logo-icon">
        <img src="<?= base_url('assets/images/logo2.png') ?>" class="logo-text">
    </div>

    <div class="menu-title">HOME</div>
    <ul class="sidebar-menu">
        <li class="<?= ($segment == '' || $segment == 'dashboard') ? 'active' : '' ?>">
            <a href="<?= base_url('/dashboard') ?>">
                <i class="fa-solid fa-border-all"></i>
                <span>Dashboard</span>
            </a>
        </li>
    </ul>

    <div class="menu-title">FITUR</div>
    <ul class="sidebar-menu">
        <li class="<?= ($segment == 'peta_view') ? 'active' : '' ?>">
            <a href="<?= base_url('/peta_view') ?>">
                <i class="fa-solid fa-map"></i>
                <span>Peta Sebaran</span>
            </a>
        </li>

        <li class="<?= ($segment == 'kasus') ? 'active' : '' ?>">
            <a href="<?= base_url('/kasus') ?>">
                <i class="fa-solid fa-chart-line"></i>
                <span>Kasus</span>
            </a>
        </li>
    </ul>

    <div class="menu-title">MANAJEMEN DATA</div>
    <ul class="sidebar-menu">
        <li class="<?= ($segment == 'pasien') ? 'active' : '' ?>">
            <a href="<?= base_url('/admin/data-pasien') ?>">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Data Pasien</span>
            </a>
        </li>

        <li class="<?= ($segment == 'user') ? 'active' : '' ?>">
            <a href="<?= base_url('/user') ?>">
                <i class="fa-solid fa-users"></i>
                <span>User</span>
            </a>
        </li>

    </ul>

    <div class="menu-title">INFORMASI</div>
    <ul class="sidebar-menu">
        <li class="<?= ($segment == 'artikel') ? 'active' : '' ?>">
            <a href="<?= base_url('/admin/artikel') ?>">
                <i class="fa-solid fa-book-open"></i>
                <span>Artikel</span>
            </a>
        </li>

        <li class="<?= ($segment == 'berita') ? 'active' : '' ?>">
            <a href="<?= base_url('/admin/berita') ?>">
                <i class="fa-regular fa-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>

        <li class="<?= ($segment == 'profil') ? 'active' : '' ?>">
            <a href="<?= base_url('/profil') ?>">
                <i class="fa-regular fa-user"></i>
                <span>Profil</span>
            </a>
        </li>
    </ul>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>

        <!-- klik user -->
        <div class="user-info" id="openProfile">
            <div>
                <strong><?= session()->get('username'); ?></strong><br>
                <small><?= session()->get('role'); ?></small>
            </div>
            <img src="https://i.pravatar.cc/40">
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

</div>

<!-- POPUP -->
<div class="profile-modal" id="profileModal">
    <div class="profile-card">

        <h5 class="popup-title">Profil Pengguna</h5>

        <div class="profile-header">
            <img src="https://i.pravatar.cc/100" class="profile-avatar">
            <div>
                <h6><?= session()->get('username'); ?></h6>
                <small><?= session()->get('role'); ?></small>
            </div>
        </div>

        <hr>

        <a href="<?= base_url('profil') ?>" class="btn-akun">
            <i class="fa-solid fa-user"></i> Akun Saya
        </a>

        <button class="btn-logout">
            Keluar <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </button>

    </div>
</div>

<script>
const toggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');
const main = document.querySelector('.main');

toggle.addEventListener('click', () => {
    sidebar.classList.toggle('hide');
    main.classList.toggle('full');
});

/* POPUP */
const profileBtn = document.getElementById('openProfile');
const modal = document.getElementById('profileModal');

profileBtn.addEventListener('click', () => {
    modal.style.display = 'flex';
});

modal.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->renderSection('script') ?>
</body>
</html>