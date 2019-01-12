<?php

session_start();
require_once("./include/registrationhandler.php");

$handler = new RegistrationHandler();
$data = $handler->GetUplineSponsorData($_GET['idna']);

if($data != false){

	if($data['downline_kiri'] == ""){
		$data['downline_kiri'] = "Tidak ada";
	}

	if($data['downline_kanan'] == ""){
		$data['downline_kanan'] = "Tidak ada";
	}

}

?>

<!DOCTYPE html>
<html>
	<body>
		<table style="font-family: Arial; color: #FFFFFF; font-size: 10pt; font-weight: bold; border: 1px solid #A096C5; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color:#000000" width="400" height="100" bgcolor="#334455">
			<?php if($data != false) echo "
			
				<tbody>
				<tr>
					<td width='35%'>ID Kartu </td>	
					<td> : ".$_GET['idna']." </td>
				</tr>
				<tr>
					<td>Nama Lengkap </td>
					<td> : ".$data['nama_lengkap']." </td>
				</tr>
				<tr>
					<td>Kota </td>
					<td> : ".$data['kota']." </td>
				</tr>
				<tr>
					<td>Posisi Kiri </td>
					<td> : ".$data['downline_kiri']."</td>
				</tr>
				<tr>
					<td>Posisi Kanan </td>
					<td> : ".$data['downline_kanan']."</td>
				</tr>
				</tbody>
			
			"; else {
				echo "
				
				<tbody>
				<tr>
					<td width='20%'>Status </td>
					<td> : Member dengan ID '" . $_GET['idna'] . "' tidak terdaftar </td>
				</tr>
				
				";
			}	
			?>
		</table> 
	</body>
</html>