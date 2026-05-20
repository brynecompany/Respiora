<?= $this->extend('layout/main_layout') ?>
<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.card {
    background: white;
    border-radius: 18px;
    padding: 30px;
    width: 100%;
    margin: 15px auto;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
}

.top-bar {
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.filter-right {
    display:flex;
    gap:8px;
    align-items:center;
    margin-right: 20px;
}

.filter-right button {
    border: 1px solid #dcdcdc;
    padding: 5px 12px;
    border-radius: 8px;
    cursor: pointer;
    background: white;
}

.filter-right button.active {
    background: #0d2b5c;
    color: white;
}

.chart-container {
    height:350px;
}
#usiaChart {
    display:flex;
    flex-direction:column;
    gap:12px;
    margin-top:10px;
}

.usia-bar-wrap {
    display:flex;
    align-items:center;
    gap:10px;
}

.usia-bar-bg {
    flex:1;
    background:#e6eef5;
    height:36px;
    border-radius:6px;
    position:relative;
    overflow:hidden;
}

.usia-bar-fill {
    height:100%;
    border-radius:6px;
    display:flex;
    align-items:center;
    justify-content:flex-end;
    padding-right:10px;
    color:white;
    font-weight:600;
    transition:0.5s;
}

.usia-label {
    width:110px;
    font-size:13px;
    color:#555;
}
.usia-tooltip {
    position: absolute;
    top: -35px;
    right: 10px;
    background: #0d2b5c;
    color: white;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    display: none;
    white-space: nowrap;
}

.chart-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    width: 100%;
}

.small-card {
    padding: 20px;
    margin : 10px;
}

.small-card canvas {
    height: 500px;
}

.card-header-action {
    max-width: 1050px;
    margin: 0 auto 10px auto;
    display: flex;
    justify-content: flex-end;
}

.container-main {
    max-width: 1050px;
    margin: auto;
}

.btn-download {
    background: #0d2b5c;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.2s;
    box-shadow: 0 4px 10px rgba(26,86,219,0.25);
}

.btn-download:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 14px rgba(26,86,219,0.35);
}

.modal-custom {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.3);
}

.modal-box {
    background: #dcdcdc;
    width: 600px;
    margin: 8% auto;
    padding: 25px 30px;
    border-radius: 15px;
    font-family: 'Poppins', sans-serif;
}

.modal-box h3 {
    margin-bottom: 10px;
}

.sub-title {
    margin: 15px 0;
    font-size: 14px;
}

.filter-grid {
    display: flex;
    justify-content: space-between;
}

.filter-grid label {
    display: block;
    margin-bottom: 12px;
    font-size: 14px;
}

/* checkbox biar clean */
input[type="checkbox"] {
    margin-right: 8px;
}

/* tombol bawah */
.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.btn-unduh {
    background: #1f3c88;
    color: white;
    border: none;
    padding: 8px 18px;
    border-radius: 8px;
    cursor: pointer;
}

.btn-tutup {
    background: #888;
    color: white;
    border: none;
    padding: 8px 18px;
    border-radius: 8px;
    cursor: pointer;
}

.btn-unduh:hover {
    background: #162d66;
}

.btn-tutup:hover {
    background: #666;
}

