<?php
include_once "base.php";
echo "<pre>";
var_dump($_POST);
echo date("Y-m-d H:i:s");
echo "</pre>";

$check=1;

foreach ($_POST['product'] as $k => $v){
  if(mb_strlen($_POST['price'][$k])==0){
    $_SESSION['err']['price']="請在輸入數量後，選擇交期或輸入詢價內容，亦可點螢幕其他位置，確認商品價格正常顯示之後，才可按下送出，不然抓不到價格。前一次儲存失敗，煩請重新送單。";
    $check=0;
  }
}


if($check){
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
  
  to("/index.php");
}else{
  to("/index.php?page=inquiry");

}
?>