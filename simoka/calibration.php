<!DOCTYPE html>
<html>

<head>

<title>Kalibrasi Sensor</title>

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
<a href="ota.php">OTA Firmware</a>

</div>

<div class="main-content">

<h2>Kalibrasi Sensor</h2>

<form id="calForm">

<div class="mb-3">

<label>pH Slope</label>

<input
type="number"
step="0.01"
class="form-control"
name="ph_slope"
id="ph_slope">

</div>

<div class="mb-3">

<label>pH Offset</label>

<input
type="number"
step="0.01"
class="form-control"
name="ph_offset"
id="ph_offset">

</div>

<div class="mb-3">

<label>EC Factor</label>

<input
type="number"
step="0.01"
class="form-control"
name="ec_factor"
id="ec_factor">

</div>

<div class="mb-3">

<label>DO Offset</label>

<input
type="number"
step="0.01"
class="form-control"
name="do_offset"
id="do_offset">

</div>

<button
class="btn btn-primary"
type="submit">

Simpan

</button>

</form>

</div>

<script>

async function loadCalibration()
{

let response=
await fetch(
'api/get_calibration.php'
);

let data=
await response.json();

document.getElementById(
'ph_slope'
).value=
data.ph_slope;

document.getElementById(
'ph_offset'
).value=
data.ph_offset;

document.getElementById(
'ec_factor'
).value=
data.ec_factor;

document.getElementById(
'do_offset'
).value=
data.do_offset;

}

loadCalibration();

document.getElementById(
'calForm'
).addEventListener(
'submit',
async function(e)
{

e.preventDefault();

let formData=
new FormData(this);

let response=
await fetch(
'api/save_calibration.php',
{
method:'POST',
body:formData
}
);

let result=
await response.text();

alert(result);

}
);

</script>

</body>

</html>