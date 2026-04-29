<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Skrining TB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
    document.querySelector('.kirim').addEventListener('click', function() {
        this.classList.add('active');
    });
    </script>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #FFFFFF;
    }

    .navbar {
        background: white;
        border-bottom: 1px solid #ddd;
        padding: 15px 40px;
    }

    .logo {
        font-weight: bold;
        color: #2b5cff;
        font-size: 20px;
    }

    /* BOX */
    .box {
        width: 1000px;
        margin: 50px auto;
        background: #EDF1F6;
        padding: 30px;
        border-radius: 10px;
        border: 1px solid #081F5C;
    }

    h2 {
        margin-bottom: 5px;
        font-size: 25px;
        font-weight: bolder;
    }

    p {
        margin-bottom: 25px;
        font-size: 20px;
        font-weight: bold;
    }

    /* RADIO HIDDEN */
    input[type="radio"] {
        display: none;
    }

    .text {
        font-size: 16px;
        font-weight: 500;
    }

    /* BUTTON STYLE */
    .pilihan {
        padding: 6px 40px;
        border-radius: 8px;
        background: #FFFFFF;
        cursor: pointer;
        margin-right: 10px;
        margin-left: 15px;
        transition: 0.2s;
        margin-top: 15px;
        margin-bottom: 15px;
        color: #D8D8D8;
        font-size: 16px;
        border: 1px #D8D8D8;
    }

    /* WARNA IYA */
    input[type="radio"]:checked+.iya {
        background: #081F5C;
        color: white;
    }

    /* WARNA TIDAK */
    input[type="radio"]:checked+.tidak {
        background: #081F5C;
        color: white;
    }

    /* ACTION BUTTON */
    .actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }

    .kembali {
        padding: 10px 185px;
        border-radius: 20px;
        border: 1px solid #081F5C;
        background: transparent;
        color: #081F5C;
        font-size: 18px;
    }

    .kirim {
        padding: 10px 185px;
        border-radius: 20px;
        border: none;
        background: #081F5C;
        color: white;
        font-size: 18px;
    }

    .kirim:hover {
        background: #5E5E5E;
        /* sama kayak Iya */
        color: white;
    }

    .kembali:hover {
        background: #5E5E5E;
        /* sama kayak Iya */
        color: white;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .radio-group {
        display: flex;
        gap: 30px;
    }

    .step-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px 0;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 120px;
        text-align: center;
    }

    .step-item small {
        margin-top: 8px;
        font-size: 12px;
        color: #333;
    }

    .step {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: 1px solid #081F5C;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        text-align: center;
    }

    .step.active {
        background: #081F5C;
        color: white;
        border: none;
    }

    .step-line {
        width: 150px;
        height: 2px;
        border-top: 1px dashed #cbd5e1;
        /* 🔥 jadi titik-titik */
        position: relative;
        top: -12px;
        /* 🔥 ini yang bikin naik */
        margin: 0 -40px;
    }

    .step-item small {
        white-space: nowrap;
        /* 🔥 biar ga turun baris */
        font-size: 12px;
    }

    .step-line.active-line {
        border-top: 1px dashed #081F5C;
    }
    </style>
</head>

