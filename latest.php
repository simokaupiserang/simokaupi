<?php

header("Content-Type: application/json");

include "../config/database.php";

$sql =
"
SELECT *
FROM sensor_data
ORDER BY id DESC
LIMIT 1
";

$result =
mysqli_query($conn,$sql);

$data =
mysqli_fetch_assoc($result);

echo json_encode($data);

?>