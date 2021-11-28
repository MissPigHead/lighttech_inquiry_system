<?php
include_once "base.php";

$product_id=$_POST['product_id'];
$price_list=$Price->all(['product_id'=>$product_id]);

echo json_encode($price_list);
?>