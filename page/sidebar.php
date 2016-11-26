<?php
$page = $_GET['p'];
$halamannya = new Page($page);
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
