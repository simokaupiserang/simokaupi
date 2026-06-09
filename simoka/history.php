<!DOCTYPE html>
<html>
<head>

<title>Riwayat Data</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="sidebar">

<h3>SIMOKA</h3>

<a href="index.php">Dashboard</a>

<a href="history.php">Riwayat Data</a>

<a href="map.php">Peta GPS</a>

<a href="calibration.php">Kalibrasi</a>

<a href="ota.php">OTA</a>

</div>

<div class="main-content">

<h2>Riwayat Monitoring</h2>

<table class="table table-striped">

<thead>

<tr>

<th>Waktu</th>
<th>Suhu</th>
<th>pH</th>
<th>EC</th>
<th>DO</th>

</tr>

</thead>

<tbody id="historyTable">

</tbody>

</table>

</div>

<script>

async function loadHistory()
{

let response =
await fetch(
'api/history_data.php'
);

let data =
await response.json();

let html = '';

data.forEach(item=>{

html += `
<tr>
<td>${item.timestamp}</td>
<td>${item.temperature}</td>
<td>${item.ph}</td>
<td>${item.ec}</td>
<td>${item.do_value}</td>
</tr>
`;

});

document.getElementById(
'historyTable'
).innerHTML =
html;

}

loadHistory();

</script>

</body>

</html>