<?php
include_once "base.php";
echo "<pre>";
var_dump($_POST);
echo date("Y-m-d H:i:s");
echo "</pre>";


$Inquiry->save([
  'user_id'=>$_POST['user_id'],
  'contact_name'=>$_POST['name'],
  'title'=>$_POST['title'],
  'company'=>$_POST['company'],
  'phone'=>$_POST['phone'],
  'email'=>$_POST['email'],
  'remark'=>$_POST['remark'],
  'sent_time'=>date("Y-m-d H:i:s")
]);

$inquiry_id=$Inquiry->q("SELECT MAX(`id`) FROM `inquiry`")[0][0];

foreach ($_POST['product'] as $k => $v) {
  $Inquiry_details->save([
    'inquiry_id'=>$inquiry_id,
    'product_id'=>$v,
    'quantity'=>$_POST['quantity'][$k],
    'price'=>$_POST['price'][$k],
    'deliver_date'=>$_POST['deliver_date'][$k]
  ]);
}

?>