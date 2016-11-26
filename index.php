<?php
require_once 'class/koneksi.php';
require_once 'class/login.php';
require_once 'class/transaksi.php';
require_once 'class/page.php';

// Initiasi objek
$database = new Koneksi();
$koneksi = $database->dapetKoneksi();

$login = new Login($koneksi);

// Cek Halaman
if ($koneksi == FALSE) {
  $page = "error";
}elseif (empty($_GET['p'])) {
  if ($login->sessionCheck() == TRUE) {
    header('location:?p=dashboard');
  }else{
    header('location:?p=login');
  }
}elseif($_GET['p'] == "dashboard" || $_GET['p'] == "income" || $_GET['p'] == "outcome" || $_GET['p'] == "wishlist" || $_GET['p'] == "login" || $_GET['p'] == "register"){
  if ($login->sessionCheck() == FALSE) {
    if ($_GET['p'] == "login" || $_GET['p'] == "register") {
      $page = $_GET['p'];
    }else{
      $page = "nosession";
    }
  }elseif ($login->sessionCheck() == TRUE) {
    if ($_GET['p'] == "login" || $_GET['p'] == "register") {
      $page = "sessiondetect";
    }else{
      $page = $_GET['p'];
    }
  }
}else{
  $page = "404";
}

$halamannya = new Page($page);
?>
<!DOCTYPE html>
  <head>
    <!-- masukkan meta disini -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $halamannya->setTitle();?></title>

    <!-- masukkan stylesheet disini -->
    <link type="text/css" rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/bootflat/css/bootflat.min.css">
    <link type="text/css" rel="stylesheet" href="assets/ionicons/css/ionicons.min.css">
    <link type="text/css" rel="stylesheet" href="assets/original/css/style.css">
  </head>
  <body>
<?php
$halamannya->setSidebar();
?>
<?php
$halamannya->setPage();
?>
    <!-- masukkan javascript disini -->
    <script type="text/javascript" src="assets/jquery/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/bootflat/js/icheck.min.js"></script>
    <script type="text/javascript" src="assets/bootflat/js/jquery.fs.selecter.min.js"></script>
    <script type="text/javascript" src="assets/bootflat/js/jquery.fs.stepper.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
  </body>
</html>
