<?= $this->extend('layout/template') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>

        .header-peta {
            display: flex;
            align-items: center;
            gap: 15px;
            background: linear-gradient(90deg, #081F5C, #5E9ADF);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
        }

        .header-icon img {
            width: 40px;      /* atur ukuran icon */
            height: 40px;
            object-fit: contain;
        }

        .map-container { /**bagian peta*/
            background: white;
            border-radius: 10px;
            padding: 15px 30px;  /**atas bawah, kiri kanan peta*/
            margin-top: 20px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        }
        .filter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        #map {
            width: 100%;
            height: 25vh;
            min-height: 300px;
        }

        /**FILTER */
        .filter-btn {
            background: white;
            border: 1px solid #ddd;
            padding: 6px 8px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .filter-btn:hover {
            background: #E4EFFF;
            border-color: #081F5C;
        }

        .filter-btn i {
            color: #081F5C;
            font-size: 16px;
        }

        /**untuk popup peta hover */
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

        /**LONGITUDE LATITUDE DAN KETERANGAN*/
        /* Wrapper mengikuti lebar map */
        .info-wrapper {
            display: flex;
            gap: 20px;
            width: 100%;
            flex-wrap: wrap;   /* biar aman kalau layar kecil */
            margin-top: 20px;
        }

        /* Box Lat Long fleksibel */
        .info-box {
            flex: 1 1 250px;   /* grow, shrink, basis */
            background: #E4EFFF;
            padding: 15px;
            border-radius: 10px;
            border: 2px solid #081F5C;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        /* Box Keterangan fleksibel */
        .legend-box {
            flex: 2 1 400px;   /* lebih panjang dari lat-long */
            position: relative;
            padding: 25px 20px 15px 20px;
            border: 2px solid #081F5C;
            border-radius: 10px;
            background: white;
        }

        /* Isi legend tetap sejajar */
        .legend-row {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;   /* kalau layar kecil, item turun */
            justify-content: space-evenly;
        }

        /* Judul floating */
        .legend-title {
            position: absolute;
            top: -12px;
            left: 15px;
            background: #081F5C;
            color: white;
            padding: 4px 12px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 6px;
        }

        /* item tinggi, sedang, rendah */
        .legend-item {
            display: flex;
            align-items: center;
            font-size: 14px;
            background: #FFFBE1;
            padding: 5px;
            border-radius: 5px;
        }

        /* Kotak warna */
        .color {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            border-radius: 4px;
        }

        .coord-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .mini-compass svg {
            width: 40px;
            height: 40px;
        }

        .coord-text p {
            margin: 0;
        }

        .red { background: #F01E21; }
        .yellow { background: #FFAD00; }
        .green { background: #07D72A; }

        .leaflet-control-attribution { /**ilangin wm map */
            font-size: 8px;
            opacity: 0.4;
        }

        
        
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="header-peta">
        <div class="header-icon">
            <img src="/assets/img/icon_breadcrumb.svg" alt="Icon Peta">
        </div>
        <div>
            <h5>Peta Sebaran</h5>
            <small>Sebaran Wilayah Kasus TBC</small>
        </div>
    </div>

<div class="map-container"> <!--latar belakang map-->
    <div class="filter">
        <h5>Peta Sebaran Risiko Tuberculosis</h5>
            <button class="filter-btn">
                <i class="fa-solid fa-sliders"></i>
            </button>
    </div>

        <div id="map"></div>
    <div class="info-wrapper">

    <!-- BOX 1: Kompas + Lat Long -->
    <div id="infoPanel" class="info-box">
        <div class="coord-wrapper">

            <div class="mini-compass">
                <svg viewBox="0 0 512 512">
                <polygon points="256,60 276,256 256,236 236,256" fill="black"/>
                <polygon points="452,256 256,276 276,256 256,236" fill="black"/>
                <polygon points="256,452 236,256 256,276 276,256" fill="black"/>
                <polygon points="60,256 256,236 236,256 256,276" fill="black"/>

                <!-- Diagonals (disesuaikan juga) -->
                <polygon points="360,150 276,256 256,236 276,236" fill="black"/>
                <polygon points="360,360 256,276 276,256 276,276" fill="black"/>
                <polygon points="150,360 236,256 256,276 236,276" fill="black"/>
                <polygon points="150,150 256,236 236,256 236,236" fill="black"/>

                <text x="256" y="40" text-anchor="middle" font-size="60" font-weight="bold">U</text>
                <text x="256" y="500" text-anchor="middle" font-size="60" font-weight="bold">S</text>
                <text x="30" y="270" text-anchor="middle" font-size="60" font-weight="bold">T</text>
                <text x="482" y="270" text-anchor="middle" font-size="60" font-weight="bold">B</text>
            </svg>
            </div>

            <div class="coord-text">
                <p><strong>Latitude:</strong> <span id="lat"></span></p>
                <p><strong>Longitude:</strong> <span id="lng"></span></p>
            </div>

        </div>
    </div>

    <!-- BOX 2: Keterangan -->
    <div id="ket" class="legend-box">
        <div class="legend-title">Keterangan</div>
            <div class="legend-row">
                <div class="legend-item">
                    <span class="color red"></span> Tinggi (>15 Kasus)
                </div>

                <div class="legend-item">
                    <span class="color yellow"></span> Sedang (6-15 Kasus)
                </div>

                <div class="legend-item">
                    <span class="color green"></span> Rendah (0-5 Kasus)
                </div>
            </div>
        </div>
    </div>

    </div>
</div> <!--batas latar belakang map-->

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


<script>

//pengatur zoom out-in peta
var map = L.map('map', {
    minZoom: 12,
    maxZoom: 18
});

//clusternya
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

function getColor(cluster){
    if(cluster == 2) return '#F01E21';
    if(cluster == 1) return '#FFAD00';
    return '#07D72A';
}

var wilayah_kasus = <?= json_encode($wilayah_kasus); ?>;
var clusterMap = {};
var kasusMap = {};

wilayah_kasus.forEach(function(w){
    clusterMap[w.id_wilayah] = w.cluster;
    kasusMap[w.id_wilayah] = w.jumlah_kasus;
});

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
            var cluster = clusterMap[id] ?? 0;
            var kasus = kasusMap[id] ?? 0;

            // Tooltip nama tetap
            layer.bindTooltip(namaKel, {
                permanent: true,
                direction: "center",
                className: "label-kelurahan"
            });

            // Popup hover tampilkan total kasus
            layer.bindPopup(
                "<b>" + namaKel + "</b><br>" +
                "Total Kasus TB: <b>" + kasus + "</b>"
            );

            layer.on('mouseover', function () {
                this.openPopup();
            });

            layer.on('mouseout', function () {
                this.closePopup();
            });
        }

    }).addTo(map);

    var bounds = geoLayer.getBounds();
    var center = bounds.getCenter();

    // 🔥 Geser polygon ke kiri dengan menggeser center ke kanan
    var shiftedCenter = L.latLng(center.lat, center.lng);

    // Set view manual
    map.setView(shiftedCenter, map.getBoundsZoom(bounds));

});

