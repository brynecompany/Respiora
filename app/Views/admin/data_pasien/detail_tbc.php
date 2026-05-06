
<?= $this->extend('layout/main_layout') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid">

<!-- HEADER -->
<div class="card mb-4"
     style="background: linear-gradient(90deg,#1e3c72,#4a76b8); border-radius:12px;">
    <div class="card-body text-white d-flex align-items-center">
        <div class="me-3 d-flex align-items-center justify-content-center"
             style="width:60px;height:60px;border-radius:18px;
                    background: rgba(255,255,255,0.12);
                    backdrop-filter: blur(6px);
                    border: 1px solid rgba(255,255,255,0.2);">
            <i class="bi bi-shield-plus" style="font-size:30px;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-1">Data Pasien</h4>
            <small>Data Pasien Terdiagnosis TBC</small>
        </div>
    </div>
</div>

<div class="card p-4">

<?php if($mode == 'create'): ?>

<form action="/admin/data-pasien/storeTbcTemp" method="post">

<?php else: ?>

<form action="/admin/data-pasien/update/tbc/<?= $pasien['id_pasien'] ?>" method="post">

<?php endif; ?>

    <!-- STEP -->
    <div class="d-flex justify-content-center align-items-center mb-4">
        <div class="text-center step-item">
        <div class="step">1</div>
        <small>Data Diri</small>
    </div>

    <div class="line-step"></div>

    <div class="text-center step-item">
        <div class="step">2</div>
        <small>Data Wilayah</small>
    </div>
    <div class="line-step"></div>

    <div class="text-center">
        <div class="step active">3</div>
        <small>Data Tuberkulosis</small>
    </div>

    <div class="line-step"></div>

    <div class="text-center">
        <div class="step">4</div>
        <small>Investigasi Kontak</small>
    </div>
    </div>

    <div class="row">

        <!-- LEFT -->
        <div class="col-md-6">

            <label>No Registrasi Fasyankes<span class="text-danger">*</span></label>
            <input name="no_reg_fasyankes" class="form-control mb-3"required
            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        inputmode="numeric"
                        autocomplete="off"

                    <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>No Registrasi TBC Kab/Kota</label>
            <input name="no_reg_tbc_kab" class="form-control mb-3"
            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        inputmode="numeric"
                        autocomplete="off"

                    <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>No Register SITB<span class="text-danger">*</span></label>
            <input name="no_register_sitb" class="form-control mb-3"required
            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        inputmode="numeric"
                        autocomplete="off"

                    <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>No BPJS</label>
            <input name="no_bpjs" class="form-control mb-3"
            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        inputmode="numeric"
                        autocomplete="off"

                    <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>Kode Fasyankes<span class="text-danger">*</span></label>
            <input name="kode_fasyankes" class="form-control mb-3"required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>Nama Fasyankes<span class="text-danger">*</span></label>
            <input name="nama_fasyankes" class="form-control mb-3"required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>Tanggal Mulai Pengobatan<span class="text-danger">*</span></label>
            <input type="date" name="tgl_mulai_pengobatan" class="form-control mb-3"required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>Pemeriksaan Tuberkulin / IGRA<span class="text-danger">*</span></label>
            <select name="pemeriksaan_igra" class="form-control mb-3" required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Pemeriksaan --</option>
                <option value="Tidak">Tidak Dilakukan</option>
                <option value="Tuberkulin">Tuberkulin</option>
                <option value="IGRA">IGRA</option>
            </select>

            <label>Panduan OAT<span class="text-danger">*</span></label>
            <select name="panduan_oat" class="form-control mb-3" required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Panduan OAT --</option>
                <option value="Kategori 1">Kategori 1</option>
                <option value="Kategori 2">Kategori 2</option>
                <option value="Kategori Anak">Kategori Anak</option>
                <option value="Non Standar">Panduan tidak standar TB SO</option>
            </select>

            <label>Tanggal Akhir Pengobatan<span class="text-danger">*</span></label>
            <input type="date" name="tgl_akhir_pengobatan" class="form-control mb-3"required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>Hasil Akhir Pengobatan<span class="text-danger">*</span></label>
            <select name="hasil_akhir_pengobatan" class="form-control mb-3" required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Hasil Akhir --</option>
                <option value="Meninggal">Meninggal</option>
                <option value="Putus berobat">Putus berobat</option>
                <option value="Pindah">Pindah</option>
                <option value="Pengobatan lengkap">Pengobatan lengkap</option>
                <option value="Sembuh">Sembuh</option>
            </select>

            <label>Tanggal Tes HIV<span class="text-danger">*</span></label>
            <input type="date" name="tgl_tes_hiv" class="form-control mb-3"required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            <label>Hasil Tes HIV<span class="text-danger">*</span></label>
            <select name="hasil_tes_hiv" class="form-control mb-3" required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Hasil Tes HIV --</option>
                <option value="Bukan ODHIV">Bukan ODHIV</option>
                <option value="ODHIV">ODHIV</option>
            </select>

        </div>

        <!-- RIGHT -->
        <div class="col-md-6">

            <label>Status Pengobatan</label>
            <select name="status_pengobatan" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Status Pengobatan --</option>
                <option value="Tidak sesuai Standar">Tidak sesuai Standar</option>
                <option value="Sesuai Standar">Sesuai Standar</option>
            </select>

            <label>Status Hamil</label>
            <select name="status_hamil" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Status Hamil --</option>
                <option value="Tidak hamil">Tidak hamil</option>
                <option value="Hamil">Hamil</option>
            </select>

            <label>Nama Fasyankes</label>
            <select name="nama_fasyankes_rujukan" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Nama Fasyankes --</option>
                <option value="Puskesmas Kaliwates">Puskesmas Kaliwates</option>
                <option value="Puskesmas Mangli">Puskesmas Mangli</option>
                <option value="Puskesmas Jember Kidul">Puskesmas Jember Kidul</option>
            </select>

            <label>Dilakukan Pemeriksaan Kontak</label>
            <select name="pemeriksaan_kontak" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Pemeriksaan Kontak --</option>
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
            </select>

            <label>Dirujuk / dikirim oleh</label>
            <select name="dirujuk_oleh" id="dirujuk_oleh" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Sumber Rujukan --</option>
                <option value="Internal">Internal</option>
                <option value="Kader/Komunitas">Kader/Komunitas</option>
                <option value="Datang Sendiri">Datang Sendiri</option>
                <option value="Skrining TBC DM">Skrining TBC DM</option>
                <option value="Lainnya">Lain-lain</option>
            </select>
            <input type="text" name="dirujuk_lainnya" id="dirujuk_lainnya"
            class="form-control mb-3"
            placeholder="Isi lainnya..."
            style="display:none;">

            <label>Tipe Diagnosis TBC<span class="text-danger">*</span></label>
            <select name="tipe_diagnosis" class="form-control mb-3" required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Tipe Diagnosis TBC --</option>
                <option value="Terkonfirmasi bakteriologis">Terkonfirmasi bakteriologis</option>
                <option value="Terkonfirmasi klinis">Terkonfirmasi klinis</option>
            </select>

            <label>Klasifikasi Berdasarkan Lokasi Anatomi<span class="text-danger">*</span></label>
            <select name="klasifikasi_lokasi" class="form-control mb-3" required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Klasifikasi Lokasi --</option>
                <option value="TB Paru">TB Paru</option>
                <option value="TB Ekstra Paru">TB Ekstra Paru</option>
            </select>

            <label>Klasifikasi Berdasarkan Riwayat Pengobatan Sebelumnya<span class="text-danger">*</span></label>
            <select name="klasifikasi_riwayat" id="klasifikasi_riwayat" class="form-control mb-3" required
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Klasifikasi Riwayat --</option>
                <option value="Tidak diketahui">Tidak diketahui</option>
                <option value="Baru">Baru</option>
                <option value="Kambuh (relaps)">Kambuh (relaps)</option>
                <option value="Diobati setelah gagal kategori 1">Diobati setelah gagal kategori 1</option>
                <option value="Diobati setelah gagal kategori 2">Diobati setelah gagal kategori 2</option>
                <option value="Diobati setelah putus berobat">Diobati setelah putus berobat</option>
                <option value="Pernah diobati tidak diketahui hasilnya">Pernah diobati tidak diketahui hasilnya</option>
                <option value="Diobati setelah gagal pengobatan lini 2">Diobati setelah gagal pengobatan lini 2</option>
                <option value="Lainnya">Lain-lain</option>
            </select>
            <input type="text" name="riwayat_lainnya" id="riwayat_lainnya"
            class="form-control mb-3"
            placeholder="Isi lainnya..."
            style="display:none;">

            <label>Skoring TBC Anak (0–13)</label>
            <select name="skoring_anak" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Skor --</option>
                <?php for($i=0; $i<=13; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>

            <label>Hasil Pemeriksaan Foto Thorax</label>
            <select name="hasil_foto_toraks" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Hasil Foto Thorax --</option>
                <option value="Neg (Negatif)">Neg (Negatif)</option>
                <option value="Pos (Positif)">Pos (Positif)</option>
                <option value="TDL (Tidak Dilakukan)">TDL (Tidak Dilakukan)</option>
            </select>

            <label>DM</label>
            <select name="dm" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Status DM --</option>
                <option value="Tidak diketahui">Tidak diketahui</option>
                <option value="Negatif">Negatif</option>
                <option value="Positif">Positif</option>
            </select>

            <label>Terapi DM</label>
            <select name="terapi_dm" class="form-control mb-3"
            <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <option value="">-- Pilih Terapi DM --</option>
                <option value="Injeksi Insulin">Injeksi Insulin</option>
                <option value="OHO">OHO</option>
            </select>

        </div>

    </div>

    <!-- BUTTON -->
    <div class="d-flex justify-content-end mt-4">

<?php if ($mode === 'edit'): ?>

    <a href="/admin/data-pasien/edit/<?= $pasien['id_pasien'] ?>"
       class="btn btn-secondary me-2">
       Kembali
    </a>

    <button type="submit" class="btn btn-primary">
        Lanjut
    </button>

<?php elseif ($mode === 'create'): ?>

    <a href="/admin/data-pasien/create"
       class="btn btn-secondary me-2">
       Kembali
    </a>

    <button type="submit" class="btn btn-success">
        Simpan
    </button>

<?php else: ?>

    <a href="/admin/data-pasien/<?= $pasien['id_pasien'] ?>/wilayah"
       class="btn btn-secondary me-2">
       Kembali
    </a>

    <a href="/admin/data-pasien/<?= $pasien['id_pasien'] ?>/kontak"
       class="btn btn-primary">
       Lanjut
    </a>

<?php endif; ?>

</div>

    </form>

</div>
</div>
<script>
document.getElementById('dirujuk_oleh').addEventListener('change', function() {
    let lainnya = document.getElementById('dirujuk_lainnya');

    if (this.value === 'Lainnya') {
        lainnya.style.display = 'block';
    } else {
        lainnya.style.display = 'none';
        lainnya.value = '';
    }
});
document.getElementById('klasifikasi_riwayat').addEventListener('change', function() {
    let lainnya = document.getElementById('riwayat_lainnya');

    if (this.value === 'Lainnya') {
        lainnya.style.display = 'block';
    } else {
        lainnya.style.display = 'none';
        lainnya.value = '';
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
</style>

<?= $this->endSection() ?>
