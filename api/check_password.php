<?php
include_once "base.php";

$account=$_POST['account'];
$password=$_POST['password'];
$user=$User->find(['account'=>$account,'password'=>$password]);

if(empty($user)){
    echo 0;
}else{
  if ($user['priority']==1) {
    $_SESSION['sales']=$account;
    echo 1;
  }else{
    $_SESSION['customer']=$account;
    echo 2;
  }
}
