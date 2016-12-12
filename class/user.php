<?php
class User{
	private $user_id;
	private $username;
	private $name;
	private $goal;
	private $profilePict;

	private $userdata;

	private $message;
	private $status;
	private $conn;

	public function __construct($koneksi, $sesi, $userID){
		$this->conn = $koneksi;
		if ($sesi != TRUE) {
			$this->message = "Access denied!";
		}else{
			if (isset($userID)) {
				//Mengambil data user dari database dan dikirimkan ke property
				try {
					$query = $this->conn->prepare("SELECT * FROM user WHERE user_id = :user_id");
					$query->bindParam(':user_id', $userID);
					$query->execute();

					$user_data = $query->fetch(PDO::FETCH_ASSOC);

					$this->user_id = $userID;
					$this->username = $user_data['username'];
					$this->name = $user_data['fullname'];
					$this->goal = $user_data['goal'];
					$this->profilePict = $user_data['pict'];

				} catch (PDOException $e) {
					$this->message = "Terjadi kesalahan : ".$e->getMessage();
				}
			}
		}
	}

	public function Request($act){
		if (empty($act)) {
			$this->message = "Menunggu perintah";
		}elseif ($act == "changeName") {
			if (empty($_POST['name'])) {
				$changedName = null;
			}else{
				$changedName = $_POST['name'];
			}
			$user_id = $this->user_id;
			$this->changeName($user_id, $changedName);
		}elseif ($act == "getUserData") {
			$this->getUserData();
		}elseif ($act == "changePassword") {
			if (empty($_POST['oldPassword'])) {
				$oldPassword = null;
			}else{
				$oldPassword = $_POST['oldPassword'];
			}

			if (empty($_POST['newPassword'])) {
				$newPassword = null;
			}else{
				$newPassword = $_POST['newPassword'];
			}

			if (empty($_POST['retryPassword'])) {
				$retryPassword = null;
			}else{
				$retryPassword = $_POST['retryPassword'];
			}
			$user_id = $this->user_id;

			$this->changePassword($user_id, $oldPassword, $newPassword, $retryPassword);
		}elseif ($act == "changeGoal"){
			if (empty($_POST['goal'])) {
				$goal = null;
			}else{
				$goal = $_POST['goal'];
			}
			$user_id = $this->user_id;

			$this->changeGoal($user_id, $goal);
		}
	}

	private function getUserData(){
		$data = array();
		$data['username'] = $this->username;
		$data['name'] = $this->name;
		$data['goal'] = $this->goal;
		$data['profilePict'] = $this->profilePict;

		$this->userdata = $data;
	}

	private function changeName($id, $changedName){
		if (empty($id) || empty($changedName)) {
			$this->message = "Data tidak boleh kosong";
			$this->status = 0;
		}else{
			try {
				$query = $this->conn->prepare("UPDATE user SET fullname = :cFullname WHERE user_id = :user_id");
				$query->bindParam(':cFullname', $changedName);
				$query->bindParam(':user_id', $id);
				$query->execute();

				$this->message = "Nama berhasil dirubah!";
				$this->status = 1;
			} catch (PDOException $e) {
				$this->message = "Kesalahan terjadi : ".$e->getMessage();
				$this->status = 0;
			}
		}
	}

	private function changePassword($id, $oldPassword, $newPassword, $retryPassword){
		if (empty($id) || empty($oldPassword) || empty($newPassword) || empty($retryPassword)) {
			$this->message = "Data tidak boleh kosong!";
			$this->status = 0;
		}else{
			if (strcmp($newPassword, $retryPassword) !== 0) {
				$this->message = "Password baru tidak sama";
				$this->status = 0;
			}else{
				try {
					$query = $this->conn->prepare("SELECT user.password FROM user WHERE user_id = :user_id");
					$query->bindParam(':user_id', $id);
					$query->execute();

					$data = $query->fetch(PDO::FETCH_ASSOC);

					if (password_verify($oldPassword, $data['password'])) {
						$change = $this->conn->prepare("UPDATE user SET password = :password WHERE user_id = :user_id");
						$change->bindParam(':password', password_hash($newPassword, PASSWORD_DEFAULT));
						$change->bindParam(':user_id', $id);
						$change->execute();

						$this->message = "Berhasil mengubah password";
						$this->status = 1;
					}else{
						$this->message = "Password lama anda salah";
						$this->status = 0;
					}
				} catch (PDOException $e) {
					$this->message = "Terjadi kesalahan : ".$e->getMessage();
					$this->status = 0;
				}
			}
		}
	}

	private function changeGoal($id, $goal){
		if (empty($id) || empty($goal)) {
			$this->message = "Data tidak boleh kosong!";
			$this->status = 0;
		}else{
			try {
				$query = $this->conn->prepare("UPDATE user SET goal = :goal WHERE user_id = :user_id");
				$query->bindParam(':goal', $goal);
				$query->bindParam(':user_id', $id);
				$query->execute();

				$this->message = "Berhasil mengubah goal!";
				$this->status = 1;
			} catch (PDOException $e) {
				$this->message = "Terjadi kesalahan : ".$e->getMessage();
				$this->status = 0;
			}
		}
	}

	public function Response(){
		$response = array();
		if ($this->message != "") {
			$response['message'] = $this->message;
			$response['status'] = $this->status;
		}else{
			$response = $this->userdata;
		}
		
		return json_encode($response);
	}
}
?>