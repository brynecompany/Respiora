<?= $this->extend('layout/main_layout') ?>
<?= $this->section('content') ?>

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
<form action="/admin/data-pasien/store-final" method="post">
<?php else: ?>
<form action="/admin/data-pasien/update/<?= $pasien['id_pasien'] ?>/wilayah" method="post">
<?php endif; ?>

        <!-- STEP -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="text-center">
                <div class="step">1</div>
                <small>Data Diri</small>
            </div>

            <div class="line-step"></div>

            <div class="text-center">
                <div class="step active">2</div>
                <small>Data Wilayah</small>
            </div>
        </div>
        <div id="alertBoxWilayah" style="
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
    ⚠️ Semua data wilayah wajib diisi!
</div>
        <div class="row">

            <!-- LEFT -->
            <div class="col-md-6">

                <?php if ($mode === 'edit' || $mode === 'create'): ?>

                    <label>Provinsi</label>
                    <select id="provinsi" class="form-control mb-3"></select>

                    <label>Kabupaten</label>
                    <select id="kabupaten" class="form-control mb-3"></select>

                    <label>Kecamatan</label>
                    <select id="kecamatan" class="form-control mb-3"></select>

                    <label>Kelurahan</label>
                    <select name="id_wilayah" id="kelurahan" class="form-control mb-3"></select>

                    <label>Kode POS</label>
                    <input id="kode_pos" class="form-control" readonly>

                <?php else: ?>

                    <!-- READ MODE -->
                    <label>Kelurahan</label>
                    <input class="form-control mb-3" value="<?= $pasien['kelurahan_nama'] ?? '-' ?>" readonly>

                    <label>Kecamatan</label>
                    <input class="form-control mb-3" value="<?= $pasien['kecamatan_nama'] ?? '-' ?>" readonly>

                    <label>Kabupaten</label>
                    <input class="form-control mb-3" value="<?= $pasien['kabupaten_nama'] ?? '-' ?>" readonly>

                    <label>Provinsi</label>
                    <input class="form-control mb-3" value="<?= $pasien['provinsi_nama'] ?? '-' ?>" readonly>

                    <label>Kode POS</label>
                    <input class="form-control" value="<?= $pasien['kode_pos'] ?? '-' ?>" readonly>

                <?php endif; ?>

            </div>

            <!-- RIGHT -->
            <div class="col-md-6">

                <label>RT</label>
                <input name="rt" class="form-control"
                       value="<?= $pasien['rt'] ?? '' ?>"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                       <?= ($mode === 'edit' || $mode === 'create') ? '' : 'readonly' ?>>

                <label class="mt-3">RW</label>
                <input name="rw" class="form-control"
                       value="<?= $pasien['rw'] ?? '' ?>"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                       <?= ($mode === 'edit' || $mode === 'create') ? '' : 'readonly' ?>>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="d-flex justify-content-end mt-4">

<?php if ($mode === 'edit'): ?>

    <a href="/admin/data-pasien/edit/<?= $pasien['id_pasien'] ?>"
       class="btn btn-secondary me-2">
       Kembali
    </a>

    <button type="submit" class="btn btn-success">
        Simpan
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

    <a href="/admin/data-pasien"
       class="btn btn-secondary me-2">
       Kembali
    </a>

<?php endif; ?>

</div>
        </div>

        </form>

    </div>
</div>

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

<?php if ($mode === 'edit' || $mode === 'create'): ?>
<script>
const provMap = {
    35: "Jawa Timur"
};

const kabMap = {
    9: "Jember"
};

const kecMap = {
    3: "Kaliwates"
};

const kelMap = {
    1: "JemberKidul",
    2: "TegalBesar",
    3: "Kaliwates",
    4: "Kebonagung",
    5: "Sempusari",
    6: "Mangli",
    7: "Kepatihan"
};
// ================= DATA AWAL =================
let selectedProv = "<?= $pasien['provinsi'] ?? '' ?>";
let selectedKab  = "<?= $pasien['kabupaten'] ?? '' ?>";
let selectedKec  = "<?= $pasien['kecamatan'] ?? '' ?>";
let selectedKel  = "<?= $pasien['id_wilayah'] ?? '' ?>";
let selectedPos  = "<?= $pasien['kode_pos'] ?? '' ?>";

