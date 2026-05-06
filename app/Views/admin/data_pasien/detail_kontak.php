<?= $this->extend('layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

<div class="card p-4">

<?php if($mode == 'edit'): ?>

<form action="/admin/data-pasien/update/kontak/<?= $id_pasien ?>" method="post">

<?php else: ?>

<form action="/admin/data-pasien/storeKontakTemp" method="post">

<?php endif; ?>
<div id="alertKontak" class="alert-custom" style="display:none;">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    Minimal 1 kontak keluarga harus ditambahkan
</div>
<!-- STEP -->
<div class="d-flex justify-content-center align-items-center mb-4">
    <div class="text-center"><div class="step">1</div><small>Data Diri</small></div>
    <div class="line-step"></div>
    <div class="text-center"><div class="step">2</div><small>Data Wilayah</small></div>
    <div class="line-step"></div>
    <div class="text-center"><div class="step">3</div><small>Data Tuberkulosis</small></div>
    <div class="line-step"></div>
    <div class="text-center"><div class="step active">4</div><small>Investigasi Kontak</small></div>
</div>

<div class="row">

<!-- LEFT -->
<div class="col-md-6">

<label>Nama Petugas</label>
<input name="nama_petugas" class="form-control mb-3" required>
<?= ($mode == 'view') ? 'readonly' : '' ?>

<label>Nama Fasyankes</label>
<input name="nama_fasyankes" class="form-control mb-3">
<?= ($mode == 'view') ? 'readonly' : '' ?>

<label>Tipe Diagnosis TBC<span class="text-danger">*</span></label>
<select name="tipe_diagnosis" class="form-control mb-3" required>
    <option value="">-- Pilih --</option>
    <option value="Bakteriologis">Bakteriologis</option>
    <option value="Klinis">Klinis</option>
</select>

</div>

<!-- RIGHT -->
<div class="col-md-6">

<label>No Register SITB<span class="text-danger">*</span></label>
<input name="no_register_sitb" class="form-control mb-3" required
oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        inputmode="numeric"
                        autocomplete="off">
                        <?= ($mode == 'view') ? 'readonly' : '' ?>

<label>Nama Kasus Indeks<span class="text-danger">*</span></label>
<input name="nama_kasus_indeks" class="form-control mb-3" required>
                        <?= ($mode == 'view') ? 'readonly' : '' ?>

<label>Tanggal Investigasi<span class="text-danger">*</span></label>
<input type="date" name="tanggal_investigasi" class="form-control mb-3" required>
<?= ($mode == 'view') ? 'readonly' : '' ?>

</div>

</div>

<hr>

<h5>Kontak Keluarga</h5>

<?php if($mode != 'view'): ?>

<button type="button"
        class="btn btn-primary"
        id="btnTambah">
    + Tambah Data
</button>

<?php endif; ?>

<table class="table table-bordered" id="tabelKontak">
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIK</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tbodyKontak">
        
    </tbody>
</table>

<?php if($mode != 'view'): ?>

<button type="submit" class="btn btn-success">
    Simpan
</button>

<?php else: ?>

<a href="/admin/data-pasien"
   class="btn btn-secondary">
   Kembali
</a>

<?php endif; ?>

</form>
</div>
</div>

<script>
function tambahBaris(){
    let table = document.querySelector("#tabelKontak tbody");

    let row = `
    <tr>
        <td><input name="nama_kontak[]" class="form-control" required></td>
        <td><input name="nik_kontak[]" class="form-control"
        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        inputmode="numeric"
                        autocomplete="off"></td>
        <td><input name="umur_kontak[]" class="form-control"></td>
        <td>
            <select name="jk_kontak[]" class="form-control">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </td>
        <td><button type="button" class="btn btn-danger" onclick="this.closest('tr').remove()">Hapus</button></td>
    </tr>
    `;

    table.insertAdjacentHTML('beforeend', row);
}
document.querySelector('form').addEventListener('submit', function(e){
    let rows = document.querySelectorAll('#tabelKontak tbody tr');
    let alertBox = document.getElementById('alertKontak');

    // hanya block kalau benar2 kosong
    if(rows.length === 0){
        e.preventDefault();
        alertBox.style.display = 'flex';

        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000);

        return false;
    }

    // kalau ada baris → JANGAN preventDefault
});
document.getElementById('btnTambah').addEventListener('click', function () {

    let tbody = document.getElementById('tbodyKontak');

    let row = `
    <tr>
        <td>
            <input type="text"
                   name="nama_kontak[]"
                   class="form-control"
                   required>
        </td>

        <td>
            <input type="text"
                   name="nik_kontak[]"
                   class="form-control"
                   required>
        </td>

        <td>
            <input type="number"
                   name="umur_kontak[]"
                   class="form-control"
                   required>
        </td>

        <td>
            <select name="jk_kontak[]"
                    class="form-control"
                    required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </td>

        <td>
            <button type="button"
                    class="btn btn-danger btnHapus">
                Hapus
            </button>
        </td>
    </tr>
    `;

    tbody.insertAdjacentHTML('beforeend', row);

});
document.addEventListener('click', function(e){

    if(e.target.classList.contains('btnHapus')){
        e.target.closest('tr').remove();
    }

});
</script>

<style>
.step {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #eaeaea;
    display: flex;
    align-items: center;
    justify-content: center;
}
.step.active {
    background: #1e2a5a;
    color: white;
}
.line-step {
    width: 80px;
    height: 2px;
    background: #ccc;
    margin: 0 10px;
}
.alert-custom {
    background: #ffe5e5;
    color: #b30000;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 14px;
    display: flex;
    align-items: center;
    border-left: 5px solid #ff4d4d;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<?= $this->endSection() ?>