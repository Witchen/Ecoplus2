<?php

require_once("db.php");

echo "Today is " . date("Y-m-d") . "<br>";
echo "The time is " . date("h:i:sa") . "<br>";
echo "current Time Zone is " . date_default_timezone_get() . "<br>";

date_default_timezone_set("Asia/Jakarta");

echo "Time Zone is changed to " . date_default_timezone_get() . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "The time is " . date("h:i:sa") . "<br>";
echo "current Time Zone is " . date_default_timezone_get() . "<br>";

?>