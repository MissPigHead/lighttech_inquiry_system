<?php
include_once "base.php"; 

$user_data=['account'=>$_POST['account'],'password'=>$_POST['password']];
$User->save($user_data);

unset($_POST['account']);
unset($_POST['password']);
$_POST['user_id']=$User->q("SELECT MAX(`id`) FROM `user`")[0][0];
$Customer->save($_POST);
?>
