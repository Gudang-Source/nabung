<?php
  class Page{
    private $page;
    private $activePage = array('dashboard' => '', 'income' => '', 'outcome' => '', 'wishlist' => '');

    //Untuk memberikan nilai awal, agar lebih mudah saat Initiasinya
    public function __construct($getPage,$sessionStatus,$connectError){
        $this->page = $getPage;
    }

    public function setTitle(){
      if ($this->page == "dashboard") {
        $title = "Dashboard";
      }elseif ($this->page == "income") {
        $title = "Income";
      }elseif ($this->page == "outcome") {
        $title = "Outcome";
      }elseif ($this->page == "wishlist") {
        $title = "Wishlist";
      }elseif ($this->page == "error") {
        $title = "Terjadi Kesalahan! ";
      }elseif ($this->page == "login") {
        $title = "Login ke Nabung";
      }elseif ($this->page == "nosession") {
        $title = "No Session Detected";
      }elseif ($this->page == "sessiondetect") {
        $title = "Session Detected";
      }else{
        $title = "404 Not Found";
      }
      return $title;
    }

    public function setPage(){
      if ($this->page == "dashboard") {
        include_once 'page/dashboard.php';
      }elseif($this->page == "income"){
        include_once 'page/income.php';
      }elseif($this->page == "outcome") {
        include_once 'page/outcome.php';
      }elseif($this->page == "wishlist"){
        include_once 'page/wishlist.php';
      }elseif ($this->page == "error") {
        include_once 'page/error.php';
      }elseif ($this->page == "login") {
        include_once 'page/login.php';
      }elseif ($this->page == "nosession") {
        include_once 'page/errorLogin.php';
      }elseif ($this->page == "sessiondetect") {
        include_once 'page/sessionDetected.php';
      }else{
        include_once 'page/404.php';
      }
    }

    public function setSidebar(){
      if ($this->page == "dashboard" || $this->page == "income" || $this->page == "outcome" || $this->page == "wishlist") {
        include_once 'page/sidebar.php';
      }
    }

    public function setActive(){
      if ($this->page == "dashboard") {
        $this->activePage['dashboard'] = " class='active'";
      }elseif ($this->page == "income") {
        $this->activePage['income'] = " class='active'";
      }elseif ($this->page == "outcome") {
        $this->activePage['outcome'] = " class='active'";
      }elseif ($this->page == "wishlist") {
        $this->activePage['wishlist'] = " class='active'";
      }
      return $this->activePage;
    }
  }
?>
