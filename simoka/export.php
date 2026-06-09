<?php

include "config/database.php";

header(
'Content-Type:text/csv'
);

header(
'Content-Disposition:attachment;filename=sensor_data.csv'
);

$output =
fopen(
'php://output',
'w'
);

fputcsv(
$output,
[
'Timestamp',
'Suhu',
'pH',
'EC',
'DO',
'Latitude',
'Longitude'
]
);

$sql =
"
SELECT *
FROM sensor_data
ORDER BY id DESC
";

$result =
mysqli_query(
$conn,
$sql
);

while(
$row=
mysqli_fetch_assoc(
$result
))
{
fputcsv(
$output,
$row
);
}

fclose(
$output
);

?>