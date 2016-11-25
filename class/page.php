<?php
  class Page{
    private $page;

    //Untuk memberikan nilai awal, agar lebih mudah Initiasinya
    public function __construct($getPage){
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
        $title = "Terdapat Kesalahan!";
      }else{
        $title = "Halamannya gak ada";
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
      }else{
        include_once 'page/404.php';
      }
    }
  }
?>
