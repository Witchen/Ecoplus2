<?php
session_start();
$_SESSION['member'] = "";
session_destroy();
header("Location: ./../");
exit();
?>
