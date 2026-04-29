<?= $this->extend('layout/main_layout') ?>
<?= $this->section('content') ?>
<?php $pasien = $pasien ?? []; ?>
<!-- FLATPICKR -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<?php
// 🔥 MAPPING LABEL
$jk = [1=>'Laki-laki', 2=>'Perempuan'];
$usia = [
    1=>'0-4 tahun',
    2=>'5-9 tahun',
    3=>'10-18 tahun',
    4=>'19-59 tahun',
    5=>'>60 tahun'
];
$pendidikan = [
    1=>'Tidak Sekolah',
    2=>'SD',
    3=>'SLTP Sederajat',
    4=>'SLTA Sederajat',
    5=>'D1-D3 Sederajat',
    6=>'D4',
    7=>'S1',
    8=>'S2',
    9=>'S3'
];
$pekerjaan = [
    1=>'Tidak Bekerja',
    2=>'PNS',
    3=>'TNI / POLRI',
    4=>'BUMN',
    5=>'Pegawai Swasta / Wirausaha',
    6=>'Lain-lain'
];
$status = [
    1=>'Belum Kawin',
    2=>'Kawin',
    3=>'Cerai Hidup',
    4=>'Cerai Mati'
];
$pendapatan = [
    1=>'<1,5 Juta',
    2=>'1,5 - 3 Juta',
    3=>'3 - 5 Juta',
    4=>'>5 Juta'
];
?>

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
<form id=formDiri action="/admin/data-pasien/store-temp" method="post">
<?php else: ?>
<form id=formDiri action="/admin/data-pasien/update/<?= $pasien['id_pasien'] ?>" method="post">
<?php endif; ?>

       <div class="d-flex justify-content-center align-items-center mb-4 step-wrapper">

    <div class="text-center step-item">
        <div class="step active">1</div>
        <small>Data Diri</small>
    </div>

    <div class="line-step"></div>

    <div class="text-center step-item">
        <div class="step">2</div>
        <small>Data Wilayah</small>
    </div>
<div id="alertBox" style="
    display:none;
    position:fixed;
    bottom:30px;
    right:30px;
    background:#ff4d4f;
    color:white;
    padding:12px 18px;
    border-radius:8px;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
    font-size:14px;
    z-index:9999;
">
    ⚠️ Semua data wajib diisi!
</div>
</div>
            <div class="row"> <div class="col-md-6">

                            <label>NIK</label>
                <input name="NIK" id="nik" class="form-control"
                        value="<?= $pasien['NIK'] ?? '' ?>"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        inputmode="numeric"
                        autocomplete="off"

                    <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>
                <small id="nikError" style="color:red; display:none;">
                    NIK harus diisi 16 digit!
                </small>   

                <label class="mt-3">Nomor Rekam Medis</label>
                <input name="no_rm" class="form-control"
                       value="<?= $pasien['no_rm'] ?? '' ?>"
                       autocomplete="off"
                       <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

                <label class="mt-3">Nama Lengkap</label>
                <input name="nama_pasien" class="form-control"
                       value="<?= $pasien['nama_pasien'] ?? '' ?>"
                       autocomplete="off"
                        <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

                <label class="mt-3"> Tempat Lahir</label>
                <input name="tempat_lahir" class="form-control"
                       value="<?= $pasien['tempat_lahir'] ?? '' ?>"
                       autocomplete="off"
                       <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

                <!-- DATE -->
                <label class="mt-3">Tanggal Lahir</label>
                <input type="text"
                       id="tanggal_lahir"
                       name="tanggal_lahir"
                       class="form-control"
                       autocomplete="off"
                       value="<?= $pasien['tanggal_lahir'] ?? '' ?>"
                       <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

                <label class="mt-3">Nomor Telepon</label>
                <input name="no_hp" class="form-control"
                       value="<?= $pasien['no_hp'] ?? '' ?>"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                       autocomplete="off"
                       <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

                <label class="mt-3">Jumlah Keluarga</label>
                <input name="jumlah_keluarga" class="form-control"
                       value="<?= $pasien['jumlah_keluarga'] ?? '' ?>"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        inputmode="numeric"
                       autocomplete="off"
                       <?= ($mode=='edit' || $mode=='create') ? '' : 'readonly' ?>>

            </div>

            <div class="col-md-6">

                <!-- JENIS KELAMIN -->
                <label>Jenis Kelamin</label>

<?php if ($mode=='edit' || $mode=='create'): ?>
<select name="jenis_kelamin" class="form-control">
    <?php foreach($jk as $k=>$v): ?>
        <option value="<?= $k ?>"
            <?= (($pasien['jenis_kelamin'] ?? '') == $k) ? 'selected' : '' ?>>
            <?= $v ?>
        </option>
    <?php endforeach; ?>
</select>
<?php else: ?>
<input class="form-control"
       value="<?= $jk[$pasien['jenis_kelamin'] ?? ''] ?? '-' ?>"
       readonly>
<?php endif; ?>

                <!-- PENDIDIKAN -->
                <label class="mt-3">Pendidikan</label>

<?php if ($mode=='edit' || $mode=='create'): ?>
<select name="pendidikan" class="form-control">
    <?php foreach($pendidikan as $k=>$v): ?>
        <option value="<?= $k ?>"
            <?= (($pasien['pendidikan'] ?? '') == $k) ? 'selected' : '' ?>>
            <?= $v ?>
        </option>
    <?php endforeach; ?>
</select>
<?php else: ?>
<input class="form-control"
       value="<?= $pendidikan[$pasien['pendidikan'] ?? ''] ?? '-' ?>"
       readonly>
