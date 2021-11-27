<?php
if (!isset($_SESSION['sales']) && !isset($_SESSION['customer'])) {
  to("index.php");
}
?>
<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 text-center">
      <h4>商品價格查詢</h4>
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
            <option value="" selected>...</option>
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
            // console.log('p', <?= $c['id'] ?>, "<?= $c['name'] ?>")
            $("#parent_cate").append("<option value=<?= $c['id'] ?>><?= $c['name'] ?></option>")
          </script>
        <?php
        } else {
        ?>
          <script>
            // console.log('c', <?= $c['id'] ?>, "<?= $c['name'] ?>")
            $("#child_cate").append("<option data-parent=<?= $c['parent'] ?> value=<?= $c['id'] ?>><?= $c['name'] ?></option>")
            $("#child_cate option").hide()
          </script>
      <?php
        }
      }
      ?>
      <script>
        let cate_id;
        $("#parent_cate").change(function(e) {
          e.preventDefault();
          cate_id = $("#parent_cate").val()
          console.log(cate_id)
          $("#child_cate option").hide()
          $(`#child_cate option[data-parent=${$("#parent_cate").val()}]`).show()
        });
      </script>

      <div class="table-responsive mt-3">
        <table class="table table-sm" id="products_table">
          <thead>
            <tr class="table-info">
              <th scope="col">品名</th>
              <th scope="col" class="d-none d-md-table-cell">圖片</th>
              <th scope="col">描述</th>
              <th scope="col">數量 / 價格</th>
              <th scope="col" class="d-none d-sm-table-cell">備註</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($products as $p) {
              // if($p)
              if (!in_array($p['cate_id'], $c_i_arr)) {
            ?>
                <tr data-cate=<?= $p['cate_id'] ?>>
                  <td><?= $p['name'] ?></td>
                  <td class="d-none d-md-table-cell"><img src="<?= $p['image'] ?>" width="100%"></td>
                  <td class="text-left"><?= $p['description'] ?></td>
                  <td>

                  <select name="" id="">
                    <option value=""></option>


                  <?php
                  $price_list=$Price->all(['product_id'=>$p['id']]);
                  foreach ($price_list as $k=>$price) {
                    if($k<(count($price_list)-1)){
                      ?>
                    <option value="<?=$price['id']?>"><?=$price['quantity']?>~<?=$price_list[$k+1]['quantity']?>單位：<?=$price['price']?>元</option>

<?php
                    }else{

                    
                    ?>

<option value="<?=$price['id']?>"><?=$price['quantity']?>單位以上數量：<?=$price['price']?></option>
                    
                    <?php
                    // echo $k."/".$price['id']."/".$price['quantity']."/".$price['price']."<br>";
                    # code...
                  }
                }
                  ?>
                  </select>
                  </td>
                  <td class="text-left d-none d-sm-table-cell"><?= $p['remark'] ?></td>
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