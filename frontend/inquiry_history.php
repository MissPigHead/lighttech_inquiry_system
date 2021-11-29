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
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container" data-item='p'>
          <div class="row align-items-center border-bottom">
            <div class="col-4 py-1">商品</div>
            <div class="col-2 py-1">數量</div>
            <div class="col-4 py-1">交期</div>
            <div class="col-2 py-1">價格</div>
          </div>
        </div>
        <div class="container mt-3" data-item='c'>
        </div>
        <div class="container mt-3" data-item='i'>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">確認</button>
      </div>
    </div>
  </div>
</div>
<script>
  function show_inquiry(id) {
    $("[data-item='c']>div.row").remove()
    $("[data-item='i']>div.row").remove()
    $("[data-item='p']>div.row.border-bottom").remove()
    $("#ModalLabel").text('')
    console.log('id',id)
    
    $.ajax({
      type: "post",
      url: "api/get_inquiry_cus.php",
      data: {
        'inquiry_id': id,
      },
      dataType: "json",
      success: function(res) {
        console.log('res',res)

        let inquiry = res.inquiry;
        let inquiry_details = res.inquiry_details;
        let price;

        $("#ModalLabel").text(`單號${inquiry.id}`)

        $("[data-item='c']").append(`
        <div class="row">
            <div class="col-12">客戶開單時間: ${inquiry.sent_time}</div>
            <div class="col-12">客戶詢價內容: ${inquiry.remark}</div>
            <div class="col-12 col-sm-5">聯絡人: ${inquiry.contact_name}_${inquiry.title}</div>
            <div class="col-12 col-sm-7">公司: ${inquiry.company}</div>
            <div class="col-12 col-sm-5">電話: ${inquiry.phone}</div>
            <div class="col-12 col-sm-7">email: ${inquiry.email}</div>
          </div>
          `)

        $("[data-item='i']").append(`
        <div class="row">
            <div class="col-12 col-sm-5">處理業務: ${inquiry.sales_account}</div>
            <div class="col-12 col-sm-7">業務回覆時間: ${inquiry.update_time}</div>
            <div class="col-12">業務回覆內容: ${inquiry.sales_reply}</div>
          </div>
          `)

        inquiry_details.forEach(e => {
          console.log(e)
          if (e.price != e.cus_price) {
            price = `<del>${e.price}</del><br><b class='text-danger'>${e.cus_price}</b>`;
          } else {
            price = e.price
          }
          $("[data-item='p']").append(`
          <div class="row bg-yellow01 align-items-center border-bottom">
          <div class="col-4 py-1">${e.product_name}</div>
          <div class="col-2 py-1">${e.quantity}</div>
          <div class="col-4 py-1">${e.deliver_date}</div>
          <div class="col-2 py-1">${price}</div>
          </div>
          `)
        });
      
        $('#Modal').modal('show')
      
      }
    });
  }
</script>