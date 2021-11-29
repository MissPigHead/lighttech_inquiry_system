<?php
if (!isset($_SESSION['user'])) {
  to("index.php");
}
$i_d_list = $Inquiry_details->all(['inquiry_id' => $_GET['i_id']]);
$inquiry = $Inquiry->find($_GET['i_id']);
?>
<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 text-center">
      <h4>詢價紀錄 - 單號<?= $_GET['i_id'] ?></h4>
    </div>
    <div class="container" data-item='p'>
      <div class="row align-items-center border-bottom">
        <div class="col-4 py-1">商品</div>
        <div class="col-2 py-1">數量</div>
        <div class="col-4 py-1">交期</div>
        <div class="col-2 py-1">價格</div>
      </div>
      <?php
      foreach ($i_d_list as $key => $i_detail) {
        $product_name = $Products->find($i_detail['product_id'])['name'];

        if ($i_detail['price'] != $i_detail['cus_price'] && $i_detail['cus_price'] != '') {
          $price = "<del>{$i_detail['price']}</del><br><b class='text-danger'>{$i_detail['cus_price']}</b>";
        } else {
          $price = $i_detail['price'];
        }
      ?>
        <div class="row bg-yellow01 align-items-center border-bottom">
          <div class="col-4 py-1"><?= $product_name ?></div>
          <div class="col-2 py-1"><?= $i_detail['quantity'] ?></div>
          <div class="col-4 py-1"><?= $i_detail['deliver_date'] ?></div>
          <div class="col-2 py-1"><?= $price ?></div>
        </div>
      <?php
      }
      ?>
    </div>
    <div class="container mt-3" data-item='c'>
      <div class="row">
        <div class="col-12">客戶開單時間: <?= $inquiry['sent_time'] ?></div>
        <div class="col-12">客戶詢價內容: <?= $inquiry['remark'] ?></div>
        <div class="col-12 col-sm-5">聯絡人: <?= $inquiry['contact_name'] . " " . $inquiry['title'] ?></div>
        <div class="col-12 col-sm-7">公司: <?= $inquiry['company'] ?></div>
        <div class="col-12 col-sm-5">電話: <?= $inquiry['phone'] ?></div>
        <div class="col-12 col-sm-7">email: <?= $inquiry['email'] ?></div>
      </div>
    </div>
    <div class="container mt-3" data-item='i'>
      <div class="row">
        <div class="col-12 col-sm-5">處理業務:
          <?=
          !empty($User->find($inquiry['sales_id'])['account']) ? $User->find($inquiry['sales_id'])['account'] : "";
          ?></div>
        <div class="col-12 col-sm-7">業務回覆時間:
          <?=
          !empty($User->find($inquiry['sales_id'])['account']) ? $inquiry['update_time'] : "";
          ?></div>
        <div class="col-12">業務回覆內容:
          <?= $inquiry['sales_reply'] ?></div>
      </div>
    </div>
    <a href="/?page=inquiry_history"><button class="btn btn-info mt-4">回上一頁</button></a>
  </div>
</div>