<!DOCTYPE html>
<html>
<head>
    <title>Lupa Kata Sandi - RESPIORA</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
    body{
        margin:0;
        font-family:'Nunito Sans', sans-serif;
        background:url('<?= base_url('assets/images/bg-respiora.png') ?>') no-repeat center center fixed;
        background-size:cover;
    }

    .container{
        display:flex;
        height:100vh;
    }

    .right-panel{
        width:50%;
        background:white;
        border-radius:0 40px 40px 0;
        padding:60px;
        display:flex;
        flex-direction:column;
        justify-content:center;   /* vertikal tengah */
        align-items:center;       /* horizontal tengah */
        text-align:center;        /* semua text jadi center */
    }

    .left-panel{
        width:50%;
        color:white;
        display:flex;
        flex-direction:column;
        align-items:center;
        text-align: center;
        position: relative;
    }

    .logo{
        width:350px;
        margin-bottom:30px;
    }

    input{
        height:50px;
        border:2px solid #132d69;
        border-radius:10px;
        padding-left:15px;
        margin-bottom:20px;
    }

    button{
        height:50px;
        background: #132d69;
        color:white;
        border:none;
        border-radius:20px;
        font-weight:bold;
    }

    .notif{
        margin-top:20px;
        padding:15px;
        border-radius:12px;
    }

    .success{
        background:#d1f5e0;
        color:#087f23;
    }

    .error{
        background:#ffe0e0;
        color:#b00020;
    }

    /* Kotak abu-abu luar */
    .form-box{
        width:100%;
        max-width:450px;
        border:1.5px solid #d9d9d9;
        border-radius:20px;
        padding:35px 30px;
        margin-top:30px;
    } 

    /* Supaya label lebih rapih */
    form label{
        display:block;
        font-size:14px;
        text-align:left;
        color: #000000;
        margin-bottom:15px;
    }

    /* Rapikan input */
    form input{
        width:420px;
        height:37px;
        border:1px solid #132d69;
        border-radius:4px;
        padding-left:15px;
        margin-bottom:25px;
        background:#f5f6f8;
    }

    /* Button lebih rounded seperti gambar */
    form button{
        width:440px;
        height:40px;
        background:#132d69;
        color:white;
        border:none;
        border-radius:15px;
        font-weight:600;
        cursor:pointer;
        transition:0.3s;
    }

    form button:hover{
        background: #0f2350;
    }

    .right-panel h2{
        margin-bottom:10px;  /* kecilkan jarak */
        font-size:28px;
        color: #081F5C;
    }

    .right-panel p{
        margin-top:0;
        margin-bottom:30px;  /* jarak ke form */
        font-size:15px;
        max-width:420px;     /* biar tidak terlalu panjang */
        color: #023D40;
    }
    .left-panel img{
        width:400px;
        display:flex;
        padding-top: 50px;
        position:relative;  /* WAJIB supaya title bisa absolute */
    }
    .left-panel h1{
        margin-top: 100px;
        position:relative;  /* WAJIB supaya title bisa absolute */
    }
    /* OVERLAY */
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
        padding-top:60px;
        z-index:999;
        opacity:0;
        visibility:hidden;
        transition:0.3s;
    }

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
        margin-right: 5px;
        gap:15px;
        box-shadow:0 10px 25px rgba(0,0,0,0.2);
    }

    .overlay.active .popup{
        transform:translateX(0);
        opacity:1;
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

</head>

<script>
function showNotif(){
    const overlay = document.getElementById('notifOverlay');
    overlay.classList.add('active');

    // hilang setelah 5 detik
    setTimeout(()=>{
        overlay.classList.remove('active');
    }, 10000);
}
</script>

<body>
<div class="container">

    <div class="right-panel">
        <img src="<?= base_url('assets/images/logo_respiora.png') ?>" class="logo">
        <h2>Lupa Kata Sandi</h2>
        <p>Jangan khawatir, kami akan mengirimkan tautan untuk mengubah kata sandi.</p>

        <div class="form-box">
            <form method="post" action="<?= base_url('forgot-password/send') ?>">
                <input type="hidden" name="role" value="<?= $role ?>">
                
                <label>Email</label>
                <input type="email" name="email" placeholder="masukkan Email yang terdaftar" required>
                
                <button type="submit">Ubah Kata Sandi</button>
            </form>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="notif error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
        <script>
        window.onload = function(){
            showNotif();}
        </script>
        <?php endif; ?>

    </div>

    <div class="left-panel">
        <h1 class="forgot-title">Lupa Kata Sandi</h1>
        <img src="<?= base_url('assets/images/pic_sandi.png') ?>">
    </div>

</div>

</body>
</html>