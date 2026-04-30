<?= $this->extend('layout/kapus_layout') ?>
<?= $this->section('content') ?>

<div class="header-card">
    <div class="icon-box">
        <i class="bi bi-shield-plus"></i>
    </div>
    <div>
        <h4 class="mb-1">Artikel</h4>
        <small>Detail Artikel</small>
    </div>
</div>

<div class="card border-0 shadow-sm p-4" style="border-radius:18px;">

    <!-- JUDUL -->
    <h4 class="fw-bold text-center mb-3">
        <?= esc($artikel['judul_artikel']) ?>
    </h4>

    <!-- INFO ROW -->
    <div class="d-flex justify-content-between align-items-center mb-4 px-2"
         style="font-size:14px;">

        <div class="text-muted d-flex align-items-center gap-2">
            <i class="bi bi-calendar"></i>
            Dipublikasikan pada:
            <?= date('d F Y', strtotime($artikel['tanggal_artikel'])) ?>
        </div>

    </div>

    <!-- GAMBAR -->
    <?php if (!empty($artikel['gambar_artikel'])) : ?>
        <img src="<?= base_url('uploads/artikel/'.$artikel['gambar_artikel']) ?>"
             class="img-fluid mb-4"
             style="width:100%; height:380px; object-fit:cover; border-radius:16px;">
    <?php endif; ?>

    <!-- DESKRIPSI -->
    <div style="line-height:1.9; font-size:15px;">
        <?= $artikel['deskripsi_artikel'] ?>
    </div>

    <!-- BUTTON -->
    <div class="text-end mt-4">
        <a href="<?= base_url('kapus/artikel') ?>"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>

<script>
document.getElementById("statusSwitch").addEventListener("click", function() {

    let switchBtn = this;
    let artikelId = switchBtn.dataset.id;

    fetch("<?= base_url('kapus/artikel/toggleStatus') ?>/" + artikelId)
    .then(response => response.json())
    .then(data => {

        if (data.status === "Publish") {
            switchBtn.classList.add("active");
        } else {
            switchBtn.classList.remove("active");
        }

        document.getElementById("statusText").innerText =
            "Status : " + data.status;

    });

});
</script>

<script>
function toggleStatus(id) {

    fetch("/kapus/artikel/toggle/" + id)
    .then(response => response.json())
    .then(data => {

        console.log("RESPONSE:", data);

        if (!data.status) {
            console.error("Status tidak ada di response!");
            return;
        }

        const switchBtn = document.getElementById("toggleSwitch");
        const statusText = document.getElementById("statusText");

        statusText.innerText = data.status;

        if (data.status === "Publish") {
            switchBtn.classList.add("active");
        } else {
            switchBtn.classList.remove("active");
        }

    })
    .catch(error => console.error("ERROR:", error));
}
</script>

<?= $this->endSection() ?>