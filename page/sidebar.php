<?php
$database = new Koneksi();
$koneksi = $database->dapetKoneksi();

$login = new Login($koneksi);

$halamannya = new Page($_GET['p'],$login->sessionCheck(),$koneksi);
$activePage = $halamannya->setActive();
?>
    <aside class="">
      <ul>
        <li<?php echo $activePage['dashboard'] ;?>><a href="?p=dashboard">Dashboard</a></li>
        <li<?php echo $activePage['income'] ;?>><a href="?p=income">Income</a></li>
        <li<?php echo $activePage['outcome'] ;?>><a href="?p=outcome">Outcome</a></li>
        <li<?php echo $activePage['wishlist'] ;?>><a href="?p=wishlist">Wishlist</a></li>
      </ul>
    </aside>
