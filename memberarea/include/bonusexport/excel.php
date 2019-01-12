<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
$today = date("d-m-Y");
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=ukmbonusperiode(".$today.").xls");
 
// Tambahkan table
include 'excelhandler.php';
?>