<?php endif; ?>

                <!-- PEKERJAAN -->
                <label class="mt-3">Pekerjaan</label>

<?php if ($mode=='edit' || $mode=='create'): ?>
<select name="pekerjaan" class="form-control">
    <?php foreach($pekerjaan as $k=>$v): ?>
        <option value="<?= $k ?>"
            <?= (($pasien['pekerjaan'] ?? '') == $k) ? 'selected' : '' ?>>
            <?= $v ?>
        </option>
    <?php endforeach; ?>
</select>
<?php else: ?>
<input class="form-control"
       value="<?= $pekerjaan[$pasien['pekerjaan'] ?? ''] ?? '-' ?>"
       readonly>
<?php endif; ?>

                <!-- STATUS -->
                <label class="mt-3">Status Pernikahan</label>

<?php if ($mode=='edit' || $mode=='create'): ?>
<select name="status_pernikahan" class="form-control">
    <?php foreach($status as $k=>$v): ?>
        <option value="<?= $k ?>"
            <?= (($pasien['status_pernikahan'] ?? '') == $k) ? 'selected' : '' ?>>
            <?= $v ?>
        </option>
    <?php endforeach; ?>
</select>
<?php else: ?>
<input class="form-control"
       value="<?= $status[$pasien['status_pernikahan'] ?? ''] ?? '-' ?>"
       readonly>
<?php endif; ?>

                <!-- USIA -->
               <label class="mt-3">Kategori Usia</label>

<?php if ($mode=='edit' || $mode=='create'): ?>
<select name="kelompok_usia" class="form-control">
    <?php foreach($usia as $k=>$v): ?>
        <option value="<?= $k ?>"
            <?= (($pasien['kelompok_usia'] ?? '') == $k) ? 'selected' : '' ?>>
            <?= $v ?>
        </option>
    <?php endforeach; ?>
</select>
<?php else: ?>
<input class="form-control"
       value="<?= $usia[$pasien['kelompok_usia'] ?? ''] ?? '-' ?>"
       readonly>
<?php endif; ?>

                <!-- PENDAPATAN -->
                <label class="mt-3">Pendapatan</label>

<?php if ($mode=='edit' || $mode=='create'): ?>
<select name="pendapatan" class="form-control">
    <?php foreach($pendapatan as $k=>$v): ?>
        <option value="<?= $k ?>"
            <?= (($pasien['pendapatan'] ?? '') == $k) ? 'selected' : '' ?>>
            <?= $v ?>
        </option>
    <?php endforeach; ?>
</select>
<?php else: ?>
<input class="form-control"
       value="<?= $pendapatan[$pasien['pendapatan'] ?? ''] ?? '-' ?>"
       readonly>
<?php endif; ?>

            </div>
        </div>

        <!-- BUTTON -->
        <div class="d-flex justify-content-end mt-4">
            <a href="/admin/data-pasien" class="btn btn-secondary me-2">Kembali</a>

            <?php if ($mode=='edit'): ?>

    <button type="submit"
        formaction="/admin/data-pasien/edit/<?= $pasien['id_pasien'] ?>/wilayah"
        class="btn btn-primary">
        Lanjut
    </button>

<?php elseif ($mode=='create'): ?>

    <button type="submit"
        formaction="/admin/data-pasien/store-temp"
        class="btn btn-primary">
        Lanjut
    </button>

<?php else: ?>

    <a href="/admin/data-pasien/<?= $pasien['id_pasien'] ?>/wilayah"
       class="btn btn-primary">Lanjut</a>

<?php endif; ?>
        </div>

        </form>
    </div>
</div>

<!-- CALENDAR -->
<?php if ($mode === 'edit' || $mode === 'create'): ?>
<script>
flatpickr("#tanggal_lahir", {
    dateFormat: "Y-m-d",
    defaultDate: "<?= $pasien['tanggal_lahir'] ?? '' ?>",
});

document.getElementById('formDiri').addEventListener('submit', function(e){

    let inputs = this.querySelectorAll('input, select');
    let nik = document.getElementById('nik');
    let nikError = document.getElementById('nikError');

    nikError.style.display = 'none';

    let adaKosong = false;

    // =========================
    // 🔥 CEK KOSONG DULU
    // =========================
    inputs.forEach(el => {

        if(el.type === 'submit' || el.type === 'button' || el.hasAttribute('readonly')){
            return;
        }

        if(el.tagName === 'SELECT'){
    if(el.value === '' || el.value === null){
        adaKosong = true;
    }
} else {
            if(el.value.trim() === ''){
                adaKosong = true;
            }
        }

    });

    // ❗ kalau ada kosong → ALERT
    if(adaKosong){
        e.preventDefault();

        let alertBox = document.getElementById('alertBox');
        alertBox.style.display = 'block';

        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000);

        return;
    }

    // =========================
    // 🔥 CEK NIK
    // =========================
    if(nik && nik.value.length !== 16){
        e.preventDefault();
        nikError.style.display = 'block';
        return;
    }

});
</script>
<?php endif; ?>
<style>
/* STEP */
.step {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: #eaeaea;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.step.active {
    background: #1e2a5a;
    color: white;
}

/* WRAPPER */
.step-wrapper {
    gap: 30px;
}

/* ITEM */
.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* TEXT */
.step-item small {
    margin-top: 6px;
    font-size: 13px;
}

/* LINE */
.line-step {
    width: 80px;
    height: 2px;
    background: #ccc;
}
</style>
<?= $this->endSection() ?>