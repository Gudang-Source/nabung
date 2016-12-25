<?php
	class Wishlist{
		public $userdata = array('userid','saldo');
		private $conn = null;
		private $response = array('status','message');
		private $data;

		public function __construct($koneksi, $sesi, $userID){
			$this->conn = $koneksi;
			if ($sesi != TRUE) {
				$this->response['message'] = "Access Denied !";
				$this->response['status'] = 0;
			}else{
				if (isset($userID)) {
					try {
						$sum_income = $this->conn->prepare("SELECT SUM(income_value) AS jumlah FROM income WHERE user_id = :user_id");
						$sum_income->bindParam(':user_id', $userID);
						$sum_income->execute();
						$result_inc = $sum_income->fetch(PDO::FETCH_ASSOC);

						$sum_outcome = $this->conn->prepare("SELECT SUM(outcome_value) AS jumlah FROM outcome WHERE user_id = :user_id");
						$sum_outcome->bindParam(':user_id', $userID);
						$sum_outcome->execute();
						$result_out = $sum_outcome->fetch(PDO::FETCH_ASSOC);

						$this->userdata['userid'] = $userID;
						$this->userdata['saldo'] = $result_inc['jumlah'] - $result_out['jumlah'];
					} catch (PDOException $e) {
						$this->response['message'] = "Terjadi kesalahan : ".$e->getMessage();
						$this->response['status'] = 0;
					}
				}
			}
		}

		public function Request($act){
			if (empty($act)) {
				$this->response['message'] = "Menunggu perintah...";
				$this->response['status'] = 0;
			}elseif ($act == "getData") {
				if (empty($_GET['searchText'])) {
					$searchText = null;
				}else{
					$searchText = "%{$_GET['searchText']}%";
				}
				if (empty($_GET['page'])) {
					$dispage = null;
				}else{
					$dispage = $_GET['page'];
				}
				$this->getData($this->userdata['userid'], $searchText, $dispage);
			}elseif($act == "addData"){
				if (empty($_POST['namaBrg'])) {
					$namaBrg = null;
				}else{
					$namaBrg = $_POST['namaBrg'];
				}
				if (empty($_POST['nominalBrg'])) {
					$nominalBrg = null;
				}else{
					$nominalBrg = $_POST['nominalBrg'];
				}
				$this->addData($this->userdata['userid'], $namaBrg, $nominalBrg);	
			}elseif($act == "editData"){
				if (empty($_POST['namaBrg'])) {
					$namaBrg = null;
				}else{
					$namaBrg = $_POST['namaBrg'];
				}
				if (empty($_POST['nominalBrg'])) {
					$nominalBrg = null;
				}else{
					$nominalBrg = $_POST['nominalBrg'];
				}
				$this->editData($this->userdata['userid'], $namaBrg, $nominalBrg);	
			}elseif($act == "delData"){
				if (empty($_POST['idBrg'])) {
					$idBrg = null;
				}else{
					$idBrg = $_POST['idBrg'];
				}
				$this->delData($userdata['userid'], $idBrg);
			}else{
				$this->response['message'] = "Perintah tidak dikenal ";
				$this->response['status'] = 0;
			}
		}

		private function addData($id, $namaBarang, $nominalBarang){
			if (empty($namaBarang) || empty($nominalBarang)) {
				$this->response['message'] = "Data tidak boleh kosong";
				$this->response['status'] = 0;
			}else{
				try{
					$query = $this->conn->prepare("INSERT INTO wishlist(nama_barang, nominal_barang, user_id) VALUES(:nama_barang, :nominal_barang, :user_id)");
					$query->bindParam(':nama_barang', $namaBarang);
					$query->bindParam(':nominal_barang', $nominalBarang);
					$query->bindParam(':user_id', $id);
					$query->execute();

					$this->response['message'] = "Data berhasil disimpan!";
					$this->response['status'] = 1;
				}catch(PDOException $e){
					$this->response['message'] = "Terjadi kesalahan : ".$e->getMessage();
					$this->response['status'] = 0;
				}
			}
		}

		private function getData($id, $searchText, $halaman){
			//Fungsi persentasi
			function persentase($harga, $saldo){
				$persentase = ceil(($saldo/$harga)* 100);
				if ($persentase > 100) {
					return 100;
				}elseif ($persentase < 0) {
					return 0;
				}else{
					return $persentase;
				}
			}

			function barColor($persen){
				if ($persen < 20) {
					$color = "progress-bar-danger";
				}elseif ($persen < 75) {
					$color = "progress-bar-warning";
				}elseif ($persen < 100) {
					$color = "progress-bar-primary";
				}elseif ($persen == 100) {
					$color = "progress-bar-success";
				}else{
					$color = "progress-bar-info";
				}
				return $color;
			}

			function barStatus($persen){
				if ($persen == 100) {
					$status = "Complete";
				}else{
					$status = $persen."%";
				}
				return $status;
			}

			function btnState($persen){
				if ($persen == 100) {
					$state = "";
				}else{
					$state = "disabled";
				}
				return $state;
			}

			try {
				//Paginasi
				$batas_data = 10;
				if (empty($halaman)) {
					$halaman_ini = 1;
				}else{
					$halaman_ini = $halaman;
				}
				$posisi = (($halaman_ini - 1)* $batas_data);

				if (empty($searchText)) {
					$query = $this->conn->prepare("SELECT * FROM wishlist WHERE user_id = :user_id ORDER BY user_id ASC");
					$query->bindParam(':user_id', $id);
					$query->execute();

					//Limited Query
					$lquery = $this->conn->prepare("SELECT * FROM wishlist WHERE user_id = :user_id ORDER BY user_id ASC LIMIT :posisi, :batas_data");
					$lquery->bindParam(':user_id', $id);
					$lquery->bindParam(':posisi', $posisi, PDO::PARAM_INT);
					$lquery->bindParam(':batas_data', $batas_data, PDO::PARAM_INT);
					$lquery->execute();
				}else{
					$query = $this->conn->prepare("SELECT * FROM wishlist WHERE user_id = :user_id AND (nama_barang LIKE :searchText OR nominal_barang LIKE :searchText) ORDER BY user_id ASC");
					$query->bindParam(':user_id', $id);
					$query->bindParam(':searchText', $searchText);
					$query->execute();

					//Limited Query
					$lquery = $this->conn->prepare("SELECT * FROM wishlist WHERE user_id = :user_id AND (nama_barang LIKE :searchText OR nominal_barang LIKE :searchText) ORDER BY user_id ASC LIMIT :posisi, :batas_data");
					$lquery->bindParam(':user_id', $id);
					$lquery->bindParam(':searchText', $searchText);
					$lquery->bindParam(':posisi', $posisi, PDO::PARAM_INT);
					$lquery->bindParam(':batas_data', $batas_data, PDO::PARAM_INT);
					$lquery->execute();
				}

				//Config Paginasi
				$countNow = $lquery->rowCount();
				$countAll = $query->rowCount();
				$countPage = ceil($countAll / $batas_data);


				while ($row = $lquery->fetch(PDO::FETCH_ASSOC)) {
					$data[] = $row;
				}

				if (empty($data)) {
					$table = "<div class='alert alert-warning'><p class='text-center'><i class='fa fa-fw fa-warning'></i>&nbsp;Tidak ditemukan</p></div>";
				}else{

					//View Paginasi
					$table = "<div class='text-left'>";
					$table .= "<ul class='pagination'>";
					if ($halaman_ini < 2) {
						$table .= "<li class='disabled'><a href='#'>&laquo;</a></li>";
					}else{
						$table .= "<li><a href='#' onclick='loadDataWS(".($halaman_ini - 1).")'>&laquo;</a></li>";
					}

					//Active set
					$page_active = array();
					for ($i=1; $i <= $countPage ; $i++) { 
						$page_active[$i] = $i;
						if ($page_active[$i] == $halaman_ini) {
							$page_active[$i] = "class='active'";
						}else{
							$page_active[$i] = "";
						}
					}
					//Pagination
					$selisih_page = $countPage - $halaman_ini;
					if ($halaman_ini == 1) {
						$start = $halaman_ini;
						if ($selisih_page < 2) {
							$end = $halaman_ini + $selisih_page;
						}else{
							$end = $halaman_ini + 2;
						}
					}elseif ($halaman_ini == $countPage) {
						if (($halaman_ini - 2) < 1) {
							$start = $halaman_ini - 1;
						}else{
							$start = $halaman_ini - 2;
						}
						$end = $halaman_ini;
					}else{
						$start = $halaman_ini - 1;
						$end = $halaman_ini + 1;
					}

					for($i = $start; $i <= $end ; $i++) { 
						$table .= "
						<li ".$page_active[$i]."><a href='#' onclick='loadDataWS(".$i.")'>".$i."</a></li>";
					}

					if (($countPage - $halaman_ini) < 1) {
						$table .= "<li class='disabled'><a href='#'>&raquo;</a></li>";
					}else{
						$table .= "<li><a href='#' onclick='loadDataWS(".($halaman_ini + 1).")'>&raquo;</a></li>";
					}
					$table .= "</ul>";
					$table .= "</div>";

					$table .= "<table class='table table-bordered table-hover'>";
					$table .= "
	              	<thead>
		                <tr>
		                  <th class='colNo'>No</th>
		                  <th class='colBarang'>Barang</th>
		                  <th class='colProgress'>Progress</th>
		                  <th class='colHarga'>Harga</th>
		                  <th class='colAct'>Aksi</th>
		                </tr>
	              	</thead>
	              	<tbody>";
					$no = $posisi + 1;
					foreach ($data as $ws) {
					$table .= "
						<tr>
							<td class='text-center'>".$no++.".</td>
							<td>".$ws['nama_barang']."</td>
							<td class='text-center'>	
								<div class='progress'>
			                      <div class='progress-bar ".barColor(persentase($ws['nominal_barang'], $this->userdata['saldo']))."' role='progressbar' aria-valuenow='".persentase($ws['nominal_barang'], $this->userdata['saldo'])."' aria-valuemin='0' aria-valuemax='100' style='width:".persentase($ws['nominal_barang'], $this->userdata['saldo'])."%;'>".barStatus(persentase($ws['nominal_barang'], $this->userdata['saldo']))."</div>
			                    </div>
							</td>
							<td>".$ws['nominal_barang']."</td>
							<td>
								<button class='btn btn-sm btn-primary ".btnState(persentase($ws['nominal_barang'], $this->userdata['saldo']))."'>Beli</button>
	                    		<button class='btn btn-sm btn-success' data-toggle='modal' data-target='#edit-barang'>Ubah</button>
								<button class='btn btn-sm btn-danger'>Hapus</button>
							</td>
						</tr>";
					}
					$table .= "
					</tbody>
					</table>";
					$table .= "
					<p class='hidden' id='halini'>".$halaman_ini."</p>
					<p class='hidden' id='sumhalini'>".$countNow."</p>
					";
				}

				$this->data = $table;
			} catch (PDOException $e) {
				$this->response['message'] = "Terjadi kesalahan : ".$e->getMessage();
				$this->response['status'] = 0;
			}
		}

		public function Response(){
			if (empty($this->response['message']) && empty($this->response['status'])) {
				$response = $this->data;
				return $response;
			}else{
				$response['message'] = $this->response['message'];
				$response['status'] = $this->response['status'];
				return json_encode($response);
			}
		}
	}
?>