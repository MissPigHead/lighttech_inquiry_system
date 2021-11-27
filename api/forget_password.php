<?php 
include_once "base.php"; 

$account=$_POST['account'];
$email=$_POST['email'];
$user=$User->find(['account'=>$account]);
$customer=$Customer->find(['email'=>$email,'user_id'=>$user['id']]);
if(!empty($customer)){
    echo $user['password'];
}

?>