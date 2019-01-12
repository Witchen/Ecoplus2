<?php

require_once("./../include/db.php");

Class ViewTreeHandler{
	
	function ViewTreeHandler(){
		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
	}
	
	function GetMemberChart($topid){
		$member1 = null;
		$member2 = null;
		$member3 = null;
		$member4 = null;
		$member5 = null;
		$member6 = null;
		$member7 = null;
		
		//Get Member1 data
		$sql = "SELECT `id`, `downline_kiri`, `downline_kanan`, `tanggal_aktif`, `nama_lengkap`, `volume_kiri`, `volume_kanan`
		FROM `member` WHERE `id` = '$topid';";
		$result = $this->connection->query($sql);
		$member1 = $result->fetch_assoc();
		
		//Get Member2 data
		if($member1['downline_kiri'] != ""){
			$sql = "SELECT `id`, `downline_kiri`, `downline_kanan`, `tanggal_aktif`, `nama_lengkap`, `volume_kiri`, `volume_kanan`
			FROM `member` WHERE `id` = '".$member1['downline_kiri']."';";
			$result = $this->connection->query($sql);
			$member2 = $result->fetch_assoc();
		}
		
		//Get Member3 data
		if($member1['downline_kanan'] != ""){
			$sql = "SELECT `id`, `downline_kiri`, `downline_kanan`, `tanggal_aktif`, `nama_lengkap`, `volume_kiri`, `volume_kanan`
			FROM `member` WHERE `id` = '".$member1['downline_kanan']."';";
			$result = $this->connection->query($sql);
			$member3 = $result->fetch_assoc();
		}
		
		//Get Member4 data
		if($member2['downline_kiri'] != ""){
			$sql = "SELECT `id`, `downline_kiri`, `downline_kanan`, `tanggal_aktif`, `nama_lengkap`, `volume_kiri`, `volume_kanan`
			FROM `member` WHERE `id` = '".$member2['downline_kiri']."';";
			$result = $this->connection->query($sql);
			$member4 = $result->fetch_assoc();
		}
		
		//Get Member5 data
		if($member2['downline_kanan'] != ""){
			$sql = "SELECT `id`, `downline_kiri`, `downline_kanan`, `tanggal_aktif`, `nama_lengkap`, `volume_kiri`, `volume_kanan`
			FROM `member` WHERE `id` = '".$member2['downline_kanan']."';";
			$result = $this->connection->query($sql);
			$member5 = $result->fetch_assoc();
		}
		
		//Get Member6 data
		if($member3['downline_kiri'] != ""){
			$sql = "SELECT `id`, `downline_kiri`, `downline_kanan`, `tanggal_aktif`, `nama_lengkap`, `volume_kiri`, `volume_kanan`
			FROM `member` WHERE `id` = '".$member3['downline_kiri']."';";
			$result = $this->connection->query($sql);
			$member6 = $result->fetch_assoc();
		}
		
		//Get Member7 data
		if($member3['downline_kanan'] != ""){
			$sql = "SELECT `id`, `downline_kiri`, `downline_kanan`, `tanggal_aktif`, `nama_lengkap`, `volume_kiri`, `volume_kanan`
			FROM `member` WHERE `id` = '".$member3['downline_kanan']."';";
			$result = $this->connection->query($sql);
			$member7 = $result->fetch_assoc();
		}
		
		$memberlist = array($member1, $member2, $member3, $member4, $member5, $member6, $member7);
		return $memberlist;
		
		/*
		print_r($memberlist); echo "<br>";
		print_r($member1); echo "<br>";
		print_r($member2); echo "<br>";
		print_r($member3); echo "<br>";
		print_r($member4); echo "<br>";
		print_r($member5); echo "<br>";
		print_r($member6); echo "<br>";
		print_r($member7); echo "<br>";
		*/
	}
	
}

?>