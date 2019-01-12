<?php

date_default_timezone_set("Asia/Jakarta");

Class Database{
	
	static $connection;
	
	public static function GetConnection(){
		return Database::OpenDBConnection();
	}
	
	private function OpenDBConnection(){
		$servername = "localhost";
		$username = "ecoplus_reader";
		$password = "";
		$dbname = "ecoplus";
		if(!isset($connection)){
			$connection = new mysqli($servername, $username, $password, $dbname);
			if($connection->connect_error){
				die("connection failed status: " . $connection->connect_error);
			}
		}
		return $connection;
	}
	
}

?>