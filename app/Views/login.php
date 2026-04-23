<!DOCTYPE html>
<html>
<head>
    <title>Login - RESPIORA</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;800&display=swap" rel="stylesheet">

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
        width:400px;
        display:flex;
        justify-content:center;
        text-align: center;
        position:relative;  /* WAJIB supaya title bisa absolute */
    }

    /* PANEL KANAN (PUTIH) */
    .right-panel{
        width: 60%;
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
        text-align:center;      /* bikin logo center */
        margin-bottom:10px;     /* jarak ke bawah */
        margin-top:-70px;
    }

    .logo img{
        width:350px;
    }

    /* Form */
    .input-group{
        position:relative;
        margin-bottom:15px;
    }

    input{
        width:100%;
        padding:12px;
        border-radius:8px;
        border:1px solid #ccc;
    }

    .eye{
        position:absolute;
        right:10px;
        top:12px;
        cursor:pointer;
    }

    .error-text{
        color:red;
        font-size:12px;
    }

    .general-error{
        color:red;
        margin-bottom:10px;
    }

    /* Judul Login di atas robot */
    .login-title{
        color:white;
        font-size:54px;
        font-weight:700;
        margin-bottom:50px; /* jarak ke robot */
        margin-top: -90px;
    }

    /* Wrapper robot + title */
    .robot-content{
        text-align:center;
    }

    /* Subjudul abu kecil dan center */
    .subtitle{
        text-align:center;
        font-size:14px;
        color:#696F79;
        margin-bottom:40px;
    }

    /* Box luar biru */
    .form-box{
        width: 500px;
        border:1px solid #ccc;
        border-radius:20px;
        padding: 40px;
        margin-left: 30px;
    }

    /* Form group */
    .form-group{
        margin-bottom:20px;
        margin-right: 30px;
    }

    .form-group label{
        font-size:14px;
        color: #6b6b6b;
        display:block;
        margin-bottom:8px;
    }

    /* Input style */
    .form-group input{
        width:100%;
        padding:12px;
        border-radius:4px;
        border:1px solid #132d69;
        font-size:14px;
        background:#f7f7f7;
    }

    /* Password wrapper */
    .password-wrapper{
        position:relative;
    }

    .password-wrapper .eye{
        position:absolute;
        right:7px;
        top:50%;
        transform:translateY(-50%);
        cursor:pointer;
    }

    /* Button */
    .btn{
        width: 100%;
        padding: 14px;
        background: #081F5C;
        color:white;
        border:none;
        border-radius:15px;
        font-weight:600;
        margin-top:10px;
    }

    .forgot-password{
        text-align:right;
        margin-top:6px;
    }

    .forgot-password a{
        color:red;
        text-decoration:none;
    }

    .error-message{
        color: #e53935;
        font-size:14px;
        margin-top:6px;
        display:flex;
        align-items:center;
    }

    .error-icon{
        display:inline-flex;
        justify-content:center;
        align-items:center;
        width:16px;
        height:16px;
        border:1px solid #e53935;
        border-radius:50%;
        font-size:11px;
        margin-right:6px;
    }
    </style>

</head>
<body>

<div class="container">

    <!-- PANEL KIRI (ROBOT) -->
    <div class="left-panel">
        <div class="robot-content">
        <h1 class="login-title">Login</h1>
        <img src="<?= base_url('assets/images/pic_login.png') ?>" alt="Robot">
        </div>
    </div>

    <!-- PANEL KANAN (FORM PUTIH) -->
    <div class="right-panel">

    <div class="logo">
        <img src="<?= base_url('assets/images/logo_respiora.png') ?>" alt="Logo">
    </div>

    <p class="subtitle">
        Akses akun RESPIORA Anda untuk menikmati layanan kesehatan terbaik.
    </p>

    <?php if(session()->getFlashdata('error')): ?>
    <div class="error-message">
        <span class="error-icon">!</span>
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <div class="form-box">
        <form method="post" action="<?= base_url('auth/proses-login') ?>">

            <!-- USERNAME -->
            <div class="form-group">
                <label>Username</label>
                <input type="text" 
                    name="username"
                    value="<?= old('username') ?>" 
                    placeholder="masukkan username">

                <?php if(session()->getFlashdata('username_error')): ?>
                    <div class="error-message">
                        <span class="error-icon">!</span>
                        <?= session()->getFlashdata('username_error') ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Kata Sandi</label>
                <div class="password-wrapper">
                    <input type="password" 
                        id="password"
                        name="password"
                        placeholder="masukkan kata sandi">
                    <span class="eye" onclick="togglePassword()">👁</span>
                </div>

                <?php if(session()->getFlashdata('password_error')): ?>
                    <div class="error-message">
                        <span class="error-icon">!</span>
                        <?= session()->getFlashdata('password_error') ?>
                    </div>
                    <div class="forgot-password">
                        <a href="<?= base_url('forgot-password/'.$role) ?>">Lupa Kata Sandi</a>
                    </div>
                <?php endif; ?>
            </div>

            <button class="btn">Masuk</button>

        </form>
    </div>

</div>

</div>

<script>
function togglePassword(){
    var pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>