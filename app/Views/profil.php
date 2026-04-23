<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
    body{
        margin:0;
        font-family:'Nunito Sans', sans-serif;
        height:100vh;
        background: url('<?= base_url('assets/images/bg-respiora.png') ?>') no-repeat center center;
        background-size: cover;
        display:flex;
    }

    /* Container utama */
    .container{
        width:100%;
        display:flex;
    }

    /* PANEL KIRI (ROBOT) */
    .left-panel{
        width:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        position:relative;
    }

    .left-panel img{
        /*width:350px;
        margin-left: -70px;*/
        width:450px;
        display:flex;
        justify-content:center;
        text-align: center;
        position:relative;  /* WAJIB supaya title bisa absolute */
    }

    /* PANEL KANAN (PUTIH) */
    .right-panel{
        width: 50%;
        background:white;
        border-radius: 50px;
        margin-right: -50px;
        padding:60px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        box-shadow: -15px 0 20px rgba(0,0,0,0.1);
    }

    /* Logo */
    .logo{
        text-align:center;
        margin-bottom:10px;
        margin-top:-70px;
    }

    .logo img{
        width:350px;
    }

    /* Judul */
    .title{
        text-align:center;
        font-size:28px;
        font-weight:700;
        margin-bottom:30px;
        color:#081F5C;
    }

    /* Box profil */
    .form-box{
        width: 500px;
        border:1px solid #ccc;
        border-radius:20px;
        padding:40px;
        margin:0 auto;
    }

    /* Isi profil */
    .profile-item{
        margin-bottom:20px;
        font-size:16px;
    }

    .profile-item span{
        font-weight:bold;
        color:#334EAC;
    }

    /* Button */
    .btn{
        width:100%;
        padding:14px;
        background:#334EAC;
        color:white;
        border:none;
        border-radius:12px;
        font-weight:600;
        margin-top:20px;
        text-decoration:none;
        display:inline-block;
        text-align:center;
    }
    </style>

</head>
<body>

<div class="container">

    <!-- PANEL KIRI -->
    <div class="left-panel">
        <img src="<?= base_url('assets/images/pic_login.png') ?>" alt="Robot">
    </div>

    <!-- PANEL KANAN -->
    <div class="right-panel">

        <div class="logo">
            <img src="<?= base_url('assets/images/logo_respiora.png') ?>" alt="Logo">
        </div>

        <div class="title">Halaman Profil</div>

        <div class="form-box">

            <div class="profile-item">
                Username: <span><?= session()->get('username'); ?></span>
            </div>

            <div class="profile-item">
                Role: <span><?= session()->get('role'); ?></span>
            </div>

            <a href="<?= base_url('sidebar_layl') ?>" class="btn">← Kembali</a>

        </div>

    </div>

</div>

</body>
</html>