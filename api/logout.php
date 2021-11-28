<?php
include_once "base.php";
  unset($_SESSION['user']);
  unset($_SESSION['priority']);
to("../index.php");
?>