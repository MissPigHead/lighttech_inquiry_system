# lighttech_inquiry_system

### 功能說明
- 一般會員註冊（客戶）：
  - 註冊功能
  - 註冊資料驗證
  - 登入登出
  - 忘記/查詢密碼
- 商品詢價（客戶）：
  - 查詢商品價格資料（提供目錄選單，依選單列出商品及價格）
  - 手填報價單（客制化報價）
  - 查詢歷史報價單（客戶）
- 回覆詢價單（業務）：
  - 回覆客戶詢價內容
  - 查詢歷史回覆資訊

### 環境設定
- DB 相關設定：儲存於api/base.php
  - 第7行 private $dsn="mysql:hostname=localhost;dbname=lighttech;charset=utf8"; 
  - 第14行 $this->pdo=new PDO($this->dsn,"root",""); 請自行代換mysql帳號密碼

### 測試資料
- 儲存於db/DB_lighttech.sql
