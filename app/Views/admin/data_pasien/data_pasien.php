<?= $this->extend('layout/main_layout') ?>
<?= $this->section('content') ?>

<!-- 🔥 TAMBAH ICON BIAR MUNCUL -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid">

    <!-- HEADER -->
    <div class="card mb-4"
         style="background: linear-gradient(90deg,#1e3c72,#4a76b8); border-radius:12px;">
        <div class="card-body text-white d-flex align-items-center">
            <div class="me-3 d-flex align-items-center justify-content-center"
     style="
        width:60px;
        height:60px;
        border-radius:18px;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,0.2);
     ">

    <i class="bi bi-shield-plus"
       style="
            font-size:30px;
            color: #ffffff;
       ">
    </i>

</div>
            <div>
                <h4 class="mb-1">Data Pasien</h4>
                <small>Data Pasien Terdiagnosis TBC</small>
            </div>
        </div>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm" style="border-radius:10px;">
        <div class="card-body">

            <!-- SEARCH & BUTTON -->
            <div class="d-flex align-items-center justify-content-between mb-2">

    <!-- SEARCH -->
    <div class="input-group" style="max-width:600px;">
        <form method="get" action="/admin/data-pasien">
            <div class="input-group" style="max-width:500px;">

                <span class="input-group-text search-icon">
                    <i class="bi bi-search"></i>
                </span>

                <input type="text"
                       name="keyword"
                       class="form-control"
                       placeholder="Cari Pasien (NIK / Nama)"
                       autocomplete="off"
                       value="<?= $keyword ?? '' ?>"
                       onkeypress="if(event.key === 'Enter') this.form.submit();">

            </div>
        </form>
    </div>

    <!-- BUTTON -->
    <div class="d-flex align-items-center">

        <a href="/admin/data-pasien/import"
           class="btn btn-navy me-2">
            <i class="bi bi-upload"></i> Import Data Pasien
        </a>

        <a href="/admin/data-pasien/create"
           class="btn btn-navy">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>

    </div>

</div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>No HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($pasien)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($pasien as $p) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($p['NIK']) ?></td>
                                    <td><?= esc($p['no_rm']) ?></td>
                                    <td><?= esc($p['nama_pasien']) ?></td>
                                    <td><?= esc($p['tempat_lahir']) ?></td>
                                    <td><?= esc($p['tanggal_lahir']) ?></td>
                                    <td><?= esc($p['no_hp']) ?></td>

                                    <td class="text-center">

                                        <!-- DETAIL -->
                                        <a href="/admin/data-pasien/<?= $p['id_pasien'] ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <!-- EDIT -->
                                        <a href="/admin/data-pasien/edit/<?= $p['id_pasien'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <!-- DELETE -->
                                        <a href="javascript:void(0)" 
                                        class="btn btn-sm btn-danger btn-delete" 
                                        data-id="<?= $p['id_pasien'] ?>">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8" class="text-center">
                                    Data pasien belum tersedia
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
<div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted" style="font-size: 14px;">
        Menampilkan <?= count($pasien) ?> dari <?= $pager->getTotal() ?> data
    </div>

    <div>
        <?= $pager->links('default', 'custom_pagination') ?>
    </div>
</div>
<?php if(session()->getFlashdata('success')): ?>
<div id="notif-success" class="notif-box">
    <div class="notif-content">
        <div class="icon">✔</div>
        <div class="text">
            <?= session()->getFlashdata('success') ?>
        </div>
    </div>
</div>
<?php endif; ?>

<style>
/* Container Pagination */
.pagination {
    display: flex;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
    padding: 0;
}

/* Kotak per halaman */
.pagination .page-item {
    border-right: 1px solid #dee2e6;
}

.pagination .page-item:last-child {
    border-right: none;
}

.pagination .page-link {
    padding: 8px 16px;
    color: #4a5568; /* Warna text gelap abu */
    text-decoration: none;
    background: #fff;
    border: none; /* Border sudah di handle parent */
    font-size: 14px;
    display: block;
    transition: all 0.2s;
}

/* Hover effect */
.pagination .page-link:hover {
    background: #f8f9fa;
    color: #1e3c72;
}

/* Saat Aktif (Halaman yang dipilih) */
.pagination .page-item.active .page-link {
    background: #e2e8f0; /* Warna abu-abu muda sesuai gambar */
    color: #2d3748;
    font-weight: 600;
}
.btn-navy {
    background: #1e3c72;
    color: white;
    border: none;
}

.btn-navy:hover {
    background: #162d56;
    color: white;
}
.search-icon {
    background: #1e3c72;
    color: white;
    border: none;
}

/* biar nyatu */
.input-group-text {
    border-right: none;
}

.form-control {
    border-left: none;
}
    .modal-hapus {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.25);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal-box {
    background: #fff;
    padding: 35px 30px;
    border-radius: 20px;
    text-align: center;
    width: 380px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    animation: popIn 0.3s ease;
}

.modal-box .icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 5px solid #e53935;
    color: #e53935;
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}

.btn-batal {
    background: #e0e0e0; 
    color: #333; 
    border: 1px solid #bab5b5; 
    padding: 8px 22px;
    border-radius: 8px !important;
     margin-right: 10px;
}

.btn-batal:hover {
    background: #d5d5d5;
}

.btn-hapus {
    background: #e53935;
    color: white;
    border: 1px solid #d32f2f; /* 🔥 biar balance */
    padding: 8px 22px;
    border-radius: 8px;
    margin-left: 10px;
}

@keyframes popIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
.notif-box {
    position: fixed;
    top: 80px;
    right: 30px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    padding: 20px 25px;
    z-index: 9999;
    animation: slideIn 0.4s ease;
}

.notif-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.notif-content .icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #1e2a5a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #1e2a5a;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function(){

    let modal = document.getElementById('modalHapus');
    let form = document.getElementById('formHapus');

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();

            let id = this.getAttribute('data-id');

            form.action = "/admin/data-pasien/delete/" + id;

            modal.style.display = 'flex';
        });
    });

    document.getElementById('btnBatal').addEventListener('click', function(){
        modal.style.display = 'none';
    });

    modal.addEventListener('click', function(e){
        if(e.target === modal){
            modal.style.display = 'none';
        }
    });

});
// 🔥 NOTIF AUTO HILANG
document.addEventListener("DOMContentLoaded", function(){

    const notif = document.getElementById('notif-success');

    if(notif){
        setTimeout(() => {
            notif.style.opacity = '0';
            notif.style.transform = 'translateX(50px)';

            setTimeout(() => notif.remove(), 300);
        }, 3000); // ⏱ 3 detik
    }

});
</script>
<!-- MODAL HAPUS -->
<div id="modalHapus" class="modal-hapus">
    <div class="modal-box">
        <div class="icon">!</div>
        <h5>Yakin ingin menghapus data ini?</h5>

        <div class="btn-group">
            <button id="btnBatal" class="btn btn-batal">Batal</button>

            <form id="formHapus" method="post">
                <button type="submit" class="btn btn-hapus">
                    Ya , Hapus !
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>  