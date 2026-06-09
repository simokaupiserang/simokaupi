<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SIMOKA</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="assets/css/style.css">

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
Kalibrasi Sensor
</a>

<a href="ota.php">
OTA Firmware
</a>

<a href="export.php">
Export CSV
</a>

</div>

<div class="main-content">

<nav class="navbar navbar-dark bg-primary shadow">

<div class="container-fluid">

<span class="navbar-brand mb-0 h1">

SIMOKA
-
Sistem Monitoring Kualitas Air

</span>

</div>

</nav>

<div class="container mt-4">

<h2 class="text-center mb-4">

Dashboard Monitoring Tambak

</h2>

<div class="row">

<div class="col-md-3 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>Suhu</h5>

<h2 id="temperature">--</h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>pH</h5>

<h2 id="ph">--</h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>EC</h5>

<h2 id="ec">--</h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>DO</h5>

<h2 id="do">--</h2>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>Data Terbaru</h5>

<p id="update_time">

Belum ada data

</p>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>Status Air</h5>

<h3 id="water_status"
class="text-success">

NORMAL

</h3>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>Status Device</h5>

<h3 id="device_status"
class="text-danger">

OFFLINE

</h3>

</div>

</div>

</div>

</div>

<div class="row mt-3">

<div class="col-md-6 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>Grafik Suhu</h5>

<canvas id="chartTemp"></canvas>

</div>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>Grafik pH</h5>

<canvas id="chartPH"></canvas>

</div>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>Grafik EC</h5>

<canvas id="chartEC"></canvas>

</div>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="card shadow">

<div class="card-body">

<h5>Grafik DO</h5>

<canvas id="chartDO"></canvas>

</div>

</div>

</div>

</div>

</div>

<script>

let chartTemp;
let chartPH;
let chartEC;
let chartDO;

async function loadLatest()
{

let response =
await fetch(
'api/latest.php'
);

let data =
await response.json();

document.getElementById(
'temperature'
).innerHTML =
data.temperature + ' °C';

document.getElementById(
'ph'
).innerHTML =
data.ph;

document.getElementById(
'ec'
).innerHTML =
data.ec;

document.getElementById(
'do'
).innerHTML =
data.do_value;

document.getElementById(
'update_time'
).innerHTML =
data.timestamp;


/* STATUS AIR */

let ph =
parseFloat(data.ph);

let doValue =
parseFloat(data.do_value);

let status =
"NORMAL";

let color =
"text-success";

if(
ph < 6.5 ||
ph > 8.5 ||
doValue < 3
)
{
status =
"BAHAYA";

color =
"text-danger";
}
else if(
ph < 7 ||
ph > 8 ||
doValue < 5
)
{
status =
"WASPADA";

color =
"text-warning";
}

document.getElementById(
'water_status'
).innerHTML =
status;

document.getElementById(
'water_status'
).className =
color;


/* STATUS DEVICE */

let now =
new Date();

let dataTime =
new Date(
data.timestamp
);

let diff =
(now - dataTime) / 1000;

if(diff < 60)
{
document.getElementById(
'device_status'
).innerHTML =
'ONLINE';

document.getElementById(
'device_status'
).className =
'text-success';
}
else
{
document.getElementById(
'device_status'
).innerHTML =
'OFFLINE';

document.getElementById(
'device_status'
).className =
'text-danger';
}

}


async function loadChart()
{

let response =
await fetch(
'api/history_data.php'
);

let data =
await response.json();

let labels = [];

let tempData = [];
let phData = [];
let ecData = [];
let doData = [];

data.forEach(item => {

labels.push(item.timestamp);

tempData.push(item.temperature);

phData.push(item.ph);

ecData.push(item.ec);

doData.push(item.do_value);

});


if(chartTemp) chartTemp.destroy();
if(chartPH) chartPH.destroy();
if(chartEC) chartEC.destroy();
if(chartDO) chartDO.destroy();


chartTemp =
new Chart(
document.getElementById('chartTemp'),
{
type:'line',
data:{
labels:labels,
datasets:[{
label:'Suhu (°C)',
data:tempData,
tension:0.4
}]
}
}
);

chartPH =
new Chart(
document.getElementById('chartPH'),
{
type:'line',
data:{
labels:labels,
datasets:[{
label:'pH',
data:phData,
tension:0.4
}]
}
}
);

chartEC =
new Chart(
document.getElementById('chartEC'),
{
type:'line',
data:{
labels:labels,
datasets:[{
label:'EC (µS/cm)',
data:ecData,
tension:0.4
}]
}
}
);

chartDO =
new Chart(
document.getElementById('chartDO'),
{
type:'line',
data:{
labels:labels,
datasets:[{
label:'DO (mg/L)',
data:doData,
tension:0.4
}]
}
}
);

}

loadLatest();
loadChart();

setInterval(loadLatest,3000);
setInterval(loadChart,5000);

</script>
</div>
</body>

</html>
