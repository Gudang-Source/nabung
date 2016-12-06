<?php
class Transaksi{
  private $conn = null;

  private $tableData;
  private $updateData;

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
      if (isset($_POST['getIncomeData'])) {
        $this->action = "getTheData";
        $this->getIncomeData();
      }
	  if (isset($_POST['updateInc'])){
		$this->action = "saveTheData";
		$this->updateIncomeData();
	  }
    }else{
      $this->auth = 0;
    }
  }

/*
=========================
    Income Method
=========================
*/
 
  private function tambahIncome(){
    if (empty($_POST['income_from']) || empty($_POST['income_value'])) {
      $this->eksekusi = 0;
      $this->message = "Data tidak boleh kosong!";
    }else{
      try {
        $query = $this->conn->prepare("INSERT INTO income(income_from,income_date,income_value,user_id) VALUES(:income_from,:income_date,:income_value,:user_id)");
        $data = array(
          ':income_from' => $_POST['income_from'],
		  ':income_date' => date("Y-m-d"),
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
	if (empty($_GET['income_date'])){
		$this->tableData = "<p class='text-center'>Anda belum memilih tanggal !</p>";
	}else{
		try {
		  //Untuk menghitung range bulan 
		  $getDate = explode('-',$_GET['income_date']);
		  $tahun = $getDate['0'];
		  $bulan = $getDate['1'];
		  $jumlahTanggal = cal_days_in_month(CAL_GREGORIAN,$bulan,$tahun);
      $first = array($tahun,$bulan,'01');
      $last = array($tahun,$bulan,$jumlahTanggal);
      $resultFirstDate = implode("-",$first);
      $resultLastDate = implode("-",$last);
  
      //Pagination Bagian 1
      $batasData = 5;
      if(empty($_GET['hal'])){
        $halamanIni = 1;
      }else{
        $halamanIni = $_GET['hal'];
      }
      $posisi = (($halamanIni - 1)*$batasData);
          
		  //Jika searchbar berisi, maka akan menampilkan hasil pencarian. Jika tidak, maka akan menampilkan semua data dibulan itu
		  if (isset($_GET['searchInc'])) {
      $serch = "%{$_GET['searchInc']}%";
      //No Limit
      $queryJumlahData = $this->conn->prepare("SELECT * FROM income WHERE user_id = :user_id AND income_date BETWEEN :income_date_first AND :income_date_last AND (income_from LIKE :findText OR income_date LIKE :findText OR income_value LIKE :findText)");
        $queryJumlahData->bindParam(':user_id', $_SESSION['id']);
        $queryJumlahData->bindParam(':findText', $serch);
        $queryJumlahData->bindParam(':income_date_first', $resultFirstDate);
        $queryJumlahData->bindParam(':income_date_last', $resultLastDate);
            
      //With Limit
			$query = $this->conn->prepare("SELECT * FROM income WHERE user_id = :user_id AND income_date BETWEEN :income_date_first AND :income_date_last AND (income_from LIKE :findText OR income_date LIKE :findText OR income_value LIKE :findText) ORDER BY income_date ASC LIMIT :posisi, :batasData");
			  $query->bindParam(':user_id', $_SESSION['id']);
        $query->bindParam(':findText', $serch);
        $query->bindParam(':income_date_first', $resultFirstDate);
        $query->bindParam(':income_date_last', $resultLastDate);
        $query->bindParam(':posisi', $posisi, PDO::PARAM_INT);
        $query->bindParam(':batasData', $batasData, PDO::PARAM_INT);
		  }else{
      //No Limit
      $queryJumlahData = $this->conn->prepare("SELECT * FROM income WHERE user_id = :user_id AND income_date BETWEEN :income_date_first AND :income_date_last");
        $queryJumlahData->bindParam(':user_id', $_SESSION['id']);
        $queryJumlahData->bindParam(':income_date_first', $resultFirstDate);
        $queryJumlahData->bindParam(':income_date_last', $resultLastDate);
            
            //With Limit
			$query = $this->conn->prepare("SELECT * FROM income WHERE user_id = :user_id AND income_date BETWEEN :income_date_first AND :income_date_last ORDER BY income_date ASC LIMIT :posisi, :batasData");
			  $query->bindParam(':user_id', $_SESSION['id']);
        $query->bindParam(':income_date_first', $resultFirstDate);
        $query->bindParam(':income_date_last', $resultLastDate);
        $query->bindParam(':posisi', $posisi, PDO::PARAM_INT);
        $query->bindParam(':batasData', $batasData, PDO::PARAM_INT);
		  }
          
      $query->execute();
      $queryJumlahData->execute();
      
      //Pagination Bagian 2
      $jumlahData = $queryJumlahData->rowCount();
      $jumlahPage = ceil($jumlahData/$batasData);

		  while($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$incomeData[] = $row;
		  }
           
		  if (empty($incomeData)) {
			$this->tableData = "<div class='alert alert-warning'><p class='text-center'><i class='fa fa-fw fa-warning'></i>&nbsp;Tidak ditemukan</p></div>";
		  }else{
			//Hitung total bulan ini
			$query2 = $this->conn->prepare("SELECT SUM(income_value) AS total FROM income WHERE user_id = :user_id AND income_date BETWEEN :income_date_first AND :income_date_last");
			$data2 = array(
				':user_id' => $_SESSION['id'],
				':income_date_first' => $_GET['income_date']."-01",
				':income_date_last' => $_GET['income_date']."-".$jumlahTanggal
			);
			$query2->execute($data2);
			$total = $query2->fetch(PDO::FETCH_ASSOC);
			
			$tableData = "<table class='table table-bordered'>";
			$tableData .= "<thead>";
			$tableData .= "
			<tr>
			  <th class='colNo'>No.</th>
			  <th class='colFor'>Asal</th>
			  <th class='colDate'>Tanggal</th>
			  <th class='colValue'>Nominal</th>
			  <th class='colAct'>Aksi</th>
			</tr>";
			$tableData .= "</thead>";
			$tableData .= "<tbody>";
            
      //Penomoran dimulai
      $no = $posisi + 1;
			foreach ($incomeData as $data) {
				  $tableData .= "
				  <tr>
					<td class='text-center'>".$no++."</td>
					<td>".$data['income_from']."</td>
					<td>".$data['income_date']."</td>
					<td>".$data['income_value']."</td>
					<td class='text-center'>
					  <button class='btn btn-default btn-sm' onclick='getIncomeData(".$data['income_id'].")'><i class='fa fa-fw fa-edit'></i>Edit</button>
					  <button class='btn btn-danger btn-sm' onclick='delIncome(".$data['income_id'].")'><i class='fa fa-fw fa-remove'></i>Delete</button>
					</td>
				  </tr>";
			}
			$tableData .= "</tbody>";
			$tableData .= "</table>";
			$tableData .= "<div class='status-jumlah'><p>Jumlah bulan ini : Rp ".$total['total']."</p></div>";
      $tableData .= "<div class='text-center'>";
      $tableData .= "<ul class='pagination'>";
      for($i=1; $i<=$jumlahPage; $i++){
          $tableData .= "
          <li><a href='#' onclick='loadIncome(".$i.")'>".$i."</a></li>
          ";
      }
      $tableData .= "</ul>";
      $tableData .= "</div>";
      $tableData .= "<p class='hidden' id='disPage'>".$halamanIni."</p>";
			$this->tableData = $tableData;
		  }
		}catch (PDOException $e) {
		  $this->tableData = "Kesalahan terjadi : ".$e->getMessage();
		}
	}
    return $this->tableData;
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

  private function getIncomeData(){
    try {
      $query = $this->conn->prepare("SELECT * FROM income WHERE income_id = :income_id AND user_id = :user_id");
      $data = array(
        ':income_id' => $_POST['income_id'],
        ':user_id' => $_SESSION['id']
      );
      $query->execute($data);

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $incomeData = $row;
      }
      $this->updateData = $incomeData;
    } catch (PDOException $e) {
      $this->message = "Kesalahan Terjadi : ".$e->getMessage();
    }
  }
	
  private function updateIncomeData(){
	if(empty($_POST['upIncFrom']) && empty($_POST['upIncValue'])){
		$this->message = "Data tidak boleh kosong!";
		$this->eksekusi = 0;
	}else{
		try{
			$query = $this->conn->prepare("UPDATE income SET income_from = :income_from, income_value = :income_value WHERE income_id = :income_id");
			$data = array(
				':income_id'	=> $_POST['upIncID'],
				':income_from' 	=> $_POST['upIncFrom'],
				':income_value' => $_POST['upIncValue']
			);
			$query->execute($data);
			$this->message = "Data berhasil diupdate!";
			$this->eksekusi = 1;
		}catch(PDOException $e){
			$this->message = "Data gagal diupdate : ".$e->getMessage();
			$this->eksekusi = 0;
		}		
	}
  }

/*
 =========================
    Response Method
 =========================
*/
	
  public function response(){
    $response = array();
    if ($this->auth == 0) {
      $response['message'] = "Access Denied !";
      return json_encode($response);
    }else{
      if ($this->action == null) {
        $response['message'] = "Menunggu sebuah jawaban...";
        return json_encode($response);
      }
	  elseif ($this->action == "addIncome") {
        $response['message'] = $this->message;
        $response['execute'] = $this->eksekusi;
        return json_encode($response);
      }
	  elseif ($this->action == "deleteIncome") {
        $response['message'] = $this->message;
        $response['execute'] = $this->eksekusi;
        return json_encode($response);
      }
	  elseif ($this->action == "saveTheData"){
		$response['message'] = $this->message;
		$response['execute'] = $this->eksekusi;
		return json_encode($response);
	  }
	  elseif ($this->action == "getTheData") {
        return json_encode($this->updateData);
      }
	  elseif ($this->action == "readIncome") {
        return $this->tableData;
      }
    }
  }
}
?>
