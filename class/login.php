<?php
class Login{
  private $conn = null;

  public function __construct($koneksi){
    $this->conn = $koneksi;

    if ($_GET['logout']) {
      $this->Logout();
    }elseif ($_POST['login']) {
      $this->Login();
    }
  }

  public function Login(){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $this->conn->query("SELECT * FROM user WHERE username = $this->username AND password = $this->password");
    $data = $result->fetch(PDO::FETCH_ASSOC);

    if ($result == 1) {
      session_start();
      $_SESSION['username'] = $data['username'];
      $_SESSION['id'] = $data['user_id'];
    }
  }

  public function Session(){
    if (isset($_SESSION['username'])) {
      return "login";
    }else{
      return ""
    }
  }

  public function Logout(){

  }
}
?>
