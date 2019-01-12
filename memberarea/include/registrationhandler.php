<?php

require_once("./../include/db.php");

class RegistrationHandler{

	function RegistrationHandler(){
		$this->card = "";
		$this->pin = "";
		$this->sponsor = "";
		$this->upline = "";
		$this->posisi = "";
		$this->tanggal = "Gunakan format (DD/MM/YYYY)";
		$this->namalengkap = "";
		$this->password = "";
		$this->noktp = "";
		$this->kota = "";
		$this->hp = "";
		$this->bank = "";
		$this->atasnama = "";
		$this->norek = "";
		$this->statusregistrasi = "";

		$this->memberpasanganlist = array();
		$this->counterlist = 0;

		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
	}

	function CheckData(){
		$this->statusregistrasi = "**Error: Ada kesalahan dalam input data!**";
		if(RegistrationHandler::CheckIsNull($_POST['vcardnumber'], $_POST['vcardpin'], $_POST['vidsponsor'],
		$_POST['vidupline'], $_POST['vnama'], $_POST['vpassword'], $_POST['vktp'], $_POST['vkota'],
		$_POST['vhphone'], $_POST['vbank'], $_POST['vatasnama'], $_POST['vrekening'])){
			if(RegistrationHandler::CheckIDPIN($_POST['vcardnumber'], $_POST['vcardpin'])){
				if(RegistrationHandler::CheckSponsor($_POST['vidsponsor'])){
					if(RegistrationHandler::CheckUpline($_POST['vidupline'], $_POST['vposisi'])){
						RegistrationHandler::RegisterUser($_POST['vcardnumber'], $_POST['vcardpin'], $_POST['vidsponsor'], $_POST['vidupline'], $_POST['vposisi'],
						$_POST['vnama'], $_POST['vpassword'], $_POST['vktp'], $_POST['vnpwp'], $_POST['vtgllahir'],
						$_POST['vkelamin'], $_POST['valamat'], $_POST['vkota'], $_POST['vpropinsi'], $_POST['vkodepos'],
						$_POST['vemail'], $_POST['vtelepon'], $_POST['vhphone'], $_POST['vbank'], $_POST['vatasnama'],
						$_POST['vrekening'], $_POST['vahliwaris'], $_POST['vhubahliwaris']);
					}
				}
			}
		}
	}

	function CheckIsNull($id, $pin, $idsponsor, $idupline, $namalengkap, $password,
							$noktp, $kota, $hp, $bank, $atasnama, $norek){
		$status = true;
		if($id == ""){
			$this->card = "Data tidak boleh kosong";
			$status = false;
		}
		if($pin == ""){
			$this->pin = "Data tidak boleh kosong";
			$status = false;
		}
		if($idsponsor == ""){
			$this->sponsor = "Data tidak boleh kosong";
			$status = false;
		}
		if($idupline == ""){
			$this->upline = "Data tidak boleh kosong";
			$status = false;
		}
		if($namalengkap == ""){
			$this->namalengkap = "Data tidak boleh kosong";
			$status = false;
		}
		if($password == ""){
			$this->password = "Data tidak boleh kosong";
			$status = false;
		}
		if($noktp == ""){
			$this->noktp = "Data tidak boleh kosong";
			$status = false;
		}
		if($kota == ""){
			$this->kota = "Data tidak boleh kosong";
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

	function CheckIDPIN($id, $pin){
		$sql = "SELECT * FROM data_id where id = '$id';";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			if($row["status"] == 0){
				if($row["pin"] == $pin){
					return true;
				}else{
					$this->pin = "PIN salah";
					return false;
				}
			}else{
				$this->card = "ID telah digunakan/tidak tersedia";
				return false;
			}
		}else{
			$this->card = "ID telah digunakan/tidak tersedia";
			return false;
		}
	}

	function CheckSponsor($id){
		$sql = "SELECT * FROM `member` WHERE id = '$id'";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			$this->sponsor = "";
			return true;
		}else{
			$this->sponsor = "ID tidak dapat ditemukan/salah";
			return false;
		}
	}

