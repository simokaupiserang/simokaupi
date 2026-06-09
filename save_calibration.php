<?php

include "../config/database.php";

$ph_slope=$_POST['ph_slope'];
$ph_offset=$_POST['ph_offset'];
$ec_factor=$_POST['ec_factor'];
$do_offset=$_POST['do_offset'];

$sql="
INSERT INTO calibration
(
ph_slope,
ph_offset,
ec_factor,
do_offset
)
VALUES
(
'$ph_slope',
'$ph_offset',
'$ec_factor',
'$do_offset'
)
";

if(mysqli_query($conn,$sql))
{
echo "OK";
}
else
{
echo "ERROR";
}