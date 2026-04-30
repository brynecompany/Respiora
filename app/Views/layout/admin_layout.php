<!DOCTYPE html>
<html>
<head>
    <title>Respiora Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
:root{
    --primary:#102C57;
    --primary-light:#4a82d8;
}

body{
    margin:0;
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    top:0;
    left:0;
    background:#ffffff;
    border-right:1px solid #eaeaea;
    padding-top:15px;
}

.sidebar .logo{
    text-align:center;
    padding:15px 20px 25px;
    border-bottom:1px solid #f0f0f0;
}

.sidebar .logo img{
    max-width:160px;
}

.sidebar small{
    display:block;
    font-size:11px;
    color:#8c8c8c;
    font-weight:600;
    margin:20px 20px 8px;
    text-transform:uppercase;
}

.sidebar a{
    display:flex;
    align-items:center;
    padding:10px 18px;
    margin:5px 15px;
    border-radius:10px;
    color:#555;
    text-decoration:none;
    font-size:14px;
    transition:.2s;
}

.sidebar a i{
    margin-right:10px;
}

.sidebar a:hover{
    background:#e6efff;
    color:var(--primary);
}

.sidebar a.active{
    background:var(--primary);
    color:#fff;
    font-weight:500;
}

/* ===== TOPBAR ===== */
.topbar{
    margin-left:250px;
    height:65px;
    background:#ffffff;
    border-bottom:1px solid #eaeaea;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
}

.avatar-img{
    width:38px;
    height:38px;
    border-radius:50%;
    object-fit:cover;
}

/* ===== CONTENT ===== */
.content{
    margin-left:250px;
    padding:30px;
}

