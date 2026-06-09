<?php

header("Content-Type: application/json");

include "../config/database.php";

$sql = "
SELECT *
FROM sensor_data
ORDER BY id DESC
LIMIT 20
";

$result = mysqli_query($conn,$sql);

$data = [];

while($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

echo json_encode(array_reverse($data));

?>