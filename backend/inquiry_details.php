<?php
if (!isset($_SESSION['user']) || $_SESSION['priority'] > 1) {
  to("index.php");
}
$sales = $User->find(['account' => $_SESSION['user']]);
$inquiry = $Inquiry->find($_GET['i_id']);
$inquiry_details = $Inquiry_details->all(['inquiry_id' => $_GET['i_id']]);
?>
<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 text-center">
      <h4>線上詢價表單</h4>
    </div>
    <form class="col-12" name="inquiry_sales" method="post" action="api/update_inquiry_sales.php">
    <input type="hidden" name="inquiry_id" value="<?= $_GET['i_id'] ?>">
      <h5 class="text-secondary mt-3">商品項目</h5>
      <?php
      foreach ($inquiry_details as $item) {
        $product = $Products->find($item['product_id']);
        $cate_child = $Category->find($product['cate_id']);
        $cate_parent = $Category->find($cate_child['parent']);
      ?>
        <div class="form-row justify-content-center mt-2">
          <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
            <div class="input-group-prepend">
              <label class="input-group-text">主目錄</label>
            </div>
            <input type="text" class="form-control" disabled value="<?= $cate_parent['name'] ?>">
          </div>
          <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
            <div class="input-group-prepend">
              <label class="input-group-text">子目錄</label>
            </div>
            <input type="text" class="form-control" disabled value="<?= $cate_parent['name'] ?>">
          </div>
          <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
            <div class="input-group-prepend">
              <label class="input-group-text">品名</label>
            </div>
            <input type="text" class="form-control" disabled value="<?= $product['name'] ?>">
          </div>
          <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
            <div class="input-group-prepend">
              <label class="input-group-text">數量</label>
            </div>
            <input type="text" class="form-control" disabled value="<?= $item['quantity'] ?>">
          </div>
          <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
            <div class="input-group-prepend">
              <label class="input-group-text">報價</label>
            </div>
            <input type="text" data-price="p" name="price[<?= $item['id'] ?>]" class="form-control" disabled value="<?= $item['price'] ?>">
          </div>
          <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
            <div class="input-group-prepend">
              <span class="input-group-text">交期</span>
            </div>
            <input type="date" class="form-control" disabled value="<?= $item['deliver_date'] ?>">
          </div>
        </div>
      <?php
      }
      ?>
      <div class="form-row justify-content-center mt-2">
        <div class="input-group col-12 mt-1">
          <div class="input-group-prepend">
            <span class="input-group-text">詢價內容</span>
          </div>
          <textarea class="form-control" disabled><?= $inquiry['remark'] ?></textarea>
        </div>
      </div>
      <h5 class="text-secondary mt-3">聯絡人資訊</h5>
      <div class="form-row justify-content-center mt-2">
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">姓名</label>
          </div>
          <input type="text" class="form-control" value="<?= $inquiry['contact_name'] ?>" disabled>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">稱謂</label>
          </div>
          <input type="text" class="form-control" value="<?= $inquiry['title'] ?>" disabled>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">公司名</label>
          </div>
          <input type="text" class="form-control" value="<?= $inquiry['company'] ?>" disabled>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">電話</label>
          </div>
          <input type="text" class="form-control" value="<?= $inquiry['phone'] ?>" disabled>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">Email</label>
          </div>
          <input type="text" class="form-control" value="<?= $inquiry['email'] ?>" disabled>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">收單時間</label>
          </div>
          <input type="text" class="form-control" value="<?= $inquiry['sent_time'] ?>" disabled>
        </div>
      </div>
      <h5 class="text-pink00 mt-3">業務回覆</h5>
      <input type="hidden" name="sales_id" value="<?= $sales['id'] ?>">
      <div class="form-row justify-content-center mt-2">
        <div class="input-group col-12 mt-1">
          <div class="input-group-prepend">
            <span class="input-group-text text-pink00">回覆客戶</span>
          </div>
          <textarea class="form-control" name="sales_reply" maxlength="200" placeholder="回覆客戶內容，客戶可讀取。"><?= $inquiry['sales_reply'] ?></textarea>
        </div>
      </div>
      <div class="form-row justify-content-center mt-2">
        <div class="input-group col-12 mt-1">
          <div class="input-group-prepend">
            <span class="input-group-text text-pink00">內部註記</span>
          </div>
          <textarea class="form-control" name="sales_remark" maxlength="200" placeholder="僅供內部人員讀取。"><?= $inquiry['sales_remark'] ?></textarea>
        </div>
      </div>
      <div class="d-flex justify-content-end mt-3">
        <button class="btn btn-info mr-2" type="button" data-fun="update" onclick="update_price()">修改報價</button>
        <button class="btn btn-info mr-2" type="button" data-fun="set" onclick="set_price()">確定報價</button>
        <button class="btn btn-secondary mr-2" type="reset">清除</button>
        <button class="btn btn-warning ml-2" type="button" onclick="form_check()">送出</button>
      </div>
    </form>
  </div>
</div>
<script>
  $("[data-fun=set]").hide();

  function update_price() {
    $("[data-price=p]").attr('disabled', false);
    $("[data-fun=update]").hide();
    $("[data-fun=set]").show();
  }

  function check_price_number() {
    let check = 1;
    $("[data-price=p]").each(function(i, e) {
      if (isNaN($(e).val()) || parseInt($(e).val() == 0)) {
        check = 0;
      } else {
        $(e).val(parseInt($(e).val()))
      }
    });
    if (!check) {
      Swal.fire({
        icon: 'error',
        html: '請檢查商品價格，<br>價格需為正整數，不能為0。',
      })
    }
    return check
  }

  function set_price() {
    if (check_price_number()) {
      $("[data-price=p]").attr('disabled', true);
      $("[data-fun=update]").show();
      $("[data-fun=set]").hide();
    }
  }

  function form_check() {
    let check = 1;
    let err=[];
    let err_msg='';

    if (!check_price_number()) {
      err.push("請檢查商品價格，<br>價格需為正整數，不能為0。");
      check = 0;
    }

    if ($('textarea[name=sales_reply]').val() == null || $('textarea[name=sales_reply]').val() == undefined || $('textarea[name=sales_reply]').val() == '') {
      console.log(typeof $('textarea[name=sales_reply]').val(),$('input[name=sales_reply]').val())
      err.push("請輸入回覆訊息。");
      check = 0;
    }

    if (check) {
      $("input[data-price=p]").attr('disabled', false)
      inquiry_sales.submit();
    } else {
      console.log(check, err)
      err.forEach(element => {
        err_msg += `<li class='text-left'>${element }</li>`
      });
      Swal.fire({
        icon: 'error',
        title: '請檢查輸入內容',
        html: `<ul>${err_msg}</ul>`,
      })
    }
  }
</script>