/* ===== HEADER CARD ===== */
.header-card {
    background: linear-gradient(to right, #0a1e3f 0%, #4a82d8 100%);
    color: white;
    padding: 25px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}
.icon-box {
    background: rgba(255,255,255,0.15);
    width: 55px;
    height: 55px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}

.header-card .icon-box{
    width:60px;
    height:60px;
    border-radius:15px;
    background:rgba(255,255,255,0.15);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    margin-right:18px;
}

.search-input:focus {
    box-shadow: none;
    border-color: #ced4da;
}

.search-icon-btn {
    width: 60px;
    background: #102C57;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
    color: white;
    font-size: 18px;
    cursor: pointer;
}

.search-icon-btn:hover {
    background: #0a1e3f;
}

.filter-btn {
    width: 50px;
    height: 50px;
    border: 2px solid #102C57;
    background: white;
    border-radius: 15px;
    color: #102C57;
    font-size: 18px;
}
.search-modern{
    display:flex;
    align-items:center;
    height:52px;
    border-radius:30px;
    background:#f8f9fb;
    overflow:hidden;
    border:1px solid #e0e0e0;
}

.search-btn{
    width:60px;
    height:52px;
    background:#102C57;
    border:none;
    color:white;
    font-size:18px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.search-field{
    width:420px;
    border:none;
    background:transparent;
    padding:0 20px;
    font-size:15px;
    outline:none;
}

.search-field::placeholder{
    color:#9aa0a6;
}

.filter-modern{
    width:52px;
    height:52px;
    border-radius:18px;
    border:2px solid #102C57;
    background:white;
    color:#102C57;
    font-size:18px;
}

.custom-toast {
    position: fixed;
    top: 25px;
    right: 25px;
    background: #ffffff;
    padding: 18px 22px;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 14px;
    z-index: 99999; /* WAJIB tinggi */
    animation: slideInRight 0.4s ease;
    min-width: 280px;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(80px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.switch {
    width: 42px;
    height: 22px;
    background: #dcdcdc;
    border-radius: 20px;
    position: relative;
    transition: 0.3s ease;
    display: flex;
    align-items: center;
    padding: 3px;
    cursor: pointer;
}

.switch-circle {
    width: 16px;
    height: 16px;
    background: #ffffff;
    border-radius: 50%;
    transition: 0.3s ease;
}

.switch.active {
    background: #1e3c72;
}

.switch.active .switch-circle {
    transform: translateX(20px);
}

.custom-switch {
    width: 46px;
    height: 24px;
    background: #dcdcdc;
    border-radius: 20px;
    position: relative;
    cursor: pointer;
    transition: 0.3s ease;
    display: flex;
    align-items: center;
    padding: 3px;
}

.custom-switch .switch-circle {
    width: 18px;
    height: 18px;
    background: white;
    border-radius: 50%;
    transition: 0.3s ease;
}

.custom-switch.active {
    background: #1e3c72; /* biru */
}

.custom-switch.active .switch-circle {
    transform: translateX(22px);
}

#toggleSwitch {
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
}

.mini-switch {
    width: 60px;
    height: 30px;
    background-color: #ddd;
    border-radius: 50px;
    cursor: pointer;
    position: relative;
    transition: background-color 0.3s ease;
}

.mini-switch.active {
    background-color: #4caf50;  /* Warna hijau saat aktif (Publish) */
}

.mini-circle {
    width: 24px;
    height: 24px;
    background-color: white;
    border-radius: 50%;
    position: absolute;
    top: 3px;
    left: 3px;
    transition: transform 0.3s ease;
}

.mini-switch.active .mini-circle {
    transform: translateX(30px);  /* Geser tombol ke kanan saat status Publish */
}

.mini-switch.inactive .mini-circle {
    transform: translateX(0);  /* Geser tombol ke kiri saat status Unpublish */
}

.mini-switch.inactive {
    background-color: #3656f4;  /* Warna merah saat tidak aktif (Unpublish) */
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo text-center">
    <img src="<?= base_url('assets/logo_respiora.png') ?>" 
        alt="Logo RESPIORA" 
        style="max-width:160px; height:auto;">
    </div>

    <small>Home</small>
    <a href="#"><i class="bi bi-grid"></i>Dashboard</a>

    <small>Fitur</small>
    <a href="#"><i class="bi bi-map"></i>Peta Sebaran</a>
    <a href="#"><i class="bi bi-graph-up"></i>Kasus</a>

    <small>Manajemen Data</small>
    <a href="#"><i class="bi bi-person-lines-fill"></i>Data Pasien</a>

    <small>Informasi</small>
    <a href="<?= base_url('admin/artikel') ?>"
       class="<?= str_contains(uri_string(),'admin/artikel') ? 'active' : '' ?>">
        <i class="bi bi-journal-text"></i>Artikel
    </a>

    <a href="<?= base_url('admin/berita') ?>" 
        class="sidebar-link <?= uri_string() == 'admin/berita' ? 'active' : '' ?>">
        <i class="bi bi-newspaper"></i>Berita
    </a>
    <a href="#"><i class="bi bi-person"></i>Profil</a>

</div>

<!-- TOPBAR -->
<div class="topbar">

    <i class="bi bi-list fs-4"></i>

    <div class="d-flex align-items-center">
        <div class="text-end me-3">
            <div style="font-size:14px;font-weight:600;">Rora</div>
            <small style="color:#888;">Admin</small>
        </div>

        <img src="<?= base_url('uploads/profile/admin.jpg') ?>" class="avatar-img">
    </div>

</div>

<!-- CONTENT -->
<div class="content">
    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<?php if (session()->getFlashdata('success')) : ?>
<div id="toastSuccess" class="custom-toast">
    <div style="font-size:24px; color:#1e3c72;">
        <i class="bi bi-check-circle-fill"></i>
    </div>
    <div style="font-weight:500;">
        <?= session()->getFlashdata('success') ?>
    </div>
</div>
<?php endif; ?>

<script>
setTimeout(function() {
    let toast = document.getElementById("toastSuccess");
    if (toast) {
        toast.style.opacity = "0";
        toast.style.transform = "translateX(50px)";
        setTimeout(() => toast.remove(), 300);
    }
}, 3000);

public function roleSelection()
{
    return view('auth/role_selection');  // View with the role selection UI
}

public function setRole()
{
    $role = $this->request->getPost('role');
    session()->set('role', $role);  // Set the user role in session
    if ($role == 'Admin') {
        return redirect()->to('/admin/dashboard');
    } else {
        return redirect()->to('/kapus/dashboard');
    }
}
</script>


</body>
</html>