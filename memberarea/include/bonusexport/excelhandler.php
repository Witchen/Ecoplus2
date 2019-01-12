<?php
require_once("./../../../include/db.php");

$today = date("D");
if($today == "Sun" || $today == "Mon" || $today == "Tue"){
	$handler = new ExcelHandler();
	$returnarr = $handler->GetLastSundayBonus();
	$bonusarr = $returnarr['bonusarr'];
	$idlist = $returnarr['idlist'];
}

Class ExcelHandler{
	
	function ExcelHandler(){
		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
		
		$this->bonusarr = null;
	}
	
	function GetLastSundayBonus(){
		$mindaytosun = 7;				//Change the value according to day difference between sunday and today. Default is 7 (Sun to Sun).
		$today = date("Y-m-d");
		$datearr = explode("-", $today);
		
		//Check whether today is Sunday, Monday or Tuesday. Then fix the day
		$day = date("D");
		if($day == "Sun"){
			//Do nothing as the date is the default bonus processing date.
		}else if($day == "Mon"){
			//Minus 1 day to set the day to sunday
			$datearr[2] = $datearr[2] - 1;
		}else if($day == "Tue"){
			//Minus 2 day to set the day to sunday
			$datearr[2] = $datearr[2] - 2;
		}
		
		$yesterdaytimestamp = mktime(0, 0, 0, $datearr[1] ,($datearr[2] - 1), $datearr[0]); 
		$date1 = date("Y-m-d", $yesterdaytimestamp); 
		$lastsundaytimestamp = mktime(0, 0, 0, $datearr[1] ,($datearr[2] - $mindaytosun), $datearr[0]); 
		$date2 = date("Y-m-d", $lastsundaytimestamp);
		$sql = "SELECT * FROM `bonus_history` WHERE `tanggal` BETWEEN '$date2' AND '$date1'";
		// echo $sql;
		$result = $this->connection->query($sql);
		$count = 0;
		for($i = 0; $i < $result->num_rows; $i++){
			$row = $result->fetch_assoc();
			if(isset($this->bonusarr[$row['member_id']])){
				//echo "row number ".$i." isset<br>";
				$this->bonusarr[$row['member_id']]['sponsor'] = $this->bonusarr[$row['member_id']]['sponsor'] + $row['sponsor'];
				$this->bonusarr[$row['member_id']]['pasangan'] = $this->bonusarr[$row['member_id']]['pasangan'] + $row['pasangan'];
				$this->bonusarr[$row['member_id']]['matching'] = $this->bonusarr[$row['member_id']]['matching'] + $row['matching'];
				$this->bonusarr[$row['member_id']]['titik'] = $this->bonusarr[$row['member_id']]['titik'] + $row['titik'];
			}else{
				//echo "row number ".$i." isnew<br>";
				$this->bonusarr[$row['member_id']] = $row;
				$idlist[$count] = $row['member_id'];
				$count++;
			}
			$this->bonusarr[$row['member_id']]['totalbonus'] = $this->bonusarr[$row['member_id']]['sponsor'] + $this->bonusarr[$row['member_id']]['pasangan'] + 
																$this->bonusarr[$row['member_id']]['matching'] + $this->bonusarr[$row['member_id']]['titik'];
			$pajak = $this->bonusarr[$row['member_id']]['totalbonus'] * 6 / 100;												
			$this->bonusarr[$row['member_id']]['totalbonus2'] = $this->bonusarr[$row['member_id']]['totalbonus'] - $pajak - 10000;
			$bonuslain = $this->GetBonus50And100($row['member_id'], $this->bonusarr[$row['member_id']]['totalbonus2']);
			$this->bonusarr[$row['member_id']]['total50persen'] = 0; //$bonuslain['bonus50persen'];
			$this->bonusarr[$row['member_id']]['total100persen'] = 0; //$bonuslain['bonus100persen'];
			$this->bonusarr[$row['member_id']]['totaltransfer'] = $this->bonusarr[$row['member_id']]['totalbonus2'];
			$this->bonusarr[$row['member_id']]['totalakumulasitabungan'] = 0; //$bonuslain['totalakumulasitabungan'];
			$this->bonusarr[$row['member_id']]['totalakumulasibonus'] = $bonuslain['totalakumulasibonus'];
		}
		for($i = 0; $i < count($idlist); $i++){
			$id = $this->bonusarr[$idlist[$i]]['member_id'];
			$sql = "SELECT nama_lengkap, bank, atas_nama, no_rekening FROM `member` WHERE id = '$id';";
			$result = $this->connection->query($sql);
			$row = $result->fetch_assoc();
			$this->bonusarr[$idlist[$i]]['nama_lengkap'] = $row['nama_lengkap'];
			$this->bonusarr[$idlist[$i]]['bank'] = $row['bank'];
			$this->bonusarr[$idlist[$i]]['atas_nama'] = $row['atas_nama'];
			$this->bonusarr[$idlist[$i]]['no_rekening'] = $row['no_rekening'];
			//print_r($this->bonusarr[$idlist[$i]]);echo "<br>";
		}
		$returnarr['bonusarr'] = $this->bonusarr;
		$returnarr['idlist'] = $idlist;
		return $returnarr;
	}
	
	//$totalbonus2 adalah bonus periode terakhir yang telah di kurangi pajak dan biaya
	function GetBonus50And100($id, $totalbonus2){
		$totalakumulasibonus = $this->GetAkumulasi($id);
		// $totalakumulasitabungan = 0;
		// if($totalakumulasibonus < 4000000){
			// $bonus50persen = $totalbonus2 * 50 / 100;
			// $bonus100persen = 0;
			// $totalakumulasitabungan = $totalakumulasibonus * 50 / 100;
		// }else{
			// $previousbonus = $this->CheckPreviousPeriodBonus($id);
			// if($previousbonus != 0){	//if member have previous bonus
				// if($previousbonus < 4000000){	//  if the current period make bonus exceed 4,000,000
					// $sisabonusuntukditabung = 4000000 - $previousbonus; //akan di kali dengan 50% dan ditampilkan di kolom 50%
					// $bonus50persen = $sisabonusuntukditabung / 2;
					// $bonus100persen = $totalbonus2 - $sisabonusuntukditabung; //akan di tampilkan di kolom 100%
					// $totalakumulasitabungan = (4000000 - $sisabonusuntukditabung) / 2 + $bonus50persen;
				// }else{	//else previous period bonus already exceed 4,000,000
					// $bonus50persen = 0;
					// $bonus100persen = $totalbonus2;
					// $totalakumulasitabungan = 4000000 / 2;
				// }
			// }else{	//else member get 4,000,000 bonus in one and only one statement(first bonus)
				// 50 % print 2,000,000
				// 100 % print sisa
				// $bonus50persen = 0;
				// $bonus100persen = $totalbonus2 - 2000000;
				// $totalakumulasitabungan = 4000000 / 2;
			// }
		// }
		// $returnarr['bonus50persen'] = $bonus50persen;
		// $returnarr['bonus100persen'] = $bonus100persen;
		// $returnarr['totalakumulasitabungan'] = $totalakumulasitabungan;
		$returnarr['totalakumulasibonus'] = $totalakumulasibonus;
		return $returnarr;
	}
	
	function GetAkumulasi($id){
		$totalbonus = 0;
		
		$periodelist = null;
		$count = 0;
		
		$today = date("Y-m-d");
		$sql = "SELECT * FROM `bonus_history` WHERE `member_id` = '$id' and `tanggal` < '$today';";
		$result = $this->connection->query($sql);
		for($i = 0; $i < $result->num_rows; $i++){
			$row = $result->fetch_assoc();
			
			$row['periode'] = ExcelHandler::GetPeriode($row['tanggal']);
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
				$minday = 0;
				break;
		}
		$periodtimestamp = mktime(0, 0, 0, $datearr[1], $datearr[2] - $minday, $datearr[0]);
		$perioddate = date("Y-m-d", $periodtimestamp);
		return $perioddate;
	}
	
	function CheckPreviousPeriodBonus($id){
		$dayweek = date("D");
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
				$minday = 0;
				break;
		}
		
		$today = date("Y-m-d");
		$datearr = explode("-", $today);
		$date1timestamp = mktime(0, 0, 0, $datearr[1] ,($datearr[2] - $minday - 1) , $datearr[0]);
		$date1 = date("Y-m-d", $date1timestamp);
		
		$sql = "SELECT * FROM `bonus_history` WHERE `member_id` = '".$id."' AND `tanggal` <= '$date1';";
		$result = $this->connection->query($sql);
		//if previous periode exists then check 
		//	if previous bonus already exceed 4,000,000
		//  else the current period make bonus exceed 4,000,000
		//else the current period make bonus exceed 4,000,000 directly in single and only bonus statement
		if($result->num_rows > 0){
			$totalbonus = 0;
			for($i = 0; $i < $result->num_rows; $i++){
				$row = $result->fetch_assoc();
				$subtotal = 0;
				$subtotal = $subtotal + $row['sponsor'];
				$subtotal = $subtotal + $row['pasangan'];
				$subtotal = $subtotal + $row['matching'];
				$subtotal = $subtotal + $row['titik'];
				$pajak = $subtotal * 6 / 100;
				$subtotal = $subtotal - $pajak - 10000;
				$totalbonus = $totalbonus + $subtotal;
			}
			return $totalbonus;
		}else{
			return 0;
		}
	}
}