.card-header-custom {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-filter {
    width: 40px;
    height: 40px;
    cursor: pointer;
    opacity: 0.7;
    transition: 0.2s;
}

.btn-filter:hover {
    opacity: 1;
    transform: scale(1.1);
}

.top-barh {
    display: flex;
    align-items: center;
    gap: 15px;
    background: linear-gradient(90deg, #081F5C, #5E9ADF);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.top-barh .header-icon img {
    width: 70px;      /* atur ukuran icon */
    height: 70px;
    object-fit: contain;
}


</style>

<!-- HEADER -->
<div class="top-barh">
    <div class="header-icon">
        <img src="/assets/img/icon_breadcrumb.svg" alt="Icon" style="width: 30px; height: 30px;">
    </div>
    <div>
        <h5>Grafik Kasus</h5>
        <small>Visualisasi grafik untuk pemantauan TBC</small>
    </div>
</div>

<div class="card-header-action">

    <button class="btn btn-download" onclick="openFilterModal()">
    Unduh Laporan
</button>
</div>

<div id="filterModal" class="modal-custom">
    <div class="modal-box">
        <h3>Filter Laporan</h3>
        <hr>

        <p class="sub-title">Unduh Laporan Berdasarkan :</p>

        <div class="filter-grid">
            <div class="left">
                <label><input type="checkbox" value="tren"> Tren Kasus TBC</label>
                <label><input type="checkbox" value="desa"> Kasus Berdasarkan Desa</label>
                <label><input type="checkbox" value="umur"> Kasus Berdasarkan Kelompok Umur</label>
            </div>

            <div class="right">
                <label><input type="checkbox" value="status"> Status Pengobatan Pasien</label>
                <label><input type="checkbox" value="jk"> Jenis Kelamin</label>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn-unduh" onclick="downloadByFilter()">UNDUH</button>
            <button class="btn-tutup" onclick="closeFilterModal()">TUTUP</button>
        </div>
    </div>
</div>

<div id="areaDownload">

    <!-- 📈 TREND -->
    <div class="card" id="section-tren">
    <div class="top-bar">
        <div><h3>Tren Kasus Tuberculosisss</h3></div>

        <div class="filter-right">
            <button id="btnTahun" class="active">Tahunan</button>
            <button id="btnBulan">Bulanan</button>

            <select id="tahunSelect">
                <?php foreach ($tahun as $t): ?>
                    <option value="<?= $t->label ?>" <?= $t->label == $tahunDefault ? 'selected' : '' ?>>
                        <?= $t->label ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="chart-container">
        <canvas id="lineChart"></canvas>
    </div>
</div>

<div class="card">
<h3 style="margin-top:20px;">Distribusi Kasus</h3>

<div class="card" id="section-desa">
     <div class="card-header-custom">
        <h4>Kasus Berdasarkan Kelurahan</h4>
        <img src="<?= base_url('assets/images/filter.png') ?>" class="btn-filter" onclick="openFilter('desa')">
    </div>
    <canvas id="kelChart"></canvas>
</div>

<div class="card" id="section-umur">
    <div class="card-header-custom">
        <h4>Kasus Berdasarkan Kelompok Umur</h4>
        <img src="<?= base_url('assets/images/filter.png') ?>" class="btn-filter" onclick="openFilter('umur')">
    </div>
    <div id="usiaChart"></div>
    <div id="usiaLegend"></div>
</div>

<div class="chart-row">
    <div class="card small-card" id="section-status">
        <div class="card-header-custom">
        <h4>Status Pengobatan</h4>
        <img src="<?= base_url('assets/images/filter.png') ?>" class="btn-filter" onclick="openFilter('status')">
    </div>
        <canvas id="pengobatanChart"></canvas>
    </div>

    <div class="card small-card" id="section-jk">
        <div class="card-header-custom">
        <h4>Jenis Kelamin</h4>
        <img src="<?= base_url('assets/images/filter.png') ?>" class="btn-filter" onclick="openFilter('jk')">
    </div>
        <canvas id="jkChart"></canvas>
    </div>
</div>
</div>

<div id="filterChartModal" class="modal-custom">
    <div class="modal-box">
        <h3>Filter Data</h3>
        <hr>

        <div id="filterContent"></div>

        <div class="modal-footer">
            <button class="btn-unduh" onclick="applyFilter()">Terapkan</button>
            <button class="btn-tutup" onclick="closeChartFilter()">Tutup</button>
        </div>
    </div>
</div>

<script>
    let kelChart, pengobatanChart, jkChart;
let currentChart = null;

let originalData = {
    desa: {
        labels: <?= $kelurahanLabels ?>,
        data: <?= $kelurahanValues ?>,
        colors: [
            '#cddc39','#8bc34a','#607d8b',
            '#ef5350','#ffca28','#9575cd','#4db6ac'
        ]
    },
    status: {
        labels: <?= $pengobatanLabels ?>,
        data: <?= $pengobatanValues ?>,
        colors: ['#26a69a','#42a5f5','#7e57c2','#ffa726']
    },
    jk: {
        labels: <?= $jkLabels ?>,
        data: <?= $jkValues ?>,
        colors: ['#26a69a','#ec407a']
    },
    umur: {
        labels: <?= $usiaLabels ?>,
        data: <?= $usiaValues ?>,
        colors: ['#039be5','#00acc1','#00bfa5','#7cb342','#5c6bc0']
    }
};

document.addEventListener("DOMContentLoaded", function(){

    let chart;
    let mode = 'tahun';

    const btnTahun = document.getElementById('btnTahun');
    const btnBulan = document.getElementById('btnBulan');
    const tahunSelect = document.getElementById('tahunSelect');

    let dataTahun = {
        labels: <?= json_encode(array_map(fn($t)=>$t->label,$tahun)) ?>,
        data: <?= json_encode(array_map(fn($t)=>$t->jumlah,$tahun)) ?>
    };

    let dataBulan = {
        labels: <?= $bulanLabels ?>,
        data: <?= $bulanValues ?>
    };

    function renderChart(labels, data){
        if(chart) chart.destroy();

        chart = new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    borderColor: '#0d2b5c',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 4
                }]
            },
            options:{
                responsive:true,
                maintainAspectRatio:false,
                plugins:{ legend:{ display:false } }
            }
        });
    }

    btnTahun.addEventListener('click', function(){
        mode = 'tahun';
        btnTahun.classList.add('active');
        btnBulan.classList.remove('active');
        renderChart(dataTahun.labels, dataTahun.data);
    });

    btnBulan.addEventListener('click', function(){
        mode = 'bulan';
        btnBulan.classList.add('active');
        btnTahun.classList.remove('active');
        loadBulan();
    });

    tahunSelect.addEventListener('change', function(){
        if(mode === 'bulan'){
            loadBulan();
        }
    });

    function loadBulan(){
        let tahun = tahunSelect.value;

        fetch("<?= base_url('kasus/getBulan') ?>/" + tahun)
        .then(res => res.json())
        .then(res => {
            renderChart(res.labels, res.data);
        });
    }

    renderChart(dataTahun.labels, dataTahun.data);

});

