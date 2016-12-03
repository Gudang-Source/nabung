<?php
class Transaksi{
  private $conn = null;

  private $tableData;

  private $auth;

  private $message;
  private $eksekusi;
  private $action;

  public function __construct($connectionStatus,$sessionStatus){
    if ($sessionStatus == TRUE) {
      $this->conn = $connectionStatus;
      $this->auth = 1;

      if (isset($_GET['readInc'])) {
        $this->action = "readIncome";
        $this->bacaIncome();
      }
      if (isset($_POST['addInc'])) {
        $this->action = "addIncome";
        $this->tambahIncome();
      }
      if (isset($_POST['delInc'])) {
        $this->action = "deleteIncome";
        $this->hapusIncome();
      }
    }else{
      $this->auth = 0;
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

  private function bacaIncome(){
    try {
      $query = $this->conn->prepare("SELECT * FROM income WHERE user_id = :user_id");
      $data = array(
        ':user_id' => $_SESSION['id']
      );
      $query->execute($data);
      while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $incomeData[] = $row;
      }

      if (empty($incomeData)) {
        $this->tableData = "<p class='text-center'>Tidak ditemukan</p>";
      }else{
        $tableData = "<table class='table table-bordered'>";
        $tableData .= "<thead>";
        $tableData .= "
        <tr>
          <th class='colNo'>No.</th>
          <th class='colFor'>Untuk</th>
          <th class='colDate'>Tanggal</th>
          <th class='colValue'>Nominal</th>
          <th class='colAct'>Nominal</th>
        </tr>";
        $tableData .= "</thead>";

        $tableData .= "<tbody>";
        $no = 1;
        foreach ($incomeData as $data) {
              $tableData .="
              <tr>
                <td class='text-center'>".$no++."</td>
                <td>".$data['income_for']."</td>
                <td>".$data['income_date']."</td>
                <td>".$data['income_value']."</td>
                <td class='text-center'>
                  <button class='btn btn-default btn-sm' onclick='editIncome(".$data['income_id'].")'><i class='fa fa-fw fa-edit'></i>Edit</button>
                  <button class='btn btn-danger btn-sm' onclick='delIncome(".$data['income_id'].")'><i class='fa fa-fw fa-remove'></i>Delete</button>
                </td>
              </tr>";
        }
        $tableData .= "</tbody>";
        $tableData .= "</table>";

        $this->tableData = $tableData;
      }
      return $this->tableData;

    }catch (PDOException $e) {
      $this->eksekusi = 0;
      $this->message = "Data can't load. ".$e->getMessage();
    }
  }

  private function hapusIncome(){
    if (empty($_POST['income_id'])) {
      $this->eksekusi = 0;
      $this->message = "ID Tidak Ditemukan";
    }else{
      try {
        $query = $this->conn->prepare("DELETE FROM income WHERE income_id = :income_id");
        $data = array(
          ':income_id' => $_POST['income_id']
        );
        $query->execute($data);
        $this->eksekusi = 1;
        $this->message = "Data berhasil dihapus";
      } catch (PDOException $e) {
        $this->eksekusi = 0;
        $this->message = "Data tidak bisa dihapus : ".$e->getMessage();
      }
    }
  }

  public function response(){
    $response = array();
    if ($this->auth == 0) {
      $response['message'] = "Access Denied !";
      return json_encode($response);
    }else{
      if ($this->action == null) {
        $response['message'] = "Menunggu sebuah jawaban...";
        return json_encode($response);
      }elseif ($this->action == "addIncome") {
        $response['message'] = $this->message;
        $response['execute'] = $this->eksekusi;
        return json_encode($response);
      }elseif ($this->action == "deleteIncome") {
        $response['message'] = $this->message;
        $response['execute'] = $this->eksekusi;
        return json_encode($response);
      }elseif($this->action == "readIncome") {
        return $this->tableData;
      }
    }
  }
}
?>
