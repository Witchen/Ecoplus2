<?php

require_once("./../include/db.php");

class EditHandler{

	function EditHandler(){
		$this->pin = "";
		$this->nama = "";
		$this->tanggal = "Gunakan format (DD/MM/YYYY)";
		$this->password = "";
		$this->ktp = "";
		$this->hp = "";
		$this->bank = "";
		$this->atasnama = "";
		$this->norek = "";
		$this->statusupdate = "";
		
		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
	}
	
	function CheckData(){
		$this->statusupdate = "**Error: Ada kesalahan dalam input data!**";
		if(EditHandler::CheckIsNull($_POST['vcardpin'], $_POST['vnama'], $_POST['vpassword'], $_POST['vktp'], $_POST['vhphone'], 
		$_POST['vbank'], $_POST['vatasnama'], $_POST['vrekening'])){
			if(EditHandler::CheckPIN($_POST['vcardpin'])){
				EditHandler::UpdateUser($_POST['vpassword'], $_POST['vnama'], $_POST['vktp'], $_POST['vnpwp'], $_POST['vtgllahir'], 
				$_POST['vkelamin'], $_POST['valamat'], $_POST['vkota'], $_POST['vpropinsi'], $_POST['vkodepos'], 
				$_POST['vemail'], $_POST['vtelepon'], $_POST['vhphone'], $_POST['vbank'], $_POST['vatasnama'],
				$_POST['vrekening'], $_POST['vahliwaris'], $_POST['vhubahliwaris']);
			}
		}
	}
	
	function CheckIsNull($pin, $nama, $password, $ktp, $hp, $bank, $atasnama, $norek){
		$status = true;
		if($pin == ""){
			$this->pin = "Data tidak boleh kosong";
			$status = false;
		}
		if($nama == ""){
			$this->nama = "Data tidak boleh kosong";
			$status = false;
		}
		if($password == ""){
			$this->password = "Data tidak boleh kosong";
			$status = false;
		}
		if($ktp == ""){
			$this->ktp = "Data tidak boleh kosong";
			$status = false;
		}
		if($hp == ""){
			$this->hp = "Data tidak boleh kosong";
			$status = false;
		}
		if($bank == ""){
			$this->bank = "Data tidak boleh kosong";
			$status = false;
		}
		if($atasnama == ""){
			$this->atasnama = "Data tidak boleh kosong";
			$status = false;
		}
		if($norek == ""){
			$this->norek = "Data tidak boleh kosong";
			$status = false;
		}
		return $status;
	}
	
	function CheckPIN($pin){
		$sql = "SELECT `pin` FROM data_id where id = '".$_SESSION['member']['id']."';";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			if($row['pin'] == $pin){
				return true;
			}else{
				$this->pin = "Pin Salah";
				return false;
			}
		}else{
			$this->pin = "Pin Salah";
			return false;
		}
	}
	
	function UpdateUser($password, $nama, $ktp, $nonpwp, $tgllahir, $kelamin, $alamat, 
						$kota, $propinsi, $kodepos, $email, $telepon, 
						$hp, $bank, $atasnama, $norek, $ahliwaris, 
						$hubahliwaris){
							
		$sql = "UPDATE `member` SET `password` = '$password', `nama_lengkap` = '$nama', `ktp` = '$ktp', `npwp` = '$nonpwp', 
		`tanggal_lahir` = '$tgllahir', `kelamin` = '$kelamin', `alamat` = '$alamat', 
		`kota` = '$kota', `propinsi` = '$propinsi', `kodepos` = '$kodepos', `email` = '$email', 
		`telepon` = '$telepon', `handphone` = '$hp', `bank` = '$bank', `atas_nama` = '$atasnama', 
		`no_rekening` = '$norek', `nama_ahli_waris` = '$ahliwaris', `hubungan_ahli_waris` = '$hubahliwaris' 
		WHERE `member`.`id` = '".$_SESSION['member']['id']."';";
		
		$result = $this->connection->query($sql);
		$this->statusupdate = "**Sukses: Data telah di update!**";
		$this->UpdateSession();
	}

	function UpdateSession(){
		$sql = "SELECT * FROM `member` WHERE `id` = '".$_SESSION['member']['id']."';";
		$result = $this->connection->query($sql);
		$row = $result->fetch_assoc();
		$_SESSION['member'] = $row;
	}
	
}
	/*
	$_POST['vcardnumber']
	$_POST['vcardpin']
	$_POST['vidsponsor']
	$_POST['vidupline']
	$_POST['vposisi']
	$_POST['vnama']
	$_POST['vnamapanggil']
	$_POST['vpassword']
	$_POST['vktp']
	$_POST['vnpwp']
	$_POST['vtgllahir']
	$_POST['vkelamin']
	$_POST['valamat']
	$_POST['vkota']
	$_POST['vpropinsi']
	$_POST['vkodepos']
	$_POST['vemail']
	$_POST['vtelepon']
	$_POST['vhphone']
	$_POST['vbank']
	$_POST['vatasnama']
	$_POST['vrekening']
	$_POST['vahliwaris']
	$_POST['vhubahliwaris']
	*/

?>