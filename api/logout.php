<?php
include_once "base.php";
if(isset($_SESSION['sales'])){
  unset($_SESSION['sales']);
}else{
  unset($_SESSION['customer']);
}

to("../index.php");
?>