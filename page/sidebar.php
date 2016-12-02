<?php
$database = new Koneksi();
$koneksi = $database->dapetKoneksi();

$login = new Login($koneksi);

$halamannya = new Page($_GET['p'],$login->sessionCheck(),$koneksi);
$activePage = $halamannya->setActive();
?>
    <aside class="main-sidebar">
      <ul class="nav nav-pills nav-stacked">
        <li<?php echo $activePage['dashboard'] ;?>><a href="?p=dashboard"><i class="fa fa-fw fa-dashboard"></i>Dashboard</a></li>
        <li<?php echo $activePage['income'] ;?>><a href="?p=income"><i class="fa fa-fw fa-arrow-circle-o-down"></i>Income</a></li>
        <li<?php echo $activePage['outcome'] ;?>><a href="?p=outcome"><i class="fa fa-fw fa-arrow-circle-o-up"></i>Outcome</a></li>
        <li<?php echo $activePage['wishlist'] ;?>><a href="?p=wishlist"><i class="fa fa-fw fa-shopping-cart"></i>Wishlist</a></li>
        <li class="spacer"><hr></li>
        <li<?php echo $activePage['settings'] ;?>><a href="?p=settings"><i class="fa fa-fw fa-cog"></i>Settings</a></li>
        <li><a href="#" data-toggle="modal" data-target="#confirmation"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>
      </ul>
    </aside>
