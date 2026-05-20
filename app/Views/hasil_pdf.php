<?php
/** @var array $data */
$d = $data;

$pertanyaan = [
"Apakah Anda mengalami batuk disertai dahak atau bercampur darah selama 2 minggu atau lebih?",
"Apakah Anda mengalami penurunan berat badan tanpa sebab yang jelas dalam waktu selama 2 bulan?",
"Apakah Anda memilihi benjolah di leher atau ketiak?",
"Apakah Anda mengalami snyeri punggung?",
"Apakah Anda sering merasa lelah atau tidak bertenaga?",
"Apakah Anda mengalami demam yang berlangsung selama 2 minggu?",
"Apakah Anda mengalami batuk berdarah?",
"Apakah Anda mengalami batuk berdahak yang disertai dengan darah?",
"Apakah Anda mengalami penurunan nafsu makan dalam beberapa minggu terakhir?",
"Apakah Anda mengalami pembengkakan kelenjar?",
"Apakah Anda sering berkeringat pada malam hari tanpa aktivitas fisik?",
"Apakah Anda mengalami nyeri pada dada?",
"Apakah Anda mengalami sesak napas?"
];

$jawaban = [
$d['batuk'],
$d['berat'],
$d['benjol'],
$d['punggung'],
$d['lemas'],
$d['demam'],
$d['darah'],
$d['dahak'],
$d['nafsu'],
$d['kelenjar'],
$d['keringat'],
$d['dada'],
$d['sesak']
];

