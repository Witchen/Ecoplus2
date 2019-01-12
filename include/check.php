<?php

require_once("db.php");
session_start();

class Checker{
	
	function Checker(){
		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
	}
	
	function GetMemberName($id){
		// prepare and bind
		$stmt = $this->connection->prepare("SELECT nama_lengkap, handphone FROM member where id = ?;");
		$stmt->bind_param("s", $idparam);
		
		// set parameters and execute
		$idparam = $id;
		$stmt->execute();
		$result = $stmt->get_result();
		
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			return $row;
		}else{
			return false;
		}
		
		// $sql = "SELECT nama_lengkap FROM member where id = '".$id."';";
		// $result = $this->connection->query($sql);
		// if($result->num_rows > 0){
			// $row = $result->fetch_assoc();
			// return $row["nama_lengkap"];
		// }else{
			// return false;
		// }
	}
	
}

?>