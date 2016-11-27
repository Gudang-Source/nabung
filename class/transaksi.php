<?php
class Transaksi{
  private $conn = null;

  private $auth;
  private $message;
  private $eksekusi;
  private $action;

  public function __construct($koneksi,$cekSesi){
    if ($cekSesi == FALSE) {
      $this->auth = FALSE;
      $this->message = "Access Denied";
    }else{
      $this->conn = $koneksi;
      $this->message = "Menunggu sebuah jawaban...";

      if (isset($_POST['addInc'])) {
        $this->action = "addIncome";
        $this->tambahIncome();
      }
      if (isset($_POST['delInc'])) {
        $this->action = "deleteIncome";
        $this->hapusIncome();
      }
    }
  }

  private function tambahIncome(){
    if (empty($_POST['income_for']) || empty($_POST['income_value'])) {
      $this->eksekusi = 0;
      $this->message = "Data tidak boleh kosong!";
    }else{
      try {
        $query = $this->conn->prepare("INSERT INTO income(income_for,income_value,user_id) VALUES(:income_for,:income_value,:user_id)");
        $data = array(
          ':income_for' => $_POST['income_for'],
          ':income_value' => $_POST['income_value'],
          ':user_id' => $_SESSION['id']
        );
        $query->execute($data);
        $this->eksekusi = 1;
        $this->message = "Data berhasil disimpan";
      } catch (PDOException $e) {
        $this->eksekusi = 0;
        $this->message = "Terjadi kesalahan saat menyimpan data. ".$e->getMessage();
      }
    }
  }

  public function response(){
    $response = array();
    if ($this->auth == FALSE) {
      $response['message'] = $this->message;
    }else{
      $response['status'] = 200;
      $response['action'] = $this->action;
      $response['execute'] = $this->eksekusi;
      $response['message'] = $this->message;
    }
    return json_encode($response);
  }
}
?>
