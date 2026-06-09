<?php

header("Content-Type: application/json");

$temperature = $_GET['temperature'] ?? null;
$ph = $_GET['ph'] ?? null;

if ($temperature === null || $ph === null) {
    echo json_encode([
        "status" => "error",
        "message" => "parameter missing"
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "temperature" => $temperature,
    "ph" => $ph,
    "time" => date("Y-m-d H:i:s")
]);

?>
