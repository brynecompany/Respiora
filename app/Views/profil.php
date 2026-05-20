<?= $this->extend('layout/main_layout') ?>

<?= $this->section('style') ?>
<style>

/* HEADER */
.header-profil { 
    display: flex;
    align-items: center;
    gap: 15px;
    background: linear-gradient(90deg, #081F5C, #5E9ADF);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
}

.header-icon img {
    width: 40px;
    height: 40px;
}

/* CARD */
.profile-card {
    background: white;
    border-radius: 10px;
    padding: 30px;
    margin-top: 20px;
    width: 100%;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.profile-content {
    max-width: 400px;
    margin: 0 auto;
    text-align: center;
}

.avatar {
    width: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.form-box {
    text-align: left;
    margin-top: 20px;
}

.form-control {
    margin-bottom: 15px;
    border-radius: 8px;
}

/* BUTTON UTAMA */
.btn-main {
    background: #081F5C;
    color: white;
    border-radius: 8px;
    border: none;
}

/* HOVER */
.btn-main:hover {
    background: #081F5C;
    color: white;
}

/* KLIK */
.btn-main:active {
    background: #081F5C !important;
    color: white !important;
}

/* FOCUS */
.btn-main:focus {
    background: #081F5C !important;
    color: white !important;
    box-shadow: none !important;
    outline: none !important;
}

/* SUPER OVERRIDE: MATIKAN SEMUA TRANSISI & ANIMASI */
*,
*::before,
*::after {
    transition: none !important;
    animation: none !important;
}

/* HAPUS EFEK BOOTSTRAP */
.btn,
.btn:focus,
.btn:active {
    box-shadow: none !important;
    outline: none !important;
}

/* INPUT FOCUS */
.form-control:focus {
    box-shadow: none !important;
    outline: none !important;
}

/* HAPUS TAP EFFECT */
* {
    -webkit-tap-highlight-color: transparent !important;
}

/* placeholder titik hitam */
.form-control::placeholder {
    color: black;
    opacity: 1;
}

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- HEADER -->
<div class="header-profil">
    <div class="header-icon">
        <img src="/assets/img/icon_breadcrumb.svg">
    </div>
    <div>
        <h5>Profil</h5>
        <small>Menampilkan Profil Anda</small>
    </div>
</div>

<!-- CARD -->
<div class="profile-card">
    <div class="profile-content">

        <img src="<?= base_url('assets/images/profil.png') ?>" class="avatar">

        <h6><?= session()->get('username'); ?></h6>

        <!-- NOTIF -->
        <?php if(session()->getFlashdata('success')): ?>
            <div style="color: green; margin-bottom:10px;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div style="color: red; margin-bottom:10px;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="form-box">

            <form action="<?= base_url('profil/update-pass') ?>" method="post">

                <!-- USERNAME -->
                <label>Username</label>
                <input type="text" name="username"
                       class="form-control"
                       value="<?= session()->get('username'); ?>" readonly>

                <!-- PASSWORD -->
                <label>Kata Sandi</label>
                <input type="password" name="password"
                       class="form-control"
                       placeholder="••••••••">

                <button class="btn btn-main w-100 mt-2">
                    Ubah Kata Sandi
                </button>

            </form>

        </div>

    </div>
</div>

<?= $this->endSection() ?>