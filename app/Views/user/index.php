<?= $this->extend('layout/main_layout') ?>

<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid">

    <!-- HEADER -->
    <div class="header-user">
    <div class="header-icon">
        <img src="/assets/img/icon_breadcrumb.svg" alt="Icon User">
    </div>
    <div>
        <h5>Manajemen User</h5>
        <small>Kelola data pengguna sistem</small>
    </div>
    </div>

    <!-- ALERT SUKSES -->
    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <!-- CARD -->
    <div class="card shadow-sm" style="border-radius:10px;">
        <div class="card-body">

            <!-- SEARCH -->
            <div class="d-flex justify-content-between mb-3">
                <form method="get" action="/user" style="max-width:500px;">
                    <div class="input-group">
                        <span class="input-group-text search-icon">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="keyword" class="form-control" placeholder="Cari username / email" value="<?= $keyword ?? '' ?>">
                    </div>
                </form>

                <a href="/user/create" class="btn btn-navy">
                    <i class="bi bi-plus-circle"></i> Tambah Data
                </a>
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $u) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($u['role']) ?></td>
                                    <td><?= esc($u['email']) ?></td>
                                    <td><?= esc($u['username']) ?></td>
                                    <td class="text-center">
                                        <a href="/user/view/<?= $u['id_user'] ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="/user/edit/<?= $u['id_user'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-delete" data-id="<?= $u['id_user'] ?>" data-name="<?= esc($u['username']) ?>">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    Data user belum tersedia
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- MODAL HAPUS -->
<div id="modalHapus" class="modal-hapus" style="display:none;">
    <div class="modal-box">
        <div class="icon">!</div>
        <h5>Yakin ingin menghapus data ini?</h5>

        <div class="btn-group">
            <button id="btnBatal" class="btn btn-batal">Batal</button>
            <form id="formHapus" method="post">
                <?= csrf_field() ?> <!-- ✅ TAMBAHAN -->
                <button type="submit" class="btn btn-hapus">
                    Ya, Hapus!
                </button>
            </form>
        </div>
    </div>
</div>

<!-- PAGINATION -->
<div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted" style="font-size: 14px;">
        Menampilkan <?= count($users) ?> dari <?= $pager->getTotal() ?> data
    </div>

    <div>
        <?= $pager->links('default', 'custom_pagination') ?>
    </div>
</div>

<!-- STYLE -->
<style>
/* header */
.header-user {
    display: flex;
    align-items: center;
    gap: 15px;
    background: linear-gradient(90deg, #081F5C, #5E9ADF);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.header-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

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
    background: #081F5C;
    color: white;
}

.btn-navy:hover {
    background: #061944;
    color: white;
}

.search-icon {
    background: #081F5C;
    color: white;
}

.input-group-text {
    border-right: none;
}

.form-control {
    border-left: none;
}

/* Modal Styling */
.modal-hapus {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.25);
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
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
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
    border: 1px solid #c2c2c2;
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
    border: 1px solid #d32f2f;
    padding: 8px 22px;
    border-radius: 8px;
    margin-left: 10px;
}

@keyframes popIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const modal = document.getElementById("modalHapus");
    const form = document.getElementById("formHapus");

    // Ketika tombol hapus ditekan
    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function(e) {
            e.preventDefault();

            // Ambil ID user yang akan dihapus
            const userId = this.getAttribute("data-id");
            const deleteUrl = `/user/delete/${userId}`;

            // ✅ FIX: action dipindah ke sini
            form.action = deleteUrl;

            // Tampilkan modal
            modal.style.display = "flex";
        });
    });

    // Tombol batal
    document.getElementById("btnBatal").addEventListener("click", function() {
        modal.style.display = "none";
    });

    // Klik luar modal
    modal.addEventListener("click", function(e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

});
</script>

<?= $this->endSection() ?>