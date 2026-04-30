<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Admin</h5>
                    <img src="<?= base_url('assets/admin_icon.png') ?>" alt="Admin Icon" class="img-fluid" width="100">
                    <p class="card-text">
                        Admin bertanggung jawab dalam pengelolaan data kasus TBC, pembaruan status pasien, serta pemantauan wilayah penyebaran penyakit melalui RESPIORA.
                    </p>
                    <!-- Tombol untuk admin -->
                    <a href="<?= base_url('admin/artikel') ?>" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kepala Puskesmas</h5>
                    <img src="<?= base_url('assets/kapus_icon.png') ?>" alt="Kapus Icon" class="img-fluid" width="100">
                    <p class="card-text">
                        Kepala Puskesmas memiliki akses untuk memantau indikator program TBC, melihat tren kasus, evaluasi wilayah risiko, serta laporan kinerja pengendalian TBC.
                    </p>
                    <!-- Tombol untuk Kepala Puskesmas -->
                    <a href="<?= base_url('kapus/artikel') ?>" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>