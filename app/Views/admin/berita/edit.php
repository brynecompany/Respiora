<?= $this->extend('layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">Edit Berita</h3>

        <form method="POST"
              action="<?= base_url('admin/berita/update/'.$berita['id_berita']) ?>"
              enctype="multipart/form-data">

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Berita</label>
                <input type="text"
                       name="judul_berita"
                       value="<?= esc($berita['judul_berita']) ?>"
                       class="form-control">
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi_berita"
                          id="deskripsi"
                          class="form-control"
                          rows="5"><?= $berita['deskripsi_berita'] ?></textarea>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status_berita" class="form-select">
                    <option value="Publish"
                        <?= $berita['status_berita'] == 'Publish' ? 'selected' : '' ?>>
                        Publish
                    </option>
                    <option value="Unpublish"
                        <?= $berita['status_berita'] == 'Unpublish' ? 'selected' : '' ?>>
                        Unpublish
                    </option>
                </select>
            </div>

            <!-- Gambar Lama -->
            <?php if (!empty($berita['gambar_berita'])) : ?>
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="<?= base_url('uploads/berita/'.$berita['gambar_berita']) ?>"
                         class="img-thumbnail"
                         width="200">
                </div>
            <?php endif; ?>

            <!-- Upload Baru -->
            <div class="mb-3">
                <label class="form-label">Ganti Gambar</label>
                <input type="file" name="gambar_berita" class="form-control">
            </div>

            <!-- Button -->
            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

        </form>
    </div>
</div>

<!-- Integrasi CKEditor -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    // Menggunakan CKEditor untuk textarea dengan id 'deskripsi'
    CKEDITOR.replace('deskripsi');
</script>

<?= $this->endSection() ?>