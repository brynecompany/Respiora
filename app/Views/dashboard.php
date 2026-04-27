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

.blue { background: #E4EFFF; color: #2563eb; }
.red { background: #FFE4E4; color: #dc2626; }
.green { background: #E6F9EC; color: #16a34a; }

/* CHART */
.chart-box {
    margin-top: 20px;
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

.list-item {
    font-size: 13px;
    margin: 6px 0 0 5px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.list-item i {
    font-size: 11px;
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
                        <div class="stat-number text-primary">30</div>
                        <div class="stat-label">Jumlah Kasus TBC</div>
                    </div>
                    <div class="stat-icon blue">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box stat-card box-style">
                    <div>
                        <div class="stat-number text-danger">18</div>
                        <div class="stat-label">Kasus Baru Bulan ini</div>
                    </div>
                    <div class="stat-icon red">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box stat-card box-style">
                    <div>
                        <div class="stat-number text-success">7</div>
                        <div class="stat-label">Kelurahan</div>
                    </div>
                    <div class="stat-icon green">
                        <i class="fa-solid fa-house"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- CHART -->
        <div class="card-box chart-box box-style">
            <h5>Jumlah Kasus TBC</h5>
            <canvas id="chartTbc"></canvas>
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
                <div class="list-item"><i class="fa-solid fa-house"></i> Kelurahan Tambakmas</div>
                <div class="list-item"><i class="fa-solid fa-house"></i> Kelurahan Bumi Ayu</div>
                <div class="list-item"><i class="fa-solid fa-house"></i> Kelurahan Mawar</div>
            </div>

            <div class="mt-3">
                <div class="badge-box badge-yellow">
                    <i class="fa-solid fa-house"></i> Risiko Sedang
                </div>
                <div class="list-item"><i class="fa-solid fa-house"></i> Kelurahan Hijo</div>
                <div class="list-item"><i class="fa-solid fa-house"></i> Kelurahan Gebang</div>
                <div class="list-item"><i class="fa-solid fa-house"></i> Kelurahan Sumber</div>
            </div>

            <div class="mt-3">
                <div class="badge-box badge-green">
                    <i class="fa-solid fa-house"></i> Risiko Rendah
                </div>
                <div class="list-item"><i class="fa-solid fa-house"></i> Kelurahan Sukomaju</div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// CHART
new Chart(document.getElementById('chartTbc'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agst','Sep','Okt','Nov','Des'],
        datasets: [{
            data: [50,150,80,200,90,250,60,210,70,100,60,180],
            borderWidth: 3,
            tension: 0.4
        }]
    },
    options: { plugins:{legend:{display:false}} }
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
</script>

<?= $this->endSection() ?>