<!DOCTYPE html>
<html>
<head>
    <title>Reset Kata Sandi - RESPIORA</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
    body{
        margin:0;
        font-family:'Nunito Sans', sans-serif;
        background:url('<?= base_url('assets/images/bg-respiora.png') ?>') no-repeat center center fixed;
        background-size:cover;
        display:flex;
        height:100vh;
        align-items: center;
    }

    /* Container */
    .container{
        display:flex;
        width:100%;
    }

    /* PANEL KIRI (PUTIH BESAR) */
    .left-panel{
        width:50%;
        background:white;
        border-radius:0 50px 50px 0;
        padding:80px 70px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items: center;
    }

    /* PANEL KANAN (BACKGROUND BIRU + GAMBAR) */
    .right-panel{
        width:50%;
        color:white;
        display:flex;
        flex-direction:column;
        align-items:center;
        text-align: center;
        position: relative;
    }
    .right-panel img{
        width:400px;
        display:flex;
        padding-top: 50px;
        position:relative;  /* WAJIB supaya title bisa absolute */
    }
    .right-panel h1{
        margin-top: 150px;
        position:relative;  /* WAJIB supaya title bisa absolute */
    }

    /* LOGO */
    .logo{
        width:320px;
        padding-bottom:20px;
        margin-top: 50px;
    }

    /* JUDUL */
    .left-panel h2{
        font-size:28px;
        font-weight:700;
        color: #081F5C;
        margin-bottom:10px;
        align-items: center;
    }

    /* SUBTEXT */
    .left-panel p{
        font-size:16px;
        color: #023D40;
        margin-bottom:40px;
        text-align:center;
        max-width:520px;   
        margin:0 auto 40px auto;  
    }

    /* CARD FORM */
    .form-box{
        border:1px solid #d6d6d6;
        border-radius:20px;
        padding:40px;
        width:100%;
        max-width:500px;
    }

    /* LABEL */
    .form-box label{
        display:block;
        font-size:14px;
        color:#6b6b6b;
        margin-bottom:8px;
    }

    /* INPUT */
    .form-box input{
        width:87%;
        height:40px;
        border-radius:4px;
        border:1px solid #132d69;
        padding:0 14px;
        font-size:14px;
        background:#f5f5f5;
        margin-bottom:25px;
    }

    /* PASSWORD WRAPPER */
    .password-wrapper{
        position:relative;
    }

    .password-wrapper input{
        padding-right:40px;
    }

    .eye{
        position:absolute;
        right:12px;
        top:10px;
        cursor:pointer;
        font-size:16px;
        margin-right: 12px;
    }

    /* BUTTON */
    .form-box button{
        width:98%;
        height:40px;
        background: #132d69;
        color:white;
        border:none;
        border-radius:15px;
        font-weight:600;
        font-size:15px;
        cursor:pointer;
    }
    .form-box button:hover{
        background: #0e2455;
    }
    /* OVERLAY BACKGROUND */
    .overlay{
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.4); /* efek abu transparan */
        display:flex;
        justify-content:flex-end;   /* 👉 ke kanan */
        align-items:flex-start;     /* 👉 ke atas */
        padding-right:20px;               /* jarak dari pinggir */
        padding-top:10px;
        z-index:999;
        opacity:0;
        visibility:hidden;
        transition:0.3s;
    }

    /* AKTIF */
    .overlay.active{
        opacity:1;
        visibility:visible;
    }

    /* POPUP */
    .popup{
        background:white;
        padding:20px 30px;
        border-radius:20px;
        align-items:center;       /* horizontal tengah */
        text-align:center;
        display:flex;
        margin-right: 20px;
        gap:15px;
        box-shadow:0 10px 25px rgba(0,0,0,0.2);
    }

    /* ICON */
    .icon{
        width:40px;
        height:40px;
        border-radius:50%;
        border:2px solid #132d69;
        display:flex;
        align-items:center;
        justify-content:center;
        color:#132d69;
        font-weight:bold;
    }

    /* TEXT */
    .popup .text{
    font-size:14px;
    color:#333;
    }
    </style>

    <script>
    function togglePassword(fieldId) {
        var input = document.getElementById(fieldId);
        
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
    
    function showSuccess(){
        const overlay = document.getElementById('successOverlay');
        overlay.classList.add('active');
        // redirect setelah 2.5 detik
        setTimeout(function(){
            window.location.href = "<?= base_url('login') ?>";
        }, 10000);
    }
    </script>

</head>

<!-- OVERLAY SUCCESS -->
<div id="successOverlay" class="overlay">
    <div class="popup">
        <div class="icon">✔</div>
        <div class="text">
            <b>Kata Sandi Berhasil Diubah.</b><br>
            Silahkan Login kembali
        </div>
    </div>
</div>

<body>
<div class="container">

    <!-- PANEL PUTIH -->
    <div class="left-panel">

        <img src="<?= base_url('assets/images/logo_respiora.png') ?>" class="logo">

        <h2>Atur Kata Sandi Baru</h2>
        <p>Kata sandi baru Anda harus berbeda dengan kata sandi yang digunakan sebelumnya.</p>

        <div class="form-box">
            <form method="post" action="<?= base_url('reset-password/update') ?>">

                <input type="hidden" name="token" value="<?= $token ?>">

                <label>Kata Sandi Baru</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="masukkan kata sandi baru" required>
                    <span class="eye" onclick="togglePassword('password')">👁</span>
                </div>

                <label>Konfirmasi Kata Sandi Baru</label>
                <div class="password-wrapper">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="masukkan kata sandi baru" required>
                    <span class="eye" onclick="togglePassword('confirm_password')">👁</span>
                </div>

                <button type="submit" onclick="setTimeout(showSuccess, 100)">Ubah Kata Sandi</button>
                
            </form>
        </div>
    </div>

    <!-- PANEL GAMBAR -->
    <div class="right-panel">
        <h1>Lupa Kata Sandi</h1>
        <img src="<?= base_url('assets/images/pic_sandi.png') ?>">
    </div>

</div>

</body>
</html>