//kompas
var compass = L.control({position: 'topright'});

compass.onAdd = function(map){
    var div = L.DomUtil.create('div', 'compass-wrapper leaflet-control');
    div.innerHTML = `
    <svg width="120" height="120" viewBox="0 0 512 512">
        
        <!-- Main 4 Directions (lebih kecil) -->
        <polygon points="256,60 276,256 256,236 236,256" fill="black"/>
        <polygon points="452,256 256,276 276,256 256,236" fill="black"/>
        <polygon points="256,452 236,256 256,276 276,256" fill="black"/>
        <polygon points="60,256 256,236 236,256 256,276" fill="black"/>

        <!-- Diagonals (disesuaikan juga) -->
        <polygon points="360,150 276,256 256,236 276,236" fill="black"/>
        <polygon points="360,360 256,276 276,256 276,276" fill="black"/>
        <polygon points="150,360 236,256 256,276 236,276" fill="black"/>
        <polygon points="150,150 256,236 236,256 236,236" fill="black"/>

        <!-- Labels (lebih jauh) -->
        <text x="256" y="40" text-anchor="middle" font-size="45" font-weight="bold">U</text>
        <text x="256" y="500" text-anchor="middle" font-size="45" font-weight="bold">S</text>
        <text x="30" y="270" text-anchor="middle" font-size="45" font-weight="bold">T</text>
        <text x="482" y="270" text-anchor="middle" font-size="45" font-weight="bold">B</text>
    </svg>
    `;
    return div;
};
compass.addTo(map);


// default sebelum kursor masuk map
document.getElementById('lat').innerText = "-";
document.getElementById('lng').innerText = "-";

// lat long sesuai kursor
map.on('mousemove', function(e){
    document.getElementById('lat').innerText = e.latlng.lat.toFixed(5);
    document.getElementById('lng').innerText = e.latlng.lng.toFixed(5);
});
// lat long kursor keluar
map.on('mouseout', function(){
    document.getElementById('lat').innerText = "-";
    document.getElementById('lng').innerText = "-";
});


</script>
<?= $this->endSection() ?>

