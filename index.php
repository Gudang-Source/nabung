<?php
require_once 'class/koneksi.php';
require_once 'class/transaksi.php';
require_once 'class/page.php';

// Initiasi objek
$database = new Koneksi();
$koneksi = $database->dapetKoneksi();

// Cek Halaman
if ($koneksi == false) {
  $page = "error";
}elseif (empty($_GET['p'])) {
  $page = "404";
}else{
  $page = $_GET['p'];
}

$halamannya = new Page($page);

?>
<!DOCTYPE html>
  <head>
    <!-- masukkan meta disini -->
    <title><?php echo $halamannya->setTitle();?></title>

    <!-- masukkan stylesheet disini -->
    <link type="text/css" rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  </head>
  <body>
<?php
$halamannya->setPage();
?>
    <!-- masukkan javascript disini -->
    <script type="text/javascript" src="assets/jquery/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