?>
<html>
	<body>
		<table border="1px">
			<tr>
				<th>ID</th>
				<th>Nama Lengkap</th>
				<th>Bonus Sponsor</th>
				<th>Bonus Pasangan</th>
				<th>Bonus Matching</th>
				<th>Bonus Titik</th>
				<th>Total Bonus I</th>
				<th>Total Bonus II</th>
				<th>Total 50%</th>
				<th>Total 100%</th>
				<th>Total Transfer</th>
				<th>Total Tabungan</th>
				<th>Total Akumulasi</th>
				<th>Bank</th>
				<th>Atas Nama</th>
				<th>No Rekening</th>
			</tr>
			
			<?php
			for($i = 0; $i < count($bonusarr); $i++){
				echo"
					<tr>
						<td>".$bonusarr[$idlist[$i]]['member_id']."</td>
						<td>".$bonusarr[$idlist[$i]]['nama_lengkap']."</td>
						<td>".$bonusarr[$idlist[$i]]['sponsor']."</td>
						<td>".$bonusarr[$idlist[$i]]['pasangan']."</td>
						<td>".$bonusarr[$idlist[$i]]['matching']."</td>
						<td>".$bonusarr[$idlist[$i]]['titik']."</td>
						<td>".$bonusarr[$idlist[$i]]['totalbonus']."</td>
						<td>".$bonusarr[$idlist[$i]]['totalbonus2']."</td>
						<td>".$bonusarr[$idlist[$i]]['total50persen']."</td>
						<td>".$bonusarr[$idlist[$i]]['total100persen']."</td>
						<td>".$bonusarr[$idlist[$i]]['totaltransfer']."</td>
						<td>".$bonusarr[$idlist[$i]]['totalakumulasitabungan']."</td>
						<td>".$bonusarr[$idlist[$i]]['totalakumulasibonus']."</td>
						<td>".$bonusarr[$idlist[$i]]['bank']."</td>
						<td>".$bonusarr[$idlist[$i]]['atas_nama']."</td>
						<td>".$bonusarr[$idlist[$i]]['no_rekening']."</td>
					</tr>
				";
			}
			?>
		</table>
	</body>
</html>