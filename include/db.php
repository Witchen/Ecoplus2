<?php

date_default_timezone_set("Asia/Jakarta");

Class Database{
	
	static $connection;
	
	public static function GetConnection(){
		return Database::OpenDBConnection();
	}
	
	private function OpenDBConnection(){
		$servername = "localhost";
		$username = "k5413684_reader";
		$password = "Readerpass312";
		$dbname = "k5413684_ecoplus";
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