<?php

include "config/database.php";

$version =
$_POST['version'];

$fileName =
$_FILES['firmware']['name'];

$tmp =
$_FILES['firmware']['tmp_name'];

move_uploaded_file(
$tmp,
"firmware/".$fileName
);

$sql=
"
INSERT INTO firmware_versions
(
version,
filename
)
VALUES
(
'$version',
'$fileName'
)
";

mysqli_query(
$conn,
$sql
);

echo "Firmware berhasil diupload";