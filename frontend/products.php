<?php
if (!isset($_SESSION['user'])) {
  to("index.php");
}
?>
<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 text-center">
      <h4>商品牌價查詢</h4>
    </div>
    <form class="mt-1 col-12">
      <div class="form-row justify-content-center">
        <div class="input-group col-12 col-sm-6 col-md-5 col-lg-3">
          <div class="input-group-prepend">
            <label class="input-group-text">主目錄</label>
          </div>
          <select class="custom-select" id="parent_cate">
            <option value="all">全部商品</option>
          </select>
        </div>
        <div class="input-group col-12 col-sm-6 col-md-5 col-lg-3">
          <div class="input-group-prepend">
            <label class="input-group-text">子目錄</label>
          </div>
          <select class="custom-select" id="child_cate">
            <option value="all" data-parent="all" selected>...</option>
          </select>
        </div>
      </div>
      <?php
      $products = $Products->all(['visible' => 1]);
      $cate_visible = $Category->all(['visible' => 1]);

      // 列出所有需隱藏的子目錄id，包含子目錄設為隱藏，及主目錄設為隱藏但該子目錄設為顯示者
      // 不能直接用全部扣除visible，會漏掉主目錄設為隱藏但該子目錄設為顯示者
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
            $("#parent_cate").append("<option value=<?= $c['id'] ?>><?= $c['name'] ?></option>")
          </script>
        <?php
        } else {
        ?>
          <script>
            $("#child_cate").append("<option data-parent=<?= $c['parent'] ?> value=<?= $c['id'] ?>><?= $c['name'] ?></option>")
            $("#child_cate option").hide()
          </script>
      <?php
        }
      }
      ?>
      <div class="table-responsive mt-3">
        <table id="products_table">
          <thead>
            <tr class="table-info text-center row">
              <th scope="col" class="col-3 col-sm-2">品名</th>
              <th scope="col" class="col-2 d-none d-sm-table-cell">圖片</th>
              <th scope="col" class="col-3">描述</th>
              <th scope="col" class="col-3 col-lg-2">數量 / 價格</th>
              <th scope="col" class="col-3 col-sm-2 col-lg-3">備註</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($products as $p) {
              if (!in_array($p['cate_id'], $c_i_arr)) {
            ?>
                <tr data-cate=<?= $p['cate_id'] ?> class="row">
                  <td class="col-3 col-sm-2"><?= $p['name'] ?></td>
                  <td class="col-2 px-0 d-none d-sm-table-cell"><img src="<?= $p['image'] ?>" width="100%"></td>
                  <td class="col-3 text-left"><?= $p['description'] ?></td>
                  <td class="col-3 col-lg-2 text-left"><?php
                                                        $price_list = $Price->all(['product_id' => $p['id']]);
                                                        foreach ($price_list as $k => $price) {
                                                          if ($k < (count($price_list) - 1)) {
                                                            echo "{$price['quantity']}~{$price_list[$k + 1]['quantity']}:{$price['price']}元<br>";
                                                          } else {
                                                            echo "{$price['quantity']}以上:{$price['price']}";
                                                          }
                                                        }
                                                        ?>
                  </td>
                  <td class="col-3 col-sm-2 col-lg-3 text-left"><?= $p['remark'] ?></td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
  </div>
  </form>
</div>
</div>
<script>
  function select_parent(){
    let show_cate_id;
    let parent_cate_id = $("#parent_cate").val()
    $("#child_cate option").hide()
    if (parent_cate_id == 'all') {
      $("#child_cate").val('all')
      $('tbody tr').each(function(i, e) {
        $(e).show();
      })
    } else {
      $(`#child_cate option[data-parent=${parent_cate_id}]`).show()
      $(`#child_cate option[data-parent=all]`).show()
      $("#child_cate")[0].selectedIndex = 0;
      $('tbody tr').each(function(i, e) {
        $(e).hide();
      })
      $(`#child_cate option[data-parent=${parent_cate_id}]`).each(function(i, e) {
        show_cate_id = $(e).val()
        $(`tbody tr[data-cate=${show_cate_id}]`).show()
      });
    }
  }

  $("#parent_cate").change(function(e) {
    e.preventDefault();
    select_parent();
  });

  function select_child(){
    let child_cate_id=$("#child_cate").val()
    $('tbody tr').each(function(i, e) {
      $(e).hide();
    })
    if (child_cate_id == 'all') {
      select_parent()
    }else{
      $(`tbody tr[data-cate=${child_cate_id}]`).show()
    }
  }

  $("#child_cate").change(function(e) {
    e.preventDefault();
    select_child()
  })
</script>