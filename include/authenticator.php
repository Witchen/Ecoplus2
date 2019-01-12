<?php

require_once("db.php");
session_start();

class Authenticator{
	
	function Authenticator(){
		$this->db = new Database();
		$this->connection = $this->db->GetConnection();
	}
	
	function CheckMember($id, $password){
		$sql = "SELECT * FROM member where id = '".$id."';";
		$result = $this->connection->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			if($row["id"] == $id and $row["password"] == $password){
				$_SESSION['member'] = $row;
				return "correct";
			}else if($row["id"] == $id){
				return "Incorrect ID or Password";
			}
		}else{
			return "Incorrect ID or Password";
		}
	}
	
	function CreateMember(){
		
	}
	
	function ValidateInput(){
		
	}
	
}

?>