// =======================
// 📊 KELURAHAN (BAR)
// =======================
kelChart = new Chart(document.getElementById('kelChart'), {
    type: 'bar',
    data: {
        labels: <?= $kelurahanLabels ?>,
        datasets: [{
            label: 'Jumlah Kasus',
            data: <?= $kelurahanValues ?>,
            backgroundColor: [
                '#cddc39','#8bc34a','#607d8b',
                '#ef5350','#ffca28','#9575cd','#4db6ac'
            ],
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


// =======================
// 💊 STATUS PENGOBATAN (DONUT)
// =======================
pengobatanChart = new Chart(document.getElementById('pengobatanChart'), {
    type: 'doughnut',
    data: {
        labels: <?= $pengobatanLabels ?>,
        datasets: [{
            data: <?= $pengobatanValues ?>,
            backgroundColor: [
                '#26a69a', // sembuh
                '#42a5f5', // dalam pengobatan
                '#7e57c2', // drop out
                '#ffa726'  // meninggal
            ]
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: {
                position: 'right'
            }
        }
    }
});


// =======================
// 🚻 JENIS KELAMIN (DONUT)
// =======================
jkChart = new Chart(document.getElementById('jkChart'), {
    type: 'doughnut',
    data: {
        labels: <?= $jkLabels ?>,
        datasets: [{
            data: <?= $jkValues ?>,
            backgroundColor: [
                '#26a69a', // laki-laki
                '#ec407a'  // perempuan
            ]
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: {
                position: 'right'
            }
        }
    }
});

// =======================
// 👶 KELOMPOK USIA (UI BAGUS)
// =======================
let usiaLabels = <?= $usiaLabels ?>;
let usiaValues = <?= $usiaValues ?>;

let container = document.getElementById('usiaChart');
container.innerHTML = '';

// total untuk persen
let total = usiaValues.reduce((a, b) => a + b, 0);

// warna sesuai UI kamu
let colors = [
    '#039be5', // biru
    '#00acc1', // cyan
    '#00bfa5', // hijau toska
    '#7cb342', // hijau
    '#5c6bc0'  // ungu
];

usiaLabels.forEach((label, i) => {

    let persen = total === 0 ? 0 : Math.round((usiaValues[i] / total) * 100);
    let displayWidth = persen < 5 && persen > 0 ? 5 : persen;

    let row = document.createElement('div');
    row.style.display = 'flex';
    row.style.alignItems = 'center';
    row.style.marginBottom = '12px';

    row.innerHTML = `
        <div style="
            flex:1;
            background:#e3edf5;
            border-radius:8px;
            overflow:hidden;
            height:38px;
            position:relative;
        ">
            <div style="
                width:${displayWidth}%;
                background:${colors[i]};
                height:100%;
                display:flex;
                align-items:center;
                justify-content:flex-end;
                padding-right:10px;
                color:white;
                font-weight:600;
                border-radius:8px;
                transition:0.6s;
            ">
                ${persen}% (${usiaValues[i]})
            </div>
        </div>

        <div style="
            width:140px;
            margin-left:12px;
            font-size:14px;
            color:#333;
        ">
            ${label}
        </div>
    `;

    container.appendChild(row);
});

async function downloadPDFChart(){

    const { jsPDF } = window.jspdf;
    const element = document.getElementById("areaDownload");

    const canvas = await html2canvas(element, { scale: 2 });

    const imgData = canvas.toDataURL("image/png");

    const pdf = new jsPDF('p','mm','a4');

    const pageWidth = pdf.internal.pageSize.getWidth();
    const imgWidth = pageWidth - 20;
    const imgHeight = canvas.height * imgWidth / canvas.width;

    pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
    pdf.save("RESPIORA - Kasus TB.pdf");
}

function openFilterModal() {
    document.getElementById("filterModal").style.display = "block";
}

function closeFilterModal() {
    document.getElementById("filterModal").style.display = "none";
}

async function downloadByFilter(){

    let selected = [];

    document.querySelectorAll('#filterModal input[type="checkbox"]:checked')
        .forEach(el => selected.push(el.value));

    if (selected.length === 0) {
        alert("Pilih minimal 1 filter!");
        return;
    }

    closeFilterModal();

    const original = document.getElementById("areaDownload");
    const clone = original.cloneNode(true);

    clone.style.background = "white";
    clone.style.padding = "20px";
    clone.style.width = original.offsetWidth + "px";

    // 🔥 convert chart jadi gambar
const canvasIds = [
    "lineChart",
    "kelChart",
    "pengobatanChart",
    "jkChart"
];

canvasIds.forEach(id => {
    const originalCanvas = original.querySelector("#" + id);
    const cloneCanvas = clone.querySelector("#" + id);

    if (originalCanvas && cloneCanvas) {
        const img = document.createElement("img");
        img.src = originalCanvas.toDataURL("image/png");
        img.style.width = "100%";
        cloneCanvas.replaceWith(img);
    }
});


    // 🔥 filter section
    const mapping = {
        tren: 'section-tren',
        desa: 'section-desa',
        umur: 'section-umur',
        status: 'section-status',
        jk: 'section-jk'
    };

    Object.entries(mapping).forEach(([key, id]) => {
        if (!selected.includes(key)) {
            let el = clone.querySelector("#" + id);
            if(el) el.remove();
        }
    });

    clone.style.position = "absolute";
    clone.style.left = "-9999px";
    document.body.appendChild(clone);

    await new Promise(r => setTimeout(r, 700));

    const canvas = await html2canvas(clone, {
        scale: 3,
        useCORS: true
    });

    document.body.removeChild(clone);

    const imgData = canvas.toDataURL("image/png");

    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('p','mm','a4');

    const pageWidth = pdf.internal.pageSize.getWidth();
    const pageHeight = pdf.internal.pageSize.getHeight();

    const imgWidth = pageWidth;
    const imgHeight = canvas.height * imgWidth / canvas.width;

    let y = 0;

    while (y < imgHeight) {
        pdf.addImage(imgData, 'PNG', 0, -y, imgWidth, imgHeight);
        y += pageHeight;

        if (y < imgHeight) pdf.addPage();
    }

    pdf.save("Laporan RESPIORA.pdf");
}

function openFilter(type){
    currentChart = type;

    let content = document.getElementById('filterContent');
    let data = originalData[type];

    let html = '';

    data.labels.forEach(label => {
        html += `
            <label>
                <input type="checkbox" value="${label}" checked>
                ${label}
            </label><br>
        `;
    });

    content.innerHTML = html;

    document.getElementById("filterChartModal").style.display = "block";
}

window.onclick = function(e) {
    let modal = document.getElementById("filterModal");
    if (e.target === modal) {
        modal.style.display = "none";
    }
}

function applyFilter(){

    let checked = [];
    document.querySelectorAll('#filterContent input:checked')
        .forEach(el => checked.push(el.value));

    let data = originalData[currentChart];

    let newLabels = [];
    let newData = [];
    let newColors = [];

    data.labels.forEach((label, i) => {
        if(checked.includes(label)){
            newLabels.push(label);
            newData.push(data.data[i]);
            newColors.push(data.colors[i]);
        }
    });

    // 🔥 HANDLE CHART
    if(currentChart === 'desa'){
        kelChart.destroy();
        kelChart = new Chart(document.getElementById('kelChart'), {
            type: 'bar',
            data: {
                labels: newLabels,
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: newData,
                    backgroundColor: newColors
                }]
            }
        });
    }

    if(currentChart === 'status'){
        pengobatanChart.destroy();
        pengobatanChart = new Chart(document.getElementById('pengobatanChart'), {
            type: 'doughnut',
            data: {
                labels: newLabels,
                datasets: [{
                    data: newData,
                    backgroundColor: ['#26a69a','#42a5f5','#7e57c2','#ffa726']
                }]
            }
        });
    }

    if(currentChart === 'jk'){
        jkChart.destroy();
        jkChart = new Chart(document.getElementById('jkChart'), {
            type: 'doughnut',
            data: {
                labels: newLabels,
                datasets: [{
                    data: newData,
                    backgroundColor: ['#26a69a','#ec407a']
                }]
            }
        });
    }

    if(currentChart === 'umur'){
        renderUsiaChart(newLabels, newData);
    }

    document.getElementById("filterChartModal").style.display = "none";
}

function renderUsiaChart(labels, values){

    let container = document.getElementById('usiaChart');
    container.innerHTML = '';

    let total = values.reduce((a, b) => a + b, 0);

    let colors = ['#039be5','#00acc1','#00bfa5','#7cb342','#5c6bc0'];

    labels.forEach((label, i) => {

        let persen = total === 0 ? 0 : Math.round((values[i] / total) * 100);

        let row = document.createElement('div');
        row.style.display = 'flex';
        row.style.marginBottom = '12px';

        row.innerHTML = `
            <div style="flex:1; background:#e3edf5; border-radius:8px;">
                <div style="
                    width:${persen}%;
                    background:${colors[i]};
                    height:38px;
                    display:flex;
                    align-items:center;
                    justify-content:flex-end;
                    padding-right:10px;
                    color:white;
                    border-radius:8px;
                ">
                    ${persen}%
                </div>
            </div>
            <div style="width:140px; margin-left:10px;">
                ${label}
            </div>
        `;

        container.appendChild(row);
    });
}
</script>


<?= $this->endSection() ?>