<?php
include_once "base.php";

$account=$_POST['account'];
$password=$_POST['password'];
$user=$User->find(['account'=>$account,'password'=>$password]);

if(empty($user)){
    echo 0;
}else{
  $_SESSION['priority']=$user['priority'];
  $_SESSION['user']=$account;
  echo 1;
}