// 🔥 HASIL LANGSUNG DARI DATABASE
$hasil = $d['hasil']; // "TB" / "Tidak TB"
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hasil Skrining</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    body {
        background: #FFFFFF;
        font-family: 'Segoe UI', sans-serif;
    }

    .logo {
        font-weight: bold;
        color: #2b5cff;
        font-size: 20px;
    }

    table {
        width: 100%;
        border-collapse: separate;
        /* 🔥 WAJIB */
        border-spacing: 0;
        /* biar ga renggang */
    }

    th {
        background: #081F5C;
        color: white;
        padding: 12px;
        border: 1px solid #E5E7EB;
        text-align: center;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #E5E7EB;
        border-left: 1px solid #E5E7EB;
        border-right: 1px solid #E5E7EB;
    }

    .badge {
        padding: 5px 15px;
        border-radius: 20px;
        width: 100px;
    }

    .badge-yes {
        background: #f8d7da;
        color: #842029;
        border: 1px solid #C00000;
    }

    .badge-no {
        background: #d1e7dd;
        color: #0f5132;
        border: 1px solid #008C2F;
    }

    .hasil {
        padding: 18px;
        border-radius: 20px;
        max-width: 1070px;
        margin: 0 auto;
        text-align: center;
        font-weight: 600;
        font-size: 16px;
    }

    /* 🔴 MERAH (RISIKO) */
    .hasil-tb {
        background: #F8D7DA;
        color: #C00000;
        border: 1px solid #C00000;
    }

    /* 🟢 HIJAU (AMAN) */
    .hasil-aman {
        background: #D1E7DD;
        color: #0F5132;
        border: 1px solid #008C2F;
    }

    .hasil-tb {
        background: #f8d7da;
        color: #842029;
    }

    .hasil-aman {
        background: #d1e7dd;
        color: #0f5132;
    }

    .rekom {
        background: #FFFFFF;
        padding: 18px;
        border-radius: 20px;
        max-width: 100px;
        margin: 0 auto;
        text-align: center;
        font-weight: 600;
        font-size: 16px;
        border: 1px solid #7096D1;
    }

    .input-hasil {
        width: 70%;
        height: 20px;
        /* 🔥 ini kunci biar sama */
        border-radius: 12px;
        padding: 10px;
        border: 1.5px solid #EBF1F6;

        background: #FFFFFF;
        /* sama kayak kamu */
        color: #081F5C;

        font-size: 14px;
        margin-top: 5px;
        margin-bottom: 13px;
    }

    .tanggal-skrining {
        background: #334EAC80;
        /* 🔥 biru transparan (HEX + opacity) */
        color: #FFFFFF;
        /* teks putih */
        border: 1.5px solid #EBF1F6;
    }

    .label-utama {
        font-size: 18px;
    }

    .inner-card {
        background: #FFFFFF;
        padding: 20px;
        border-radius: 14px;
        max-width:700px;
        /* atur sesuai selera */
        margin: 0 auto;

        border: 1px solid #EBF1F6;
    }

    h5 {
        margin-left: 60px;
        margin-bottom: 20px;
        margin-top: 15px;
    }

    h1 {
        margin-top: 30px;
        font-size: 20px;
        margin-left: 30px;
    }

    .card {
        background: #FFFFFF;
        border-radius: 15px;
        max-width: 100px;
        /* atur sesuai selera */
        margin: 0 auto;

        border: 1px solid #EBF1F6;
        overflow: hidden;
    }

    h3 {
        margin-left: 60px;
        margin-bottom: 20px;
        margin-top: 50px;
        font-weight: bold;
        font-size: 20px;
    }

    .tips-card {
        max-width: 100px;
        margin: 15px auto;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #EBF1F6;
    }

    /* HEADER BIRU */
    .tips-header {
        background: #081F5C;
        color: white;
        padding: 7px 18px;
        font-weight: 600;
        width: 90%;
        /* 🔥 bikin full */
        display: block;
        margin: 0 auto;
        border-radius: 20px;
        margin-top: 70px;
        position: relative;
        z-index: 2;
        padding-left: 55px;
        font-size: 20px;
    }

    /* ISI */
    .tips-list {
        background: #D6E4FF;
        padding: 15px 50px;
        margin: 0;
        width: 85%;
        margin: 0 auto;
        border-radius: 20px;
        margin-top: -20px;
        padding-top: 35px;
    }

    .tips-list li {
        margin-bottom: 8px;
    }

    .tips-wrapper {
        position: relative;
        width: 100%;
        margin: 70px auto 0 auto;
    }

    .tips-icon {
        position: absolute;
        top: -15px;
        /* 🔥 bikin dia naik ke atas header */
        left: 27px;
        /* 🔥 agak keluar kiri */
        width: 68px;
        z-index: 3;
    }
    .btn-cetak {
     background: #081F5C;
        color: white;
        padding: 7px 18px;
        font-weight: 600;
        width: 100%;
        /* 🔥 bikin full */
        display: block;
        margin: 0 auto;
        border-radius: 20px;
        margin-top: 70px;
        position: relative;
        z-index: 2;
        font-size: 18px;
        text-align: center;
        margin-bottom: 30px;
        
}

.btn-cetak:hover {
    background: #0A2A7A; /* 🔥 lebih terang dikit pas hover */
}
.icon-cetak{
        margin-top: -6px;
        width: 20px;
}
/* Kolom No */
table td:nth-child(1),
table th:nth-child(1) {
    text-align: center;
    width: 60px;
}

/* Kolom Jawaban */
table td:nth-child(3),
table th:nth-child(3) {
    text-align: center;
}
.info-table {
    width: 100%;
    border-collapse: collapse;
}

.info-table .col {
    width: 50%;
    vertical-align: top;
    padding: 10px;
}
.info-table td {
    width: 50%;
    vertical-align: top;
}

    </style>
</head>

