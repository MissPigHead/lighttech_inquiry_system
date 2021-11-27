<?php
if (isset($_SESSION['sales']) || isset($_SESSION['customer'])) {
  to("index.php");
}
?>

<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 ml-5 pl-5 text-center">
      <h4>忘記密碼</h4>
    </div>
    <form class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 mt-1">
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">帳號</div>
        <input class="col-8 col-md-9 form-control w-100" type="text" name="account" minlength="3" maxlength="8" placeholder="3~8位小寫英文字母" required>
      </div>
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">Email</div>
        <input class="col-8 col-md-9 form-control w-100" type="email" name="email" placeholder="請輸入您註冊使用的email" required>
      </div>
      <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-secondary mr-2" type="reset">清除</button>
        <button class="btn btn-warning ml-2" type="button" onclick="forget_password()">送出</button>
      </div>
    </form>
  </div>
</div>

<script>
  function forget_password() {
    let
      account = $("input[name='account']").val(),
      email = $("input[name='email']").val();

    $.post("api/forget_password.php", {
      account,
      email
    }, function(res) {
      if(res!=''){
        Swal.fire({
          icon: 'info',
          title: `您的密碼為 ${res}`,
        }).then(function() {
          location.href='index.php';
        })
      }else{
        Swal.fire({
          icon: 'error',
          title: '查無此資料',
        }).then(function() {
          location.reload();
        })
      }
    })
  }
</script>