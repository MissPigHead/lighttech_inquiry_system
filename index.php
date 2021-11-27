<?php
include_once "api/base.php";
if(isset($_GET['page'])){ // 頁簽 title
  
  switch ($_GET['page']) {
    case 'login':
      $page="登入";
      break;
    case 'register':
      $page="註冊";
      break;
    case 'products':
      $page="商品查價";
      break;
    
    default:
      $page="後台";
      break;
  }
}else{
  $page="首頁";
}

include_once "layout/frame_head.php";

$file='';
if(isset($_GET['page'])){
  $file="frontend/".$_GET['page'].".php";
}elseif (isset($_GET['backend'])) {
  $file="backend/".$_GET['backend'].".php";
}

is_file($file)?include_once $file:include_once "frontend/main.php";

include_once "layout/frame_footer.php";
?>