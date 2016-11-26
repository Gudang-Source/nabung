<?php
if (empty($_SESSION['username'])) {
  $url = "?p=login";
  $label = "Login";
}else {
  $url = "?p=dashboard";
  $label = "Dashboard";
}
?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <span class="size-96">
            <center><i class="icon ion-alert fc-warning-light"></i></center>
          </span>
          <h2 class="error-title text-center">404 Not Found</h2>
          <div class="alert alert-warning error-box">
            <h4><span class="icon ion-fw ion-alert-circled"></span>Ente salah kamar</h4>
            <p class="error-message error-message-warning">Halaman yang ente cari tidak ditemukan!</p>
            <a class="btn btn-warning error-button" name="button" href="<?php echo $url;?>"><?php echo $label;?></a>
          </div>
        </div>
      </div>
    </div>
