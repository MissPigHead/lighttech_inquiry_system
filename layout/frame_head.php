<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inquiry System - <?= $page ?></title>
  <!-- Favicons -->
  <link rel="shortcut icon" href="/image/favicon.ico" type="image/x-icon">
  <!-- CSS -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.2.1/sweetalert2.min.css">
  <link rel="stylesheet" href="/plus/custom.css">

  <!-- Script -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>

<body>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
          <a href="/index.php" class="d-flex align-items-center py-2">
            <img src="/image/favicon.ico" width="50px" alt="logo" class="px-2">
            <h2 class="text-secondary">客戶詢價系統</h2>
          </a>
          <?php
          if (isset($_SESSION['sales']) || isset($_SESSION['customer'])) {
          ?>
            <a href="api/logout.php">
              <button class="btn btn-dark-gray">登出</button>
            </a>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </header>
  <main>