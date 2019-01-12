<?php

require_once("./../include/db.php");

class StatemenHandler{

	function StatemenHandler(){
		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
		
		$this->bonuslist = array();
		$this->yearlist = array();
	}
	
	function GetStatementPeriodeAkhir(){
		$dayweek = date("D");
		switch($dayweek){
			case "Mon":
				$minday = 1;
				$plusday = 6 - $minday;
				break;
			case "Tue":
				$minday = 2;
				$plusday = 6 - $minday;
				break;
			case "Wed":
				$minday = 3;
				$plusday = 6 - $minday;
				break;
			case "Thu":
				$minday = 4;
				$plusday = 6 - $minday;
				break;
			case "Fri":
				$minday = 5;
				$plusday = 6 - $minday;
				break;
			case "Sat":
				$minday = 6;
				$plusday = 6 - $minday;
				break;
			case "Sun":
				$minday = 0;
				$plusday = 6 - $minday;
				break;
		}
		
		$date = date("Y-m-d");
		$datearr = explode("-", $date);
		$date1timestamp = mktime(0, 0, 0, $datearr[1] ,($datearr[2] + $plusday) , $datearr[0]);
		$date2timestamp = mktime(0, 0, 0, $datearr[1] ,($datearr[2] - $minday) , $datearr[0]);
		$date1 = date("Y-m-d", $date1timestamp);
		$date2 = date("Y-m-d", $date2timestamp);
		$sql = "SELECT * FROM `bonus_history` WHERE `member_id` = '".$_SESSION['member']['id']."' AND `tanggal` BETWEEN '$date2' AND '$date1';";
		$result = $this->connection->query($sql);
		
		$bonus['totalsponsor'] = 0;
		$bonus['totalpasangan'] = 0;
		$bonus['totalmatching'] = 0;
		$bonus['totaltitik'] = 0;
		$bonus['tanggal'] = $date2." s/d ".$date1;
		for($i = 0; $i < $result->num_rows; $i++){
			$row = $result->fetch_assoc();
			$bonus['totalsponsor'] = $bonus['totalsponsor'] + $row['sponsor'];
			$bonus['totalpasangan'] = $bonus['totalpasangan'] + $row['pasangan'];
			$bonus['totalmatching'] = $bonus['totalmatching'] + $row['matching'];
			$bonus['totaltitik'] = $bonus['totaltitik'] + $row['titik'];
		}
		return $bonus;
	}
	
	function GetAkumulasi($id){
		$totalbonus = 0;
		
		$periodelist = null;
		$count = 0;
		
		$today = date("Y-m-d");
		$sql = "SELECT * FROM `bonus_history` WHERE `member_id` = '$id'";
		$result = $this->connection->query($sql);
		for($i = 0; $i < $result->num_rows; $i++){
			$row = $result->fetch_assoc();
			
			$row['periode'] = StatemenHandler::GetPeriode($row['tanggal']);
			$status = "not found";
			for($j = 0; $j < count($periodelist); $j++){
				if($periodelist[$j] == $row['periode']){
					$status = "found";
					break;
				}
			}
			if($status == "not found"){
				$periodelist[$count] = $row['periode'];
				$count++;
			}
			
			$subtotal = 0;
			$subtotal = $subtotal + $row['sponsor'];
			$subtotal = $subtotal + $row['pasangan'];
			$subtotal = $subtotal + $row['matching'];
			$subtotal = $subtotal + $row['titik'];
			$pajak = $subtotal * 6 / 100;
			
			$subtotal = $subtotal - $pajak;
			$totalbonus = $totalbonus + $subtotal;
		}
		$totalbonus = $totalbonus - (count($periodelist) * 10000);
		return $totalbonus;
	}

	function GetPeriode($date){
		$datearr = explode("-", $date);
		$dayweektimestamp = mktime(0, 0, 0, $datearr[1], $datearr[2], $datearr[0]);
		$dayweek = date("D", $dayweektimestamp);
		switch($dayweek){
			case "Mon":
				$minday = 1;
				break;
			case "Tue":
				$minday = 2;
				break;
			case "Wed":
				$minday = 3;
				break;
			case "Thu":
				$minday = 4;
				break;
			case "Fri":
				$minday = 5;
				break;
			case "Sat":
				$minday = 6;
				break;
			case "Sun":
				$minday = 7;
				break;
		}
		$periodtimestamp = mktime(0, 0, 0, $datearr[1], $datearr[2] - $minday, $datearr[0]);
		$perioddate = date("Y-m-d", $periodtimestamp);
		return $perioddate;
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
	
	// function CheckPreviousPeriodBonus(){
		// $dayweek = date("D");
		// switch($dayweek){
			// case "Mon":
				// $minday = 4;
				// break;
			// case "Tue":
				// $minday = 5;
				// break;
			// case "Wed":
				// $minday = 6;
				// break;
			// case "Thu":
				// $minday = 0;
				// break;
			// case "Fri":
				// $minday = 1;
				// break;
			// case "Sat":
				// $minday = 2;
				// break;
			// case "Sun":
				// $minday = 3;
				// break;
		// }
		
		// $today = date("Y-m-d");
		// $datearr = explode("-", $today);
		// $date1timestamp = mktime(0, 0, 0, $datearr[1] ,($datearr[2] - $minday - 1) , $datearr[0]);
		// $date1 = date("Y-m-d", $date1timestamp);
		
		// $sql = "SELECT * FROM `bonus_history` WHERE `member_id` = '".$_SESSION['member']['id']."' AND `tanggal` <= '$date1';";
		// $result = $this->connection->query($sql);
		// // if previous periode exists then check 
			// // if previous bonus already exceed 4,000,000
		 // // else the current period make bonus exceed 4,000,000
		// // else the current period make bonus exceed 4,000,000 directly in single and only bonus statement
		// if($result->num_rows > 0){
			// $totalbonus = 0;
			// for($i = 0; $i < $result->num_rows; $i++){
				// $row = $result->fetch_assoc();
				// $subtotal = 0;
				// $subtotal = $subtotal + $row['sponsor'];
				// $subtotal = $subtotal + $row['pasangan'];
				// $subtotal = $subtotal + $row['matching'];
				// $subtotal = $subtotal + $row['titik'];
				// $pajak = $subtotal * 6 / 100;
				// $subtotal = $subtotal - $pajak - 10000;
				// $totalbonus = $totalbonus + $subtotal;
			// }
			// return $totalbonus;
		// }else{
			// return 0;
		// }
	// }
	
	// function DateFormatter($string){
		// $str = explode("-", $string);
		// return $str[2]."-".$str[1]."-".$str[0];
	// }
	
	// function AddDateBy6($date){
		// $str = explode("-", $date);
		
		// $date = mktime(0, 0, 0, $str[1] ,($str[2] + 6) , $str[0]);
		// $dayweek = date("Y-m-d", $date);
		// return $dayweek;
	// }
	
}

?>
