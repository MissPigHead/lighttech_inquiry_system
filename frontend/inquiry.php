<?php
if (!isset($_SESSION['user'])) {
  to("index.php");
}
?>
<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 text-center">
      <h4>線上詢價表單</h4>
    </div>
    <form class="col-12" name="inquiry" method="post" action="api/add_inquiry.php">
      <h5 class="text-secondary mt-3">商品項目</h5>
      <!-- -------- -->
      <div class="form-row justify-content-center mt-2" data-item=1>

        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">主目錄</label>
          </div>
          <select class="custom-select" data-cate="parent_cate" onchange="select_parent(this.parentElement.parentElement.dataset.item)">
            <option disabled selected>請選擇主目錄</option>
          </select>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">子目錄</label>
          </div>
          <select class="custom-select" data-cate="child_cate" onchange="select_child(this.parentElement.parentElement.dataset.item)">
            <option disabled selected>請選擇子目錄</option>
          </select>
        </div>
        <?php
        $user = $User->find(['account' => $_SESSION['user']]);
        $customer = $Customer->find(['user_id' => $user['id']]);
        $products = $Products->all(['visible' => 1]);
        $cate_visible = $Category->all(['visible' => 1]);
        $cate_invisible = $Category->all(['visible' => 0]);
        $c_i_arr = [];

        foreach ($cate_invisible as $c_i) {
          if ($c_i['parent'] == 0) {
            $c_invi_children = $Category->all(['parent' => $c_i['id']]);
            foreach ($c_invi_children as $c_i_c) {
              array_push($c_i_arr, $c_i_c['id']);
            }
          } else {
            array_push($c_i_arr, $c_i['id']);
          }
        }

        foreach ($cate_visible as $c) {
          if ($c['parent'] == 0) {
        ?>
            <script>
              $("[data-cate=parent_cate]").last().append("<option value=<?= $c['id'] ?>><?= $c['name'] ?></option>")
            </script>
          <?php
          } else {
          ?>
            <script>
              $("[data-cate=child_cate]").last().append("<option data-parent=<?= $c['parent'] ?> value=<?= $c['id'] ?>><?= $c['name'] ?></option>")
            </script>
        <?php
          }
        }
        ?>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">品名</label>
          </div>
          <select class="custom-select h-100" name="product[]" data-product="product_list" onchange="select_product(this.parentElement.parentElement.dataset.item)" required>
            <option disabled selected>請選擇商品</option>
            <?php
            foreach ($products as $p) {
              if (!in_array($p['cate_id'], $c_i_arr)) {
            ?>
                <option value="<?= $p['id'] ?>" data-cate="<?= $p['cate_id'] ?>"><?= $p['name'] ?></option>
            <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">數量</label>
          </div>
          <input type="number" name="quantity[]" class="form-control" disabled required onchange="show_price(this.parentElement.parentElement.dataset.item)">
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">牌價</label>
          </div>
          <input type="text" name="price[]" class="form-control" disabled>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <span class="input-group-text">交期</span>
          </div>
          <input type="date" name="deliver_date[]" class="form-control" min="<?= date('Y-m-d', strtotime('+1 week')) ?>" max=<?= date('Y-m-d', strtotime('+6 month')) ?> value="<?= date('Y-m-d', strtotime('+1 month')) ?>">
        </div>
      </div>
      <div class="form-row justify-content-center mt-2">
        <div class="input-group col-12 mt-1">
          <div class="input-group-prepend">
            <span class="input-group-text">詢價內容</span>
          </div>
          <textarea class="form-control" name="remark" maxlength="200" placeholder="若需特殊報價，請敘述報價內容，謝謝。"></textarea>
        </div>
      </div>
      <h5 class="text-secondary mt-3">聯絡人資訊</h5>
      <div class="form-row justify-content-center mt-2">
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">姓名</label>
          </div>
          <input type="text" name="name" class="form-control" required value="<?= $customer['name'] ?>">
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">稱謂</label>
          </div>
          <input type="text" name="title" class="form-control" value="<?= $customer['title'] ?>">
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">公司名</label>
          </div>
          <input type="text" name="company" class="form-control" value="<?= $customer['company'] ?>" required>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">電話</label>
          </div>
          <input type="text" name="phone" class="form-control" required value="<?= $customer['phone'] ?>">
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">Email</label>
          </div>
          <input type="text" name="email" class="form-control" required value="<?= $customer['email'] ?>">
        </div>
        <div class="input-group col-12 col-sm-6 col-md-4 mt-1">
          <div class="input-group-prepend">
            <label class="input-group-text">送單日</label>
          </div>
          <input type="date" name="update_item" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
        </div>
      </div>
      <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
      <div class="d-flex justify-content-end mt-3">
        <!-- 缺少移除商品 -->
        <button class="btn btn-info mr-2" type="button" onclick="add_inquiry_item()">新增商品</button>
        <button class="btn btn-secondary mr-2" type="reset">清除</button>
        <button class="btn btn-warning ml-2" type="button" onclick="check()">送出</button>
      </div>
    </form>
  </div>
</div>
<script>
  let data_item = 1
  initial(data_item);

  function initial(item) {
    init_child(item);
    init_prod(item);
    init_qty(item);
    init_price(item);
  }

  function init_child(item) {
    $(`[data-item=${item}] [data-cate=child_cate] option`).hide()
  }

  function init_prod(item) {
    $(`[data-item=${item}] [data-product=product_list] option`).hide()
  }

  function init_qty(item) {
    $(`[data-item=${item}] input[name='quantity[]']`).val('')
    $(`[data-item=${item}] input[name='quantity[]']`).attr('disabled', true)
  }

  function init_price(item) {
    $(`[data-item=${item}] input[name='price[]']`).val('')
    $(`[data-item=${item}] input[name='price[]']`).attr('disabled', true)
  }

  // 增加商品項目
  function add_inquiry_item() {
    let a = $('[data-item=1]').clone()
    if (data_item == 5) {
      Swal.fire({
        icon: 'warning',
        html: '每單限制5項商品，以利為您加速處理訂單與結案。<br>若有更多需求，歡迎填寫新的詢價單，謝謝。',
      })
    } else {
      if (isNaN(parseInt($(`[data-item=${data_item}] input[name='quantity[]']`).val())) || parseInt($(`[data-item=${data_item}] input[name='quantity[]']`).val()) == 0 || $(`[data-item=${data_item}] input[name='price[]']`).val()=='') {
        Swal.fire({
          icon: 'warning',
          html: '請確認目前商品名稱正確、數量填寫完畢，<br>再進行下一項商品詢價，謝謝。',
        })
      } else {
        $(`[data-item=${data_item}]`).after(a)
        data_item++;
        $(a).last().attr('data-item', data_item)
        initial(data_item);
      }
    }
  }

  // 選完主目錄才能選子目錄
  function select_parent(item) {
    initial(item)
    let parent_cate_id = $(`[data-item=${item}] [data-cate=parent_cate]`).val()
    $(`[data-item=${item}] [data-cate=child_cate] option[data-parent=${parent_cate_id}]`).show()
    $(`[data-item=${item}] [data-cate=child_cate]`)[0].selectedIndex = 0;
    $(`[data-item=${item}] [data-product=product_list]`)[0].selectedIndex = 0;
  }

  // 選完子目錄才能選商品
  function select_child(item) {
    init_prod(item)
    init_qty(item)
    init_price(item)
    let child_cate_id = $(`[data-item=${item}] [data-cate=child_cate]`).val()
    $(`[data-item=${item}] [data-product=product_list] option[data-cate=${child_cate_id}]`).show()
    $(`[data-item=${item}] [data-product=product_list]`)[0].selectedIndex = 0;
  }

  // 選完商品才能寫數量
  function select_product(item) {
    init_qty(item)
    init_price(item)
    let val = $(`[data-item=${item}] [data-product=product_list]`).val() // 商品id
    $(`[data-item=${item}] input[name='quantity[]']`).attr('disabled', false)
  }

  // 寫完數量顯示牌價
  function show_price(item) {
    // console.log('show_price', item)
    let product_id = $(`[data-item=${item}] [data-product=product_list]`).val()
    let quantity = parseInt($(`[data-item=${item}] input[name='quantity[]']`).val())
    let price
    // console.log(item, product_id, quantity)
    $.ajax({
      type: "post",
      url: "api/get_price.php",
      data: {
        'product_id': product_id
      },
      dataType: "json",
      success: function(res) {
        console.log(res[0]['quantity'])
        if (res[0]['quantity'] > quantity) {
          // console.log()
          Swal.fire({
            icon: 'warning',
            title: `MOQ為${res[0]['quantity']}`,
          }).then(function(){
            $(`[data-item=${item}] input[name='quantity[]']`).val('')
            init_price(item);
          })
        } else {
          for (const i of res) {
            if (parseInt(quantity) >= parseInt(i['quantity'])) {
              price = i['price']
            }
          }
        }
        $(`[data-item=${item}] input[name='price[]']`).val(price)
      }
    });
  }

  function check() {
    let check = 1;
    let quantity_check = 1;
    let deliver_check = 1;
    let err = [];
    let err_msg = '';

    $("input[name='quantity[]']").each(function(i, e) {
      if (isNaN(parseInt($(e).val())) || parseInt($(e).val()) == 0) {
        quantity_check = 0;
      } else {
        console.log($(e).val())
      }
    });

    if (!quantity_check) {
      err.push("請檢查數量填寫正確，不得空白或為0");
      check=0;
    }
    
    $("input[name='deliver_date[]']").each(function(i, e) {
      if (isNaN(parseInt($(e).val())) || parseInt($(e).val()) == 0) {
        deliver_check = 0;
      } else {
        console.log($(e).val())
      }
    });
    
    if (!deliver_check) {
      err.push("請確認商品交期");
      check=0;
    }
    
    if ($('input[name=name]').val() == null || $('input[name=name]').val() == undefined || $('input[name=name]').val() == '') {
      err.push("請填寫聯絡人名稱");
      check = 0;
    }

    if ($('input[name=phone]').val() == null || $('input[name=phone]').val() == undefined || $('input[name=phone]').val() == '') {
      err.push("請填寫電話號碼");
      check = 0;
    }

    if ($('input[name=email]').val() == null || $('input[name=email]').val() == undefined || $('input[name=email]').val() == '') {
      err.push("請填寫Email");
      check = 0;
    }

    if (check) {
      $("input[disabled]").attr('disabled', false)
      inquiry.submit();
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