// ================= PROVINSI =================
fetch('<?= base_url("api/wilayah/provinsi") ?>')
.then(res => res.json())
.then(data => {
    let prov = document.getElementById('provinsi');
    if(selectedProv){
    prov.value = selectedProv;
}
    prov.innerHTML = '<option value="">Pilih Provinsi</option>';

    data.forEach(d => {
        let nama = provMap[d.provinsi] || d.provinsi;
        prov.innerHTML += `<option value="${d.provinsi}">${nama}</option>`;
    });
    

    if(selectedProv) prov.dispatchEvent(new Event('change'));
});

// ================= PROV → KAB =================
document.getElementById('provinsi').addEventListener('change', function(){
    fetch(`<?= base_url("api/wilayah/kabupaten") ?>/${this.value}`)
    .then(res => res.json())
    .then(data => {
        let kab = document.getElementById('kabupaten');
        kab.innerHTML = '<option value="">Pilih Kabupaten</option>';

        data.forEach(d => {
            let nama = kabMap[d.kabupaten] || d.kabupaten;
            kab.innerHTML += `<option value="${d.kabupaten}">${nama}</option>`;
        });

        if(selectedKab) kab.dispatchEvent(new Event('change'));
    });
});

// ================= KAB → KEC =================
document.getElementById('kabupaten').addEventListener('change', function(){
    fetch(`<?= base_url("api/wilayah/kecamatan") ?>/${this.value}`)
    .then(res => res.json())
    .then(data => {
        let kec = document.getElementById('kecamatan');
        kec.innerHTML = '<option value="">Pilih Kecamatan</option>';

        data.forEach(d => {
            let nama = kecMap[d.kecamatan] || d.kecamatan;
            kec.innerHTML += `<option value="${d.kecamatan}">${nama}</option>`;
        });

        if(selectedKec) kec.dispatchEvent(new Event('change'));
    });
});

// ================= KEC → KEL =================
document.getElementById('kecamatan').addEventListener('change', function(){
    fetch(`<?= base_url("api/wilayah/kelurahan") ?>/${this.value}`)
    .then(res => res.json())
    .then(data => {
        let kel = document.getElementById('kelurahan');
        kel.innerHTML = '<option value="">Pilih Kelurahan</option>';

        data.forEach(d => {
            let nama = kelMap[d.id_wilayah] || d.kelurahan;
            kel.innerHTML += `
            <option value="${d.id_wilayah}" data-pos="${d.kode_pos}">
                ${nama}
            </option>
            `;
        });
        if(selectedKel){
         kel.value = selectedKel;
}
        if(selectedPos){
            document.getElementById('kode_pos').value = selectedPos;
        }
    });
});

// ================= KODE POS =================
document.getElementById('kelurahan').addEventListener('change', function(){
    let selected = this.options[this.selectedIndex];
    document.getElementById('kode_pos').value =
        selected.getAttribute('data-pos') || '';
});
document.querySelector('form').addEventListener('submit', function(e){

    let valid = true;

    let idWilayah = document.querySelector('[name="id_wilayah"]');
    let rt = document.querySelector('[name="rt"]');
    let rw = document.querySelector('[name="rw"]');

    // 🔥 CEK KOSONG
    if(!idWilayah || idWilayah.value === ''){
        valid = false;
    }

    if(!rt || rt.value.trim() === ''){
        valid = false;
    }

    if(!rw || rw.value.trim() === ''){
        valid = false;
    }

    // 🔥 CEK ANGKA
    if(rt && !/^[0-9]+$/.test(rt.value)){
        valid = false;
    }

    if(rw && !/^[0-9]+$/.test(rw.value)){
        valid = false;
    }

    // ❌ STOP SUBMIT
    if(!valid){
        e.preventDefault();

        let alertBox = document.getElementById('alertBoxWilayah');
        alertBox.style.display = 'block';

        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000);

        return false;
    }

});
</script>
<?php endif; ?>

<?= $this->endSection() ?>