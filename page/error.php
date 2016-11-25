<?php
  $database = new Koneksi();
  $database->dapetKoneksi();
?>
<h1 style='margin-left:20px;'>Terjadi kesalahan!</h1>
<p style='margin:25px 40px; color:red; font-size:16px;'><?php echo $database->kesalahan();?></p>
