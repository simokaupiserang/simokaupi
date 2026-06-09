<!DOCTYPE html>
<html>
<head>

<title>OTA Firmware</title>

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

<h2>OTA Firmware Manager</h2>

<form
action="upload_firmware.php"
method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label>Versi Firmware</label>

<input
type="text"
name="version"
class="form-control"
required>

</div>

<div class="mb-3">

<label>File Firmware (.bin)</label>

<input
type="file"
name="firmware"
class="form-control"
accept=".bin"
required>

</div>

<button
class="btn btn-primary">

Upload Firmware

</button>

</form>

</div>

</body>
</html>