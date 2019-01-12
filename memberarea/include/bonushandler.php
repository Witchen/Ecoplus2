<?php

require_once("./../include/db.php");

class BonusHandler{

	function BonusHandler(){
		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
		
		$this->todaybonus = null;
		$this->weeklybonus = array();
		$this->akumulasibonus= array();
		$this->bonusrincian = array(array());
	}
	
	function GetBonusRincian($id){
		$dayweek = date("D");
		switch($dayweek){
			case "Mon":
				$minus = 1;
				break;
			case "Tue":
				$minus = 2;
				break;
			case "Wed":
				$minus = 3;
				break;
			case "Thu":
				$minus = 4;
				break;
			case "Fri":
				$minus = 5;
				break;
			case "Sat":
				$minus = 6;
				break;
			case "Sun":
				$minus = 0;
				break;
		}
		$day = date("d");
		$month = date("m");
		$year = date("Y");
		$mkdate1 = mktime(0, 0, 0, $month ,($day-$minus) , $year);
		$date1 = date("Y-m-d", $mkdate1);
		$mkdate2 = mktime(0, 0, 0, $month ,($day-$minus+6) , $year);
		$date2 = date("Y-m-d", $mkdate2);
		
		$sql = "SELECT * FROM `bonus_history` WHERE `member_id` = '$id' AND `tanggal` BETWEEN '$date1' AND '$date2'";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			for($i = 0; $i < $result->num_rows; $i++){
				$row = $result->fetch_assoc();
				$this->bonusrincian[$i] = $row;
			}
		}
		
		BonusHandler::GetTodayBonus($id);
		BonusHandler::GetWeeklyBonus();
		BonusHandler::GetBonusAkumulasi($id);
	}
	
	function GetTodayBonus($id){
		$today = date("Y-m-d");
		$sql = "SELECT * FROM `bonus_history` WHERE `member_id` = '$id' AND `tanggal` = '$today';";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			$this->todaybonus = $result->fetch_assoc();
			$total = $this->todaybonus['sponsor'] + $this->todaybonus['pasangan'] 
			+ $this->todaybonus['matching'] + $this->todaybonus['titik'];
			$this->todaybonus["total"] = $total;
		}else{
			$this->todaybonus = [
				"sponsor" => "0",
				"pasangan" => "0",
				"matching" => "0",
				"titik" => "0",
				"total" => "0"
			];
		}
	}
	
	function GetWeeklyBonus(){
		$totalsponsor = 0;
		$totalpasangan = 0;
		$totalmatching = 0;
		$totaltitik = 0;
		if($this->bonusrincian[0] != array()){
			for($i = 0; $i < count($this->bonusrincian); $i++){
				$rincian = $this->bonusrincian[$i];
				$totalsponsor = $totalsponsor + $rincian['sponsor'];
				$totalpasangan = $totalpasangan + $rincian['pasangan'];
				$totalmatching = $totalmatching + $rincian['matching'];
				$totaltitik = $totaltitik + $rincian['titik'];
			}
		}
		$total = $totalsponsor + $totalpasangan 
		+ $totalmatching + $totaltitik;
		$this->weeklybonus[0] = $totalsponsor;
		$this->weeklybonus[1] = $totalpasangan;
		$this->weeklybonus[2] = $totalmatching;
		$this->weeklybonus[3] = $totaltitik;
		$this->weeklybonus[4] = $total;
	}
	
	function GetBonusAkumulasi($id){
		$sql = "SELECT * FROM `bonus_history` WHERE `member_id` = '$id';";
		$result = $this->connection->query($sql);
		$totalsponsor = 0;
		$totalpasangan = 0;
		$totalmatching = 0;
		$totaltitik = 0;
		for($i = 0; $i < $result->num_rows; $i++){
			$row = $result->fetch_assoc();
			$totalsponsor = $totalsponsor + $row['sponsor'];
			$totalpasangan = $totalpasangan + $row['pasangan'];
			$totalmatching = $totalmatching + $row['matching'];
			$totaltitik = $totaltitik + $row['titik'];
		}
		$total = $totalsponsor + $totalpasangan 
		+ $totalmatching + $totaltitik;
		$totalbonus = array(
			"totalsponsor" => $totalsponsor,
			"totalpasangan" => $totalpasangan,
			"totalmatching" => $totalmatching,
			"totaltitik" => $totaltitik,
			"total" => $total
		);
		$this->akumulasibonus = $totalbonus;
	}
	
	function formatRupiah($bonus){
		$bonus = $bonus."";
		$fbonus = "";
		$length = strlen($bonus);
		$arrOfStr = str_split($bonus);
		$count = 0;
		for($x = 0; $x < $length; $x++){
			if($x < 3 && $x == ($length % 3) && $x != 0){
				$fbonus = $fbonus.",".$arrOfStr[$x];
				$count = 0;
				$count++;
			}else if($count % 3 == 0 && $count != 0){
				$fbonus = $fbonus.",".$arrOfStr[$x];
				$count = 0;
				$count++;
			}else{
				$fbonus = $fbonus.$arrOfStr[$x];
				$count++;
			}
		}
		echo " ";
		return $fbonus;
	}
	
}

?>