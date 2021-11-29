<?php
if (!isset($_SESSION['user']) || $_SESSION['priority'] > 1) {
  to("index.php");
}

$i_list = $Inquiry->all();
?>
<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 text-center">
      <h4>客戶詢價紀錄</h4>
    </div>

    <div class="col-12 col-md-10 col-lg-8 col-xl-7 mt-3">

    <!-- 多筆數的撈取條件 & 版面  待處理 -->

      <?php
      foreach ($i_list as $i) {
        $ans = empty($i['sales_id']) ? "尚未回應!!" : "";
        $icon = empty($i['sales_id']) ? "" : "-check";

        $count = $Inquiry_details->count(['inquiry_id' => $i['id']]);
      ?>
        <a href="?backend=inquiry_details&i_id=<?=$i['id']?>">
          <div class="row my-1<?=empty($i['sales_id']) ? " hover-pink00" : ""?>">
            <div class="col-3 pl-1 pl-sm-3 col-sm-2 pr-0"><i class="far fa<?= $icon ?>-square"></i>&nbsp;單號:<?= $i['id'] ?></div>
            <div class="col-6 pl-1 pl-sm-3 col-sm-3 pr-0">收單日:<?= substr($i['sent_time'], 0, 10) ?></div>
            <div class="col-sm-2 d-none d-sm-block pr-0">客戶ID:<?= $i['user_id'] ?></div>
            <div class="col-sm-3 d-none d-sm-block pr-0">商品項目數:<?= $count ?></div>
            <div class="col-3 col-sm-2 pl-1 pl-sm-3 pr-1 font-weight-bold text-danger"><?= $ans ?></div>
          </div>
        </a>
      <?php
      }
      ?>

    </div>
  </div>
</div>