<body>
    <h1>Hasil Skrining Tuberkulosis Anda</h1>
            <h5 class="fw-bold">Informasi Umum</h5>

            <div class="inner-card">
        <table class="info-table">
    <tr>
        <!-- KIRI -->
        <td class="col">
            <b>Nama Lengkap</b>
            <div class="input-hasil"><?= $d['nama'] ?></div>

            <b>Nomor Induk Kependudukan</b>
            <div class="input-hasil"><?= $d['nik'] ?></div>

            <b>Jenis Kelamin</b>
            <div class="input-hasil">
                <?= ($d['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan' ?>
            </div>

            <b>Tanggal Lahir</b>
            <div class="input-hasil"><?= $d['tanggal_lahir'] ?></div>

            <b>Kategori Usia</b>
            <div class="input-hasil"><?= $d['kategori_usia'] ?></div>
        </td>

        <!-- KANAN -->
        <td class="col">
            <b>Tanggal Skrining</b>
            <div class="input-hasil tanggal-skrining">
                <?= $d['tanggal_skrining']; ?>
            </div>

            <b>Provinsi</b>
            <div class="input-hasil"><?= $d['provinsi'] ?></div>

            <b>Kabupaten</b>
            <div class="input-hasil"><?= $d['kabupaten'] ?></div>

            <b>Kecamatan</b>
            <div class="input-hasil"><?= $d['kecamatan'] ?></div>

            <b>Kelurahan</b>
            <div class="input-hasil"><?= $d['kelurahan'] ?></div>

            <b>Kode Pos</b>
            <div class="input-hasil"><?= $d['kode_pos'] ?></div>
        </td>
    </tr>
</table>

            </div>

            <b>
                <h3>Rincian Jawaban</h3>
            </b>

            <div class="card">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                    </tr>

                    <?php foreach ($pertanyaan as $i => $tanya): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $tanya ?></td>
                        <td>
                            <?php if ($jawaban[$i] == 1): ?>
                            <span class="badge badge-yes">Ya</span>
                            <?php else: ?>
                            <span class="badge badge-no">Tidak</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </table>
            </div>
            <h3>Hasil</h3>

            <div class="hasil <?= ($hasil == 'TB') ? 'hasil-tb' : 'hasil-aman' ?>">
                <?= ($hasil == 'TB') ? 'Anda Berisiko TB' : 'Anda Tidak Berisiko TB'; ?>
            </div>

            <!-- REKOMENDASI -->
            <h3>Rekomendasi</h3>
            <div class="rekom">
                <?php if ($hasil == 'TB'): ?>
                Berdasarkan hasil skrining, Anda memiliki risiko Tuberkulosis (TB). Disarankan untuk segera melakukan
                pemeriksaan lebih lanjut di fasilitas pelayanan kesehatan (fasyankes) terdekat untuk memastikan
                diagnosis dan mendapatkan penanganan yang tepat.
                <?php else: ?>
                Berdasarkan hasil skrining, saat ini Anda tidak menunjukkan risiko Tuberkulosis (TB). Tetap pertahankan
                kondisi kesehatan Anda dan lakukan pemantauan mandiri terhadap gejala yang mungkin muncul di kemudian
                hari.
                <?php endif; ?>
            </div>

            <div class="tips-wrapper">
                <img src="/img/book.png" class="tips-icon">

                <div class="tips-header">
                    <?php if ($hasil == 'TB'): ?>
                    <span>Tips Sementara Sebelum Pemeriksaan</span>
                    <?php else: ?>
                    <span>Tips Kesehatan</span>
                    <?php endif; ?>
                </div>
            </div>

            <ul class="tips-list">
                <?php if ($hasil == 'TB'): ?>
                <li>Gunakan masker saat berinteraksi dengan orang lain</li>
                <li>Terapkan etika batuk (menutup mulut dan hidung saat batuk/bersin)</li>
                <li>Hindari kontak dekat dengan anak-anak, lansia, atau orang dengan daya tahan tubuh rendah</li>
                <li>Jaga daya tahan tubuh dengan makan bergizi dan istirahat cukup</li>
                <?php else: ?>
                <li>Konsumsi makanan bergizi seimbang setiap hari</li>
                <li>Rutin berolahraga minimal 30 menit</li>
                <li>Istirahat yang cukup</li>
                <li>Jaga kebersihan lingkungan dan ventilasi rumah</li>
                <?php endif; ?>
            </ul>
            <button onclick="window.location.href='/dashboard/cetak/<?= $data['id'] ?>'" class="btn-cetak">
                <img src="/img/pdf.png" class="icon-cetak">
    Cetak PDF
</button>
        </div>

    </div>
    </div>



</body>
</html>