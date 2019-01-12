<?php

require_once("./../include/db.php");

Class SponsorHandler{

	function SponsorHandler(){
		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
	}

	function GetAllSponsorData($id){
		$sql = "SELECT `id`, `nama_lengkap`, `tanggal_aktif`, `kota` FROM `member` WHERE `sponsor` = '$id';";
		$result = $this->connection->query($sql);
		return $result;
	}
}

?>