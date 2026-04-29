<!DOCTYPE html>
<html>
<head>
    <title>RESPIORA | Grafik Kasus</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background: #f5f7fb;
            font-family: 'poppins';
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            width: 90%;
            margin: 30px auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .title {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .chart-container {
            position: relative;
            height: 300px; 
        }

        .filter {
            margin-bottom: 10px;
        }

        .filter button {
            border: none;
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 5px;
            cursor: pointer;
            background: #eee;
        }

        .filter button.active {
            background: #0d2b5c;
            color: white;
        }

        .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.filter-right {
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-right button {
    border: none;
    padding: 5px 12px;
    border-radius: 6px;
    cursor: pointer;
    background: #eee;
    font-size: 13px;
}

.filter-right button.active {
    background: #0d2b5c;
    color: white;
}

.filter-right select {
    padding: 5px 8px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 13px;
}

        select {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-left: 10px;
}
    </style>
</head>

<body>

<div class="card">

    <!-- 🔥 TOP BAR (KIRI: JUDUL | KANAN: FILTER) -->
    <div class="top-bar">
        <div class="title">Tren Kasus TBC</div>

        <div class="filter-right">
            <button id="btnTahun" class="active" onclick="setMode('tahun')">Tahunan</button>
            <button id="btnBulan" onclick="setMode('bulan')">Bulanan</button>

            <select id="tahunSelect" onchange="gantiTahun()">
                <?php foreach ($tahun as $t): ?>
                    <option value="<?= $t->label ?>" <?= $t->label == $tahunDefault ? 'selected' : '' ?>>
                        <?= $t->label ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- 🔥 CHART -->
    <div class="chart-container">
        <canvas id="lineChart"></canvas>
    </div>

</div>


<script>
/// 🔥 DATA DARI CONTROLLER
let dataTahun = {
    labels: <?= json_encode(array_column($tahun, 'label')) ?>,
    data: <?= json_encode(array_column($tahun, 'jumlah')) ?>
};

let dataBulan = {
   labels: <?= json_encode(array_map(function($b){
    $map = [
        '01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr',
        '05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu',
        '09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'
    ];
    return $map[$b->bulan];
}, $bulan)) ?>,
    data: <?= json_encode(array_column($bulan, 'jumlah')) ?>
};

let mode = 'tahun';
let chart;

// 🔥 RENDER
function renderChart(data) {
    if (chart) chart.destroy();

    chart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.data,
                borderColor: '#0d2b5c',
                borderWidth: 4,
                pointBackgroundColor: '#0d2b5c',
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Jumlah: ' + context.raw + ' kasus';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#eee' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
}

// 🔥 SWITCH MODE
function setMode(m) {
    mode = m;

    document.getElementById('btnTahun').classList.remove('active');
    document.getElementById('btnBulan').classList.remove('active');

    if (mode === 'tahun') {
        document.getElementById('btnTahun').classList.add('active');
        renderChart(dataTahun);
    } else {
        document.getElementById('btnBulan').classList.add('active');
        renderChart(dataBulan);
    }
}

// 🔥 GANTI TAHUN (AJAX)
function gantiTahun() {
    let tahun = document.getElementById('tahunSelect').value;

    fetch(`/kasus/getBulan/${tahun}`)
        .then(res => res.json())
        .then(res => {
            dataBulan = {
                labels: res.labels,
                data: res.data
            };

            if (mode === 'bulan') {
                renderChart(dataBulan);
            }
        });
}

// default
renderChart(dataTahun);
</script>

<div class="card mt-4">
    <h4>Kasus Berdasarkan Kelurahan</h4>
    <canvas id="kelChart"></canvas>
</div>

<script>
const kelChart = new Chart(document.getElementById('kelChart'), {
    type: 'bar',
    data: {
        labels: <?= $kelurahanLabels ?>,
        datasets: [{
            data: <?= $kelurahanValues ?>,
            backgroundColor: [
                '#cddc39','#80cbc4','#455a64',
                '#e57373','#ffca28','#9575cd','#4db6ac'
            ],
            borderRadius: 8
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>


</body>
</html>