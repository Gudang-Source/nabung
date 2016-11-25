<?php
class Koneksi{
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $db = "nabung";

	private $conn = null;
	private $message;

	public function dapetKoneksi(){
		try{
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->db",$this->user,$this->pass);
			return $this->conn;
		}catch(PDOException $e){
			$this->message = $e->getMessage();
			return false;
		}
	}

	public function kesalahan(){
		return $this->message;
	}
}
?>
