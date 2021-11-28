<?php
if (isset($_SESSION['user'])) {
  to("index.php");
}
?>

<div class="container my-2">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 mt-3 ml-5 pl-5 text-center">
      <h4>客戶註冊</h4>
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
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2 pr-0">確認密碼</div>
        <input class="col-8 col-md-9 form-control w-100" type="password" name="password2" minlength="8" maxlength="12" placeholder="請再次輸入您的密碼" required>
      </div>
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">姓名</div>
        <input class="col-8 col-md-9 form-control w-100" type="text" name="name" maxlength="12" placeholder="最多12個字" required>
      </div>
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">稱謂</div>
        <input class="col-8 col-md-9 form-control w-100" type="text" maxlength="6" placeholder="最多6個字" name="title">
      </div>
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">公司</div>
        <input class="col-8 col-md-9 form-control w-100" type="text" maxlength="20" placeholder="最多20個字" name="company">
      </div>
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">Email</div>
        <input class="col-8 col-md-9 form-control w-100" type="email" name="email" maxlength="40" placeholder="" required>
      </div>
      <div class="d-flex justify-content-between align-items-center my-1 my-md-2">
        <div class="col-3 col-md-2">電話</div>
        <input class="col-8 col-md-9 form-control w-100" type="text" name="phone" maxlength="10" placeholder="請輸入手機號碼不含符號" required>
      </div>
      <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-secondary mr-2" type="reset">清除</button>
        <button class="btn btn-warning ml-2" type="button" onclick="register()">送出</button>
      </div>
    </form>
  </div>
</div>
<script>
  function register() {
    let
      check = 1,
      err = [],
      err_msg = '',
      account = $("input[name='account']").val(),
      password = $("input[name='password']").val(),
      password2 = $("input[name='password2']").val(),
      name = $("input[name='name']").val(),
      title = $("input[name='title']").val(),
      company = $("input[name='company']").val(),
      email = $("input[name='email']").val(),
      phone = $("input[name='phone']").val(),
      account_reg = /^[a-z]{3,8}$/,
      password_reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,12}$/,
      phone_reg = /^(09)\d{8}$/;

    if (!account_reg.test(account)) {
      err.push("帳號格式錯誤")
      check = 0
    }
    if (!password_reg.test(password)) {
      err.push("密碼格式錯誤")
      check = 0
    }
    if (password !== password2) {
      err.push("兩次密碼輸入不同");
      check = 0
    }
    if (!phone_reg.test(phone)) {
      err.push("電話格式錯誤")
      check = 0
    }

    if (check) {
      console.log('ok')
      $.post("api/check_account.php", {
        account
      }, function(res) {
        console.log(res)
        if (res == 1) {
          Swal.fire({
            icon: 'warning',
            title: '此帳號已被註冊',
          })
        } else {
          $.post("api/register.php", {
            account,
            password,
            name,
            title,
            company,
            email,
            phone
          }, function() {
            Swal.fire({
              icon: 'success',
              title: '註冊成功，請進行登入',
            }).then(function() {
              location.href = "index.php?page=login"
            })
          })
        }
      })
    } else {
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