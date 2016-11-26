<?php
class Login{
  private $conn = null;

  private $message;

  public function __construct($koneksi){
    $this->conn = $koneksi;

    if (empty($_SESSION['status'])) {
      session_start();
    }

    if (isset($_GET['logout'])) {
      $this->Logout();
    }
    if (isset($_POST['login'])) {
      $this->Login();
    }
  }

  private function Login(){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $this->conn->prepare("SELECT * FROM user WHERE username = :username");
    $auth = array(':username' => $username);
    $query->execute($auth);

    $query2 = $this->conn->prepare("SELECT COUNT(*) AS jumlah FROM user WHERE username = :username");
    $query2->execute($auth);

    $jumlah = $query2->fetch();
    $userData = $query->fetch();

    if ($jumlah['jumlah'] == 1) {
      if ($password == $userData['password']) {
        $_SESSION['status'] = 1;
        $_SESSION['id'] = $userData['user_id'];
        $_SESSION['username'] = $userData['username'];

        header('location:?p=dashboard');
      }else{
        $this->message = "Username / Password salah";
      }
    }else{
      $this->message = "User tidak ditemukan";
    }
    return $this->message;
  }

  public function sessionCheck(){
    if (isset($_SESSION['status'])) {
      return TRUE;
    }else{
      return FALSE;
    }
  }

  private function Logout(){
    session_unset();
    session_destroy();
    header('location?p=login');
  }
}
?>
