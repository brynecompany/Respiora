<?= $this->extend('layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="header-card mb-4 d-flex align-items-center">

    <!-- ICON BOX -->
    <div class="me-3"
         style="width:65px; height:65px;
                background: rgba(255,255,255,0.15);
                border-radius:18px;
                display:flex;
                align-items:center;
                justify-content:center;">

        <i class="bi bi-shield-plus text-white" style="font-size:30px;"></i>
    </div>

    <!-- TEXT -->
    <div>
        <h4 class="mb-1">berita</h4>
        <small>Menampilkan list data berita</small>
    </div>

</div>

<div class="d-flex justify-content-between align-items-center mb-4">

    <!-- KIRI: SEARCH + FILTER -->
<div class="search-wrapper d-flex align-items-center gap-3">

    <form method="GET" action="<?= base_url('admin/berita') ?>"
          class="search-modern">

        <button type="submit" class="search-btn">
            <i class="bi bi-search"></i>
        </button>

        <input type="text"
               name="search"
               value="<?= $keyword ?? '' ?>"
               placeholder="Cari sesuatu..."
               class="search-field">

    </form>

<button class="filter-modern"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#filterModal">
    <i class="bi bi-sliders"></i>
</button>

</div>

    <!-- KANAN: TAMBAH DATA -->
    <a href="<?= base_url('admin/berita/tambah') ?>" 
        class="btn btn-primary">
        + Tambah Data
    </a>

</div>

<div class="card">
    <div class="card-body text-center">

        <?php if (empty($berita)) : ?>

            <div class="py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486746.png"
                     width="220" class="mb-3">

                <h5 class="fw-bold">Belum Ada Data</h5>
                <p class="text-muted">
                    Yuk, tambahkan data baru agar fitur ini bisa digunakan.
                </p>
            </div>

        <?php else : ?>

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php $no = 1; ?>
                <?php foreach ($berita as $a): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $a['judul_berita']; ?></td>
                        <td><?= substr($a['deskripsi_berita'],0,50); ?>...</td>
                        <td>
                            <?php if ($a['status_berita'] == 'Publish'): ?>
                                <span class="badge bg-success">Publish</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Unpublish</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d M Y', strtotime($a['tanggal_berita'])); ?></td>
                        <td>
                            <a href="<?= base_url('admin/berita/'.$a['id_berita']) ?>"
                                class="btn btn-sm btn-info">
                                👁
                            </a>
                            <a href="<?= base_url('admin/berita/edit/'.$a['id_berita']) ?>"
                                class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-danger"
                                onclick="confirmDelete(<?= $a['id_berita'] ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        <?php endif; ?>
        
<div class="d-flex justify-content-between align-items-center mt-3">

    <div style="font-size:14px; color:#777;">
        <?php
        $perPage = 8;
        $currentPage = $pager->getCurrentPage();
        $start = ($currentPage - 1) * $perPage + 1;
        $end = min($start + $perPage - 1, $total);
        ?>
        Menampilkan <?= $start ?>-<?= $end ?> dari <?= $total ?> berita
    </div>

    <div>
        <?php if ($pager->getPageCount() > 1) : ?>
            <?= $pager->links('default', 'bootstrap_full') ?>
        <?php endif; ?>
    </div>

</div>

<!-- FILTER MODAL -->
<form method="GET" action="<?= base_url('admin/berita') ?>">

<div class="modal fade" id="filterModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4">

      <h5 class="fw-bold mb-4">Filter Data berita</h5>

      <div class="mb-3">
        <label class="form-label">Urutkan</label>
        <select name="urutkan" class="form-select">
          <option value="">Pilih Urutan</option>
          <option value="terbaru">Terbaru</option>
          <option value="terlama">Terlama</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Status berita</label>
        <select name="status" class="form-select">
          <option value="">Semua Status</option>
          <option value="Publish">Publish</option>
          <option value="Unpublish">Unpublish</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="form-label">Tanggal Dibuat</label>
        <input type="text"
               name="tanggal"
               id="tanggalFilter"
               class="form-control"
               placeholder="YYYY-MM-DD">
      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="<?= base_url('admin/berita') ?>"
           class="btn btn-outline-secondary">
            Reset
        </a>

        <div>
          <button type="button"
                  class="btn btn-light me-2"
                  data-bs-dismiss="modal">
              Batal
          </button>

          <button type="submit"
                  class="btn btn-primary">
              Terapkan
          </button>
        </div>
      </div>

    </div>
  </div>
</div>

</form>

    </div>
  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

    flatpickr("#tanggalFilter", {
        dateFormat: "Y-m-d",
        allowInput: true,
        monthSelectorType: "dropdown",
    });

});
</script>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">

      <div class="mb-3">
        <i class="bi bi-exclamation-circle"
           style="font-size:50px; color:#dc3545;"></i>
      </div>

      <h5 class="mb-4">Yakin ingin menghapus data ini?</h5>

      <div class="d-flex justify-content-center gap-3">
        <button type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
            Batal
        </button>

        <a href="#" id="deleteConfirmBtn"
           class="btn btn-danger">
            Ya, Hapus !
        </a>
      </div>

    </div>
  </div>
</div>

<script>
function confirmDelete(id) {
    const url = "<?= base_url('admin/berita/delete/') ?>" + id;
    document.getElementById('deleteConfirmBtn').setAttribute('href', url);

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>

<?= $this->endSection() ?>