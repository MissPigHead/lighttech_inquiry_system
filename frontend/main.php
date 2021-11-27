<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 my-3 text-center">
      <h4>歡迎使用 MissPigHead 詢價系統</h4>
    </div>
    <div class="w-100"></div>
    <?php
    if (!isset($_SESSION['sales']) && !isset($_SESSION['customer'])) {
    ?>
      <div class="col-12 col-sm-8 col-md-6 col-lg-5">
        本系統提供會員客戶進行商品價格查詢，亦可進行客制化報價。若您尚未擁有系統帳號，請先進行註冊，以便為您提供完整服務。
      </div>
      <div class="col-12 text-center my-3">
        <button class="btn btn-outline-warning bg-yellow01 text-dark mx-1">
          <a href="?page=login">
            會員登入
          </a>
        </button>
        <button class="btn btn-outline-warning bg-yellow01 text-dark mx-1">
          <a href="?page=register">
            帳號註冊
          </a>
        </button>
      </div>
      <?php
    } else {
      if (isset($_SESSION['sales'])) {
      ?>
        <div class="bg-danger">
          <a href="?backend=inquiry">
            客戶詢價表
          </a>
        </div>
        <div class="w-100"></div>
      <?php
      }
      ?>
      <div class="bg-warning">
        <a href="?page=products">
          商品價格表
        </a>
      </div>
    <?php
    }
    ?>
  </div>
</div>