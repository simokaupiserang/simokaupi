<?php

header("Content-Type: application/json");

include "../config/database.php";

$temperature = $_POST['temperature'] ?? 0;
$ph          = $_POST['ph'] ?? 0;
$ec          = $_POST['ec'] ?? 0;
$do_value    = $_POST['do'] ?? 0;
$latitude    = $_POST['lat'] ?? 0;
$longitude   = $_POST['lon'] ?? 0;

$sql = "INSERT INTO sensor_data
(
temperature,
ph,
ec,
do_value,
latitude,
longitude
)
VALUES
(
'$temperature',
'$ph',
'$ec',
'$do_value',
'$latitude',
'$longitude'
)";

if(mysqli_query($conn,$sql))
{
    echo json_encode([
        "status"=>"success"
    ]);
}
else
{
    echo json_encode([
        "status"=>"error",
        "message"=>mysqli_error($conn)
    ]);
}

?>