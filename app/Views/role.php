<!DOCTYPE html>
<html>
<head>
    <title>Pilih Role - RESPIORA</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
    body {
        margin: 0;
        font-family: 'Nunito Sans', sans-serif;
        background: url('<?= base_url('assets/images/bg-respiora.png') ?>') no-repeat center center fixed;
        background-size: cover;
        color: white;
    }

    .container {
        text-align: center;
        padding: 60px;
    }

    .back-btn {
        position: absolute;
        top: 20px;
        left: 30px;
    }

    .back-btn img {
        width: 40px;
    }

    .header h1 {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 10px;
        margin-top: 0px;
    }

    .header p {
        font-size: 18px;
        font-weight: 400;
        margin-bottom: 30px;
    }

    .card-wrapper {
        position: relative;
        display: flex;
        justify-content: center;
        gap: 50px;
    }

    .card {
        width: 320px;
        height: 380px;
        position: relative;
        border-radius: 50px;
        border: 2px solid #ffffff;
        transition: transform 0.3s ease;
        overflow: visible;
        background: #081F5C;
        box-shadow: 0 5px 20px rgba(0,0,0,0.4);
        z-index: 2;
        padding-bottom: 20px;
    }

    .card-title {
        width: 220px;
        height: 45px;
        background: #081F5C;
        border-radius: 50px;
        position: relative;
        left: 15%;
        display: flex;
        padding-bottom: 10px;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .profile-box {
        width: 320px;
        height: 200px;
        background: white;
        border-radius: 50px;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: -60px;
    }

    .card-body {
        padding: 20px;
        font-size: 12px;
        padding-bottom: 30px;
        padding-top: 30px;
        padding-right: 15px;
        padding-left: 15px;
        line-height: 1.6;
        text-align: center;
    }

    .avatar {
        padding-top: 5px;
        width: 100px;
        margin: 30px 0;
        margin-bottom: 1px;
    }

    .card-body p {
        font-size: 12px;
        line-height: 1.6;
    }

    .btn {
        width: 230px;
        display: inline-block;
        background: #334EAC;
        padding: 8px 20px;
        border-radius: 20px;
        color: white;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid white;
    }
    </style>

</head>
<body>

<div class="container">

    <a href="<?= base_url('myhome') ?>" class="back-btn">
        <img src="<?= base_url('assets/images/back.png') ?>" alt="Back">
    </a>

    <div class="header">
        <h1>Pilih Pengguna untuk nikmati RESPIORA</h1>
        <p>Silakan pilih peran untuk melanjutkan ke Fitur yang diinginkan</p>
    </div>

    <div class="card-wrapper">
        
        <!-- Admin -->
        <div class="card">
            <div class="card-title">Admin</div>
            
            <div class="profile-box">
                <img src="<?= base_url('assets/images/admin.png') ?>" class="avatar">
            </div>

            <div class="card-body">
                Admin bertanggung jawab dalam pengelolaan data kasus TBC,
                pembaruan status pasien, serta pemantauan wilayah penyebaran penyakit melalui RESPIORA.
            </div>

            <a href="<?= base_url('login/admin') ?>" class="btn">Pilih</a>
        </div>

        <!-- Kepala Puskesmas -->
        <div class="card">
            <div class="card-title">Kepala Puskesmas</div>

            <div class="profile-box">
                <img src="<?= base_url('assets/images/kapus.png') ?>" class="avatar">
            </div>

            <div class="card-body">
                Kepala Puskesmas memiliki akses untuk memantau indikator program TBC,
                melihat tren kasus, evaluasi wilayah risiko, serta laporan kinerja pengendalian TBC.
            </div>

            <a href="<?= base_url('login/kepalapuskesmas') ?>" class="btn">Pilih</a>
        </div>

        <!-- Kepala Dinkes -->
        <div class="card">
            <div class="card-title">Kepala Dinkes</div>

            <div class="profile-box">
                <img src="<?= base_url('assets/images/dinkes.png') ?>" class="avatar">
            </div>

            <div class="card-body">
                Pemimpin instansi teknis pemerintahan tingkat provinsi atau kabupaten/kota 
                yang bertanggung jawab melaksanakan urusan pemerintahan bidang kesehatan.
            </div>

            <a href="<?= base_url('login/kepaladinkes') ?>" class="btn">Pilih</a>
        </div>

    </div>

</div>

</body>
</html>