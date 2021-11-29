<?php
if (!isset($_SESSION['user'])) {
  to("index.php");
}

$user_id = $User->find(['account' => $_SESSION['user']])['id'];
$i_list = $Inquiry->all(['user_id' => $user_id]);
?>
<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 text-center">
      <h4>線上詢價歷史紀錄</h4>
    </div>
    <div class="col-12 col-sm-10 col-md-8 col-lg-7 mt-3">
      <!-- 多筆數的撈取條件 & 版面  待處理 -->
      <?php
      foreach ($i_list as $i) {
        $ans = empty($i['sales_id']) ? "尚未回應" : $User->find($i['sales_id'])['account'] . "回";
        $icon = empty($i['sales_id']) ? "" : "-check";
        $count = $Inquiry_details->count(['inquiry_id' => $i['id']]);
      ?>
        <div class="row my-1 <?= empty($i['sales_id']) ? "hover-pointer" : "hover-pink00" ?>" onclick="show_inquiry(<?= $i['id'] ?>)" data-toggle="modal" data-target="#exampleModal">
          <div class="col-3 col-sm-2 pl-1 pl-sm-3 pr-0"><i class="far fa<?= $icon ?>-square"></i>&nbsp;單號:<?= $i['id'] ?></div>
          <div class="col-6 col-sm-4 pl-1 pl-sm-3 pr-0">送單日:<?= substr($i['sent_time'], 0, 10) ?></div>
          <div class="col-sm-3 d-none d-sm-block pr-0">商品項目數:<?= $count ?></div>
          <div class="col-3 col-sm-3 pl-1 pl-sm-3 pr-1 font-weight-bold text-danger"><?= $ans ?></div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<script>
  function show_inquiry(id) {
    location.href=`/?page=inquiry_history_details&i_id=${id}`;
  }
</script>