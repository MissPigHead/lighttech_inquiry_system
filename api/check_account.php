<?php
include_once "base.php";

$account=$_POST['account'];
$user=$User->find(['account'=>$account]);
if(empty($user)){
    echo 0;
}else{
    echo 1;
}
?>