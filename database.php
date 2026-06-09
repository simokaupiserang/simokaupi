<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "simoka_monitoring_tambak";

$conn = mysqli_connect(
    $host,
    $user,
    $pass,
    $db
);

if(!$conn)
{
    die("Database gagal terhubung");
}

?>