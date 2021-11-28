<?php
include_once "base.php";
echo "<pre>";
var_dump($_POST);
echo date("Y-m-d H:i:s");
echo "</pre>";

foreach ($_POST['price'] as $i_details_id => $cus_price) {
$Inquiry_details->save(['cus_price'=>$cus_price,'update_price_by'=>$_POST['sales_id'],'id'=>$i_details_id]);
}

$Inquiry->save([
  'id'=>$_POST['inquiry_id'],
  'sales_id'=>$_POST['sales_id'],
  'sales_reply'=>$_POST['sales_reply'],
  'sales_remark'=>$_POST['sales_remark'],
]);

to("/index.php?backend=inquiry_details");
?>