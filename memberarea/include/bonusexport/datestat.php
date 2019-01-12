<?php

echo date("Y-m-D")."<br>";
$today = date("D");
echo $today."<br>";

$date = date('Y-m-d H:i:s');
echo $date."<br>";

$timezone = date_default_timezone_get();
echo "The current server timezone is: " . $timezone;

?>