<body>
    <nav class="navbar d-flex justify-content-between align-items-center">
        <div class="logo">RESPRIORA</div>

        <div>
            <a class="me-4 text-dark">Beranda</a>
            <a class="me-4 text-dark">Tentang Kami</a>
            <a class="me-4 text-dark">Layanan</a>
            <a class="me-4 text-dark">Kontak</a>
            <button class="btn btn-primary">Login</button>
        </div>
    </nav>
    <div class="step-container">

        <div class="step-item">
            <div class="step active">1</div>
            <small>Informasi Umum</small>
        </div>

        <div class="step-line active-line"></div>

        <div class="step-item">
            <div class="step active">2</div>
            <small>Informasi Gejala Klinis</small>
        </div>

        <div class="step-line"></div>

        <div class="step-item">
            <div class="step">3</div>
            <small>Informasi Faktor Risiko & Riwayat</small>
        </div>

    </div>
    <form method="post" action="/dashboard/proses">

        <div class="box">
            <h2>Informasi Gejala Klinis</h2>
            <p>Sesuaikan dengan kondisi gejala yang dialami</p>

            <!-- 1 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami batuk disertai dahak atau bercampur darah selama 2 minggu atau
                    lebih? <br></div>
                <div class="radio-group">
                    <input type="radio" name="batuk" value="1" id="batuk1">
                    <label class="pilihan iya" for="batuk1">Iya</label>

                    <input type="radio" name="batuk" value="0" id="batuk0">
                    <label class="pilihan tidak" for="batuk0">Tidak</label>
                </div>
            </div>

            <!-- 2 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami penurunan berat badan tanpa sebab yang jelas dalam waktu selama
                    2 bulan? <br></div>
                <div class="radio-group">
                    <input type="radio" name="berat" value="1" id="berat1">
                    <label class="pilihan iya" for="berat1">Iya</label>

                    <input type="radio" name="berat" value="0" id="berat0">
                    <label class="pilihan tidak" for="berat0">Tidak</label>
                </div>
            </div>

            <!-- 3 -->
            <div class="question">
                <div class="text">Apakah Anda memilihi benjolah di leher atau ketiak? <br> </div>
                <div class="radio-group">
                    <input type="radio" name="benjol" value="1" id="benjol1">
                    <label class="pilihan iya" for="benjol1">Iya</label>

                    <input type="radio" name="benjol" value="0" id="benjol0">
                    <label class="pilihan tidak" for="benjol0">Tidak</label>
                </div>
            </div>
            <!-- 4 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami nyeri punggung? <br></div>
                <div class="radio-group">
                    <input type="radio" name="punggung" value="1" id="p1">
                    <label class="pilihan iya" for="p1">Iya</label>

                    <input type="radio" name="punggung" value="0" id="p0">
                    <label class="pilihan tidak" for="p0">Tidak</label>
                </div>
            </div>
            <!-- 5 -->
            <div class="question">
                <div class="text">Apakah Anda sering merasa lelah atau tidak bertenaga? <br></div>
                <div class="radio-group">
                    <input type="radio" name="lemas" value="1" id="l1">
                    <label class="pilihan iya" for="l1">Iya</label>

                    <input type="radio" name="lemas" value="0" id="l0">
                    <label class="pilihan tidak" for="l0">Tidak</label>
                </div>
            </div>
            <!-- 6 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami demam yang berlangsung selama 2 minggu? <br></div>
                <div class="radio-group">
                    <input type="radio" name="demam" value="1" id="d1">
                    <label class="pilihan iya" for="d1">Iya</label>

                    <input type="radio" name="demam" value="0" id="d0">
                    <label class="pilihan tidak" for="d0">Tidak</label>
                </div>
            </div>
            <!-- 7 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami batuk berdarah? <br></div>
                <div class="radio-group">
                    <input type="radio" name="darah" value="1" id="dr1">
                    <label class="pilihan iya" for="dr1">Iya</label>

                    <input type="radio" name="darah" value="0" id="dr0">
                    <label class="pilihan tidak" for="dr0">Tidak</label>
                </div>
            </div>
            <!-- 8 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami batuk berdahak yang disertai dengan darah? <br></div>
                <div class="radio-group">
                    <input type="radio" name="dahak" value="1" id="dh1">
                    <label class="pilihan iya" for="dh1">Iya</label>

                    <input type="radio" name="dahak" value="0" id="dh0">
                    <label class="pilihan tidak" for="dh0">Tidak</label>
                </div>
            </div>
            <!-- 9 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami penurunan nafsu makan dalam beberapa minggu terakhir? <br></div>
                <div class="radio-group">
                    <input type="radio" name="nafsu" value="1" id="n1">
                    <label class="pilihan iya" for="n1">Iya</label>

                    <input type="radio" name="nafsu" value="0" id="n0">
                    <label class="pilihan tidak" for="n0">Tidak</label>
                </div>
            </div>
            <!-- 10 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami pembengkakan kelenjar? <br></div>
                <div class="radio-group">
                    <input type="radio" name="kelenjar" value="1" id="k1">
                    <label class="pilihan iya" for="k1">Iya</label>

                    <input type="radio" name="kelenjar" value="0" id="k0">
                    <label class="pilihan tidak" for="k0">Tidak</label>
                </div>
            </div>
            <!-- 11 -->
            <div class="question">
                <div class="text">Apakah Anda sering berkeringat pada malam hari tanpa aktivitas fisik? <br></div>
                <div class="radio-group">
                    <input type="radio" name="keringat" value="1" id="kr1">
                    <label class="pilihan iya" for="kr1">Iya</label>

                    <input type="radio" name="keringat" value="0" id="kr0">
                    <label class="pilihan tidak" for="kr0">Tidak</label>
                </div>
            </div>

            <!-- 12 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami nyeri pada dada? <br></div>
                <div class="radio-group">
                    <input type="radio" name="dada" value="1" id="dd1">
                    <label class="pilihan iya" for="dd1">Iya</label>

                    <input type="radio" name="dada" value="0" id="dd0">
                    <label class="pilihan tidak" for="dd0">Tidak</label>
                </div>
            </div>

            <!-- 13 -->
            <div class="question">
                <div class="text">Apakah Anda mengalami sesak napas?<br></div>
                <div class="radio-group">
                    <input type="radio" name="sesak" value="1" id="s1">
                    <label class="pilihan iya" for="s1">Iya</label>

                    <input type="radio" name="sesak" value="0" id="s0">
                    <label class="pilihan tidak" for="s0">Tidak</label>
                </div>
            </div>

            <div class="actions">
                <button type="button" class="kembali" onclick="history.back()">Kembali</button>
                <button type="submit" class="kirim">Selanjutnya</button>
            </div>

        </div>

    </form>
    <footer class="text-center" style="background:#081F5C; color:white; padding:50px; margin-top:60px;">
        <h5>RESPRIORA</h5>
        <p>Platform deteksi dini TBC</p>
    </footer>

</body>

</html>