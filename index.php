<?php
require_once 'class/koneksi.php';
require_once 'class/login.php';
require_once 'class/page.php';

// Initiasi objek
$database = new Koneksi();
$koneksi = $database->dapetKoneksi();

$login = new Login($koneksi);
$halamannya = new Page($_GET['p'],$login->sessionCheck(),$koneksi);
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
    <link type="text/css" rel="stylesheet" href="assets/datatables/datatables.min.css">
    <link type="text/css" rel="stylesheet" href="assets/original/css/style.css">
  </head>
  <body>
<?php
$halamannya->setSidebar();
?>
<?php
$halamannya->setPage();
?>
    <div id="confirmation" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close">&times;</button>
            <h4 class="modal-title">Confirmation</h4>
          </div>
          <div class="modal-body">
            <p>
              Apakah anda yakin ingin logout ?
            </p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="?logout">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- masukkan javascript disini -->
    <script type="text/javascript" src="assets/jquery/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/bootflat/js/icheck.min.js"></script>
    <script type="text/javascript" src="assets/bootflat/js/jquery.fs.selecter.min.js"></script>
    <script type="text/javascript" src="assets/bootflat/js/jquery.fs.stepper.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/original/js/ajax-income.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#income').dataTable();
        $('#outcome').dataTable();
      });
    </script>
  </body>
</html>
