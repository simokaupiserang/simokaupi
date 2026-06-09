<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Peta GPS</title>

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<link
rel="stylesheet"
href="assets/css/style.css">

</head>

<body>

<div class="sidebar">

<h3>SIMOKA</h3>

<a href="index.php">
Dashboard
</a>

<a href="history.php">
Riwayat Data
</a>

<a href="map.php">
Peta GPS
</a>

<a href="calibration.php">
Kalibrasi
</a>

<a href="ota.php">
OTA Firmware
</a>

<a href="export.php">
Export CSV
</a>

</div>

<div class="main-content">

<h2 class="mb-3">

Lokasi Perangkat

</h2>

<div class="card shadow">

<div class="card-body">

<div id="map"
style="height:600px;">
</div>

</div>

</div>

</div>

<script
src="https://unpkg.com/leaflet/dist/leaflet.js">
</script>

<script>

let map =
L.map('map')
.setView(
[-6.2,106.8],
15
);

L.tileLayer(
'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
{
maxZoom:19
}
).addTo(map);

let marker =
L.marker(
[-6.2,106.8]
)
.addTo(map);

async function loadGPS()
{

let response =
await fetch(
'api/latest_gps.php'
);

let data =
await response.json();

let lat =
parseFloat(
data.latitude
);

let lon =
parseFloat(
data.longitude
);

marker.setLatLng(
[lat,lon]
);

map.setView(
[lat,lon],
17
);

marker.bindPopup(
`
<b>SIMOKA</b>
<br>
Lat : ${lat}
<br>
Lon : ${lon}
<br>
${data.timestamp}
`
);

}

loadGPS();

setInterval(
loadGPS,
5000
);

</script>

</body>

</html>