<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 my-3 text-center">
      <h4>歡迎使用 MissPigHead 詢價系統</h4>
    </div>
    <div class="w-100"></div>
    <?php
    if (!isset($_SESSION['user'])) {
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
    ?>
    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
      Hi,&nbsp;<?= $_SESSION['user'] ?>! 歡迎進入以下內容：
    </div>
    <div class="w-100"></div>
    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
      <ul>
        <?php
        if ($_SESSION['priority'] != 2) {
        ?>
          <li>
            <a href="?backend=inquiry" class="hover-pink">
              客戶詢價表
            </a>
          </li>
        <?php
        } else {
        ?>
          <li>
            <a href="?page=products" class="hover-pink">
              商品價格表
            </a>
          </li>
          <li>
            <a href="?page=inquiry" class="hover-pink">
              開立線上詢價單
            </a>
          </li>
          <li>
            <a href="#" class="hover-pink">
              歷史詢價記錄（未建立）
            </a>
          </li>
        <?php
        }
        ?>
      </ul>
    <?php
      }
    ?>
    </div>
  </div>
</div>