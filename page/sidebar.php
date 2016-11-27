<?php
$database = new Koneksi();
$koneksi = $database->dapetKoneksi();

$login = new Login($koneksi);

$halamannya = new Page($_GET['p'],$login->sessionCheck(),$koneksi);
$activePage = $halamannya->setActive();
?>
    <aside class="main-sidebar">
      <ul class="nav nav-pills nav-stacked">
        <li<?php echo $activePage['dashboard'] ;?>><a href="?p=dashboard"><i class="icon ion-android-home ion-fw"></i>Dashboard</a></li>
        <li<?php echo $activePage['income'] ;?>><a href="?p=income"><i class="icon ion-android-arrow-down ion-fw"></i>Income</a></li>
        <li<?php echo $activePage['outcome'] ;?>><a href="?p=outcome"><i class="icon ion-android-arrow-up  ion-fw"></i>Outcome</a></li>
        <li<?php echo $activePage['wishlist'] ;?>><a href="?p=wishlist"><i class="icon ion-android-cart ion-fw"></i>Wishlist</a></li>
        <li class="spacer"><hr></li>
        <li<?php echo $activePage['settings'] ;?>><a href="?p=settings"><i class="icon ion-android-settings ion-fw"></i>Settings</a></li>
        <li><a href="#" data-toggle="modal" data-target="#confirmation"><i class="icon ion-log-out ion-fw"></i>Logout</a></li>
      </ul>
    </aside>
