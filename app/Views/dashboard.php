<?= $this->extend('layout/main_layout') ?>

<?= $this->section('style') ?>
<style>

.box-style {
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 4px 4px rgba(0,0,0,0.25);
}

/* CARD */
.card-box {
    position: relative; 
    margin-left: -10px;
}

.stat-card {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    min-height: 100px;
}

/* ANGKA */
.stat-number {
    font-size: 25px; 
    font-weight: bold;
    position: absolute;
    top: 12px;
    left: 15px;
}

/* TEXT */
.stat-label {
    font-size: 15px; 
    color: #666;
    margin-top: 45px; 
    line-height: 1.3;
}

/* ICON */
.stat-icon {
    font-size: 18px;
    padding: 8px;
    border-radius: 8px;
    
    position: absolute;
    top: 12px;
    right: 12px;

    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-blue { background: #E4EFFF; color: #2563eb; }
.icon-red { background: #FFE4E4; color: #dc2626; }
.icon-green { background: #E6F9EC; color: #16a34a; }

/* CHART */
.chart-box {
    margin-top: 20px;
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.chart-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* TOGGLE */
.toggle {
    display: flex;
    gap: 5px;
}

.toggle button {
    border: none;
    background: transparent;
    padding: 6px 12px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #102C57;
    cursor: pointer;
    transition: 0.2s;
}

/* DOT */
.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #102C57;
}

/* ACTIVE */
.toggle button.active {
    background: #102C57;
    color: white;
}

.toggle button.active .dot {
    background: white;
}

/* ICON TITIK 3 */
.more {
    font-size: 16px;
    cursor: pointer;
    color: #333;
}

/* RIGHT PANEL */
.side-box {
    overflow: hidden;
}

/* CALENDAR */
.calendar {
    width: 100%;
    text-align: center;
    margin-bottom: 20px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.calendar-days, .calendar-dates {
    display: grid;
    grid-template-columns: repeat(7,1fr);
    gap: 4px;
    margin-top: 10px;
}

.calendar-dates div {
    padding: 6px;
    font-size: 13px;
    border-radius: 6px;
}

.today {
    background: transparent;
    border: 2px solid #102C57;
    color: #102C57;
    font-weight: bold;
}

.divider {
    border-top: 1px solid #ddd;
    margin: 15px 0;
}

/* BADGE */
.badge-box {
    width: 100%;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 13px;
    color: white;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
}

.badge-box i {
    font-size: 12px;
}

.badge-red { background: #F01E21; }
.badge-yellow { background: #FFAD00; }
.badge-green { background: #07D72A; }
.text-red-soft {
    color: rgba(240, 30, 33, 0.7); /* pudar */
}
.text-yellow-soft {
    color: rgba(255, 173, 0, 0.7);
}
.text-green-soft {
    color: rgba(7, 215, 42, 0.7);
}

.list-item {
    font-size: 13px;
    margin: 6px 0 0 35px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.list-item i {
    font-size: 11px;
}

.filter-wrap {
    position: relative;
}

/* ICON FILTER */
.filter-icon {
    font-size: 16px;
    cursor: pointer;
    padding: 8px;
    border-radius: 10px;
    border: 1px solid #102C57;
    color: #102C57;
    transition: 0.2s;
}

.filter-icon:hover {
    background: #102C57;
    color: white;
}

/* DROPDOWN */
.filter-dropdown {
    position: absolute;
    top: 35px;
    right: 0;
    display: none;

    width: 90px;            
    padding: 5px 8px;      
    font-size: 13px;       

    border-radius: 10px;
    border: 1px solid #ccc;
    background: white;

    max-height: 150px;     
    overflow-y: auto;

    z-index: 99;
}

.artikel-list {
    margin-top: 10px;
}

.artikel-item {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom: 12px;
}

.artikel-item img {
    width: 55px;
    height: 55px;
    border-radius: 10px;
    object-fit: cover;
}

.judul {
    font-size: 14px;
    font-weight: 500;
}

/* MAP DASHBOARD */
.map-box {
    margin-top: 20px;
}

#mapDashboard {
    width: 100%;
    height: 260px;
    border-radius: 10px;
    margin-top: 20px;
}

.legend-dashboard {
    position: absolute;
    right: 20px;
    top: 20px;
    background: #f5f1e6;
    padding: 12px 15px;
    border-radius: 10px;
    font-size: 12px;
}

.legend-dashboard .item {
    display: flex;
    align-items: center;
    margin-bottom: 6px;
}

.legend-dashboard .color {
    width: 12px;
    height: 12px;
    margin-right: 6px;
    border-radius: 3px;
}

.bg-red { background: #F01E21; }
.bg-yellow { background: #FFAD00; }
.bg-green { background: #07D72A; }

.label-kelurahan {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
    color: black;
    font-weight: bold;
    font-size: 12px;
    text-shadow: 1px 1px 2px white;
}

.leaflet-tooltip {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}

.legend-box {
    margin-top: 20px;
    position: relative;
    padding: 12px 12px 10px 12px;
    border: 1.5px solid #102C57;
    border-radius: 8px;
    background: white;
}

.legend-title {
    position: absolute;
    top: -13px;
    left: 15px;
    background: #102C57;
    color: white;
    padding: 4px 12px;
    font-weight: bold;
    font-size: 12px;
    border-radius: 6px;
}

.legend-row {
    display: flex;
    gap: 20px;
    justify-content: space-between;
    margin-top: 5px;
}

.legend-item {
    display: flex;
    align-items: center;
    font-size: 13px;
    background: #FFFBE1;
    padding: 6px 10px;
    border-radius: 6px;
}
.legend-item .color {
    width: 14px;
    height: 14px;
    margin-right: 8px;
    border-radius: 3px;
    display: inline-block;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row g-3">

    <!-- LEFT -->
    <div class="col-md-8">

        <!-- STAT -->
        <div class="row g-3">

            <div class="col-md-4">
                <div class="card-box stat-card box-style">
                    <div>
                        <div class="stat-number text-primary"> <?= $totalKasus ?> </div>
                        <div class="stat-label">Jumlah Kasus TBC</div>
                    </div>
                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box stat-card box-style">
                    <div>
                        <div class="stat-number text-danger"> <?= $kasusBulanIni ?> </div>
                        <div class="stat-label">Kasus Baru Bulan ini</div>
                    </div>
                    <div class="stat-icon icon-red">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box stat-card box-style">
                    <div>
                        <div class="stat-number text-success"> <?= $totalKelurahan ?> </div>
                        <div class="stat-label">Kelurahan</div>
                    </div>
                    <div class="stat-icon icon-green">
                        <i class="fa-solid fa-house"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- CHART -->
        <div class="card-box chart-box box-style">
        <div class="chart-header">
        <h5>Jumlah Kasus TBC</h5>

            <div class="chart-actions">
                <div class="toggle">
                    <button id="btnBulanan" class="active">
                        <span class="dot"></span> Bulanan
                    </button>
                    <button id="btnTahunan">
                        <span class="dot"></span> Tahunan
                    </button>
                </div>

                <div class="filter-wrap">
                    <i class="fa-solid fa-sliders filter-icon" id="btnFilter"></i>
                    <select id="filterTahun" class="filter-dropdown">
                        <?php for($i=2016; $i<=2030; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>
            <canvas id="chartTbc"></canvas>
        </div>
        
        <!-- PETA -->
        <div class="card-box box-style map-box">
            <h6>Peta Sebaran</h6>

            <div style="position: relative;">
                <div id="mapDashboard"></div>
                <!-- KETERANGAN -->
                <div class="legend-box">
                    <div class="legend-title">Keterangan</div>

                    <div class="legend-row">
                        <div class="legend-item">
                            <span class="color bg-red"></span> Tinggi (>15 Kasus)
                        </div>

                        <div class="legend-item">
                            <span class="color bg-yellow"></span> Sedang (6-15 Kasus)
                        </div>

                        <div class="legend-item">
                            <span class="color bg-green"></span> Rendah (0-5 Kasus)
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="col-md-4">

        <div class="side-box box-style">

            <!-- CALENDAR -->
            <div class="calendar">
                <div class="calendar-header">
                    <button id="prev">‹</button>
                    <h6 id="monthYear"></h6>
                    <button id="next">›</button>
                </div>

                <div class="calendar-days">
                    <div>S</div><div>M</div><div>T</div>
                    <div>W</div><div>T</div><div>F</div><div>S</div>
                </div>

                <div class="calendar-dates" id="dates"></div>
            </div>

            <div class="divider"></div>

            <!-- RISIKO -->
            <h6>Wilayah Kelurahan Berisiko</h6>

            <div class="mt-3">
                <div class="badge-box badge-red">
                    <i class="fa-solid fa-house"></i> Risiko Tinggi
                </div>

                <?php foreach($risiko['tinggi'] as $r): ?>
                    <div class="list-item text-red-soft">
                        <i class="fa-solid fa-house"></i>
                        <!--  <?= $r->nama_wilayah ?> -->
                        <?= $wilayahNames[$r->id_wilayah] ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-3">
                <div class="badge-box badge-yellow">
                    <i class="fa-solid fa-house"></i> Risiko Sedang
                </div>

                <?php foreach($risiko['sedang'] as $r): ?>
                    <div class="list-item text-yellow-soft">
                        <i class="fa-solid fa-house"></i>
                        <!--  <?= $r->nama_wilayah ?> -->
                        <?= $wilayahNames[$r->id_wilayah] ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-3">
                <div class="badge-box badge-green">
                    <i class="fa-solid fa-house"></i> Risiko Rendah
                </div>

                <?php foreach($risiko['rendah'] as $r): ?>
                    <div class="list-item text-green-soft">
                        <i class="fa-solid fa-house"></i>
                        <!--  <?= $r->nama_wilayah ?> -->
                        <?= $wilayahNames[$r->id_wilayah] ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="box-style mt-3">
            <h6>Artikel Yang Dibuat Bulan Ini</h6>

            <div class="artikel-list">

                <div class="artikel-item">
                    <img src="/img1.jpg">
                    <div>
                        <div class="judul">Judul Artikel 1</div>
                        <small>01/02/26</small>
                    </div>
                </div>

                <div class="artikel-item">
                    <img src="/img2.jpg">
                    <div>
                        <div class="judul">Judul Artikel 2</div>
                        <small>12/02/26</small>
                    </div>
                </div>

                <div class="artikel-item">
                    <img src="/img3.jpg">
                    <div>
                        <div class="judul">Judul Artikel 3</div>
                        <small>13/02/26</small>
                    </div>
                </div>

                <div class="artikel-item">
                    <img src="/img4.jpg">
                    <div>
                        <div class="judul">Judul Artikel 4</div>
                        <small>15/02/26</small>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// CHART
const bulanLabels = <?= $bulanLabels ?>;
const bulanData   = <?= $bulanValues ?>;

const tahunLabels = <?= $trend_labels ?>;
const tahunData   = <?= $trend_values ?>;

const ctx = document.getElementById('chartTbc').getContext('2d');

let chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Jumlah',
            data: bulanData,
            borderColor: '#102C57',
            borderWidth: 4,
            tension: 0.5,
            pointRadius: 5,
            pointBackgroundColor: '#102C57',
            fill: false
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
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

// EVENT BULANAN
document.getElementById('btnBulanan').onclick = function () {
    chart.data.labels = bulanLabels;
    chart.data.datasets[0].data = bulanData;
    chart.update();

    this.classList.add('active');
    document.getElementById('btnTahunan').classList.remove('active');
};

// EVENT TAHUNAN
document.getElementById('btnTahunan').onclick = function () {
    chart.data.labels = tahunLabels;
    chart.data.datasets[0].data = tahunData;
    chart.update();

    this.classList.add('active');
    document.getElementById('btnBulanan').classList.remove('active');
};

// Filter Grafik
const btnFilter = document.getElementById('btnFilter');
const filterTahun = document.getElementById('filterTahun');

// toggle dropdown
btnFilter.onclick = function () {
    // kalau disabled → ga bisa klik
    if(btnFilter.style.opacity == "0.3") return;

    if(filterTahun.style.display === 'block'){
        filterTahun.style.display = 'none';
    } else {
        filterTahun.style.display = 'block';
    }
};

// klik luar → tutup dropdown
window.addEventListener('click', function(e){
    if(!e.target.closest('.filter-wrap')){
        filterTahun.style.display = 'none';
    }
});

// default: aktif di bulanan
btnFilter.style.opacity = 1;

// override event bulanan
document.getElementById('btnBulanan').onclick = function () {
    chart.data.labels = bulanLabels;
    chart.data.datasets[0].data = bulanData;
    chart.update();

    this.classList.add('active');
    document.getElementById('btnTahunan').classList.remove('active');

    // FILTER AKTIF DI BULANAN
    btnFilter.style.opacity = 1;
};

// override event tahunan
document.getElementById('btnTahunan').onclick = function () {
    chart.data.labels = tahunLabels;
    chart.data.datasets[0].data = tahunData;
    chart.update();

    this.classList.add('active');
    document.getElementById('btnBulanan').classList.remove('active');

    // FILTER MATI DI TAHUNAN
    btnFilter.style.opacity = 0.3;
    filterTahun.style.display = 'none';
};

// change tahun → update chart
filterTahun.addEventListener('change', function(){
    let tahun = this.value;

    fetch("<?= base_url('dashboard/getByYear') ?>/" + tahun)
    .then(res => res.json())
    .then(res => {
        chart.data.labels = res.labels;
        chart.data.datasets[0].data = res.data;
        chart.update();
    });
});

// CALENDAR
const monthYear = document.getElementById("monthYear");
const dates = document.getElementById("dates");
let currentDate = new Date();

function renderCalendar(date){
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month+1, 0).getDate();

    monthYear.innerText = date.toLocaleString('default',{month:'long', year:'numeric'});
    dates.innerHTML = "";

    for(let i=0;i<firstDay;i++) dates.innerHTML += "<div></div>";

    for(let d=1; d<=lastDate; d++){
        let todayClass = "";
        if(d === new Date().getDate() &&
           month === new Date().getMonth() &&
           year === new Date().getFullYear()){
            todayClass = "today";
        }
        dates.innerHTML += `<div class="${todayClass}">${d}</div>`;
    }
}

document.getElementById("prev").onclick = ()=> {
    currentDate.setMonth(currentDate.getMonth()-1);
    renderCalendar(currentDate);
};

document.getElementById("next").onclick = ()=> {
    currentDate.setMonth(currentDate.getMonth()+1);
    renderCalendar(currentDate);
};

renderCalendar(currentDate);

// =======================
// MAP DASHBOARD
// =======================

var map = L.map('mapDashboard', {
    zoomControl: true,
    attributionControl: false
}).setView([-8.173, 113.700], 12);

// base map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

// warna
function getColor(cluster){
    if(cluster == 2) return '#F01E21';
    if(cluster == 1) return '#FFAD00';
    return '#07D72A';
}

// data dari backend (SAMA PERSIS)
var wilayah_kasus = <?= json_encode($wilayah_kasus ?? []) ?>;

var clusterMap = {};
var kasusMap = {};

wilayah_kasus.forEach(function(w){
    clusterMap[w.id_wilayah] = w.cluster;
    kasusMap[w.id_wilayah] = w.jumlah_kasus;
});

// load geojson
fetch("<?= base_url('assets/geojson/Kaliwates.json') ?>")
.then(res => res.json())
.then(data => {

    var geoLayer = L.geoJSON(data, {

        style: function(feature){
            var id = parseInt(feature.properties.id_wilayah);
            var cluster = clusterMap[id] ?? 0;

            return {
                fillColor: getColor(cluster),
                weight: 1,
                color: 'black',
                fillOpacity: 1
            };
        },

        onEachFeature: function(feature, layer){
            var namaKel = feature.properties.WADMKD;
            var id = parseInt(feature.properties.id_wilayah);
            var kasus = kasusMap[id] ?? 0;

            // TOOLTIP NAMA (INI YANG BELUM ADA)
            layer.bindTooltip(namaKel, {
                permanent: true,
                direction: "center",
                className: "label-kelurahan"
            });

            // POPUP
            layer.bindPopup(
                "<b>" + namaKel + "</b><br>" +
                "Total Kasus TB: <b>" + kasus + "</b>"
            );
            /* layer.bindPopup(
                "<b>" + namaKel + "</b><br>" +
                "Total Kasus TB: <b>" + kasus + "</b><br>" +
                "Wilayah: <b>" + wilayahNames[feature.properties.id_wilayah] + "</b>"
            ); */

            // HOVER AUTO OPEN
            layer.on('mouseover', function () {
                this.openPopup();
            });

            layer.on('mouseout', function () {
                this.closePopup();
            });
        }

    }).addTo(map);

    map.fitBounds(geoLayer.getBounds());
});

// =======================
// MINI KOMPAS
// =======================
var compass = L.control({position: 'topright'});

compass.onAdd = function(map){
    var div = L.DomUtil.create('div', 'compass-wrapper leaflet-control');
    div.innerHTML = `
    <svg width="120" height="120" viewBox="0 0 512 512">
        
        <polygon points="256,60 276,256 256,236 236,256" fill="black"/>
        <polygon points="452,256 256,276 276,256 256,236" fill="black"/>
        <polygon points="256,452 236,256 256,276 276,256" fill="black"/>
        <polygon points="60,256 256,236 236,256 256,276" fill="black"/>

        <polygon points="360,150 276,256 256,236 276,236" fill="black"/>
        <polygon points="360,360 256,276 276,256 276,276" fill="black"/>
        <polygon points="150,360 236,256 256,276 236,276" fill="black"/>
        <polygon points="150,150 256,236 236,256 236,236" fill="black"/>

        <text x="256" y="40" text-anchor="middle" font-size="45" font-weight="bold">U</text>
        <text x="256" y="500" text-anchor="middle" font-size="45" font-weight="bold">S</text>
        <text x="30" y="270" text-anchor="middle" font-size="45" font-weight="bold">T</text>
        <text x="482" y="270" text-anchor="middle" font-size="45" font-weight="bold">B</text>
    </svg>
    `;
    return div;
};
compass.addTo(map);

compass.onAdd = function(map){
    var div = L.DomUtil.create('div');
    div.innerHTML = `
    <div style="background:white;padding:5px;border-radius:10px;">
        <svg width="50" height="50" viewBox="0 0 512 512">
            <polygon points="256,60 276,256 256,236 236,256" fill="black"/>
            <polygon points="256,452 236,256 256,276 276,256" fill="black"/>
            <text x="256" y="40" text-anchor="middle" font-size="40">U</text>
            <text x="256" y="500" text-anchor="middle" font-size="40">S</text>
        </svg>
    </div>
    `;
    return div;
};

compass.addTo(map);
</script>

<?= $this->endSection() ?>