<?= $this->extend('layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="header-card">
    <div class="icon-box">
        <i class="bi bi-shield-plus"></i>
    </div>
    <div>
        <h4 class="mb-1">berita</h4>
        <small>Detail berita</small>
    </div>
</div>

<div class="card border-0 shadow-sm p-4" style="border-radius:18px;">
    <!-- JUDUL -->
    <h4 class="fw-bold text-center mb-3">
        <?= esc($berita['judul_berita']) ?>
    </h4>

    <!-- INFO ROW -->
<div class="d-flex justify-content-between align-items-center mb-4 px-2" style="font-size:14px;">
    <div class="text-muted d-flex align-items-center gap-2">
        <i class="bi bi-calendar"></i>
        Dipublikasikan pada:
        <?= date('d F Y', strtotime($berita['tanggal_berita'])) ?>
    </div>

    <!-- Tombol hanya muncul di admin/berita atau admin/berita -->
    <?php if (strpos(current_url(), 'admin/berita') !== false || strpos(current_url(), 'admin/berita') !== false): ?>
        <div class="d-flex align-items-center gap-2 mt-3">
            <div id="toggleSwitch" class="mini-switch <?= $berita['status_berita'] === 'Publish' ? 'active' : 'inactive' ?>" onclick="toggleStatus(<?= $berita['id_berita']; ?>)">
                <div class="mini-circle"></div>
            </div>
            <span>
                Status : <strong id="statusText"><?= $berita['status_berita']; ?></strong>
            </span>
        </div>
    <?php endif; ?>
</div>

    <!-- GAMBAR -->
    <?php if (!empty($berita['gambar_berita'])) : ?>
        <img src="<?= base_url('uploads/berita/'.$berita['gambar_berita']) ?>" class="img-fluid mb-4" style="width:100%; height:380px; object-fit:cover; border-radius:16px;">
    <?php endif; ?>

    <!-- DESKRIPSI -->
    <div style="line-height:1.9; font-size:15px;">
        <?= $berita['deskripsi_berita'] ?>
    </div>

    <!-- BUTTON -->
    <div class="text-end mt-4">
        <a href="<?= base_url('admin/berita') ?>" class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>


<!-- SCRIPT untuk toggle status -->
<script>
function toggleStatus(id) {
    // Kirim permintaan ke server untuk toggle status berita menggunakan POST
    fetch("/admin/berita/toggle/" + id, {
        method: "POST", // Pastikan menggunakan POST
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: id }) // Menyertakan ID berita sebagai payload
    })
    .then(response => response.json())
    .then(data => {
        if (!data.status) {
            console.error("Status tidak ada di response!");
            return;
        }

        // Ambil elemen tombol dan teks status
        const switchBtn = document.getElementById("toggleSwitch");
        const statusText = document.getElementById("statusText");

        // Update status berita dan tampilkan perubahan status
        statusText.innerText = data.status;

        // Update kelas untuk switch sesuai dengan status
        if (data.status === "Publish") {
            switchBtn.classList.add("active");
            switchBtn.classList.remove("inactive");
        } else {
            switchBtn.classList.remove("active");
            switchBtn.classList.add("inactive");
        }
    })
    .catch(error => console.error("ERROR:", error));
}
</script>


<?= $this->endSection() ?>