	function CheckUpline($id, $posisi){
		$sql = "SELECT * FROM `member` WHERE id = '$id'";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			if($posisi == "kanan"){
				if($row['downline_kanan'] == ""){
					$this->upline = "";
					$this->posisi = "";
					return true;
				}else{
					$this->posisi = "Downline kanan telah terisi";
					return false;
				}
			}else if($posisi == "kiri"){
				if($row['downline_kiri'] == ""){
					$this->upline = "";
					$this->posisi = "";
					return true;
				}else{
					$this->posisi = "Downline kiri telah terisi";
					return false;
				}
			}
			return true;
		}else{
			$this->upline = "ID tidak dapat ditemukan/salah";
			return false;
		}
	}

	function RegisterUser($id, $pin, $idsponsor, $idupline, $posisi,
						$namalengkap, $password, $noktp, $nonpwp, $tgllahir,
						$kelamin, $alamat, $kota, $propinsi, $kodepos,
						$email, $telepon, $hp, $bank, $atasnama,
						$norek, $ahliwaris, $hubahliwaris){

		$today = date("Y-m-d");
		
		if ($kodepos == "") $kodepos = 0;
		
		//Insert data to member
		$sql = "INSERT INTO `member` (
		`id`, `sponsor`, `upline`, `posisi`, `downline_kiri`,
		`downline_kanan`, `tanggal_aktif`, `nama_lengkap`, `password`, `ktp`,
		`npwp`, `tanggal_lahir`, `kelamin`, `alamat`, `kota`,
		`propinsi`, `kodepos`, `email`, `telepon`, `handphone`,
		`bank`, `atas_nama`, `no_rekening`, `nama_ahli_waris`, `hubungan_ahli_waris`)
		VALUES (
		'$id', '$idsponsor', '$idupline', '$posisi', '',
		'', '$today', '$namalengkap', '$password', '$noktp',
		'$nonpwp', '$tgllahir', '$kelamin', '$alamat', '$kota',
		'$propinsi', '$kodepos', '$email', '$telepon', '$hp',
		'$bank', '$atasnama', '$norek', '$ahliwaris', '$hubahliwaris');";
		$result = $this->connection->query($sql);
		echo "$sql<br>$result<br>";

		//Update posisi kaki
		if($posisi == "kiri"){
			$sql = "UPDATE `member` SET `downline_kiri` = '$id' WHERE `member`.`id` = '$idupline'";
		}else{
			$sql = "UPDATE `member` SET `downline_kanan` = '$id' WHERE `member`.`id` = '$idupline'";
		}
		$result = $this->connection->query($sql);

		//Update status id
		$sql = "UPDATE `data_id` SET `status` = '1' WHERE `data_id`.`id` = '$id';";
		$result = $this->connection->query($sql);

		$_POST['vcardnumber'] = "";
		$_POST['vcardpin'] = "";
		$_POST['vidsponsor'] = "";
		$_POST['vidupline'] = "";
		$_POST['vposisi'] = "";
		$_POST['vnama'] = "";
		$_POST['vnamapanggil'] = "";
		$_POST['vpassword'] = "";
		$_POST['vktp'] = "";
		$_POST['vnpwp'] = "";
		$_POST['vtgllahir'] = "";
		$_POST['vkelamin'] = "";
		$_POST['valamat'] = "";
		$_POST['vkota'] = "";
		$_POST['vpropinsi'] = "";
		$_POST['vkodepos'] = "";
		$_POST['vemail'] = "";
		$_POST['vtelepon'] = "";
		$_POST['vhphone'] = "";
		$_POST['vbank'] = "";
		$_POST['vatasnama'] = "";
		$_POST['vrekening'] = "";
		$_POST['vahliwaris'] = "";
		$_POST['vhubahliwaris'] = "";
		$this->statusregistrasi = "**Registrasi Member Sukses**";

		//Update bonus
		$this->registeredId = $id;
		RegistrationHandler::UpdateBonusSponsor($id, $idsponsor);
		RegistrationHandler::UpdateBonusPasangan($id, $idupline);
		RegistrationHandler::UpdateBonusMatching();
		RegistrationHandler::UpdateBonusTitik($id);
	}

	function GetUplineSponsorData($id){
		$sql = "SELECT `nama_lengkap`, `kota`, `downline_kiri`, `downline_kanan` FROM `member` WHERE `id` = '$id';";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			return $row;
		}else{
			return false;
		}
	}

	//parameter = registered user id, and its sponsor
	function UpdateBonusSponsor($id, $sponsor){
		$bonusSponsor = 50000;
		$today = date("Y-m-d");
		$sql = "SELECT * FROM `bonus_history` where `member_id` = '$sponsor' AND `tanggal` = '$today';";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$historyid = $row['history_id'];
			$bonussebelum = $row['sponsor'];
			$idsponsor = $row['idsponsor']."-".$id;
			$bonustotal = $bonussebelum + $bonusSponsor;
			$sql = "UPDATE `bonus_history` SET `sponsor` = '$bonustotal', `idsponsor` = '$idsponsor' WHERE `bonus_history`.`history_id` = $historyid;";
			$this->connection->query($sql);
		}else{
			$sql = "INSERT INTO `bonus_history` (`history_id`, `member_id`, `tanggal`, `sponsor`, `pasangan`, `matching`, `titik`, `idsponsor`)
				VALUES (NULL, '$sponsor', '$today', '$bonusSponsor', '0', '0', '0', '$id');";
			$this->connection->query($sql);
		}
	}

	//parameter = registered user id, and its upline
	function UpdateBonusPasangan($id, $upline){
		$bonusPasangan = 25000;
		$bonusPasanganMax = 375000;
		$today = date("Y-m-d");

		//Get Upline data
		$sql = "SELECT * FROM `member` WHERE `id` = '$upline';";
		$result = $this->connection->query($sql);
		$memberupline = $result->fetch_assoc();

		//Get Bonus History data
		$sql = "SELECT * FROM `bonus_history` where `member_id` = '$upline' AND `tanggal` = '$today';";
		$result = $this->connection->query($sql);

		if($result->num_rows > 0){
			$bonushistory = $result->fetch_assoc();
			$historyid = $bonushistory['history_id'];
			$bonussebelum = $bonushistory['pasangan'];
			//$idpasangan = $bonushistory['idpasangan']."-".$this->registeredId;
			$bonustotal = $bonussebelum + $bonusPasangan;

			$updatebonus = false;
			if($memberupline['downline_kiri'] == $id){
				$type = "volume_kiri";
				//Update volume +1
				$volume = $memberupline['volume_kiri'] + 1;
				$sql = "UPDATE `member` SET `volume_kiri` = '$volume' WHERE `member`.`id` = '$upline';";
				$this->connection->query($sql);
				//Update bonus +1 pasang
				if(($memberupline['volume_kiri'] + 1) <= $memberupline['volume_kanan']){
					$updatebonus = true;
				}
			}else if($memberupline['downline_kanan'] == $id){
				$type = "volume_kanan";
				//Update volume +1
				$volume = $memberupline['volume_kanan'] + 1;
				$sql = "UPDATE `member` SET `volume_kanan` = '$volume' WHERE `member`.`id` = '$upline';";
				$this->connection->query($sql);
				//Update bonus +1 pasang
				if(($memberupline['volume_kanan'] + 1) <= $memberupline['volume_kiri']){
					$updatebonus = true;
				}
			}

			if($updatebonus && $bonustotal <= $bonusPasanganMax){
				$sql = "UPDATE `bonus_history` SET `pasangan` = '$bonustotal' WHERE `bonus_history`.`history_id` = $historyid;";
				$this->connection->query($sql);
				//add id to array of member who get new pasangan bonus
				$this->memberpasanganlist[$this->counterlist] = $upline;
				$this->counterlist++;
			}
		}else{
			$insertbonus = false;
			if($memberupline['downline_kiri'] == $id){
				$type = "volume_kiri";
				//Update volume +1
				$volume = $memberupline['volume_kiri'] + 1;
				$sql = "UPDATE `member` SET `volume_kiri` = '$volume' WHERE `member`.`id` = '$upline';";
				$this->connection->query($sql);
				//Update bonus +1 pasang
				if(($memberupline['volume_kiri'] + 1) <= $memberupline['volume_kanan']){
					$insertbonus = true;
				}
			}else if($memberupline['downline_kanan'] == $id){
				$type = "volume_kanan";
				//Update volume +1
				$volume = $memberupline['volume_kanan'] + 1;
				$sql = "UPDATE `member` SET `volume_kanan` = '$volume' WHERE `member`.`id` = '$upline';";
				$this->connection->query($sql);
				//Update bonus +1 pasang
				if(($memberupline['volume_kanan'] + 1) <= $memberupline['volume_kiri']){
					$insertbonus = true;
				}
			}

			if($insertbonus){
				$sql = "INSERT INTO `bonus_history` (`history_id`, `member_id`, `tanggal`, `sponsor`, `pasangan`, `matching`, `titik`, `idsponsor`)
					VALUES (NULL, '$upline', '$today', '0', '$bonusPasangan', '0', '0', '');";
				$this->connection->query($sql);
				//add id to array of member who get new pasangan bonus
				$this->memberpasanganlist[$this->counterlist] = $upline;
				$this->counterlist++;
			}
		}

		//Condition to update all upline above with recursive function
		if($memberupline['upline'] != ""){
			RegistrationHandler::UpdateBonusPasangan($upline, $memberupline['upline']);
		}
	}

	function UpdateBonusMatching(){
		$bonusMatching = 25000;
		$today = date("Y-m-d");
		for($i = 0; $i < $this->counterlist; $i++){
			$id = $this->memberpasanganlist[$i];
			$sql = "SELECT `sponsor` FROM `member` WHERE `id` = '$id'";
			$row = $this->connection->query($sql)->fetch_assoc();
			$idsponsor = $row['sponsor'];
			if($idsponsor != ""){
				//Get Bonus History data
				$sql = "SELECT * FROM `bonus_history` where `member_id` = '$idsponsor' AND `tanggal` = '$today';";
				$result = $this->connection->query($sql);

				if($result->num_rows > 0){
					$bonushistory = $result->fetch_assoc();
					$historyid = $bonushistory['history_id'];
					$bonussebelum = $bonushistory['matching'];
					$bonustotal = $bonussebelum + $bonusMatching;
					$sql = "UPDATE `bonus_history` SET `matching` = '$bonustotal' WHERE `bonus_history`.`history_id` = '$historyid';";
					$this->connection->query($sql);
				}else{
					$sql = "INSERT INTO `bonus_history` (`history_id`, `member_id`, `tanggal`, `sponsor`, `pasangan`, `matching`, `titik`, `idsponsor`)
					VALUES (NULL, '$idsponsor', '$today', '0', '0', '$bonusMatching', '0', '');";
					$this->connection->query($sql);
				}
			}
		}
	}

	//parameter = registered user id
	function UpdateBonusTitik($id){
		$bonusTitik = 2500;
		$today = date("Y-m-d");
		$sql = "SELECT `upline` FROM `member` WHERE `id` = '$id'";
		$row = $this->connection->query($sql)->fetch_assoc();
		$idupline = $row['upline'];
		if($idupline != ""){
			$sql = "SELECT * FROM `bonus_history` where `member_id` = '$idupline' AND `tanggal` = '$today';";
			$result = $this->connection->query($sql);

			if($result->num_rows > 0){
				$bonushistory = $result->fetch_assoc();
				$historyid = $bonushistory['history_id'];
				$bonussebelum = $bonushistory['titik'];
				$bonustotal = $bonussebelum + $bonusTitik;
				$sql = "UPDATE `bonus_history` SET `titik` = '$bonustotal' WHERE `bonus_history`.`history_id` = '$historyid';";
				$this->connection->query($sql);
			}else{
				$sql = "INSERT INTO `bonus_history` (`history_id`, `member_id`, `tanggal`, `sponsor`, `pasangan`, `matching`, `titik`, `idsponsor`)
				VALUES (NULL, '$idupline', '$today', '0', '0', '0', '$bonusTitik', '');";
				$this->connection->query($sql);
			}

			RegistrationHandler::UpdateBonusTitik($idupline);
		}

	}

}

?>
