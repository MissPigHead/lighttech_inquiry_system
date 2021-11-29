<?php
include_once "base.php";

$inquiry=$Inquiry->find($_POST['inquiry_id']);
$sales_account=$User->find($inquiry['sales_id'])['account'];
$inquiry['sales_account']=$sales_account;
$inquiry_d=$Inquiry_details->all(['inquiry_id'=>$_POST['inquiry_id']]);
foreach ($inquiry_d as $k=>$d) {
  $product_name=$Products->find($d['product_id'])['name'];
  $in_d[$k]['product_name']=$product_name;
}

$data=["inquiry"=>$inquiry,"inquiry_details"=>$inquiry_d];
echo json_encode($data);
?>