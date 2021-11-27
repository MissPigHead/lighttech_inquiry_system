# lighttech_inquiry_system

### 功能說明
- 一般會員註冊（客戶）：
  - 註冊功能
  - 資料驗證
  - 登入登出
  - 忘記密碼
- 商品詢價（客戶）：
  - 查詢商品價格資料
  - 手填報價單（客制化報價）
  - 查詢歷史報價單（客戶）：第二階段
- 回覆詢價單（業務）：
  - 回覆客制化報價內容
  - 查詢歷史回覆資訊（業務）：第二階段
### 環境設定
- DB 相關設定：儲存於api/base.php
  - 第7行 private $dsn="mysql:hostname=localhost;dbname=lighttech;charset=utf8"; 
  - 第14行 $this->pdo=new PDO($this->dsn,"root","");
