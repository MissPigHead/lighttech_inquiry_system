<?php
if (isset($_SESSION['sales']) || isset($_SESSION['customer'])) {
  to("index.php");
}
?>

<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 ml-5 pl-5 text-center">
      <h4>系統登入</h4>
    </div>
    <form class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 mt-1">
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">帳號</div>
        <input class="col-8 col-md-9 form-control w-100" type="text" name="account" minlength="3" maxlength="8" placeholder="3~8位小寫英文字母" required>
      </div>
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">密碼</div>
        <input class="col-8 col-md-9 form-control w-100" type="password" name="password" minlength="8" maxlength="12" placeholder="8~12位英文大小寫及數字" required>
      </div>
      <div class="d-flex align-items-center justify-content-end mt-4">
        <div class="col text-gray">
          <a href="?page=forget">
            <i class="fas fa-question px-2"></i>忘記密碼，請由此找回
          </a>
        </div>
        <button class="btn btn-secondary mr-2" type="reset">清除</button>
        <button class="btn btn-warning ml-2" type="button" onclick="login()">送出</button>
      </div>
    </form>
  </div>
</div>
<script>
  function login() {
    let
      account = $("input[name='account']").val(),
      password = $("input[name='password']").val();

    $.post("api/check_account.php", {
      account
    }, function(res) {
      if (res == '1') {
        $.post("api/check_password.php", {
          account,
          password
        }, function(res) {
          console.log(res)
          if (res == 1) {
            location.href = "?backend=inquiry";
          } else if (res == 2) {
            location.href = "?page=products";
          } else {
            Swal.fire({
              icon: 'error',
              title: '密碼錯誤',
            }).then(function() {
              location.reload();
            })
          }
        })
      } else {
        Swal.fire({
          icon: 'error',
          title: '無此帳號',
        }).then(function() {
          location.reload();
        })
      }
    })
  }
</script>