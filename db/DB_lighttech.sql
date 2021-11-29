-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-11-29 04:28:15
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `lighttech`
--
CREATE DATABASE IF NOT EXISTS `lighttech` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `lighttech`;

-- --------------------------------------------------------

--
-- 資料表結構 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL,
  `parent` int(11) NOT NULL,
  `visible` tinyint(1) DEFAULT 1,
  `update_by` int(11) NOT NULL DEFAULT 0,
  `update_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `category`
--

INSERT INTO `category` (`id`, `name`, `parent`, `visible`, `update_by`, `update_time`) VALUES
(1, '日用品', 0, 1, 0, '2021-11-28 17:17:46'),
(2, '食品', 0, 1, 0, '2021-11-28 17:17:46'),
(3, '貓砂', 1, 1, 0, '2021-11-28 17:17:46'),
(4, '玩具', 1, 1, 0, '2021-11-28 17:17:46'),
(5, '主食罐', 2, 1, 0, '2021-11-28 17:17:46'),
(6, '副食罐', 2, 1, 0, '2021-11-28 17:17:46'),
(7, '零食', 2, 1, 0, '2021-11-28 17:17:46'),
(8, '乾糧', 2, 1, 0, '2021-11-28 17:17:46'),
(9, '藥品', 0, 1, 0, '2021-11-28 17:17:46'),
(10, '其他', 0, 1, 0, '2021-11-28 17:17:46'),
(11, '衣物', 10, 1, 0, '2021-11-28 17:17:46'),
(12, '測試劑', 9, 1, 0, '2021-11-28 17:17:46'),
(13, '儀器', 10, 1, 0, '2021-11-28 17:17:46');

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL,
  `title` varchar(6) DEFAULT NULL,
  `company` varchar(20) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `register_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`id`, `user_id`, `name`, `title`, `company`, `email`, `phone`, `register_time`, `update_time`) VALUES
(1, 4, 'Zeng', 'Mr', NULL, 'test@example.com', '0912345678', '2021-11-26 17:19:34', '2021-11-28 17:16:56'),
(2, 9, '張綾凌', '', '', 'misspighead@gmail.com', '0927775101', '2021-11-26 23:44:38', '2021-11-28 17:16:56'),
(3, 10, 'CHANG', 'ms', '個人接案程式設計', 'misspighead@gmail.com', '0922006135', '2021-11-26 23:46:12', '2021-11-28 17:16:56'),
(13, 11, 'poo', 'poo', 'poo', 'poo@poo', '0958585858', '2021-11-29 10:21:56', '2021-11-29 10:21:56');

-- --------------------------------------------------------

--
-- 資料表結構 `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_time` datetime NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `sales_reply` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_remark` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `inquiry`
--

INSERT INTO `inquiry` (`id`, `user_id`, `contact_name`, `title`, `company`, `phone`, `email`, `remark`, `sent_time`, `sales_id`, `sales_reply`, `sales_remark`, `update_time`) VALUES
(1, 9, '張綾凌', '22', '22', '0927775101', 'misspighead@gmail.com', '', '2021-11-29 10:24:22', NULL, NULL, NULL, '2021-11-29 10:24:22'),
(2, 9, '張綾凌', '22', '22', '0927775101', 'misspighead@gmail.com', '一定要風險收集，笑道認真趨勢，設施傳來都市不見畢業生趕緊首頁舉報預防，技能思路實業，沒事解決本帖網通為您另一加強私服習慣一人這種，顧問學習學者參考我們規律屏幕日期收藏明顯股份有限公司一下，高雄書記細節溝通選項透露動態不承擔有着，民眾跟我，道理創作，工藝女。一定要風險收集，笑道認真趨勢，設施傳來都市不見畢業生趕緊首頁舉報預防，技能思路實業，沒事解決本帖網通為您另一加強私服習慣一人這種，顧問學習學者參', '2021-11-29 10:29:12', 3, '設施傳來都市不見畢業生趕緊首頁舉報預防，技能思路實業，沒事解決本帖網通為您另一加強私服習慣一人這種，顧問學習學者參考我們規律屏幕日期收藏明顯股份有限公司一下，高雄書記細節溝通選項透露動態不承擔有着，民眾跟我，道理創作，工藝女。一定要風險收集設施傳來都市不見畢業生趕緊首頁舉報預防，技能思路實業，沒事解決本帖網通為您另一加強私服習慣一人這種，顧問學習學者參考我們規律屏幕日期收藏明顯股份有限公司一下，高', '能思路實業，沒事解決本帖網通為您另一加強私服習慣一人這種，顧問學習學者參', '2021-11-29 10:29:12'),
(3, 9, '張綾凌', '把它線路警告審核是一', '不然付出不在是這樣，利潤工業轉移世界怎麼辦另一個前面證實不僅', '0927775101', 'misspighead@gmail.com', '把它線路不然付出不在是這樣，利潤工業轉移世界怎麼辦另一個前面證實不僅想法，給我需要好看怎麼辦畢竟驚人所說觀察再度敵人，咱們看出父母而已，姓名發出安裝告知包含，笑話無數一系列人口壓縮一樣大戰攻擊快車解決舉行，春天較高改造加速大連商品微微孤獨不良警告審核是一。把它線路不然付出不在是這樣，利潤工業轉移世界怎麼辦另一個前面證實不僅想法，給我需要好看怎麼辦畢竟驚人所說觀察再度敵人，咱們看出父母而已，姓名發出', '2021-11-29 10:30:39', 3, '！123', '122211212', '2021-11-29 10:30:39'),
(4, 9, '張綾凌', '不然付出不在是這樣，', '不然付出不在是這樣，利潤工業轉移世界怎麼辦另一個前面證實不僅', '0927775101', 'misspighead@gmail.com', '不然付出不在是這樣，利潤工業轉移世界怎麼辦另一個前面證實不僅想法，給我需不然付出不在是這樣，利潤工業轉移世界怎麼辦另一個前面證實不僅想法，給我需不然付出不在是這樣，利潤工業轉移世界怎麼辦另一個前面證實不僅想法，給我需', '2021-11-29 10:32:09', 2, '不用請您顧問經濟發展巨大，遠程篇文章分享，熱門終於你不，考慮今日行為包含投票學院哪些網絡來了人們和你施工看過我還失去，事實美女研究生感到消息金幣患者空中雙手官員我把，休閒很多人如果您當我這麼多進來讓我們招標，註冊時間提問戰士感謝鏡頭做出受到，還在我只，不。\r\n', '分享，熱門終於你不，考慮今日行為包含投票學院哪些網絡來了', '2021-11-29 10:32:09');

-- --------------------------------------------------------

--
-- 資料表結構 `inquiry_details`
--

CREATE TABLE `inquiry_details` (
  `id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `deliver_date` date NOT NULL,
  `price` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_price` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_price_by` int(11) NOT NULL,
  `update_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `inquiry_details`
--

INSERT INTO `inquiry_details` (`id`, `inquiry_id`, `product_id`, `quantity`, `deliver_date`, `price`, `cus_price`, `update_price_by`, `update_time`) VALUES
(1, 1, 6, 22, '2021-12-29', '150', NULL, 0, '2021-11-29 10:27:39'),
(2, 2, 7, 22, '2021-12-29', '270', '220', 3, '2021-11-29 10:29:12'),
(3, 2, 11, 555, '2021-12-29', '90', '90', 3, '2021-11-29 10:29:12'),
(4, 2, 19, 2, '2021-12-29', '200', '160', 3, '2021-11-29 10:29:12'),
(5, 2, 16, 11, '2021-12-29', '200', '150', 3, '2021-11-29 10:29:12'),
(6, 3, 17, 100, '2021-12-29', '120', '80', 3, '2021-11-29 10:30:39'),
(7, 4, 7, 111, '2021-12-29', '220', '220', 2, '2021-11-29 10:32:09'),
(8, 4, 19, 222, '2021-12-29', '150', '140', 2, '2021-11-29 10:32:09'),
(9, 4, 9, 333, '2021-12-29', '客制報價', '50', 2, '2021-11-29 10:32:09');

-- --------------------------------------------------------

--
-- 資料表結構 `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_by` int(11) NOT NULL DEFAULT 0,
  `update_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `price`
--

INSERT INTO `price` (`id`, `product_id`, `quantity`, `price`, `remark`, `update_by`, `update_time`) VALUES
(1, 1, '1', '200', '', 0, '2021-11-28 17:21:54'),
(2, 1, '30', '170', '', 0, '2021-11-28 17:21:54'),
(3, 1, '100', '150', '', 0, '2021-11-28 17:21:54'),
(4, 1, '200', '客制報價', '', 0, '2021-11-28 17:21:54'),
(5, 2, '100', '120', '', 0, '2021-11-28 17:21:54'),
(6, 2, '200', '110', '', 0, '2021-11-28 17:21:54'),
(7, 2, '300', '客制報價', '', 0, '2021-11-28 17:21:54'),
(8, 3, '1', '300', '', 0, '2021-11-28 17:21:54'),
(9, 3, '30', '270', '', 0, '2021-11-28 17:21:54'),
(10, 3, '100', '250', '', 0, '2021-11-28 17:21:54'),
(11, 3, '500', '客制報價', '', 0, '2021-11-28 17:21:54'),
(12, 4, '1', '200', '', 0, '2021-11-28 17:21:54'),
(13, 4, '30', '170', '', 0, '2021-11-28 17:21:54'),
(14, 4, '100', '150', '', 0, '2021-11-28 17:21:54'),
(15, 4, '300', '客制報價', '', 0, '2021-11-28 17:21:54'),
(16, 5, '1', '100', '', 0, '2021-11-28 17:21:54'),
(17, 5, '10', '95', '', 0, '2021-11-28 17:21:54'),
(18, 5, '30', '85', '', 0, '2021-11-28 17:21:54'),
(19, 5, '100', '客制報價', '', 0, '2021-11-28 17:21:54'),
(20, 6, '1', '200', '', 0, '2021-11-28 17:21:54'),
(21, 6, '10', '180', '', 0, '2021-11-28 17:21:54'),
(22, 6, '20', '150', '', 0, '2021-11-28 17:21:54'),
(23, 6, '50', '客制報價', '', 0, '2021-11-28 17:21:54'),
(24, 7, '1', '300', '', 0, '2021-11-28 17:21:54'),
(25, 7, '10', '270', '', 0, '2021-11-28 17:21:54'),
(26, 7, '30', '250', '', 0, '2021-11-28 17:21:54'),
(27, 7, '100', '220', '', 0, '2021-11-28 17:21:54'),
(28, 7, '200', '客制報價', '', 0, '2021-11-28 17:21:54'),
(29, 8, '10', '30', '', 0, '2021-11-28 17:21:54'),
(30, 8, '100', '27', '', 0, '2021-11-28 17:21:54'),
(31, 8, '300', '25', '', 0, '2021-11-28 17:21:54'),
(32, 8, '1000', '22', '', 0, '2021-11-28 17:21:54'),
(33, 8, '3000', '客制報價', '', 0, '2021-11-28 17:21:54'),
(34, 9, '1', '3000', '', 0, '2021-11-28 17:21:54'),
(35, 9, '5', '2700', '', 0, '2021-11-28 17:21:54'),
(36, 9, '10', '2500', '', 0, '2021-11-28 17:21:54'),
(37, 9, '20', '客制報價', '', 0, '2021-11-28 17:21:54'),
(38, 10, '12', '30', '', 0, '2021-11-28 17:21:54'),
(39, 10, '120', '26', '', 0, '2021-11-28 17:21:54'),
(40, 10, '300', '21', '', 0, '2021-11-28 17:21:54'),
(41, 10, '1200', '客制報價', '', 0, '2021-11-28 17:21:54'),
(42, 11, '10', '100', '', 0, '2021-11-28 17:21:54'),
(43, 11, '100', '90', '', 0, '2021-11-28 17:21:54'),
(44, 11, '1000', '70', '', 0, '2021-11-28 17:21:54'),
(45, 11, '3000', '客制報價', '', 0, '2021-11-28 17:21:54'),
(46, 12, '1', '180', '', 0, '2021-11-28 17:21:54'),
(47, 12, '20', '160', '', 0, '2021-11-28 17:21:54'),
(48, 12, '50', '140', '', 0, '2021-11-28 17:21:54'),
(49, 12, '300', '客制報價', '', 0, '2021-11-28 17:21:54'),
(50, 13, '20', '60', '', 0, '2021-11-28 17:21:54'),
(51, 13, '100', '50', '', 0, '2021-11-28 17:21:54'),
(52, 13, '300', '45', '', 0, '2021-11-28 17:21:54'),
(53, 13, '1000', '客制報價', '', 0, '2021-11-28 17:21:54'),
(54, 14, '1', '260', '', 0, '2021-11-28 17:21:54'),
(55, 14, '10', '220', '', 0, '2021-11-28 17:21:54'),
(56, 14, '100', '200', '', 0, '2021-11-28 17:21:54'),
(57, 14, '300', '客制報價', '', 0, '2021-11-28 17:21:54'),
(58, 15, '1', '28', '', 0, '2021-11-28 17:21:54'),
(59, 15, '30', '26', '', 0, '2021-11-28 17:21:54'),
(60, 15, '100', '24', '', 0, '2021-11-28 17:21:54'),
(61, 15, '500', '22', '', 0, '2021-11-28 17:21:54'),
(62, 15, '2000', '客制報價', '', 0, '2021-11-28 17:21:54'),
(63, 16, '1', '200', '', 0, '2021-11-28 17:21:54'),
(64, 16, '30', '170', '', 0, '2021-11-28 17:21:54'),
(65, 16, '100', '150', '', 0, '2021-11-28 17:21:54'),
(66, 16, '200', '客制報價', '', 0, '2021-11-28 17:21:54'),
(67, 17, '100', '120', '', 0, '2021-11-28 17:21:54'),
(68, 17, '200', '110', '', 0, '2021-11-28 17:21:54'),
(69, 17, '300', '客制報價', '', 0, '2021-11-28 17:21:54'),
(70, 18, '1', '300', '', 0, '2021-11-28 17:21:54'),
(71, 18, '30', '270', '', 0, '2021-11-28 17:21:54'),
(72, 18, '100', '250', '', 0, '2021-11-28 17:21:54'),
(73, 18, '500', '客制報價', '', 0, '2021-11-28 17:21:54'),
(74, 19, '1', '200', '', 0, '2021-11-28 17:21:54'),
(75, 19, '30', '170', '', 0, '2021-11-28 17:21:54'),
(76, 19, '100', '150', '', 0, '2021-11-28 17:21:54'),
(77, 19, '300', '客制報價', '', 0, '2021-11-28 17:21:54'),
(78, 20, '1', '100', '', 0, '2021-11-28 17:21:54'),
(79, 20, '10', '95', '', 0, '2021-11-28 17:21:54'),
(80, 20, '30', '85', '', 0, '2021-11-28 17:21:54'),
(81, 20, '100', '客制報價', '', 0, '2021-11-28 17:21:54'),
(82, 21, '1', '200', '', 0, '2021-11-28 17:21:54'),
(83, 21, '10', '180', '', 0, '2021-11-28 17:21:54'),
(84, 21, '20', '150', '', 0, '2021-11-28 17:21:54'),
(85, 21, '50', '客制報價', '', 0, '2021-11-28 17:21:54');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cate_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `moq` int(11) DEFAULT NULL,
  `in_stock` int(11) NOT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `update_by` int(11) DEFAULT 0,
  `update_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`id`, `name`, `cate_id`, `description`, `visible`, `image`, `moq`, `in_stock`, `remark`, `update_by`, `update_time`) VALUES
(1, '貓砂1號', 3, '經濟衛生礦砂，需要丟垃圾桶，請勿隨意棄置。', 1, 'https://fakeimg.pl/640x480/84a59d/ffffff?text=MS1-', 1, 620, '', 0, '2021-11-28 18:06:49'),
(2, '貓砂2號', 3, '經濟衛生礦砂，需要丟垃圾桶，請勿隨意棄置。', 1, 'https://fakeimg.pl/640x480/84a59d/ffffff?text=MS2-', 100, 0, '繁殖場專用，客訂叫貨', 0, '2021-11-28 18:06:49'),
(3, '貓砂3號', 3, '環保健康凝結式松木砂，可沖入馬桶。', 1, 'https://fakeimg.pl/640x480/84a59d/ffffff?text=MS3-', 1, 860, '', 0, '2021-11-28 18:06:49'),
(4, '貓砂4號', 3, '環保健康崩解式松木砂，請使用雙層貓砂盆，可沖入馬桶。', 1, 'https://fakeimg.pl/640x480/84a59d/ffffff?text=MS4-', 1, 0, '無即時庫存，客訂叫貨', 0, '2021-11-28 18:06:49'),
(5, '玩具1號', 4, '我是好玩的玩具1號，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/219ebc/ffffff?text=WJ1', 1, 2000, '', 0, '2021-11-28 18:06:49'),
(6, '玩具2號', 4, '我是好玩的玩具2號，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/219ebc/ffffff?text=WJ2', 1, 100, '出貨時間約需15天', 0, '2021-11-28 18:06:49'),
(7, '主食罐1號', 5, '我是好吃的主食罐1號，營養多又多，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/F5CAC3/ffffff?text=ZSG1', 1, 1000, '', 0, '2021-11-28 18:06:49'),
(8, '主食罐2號', 5, '我是好吃的主食罐2號，營養多又多，YA~YA~YA~YA~YA~', 0, 'https://fakeimg.pl/640x480/F5CAC3/ffffff?text=ZSG2', 1, 800, '', 0, '2021-11-28 18:06:49'),
(9, '主食罐3號', 5, '我是好吃的主食罐3號，營養多又多，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/F5CAC3/ffffff?text=ZSG3', 1, 500, '', 0, '2021-11-28 18:06:49'),
(10, '副食罐1號', 6, '我是好吃的副食罐1號，營養多又多，YA~YA~YA~YA~YA~', 0, 'https://fakeimg.pl/640x480/F5CAC3/ffffff?text=FSG1', 12, 2000, '', 0, '2021-11-28 18:06:49'),
(11, '零食1號', 7, '我是貓貓喜歡的零食1號，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/ee6c4d/ffffff?text=LS1', 10, 1000, '', 0, '2021-11-28 18:06:49'),
(12, '零食2號', 7, '我是貓貓喜歡的零食2號，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/ee6c4d/ffffff?text=LS2', 1, 500, '', 0, '2021-11-28 18:06:49'),
(13, '零食3號', 7, '我是貓貓喜歡的零食3號，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/ee6c4d/ffffff?text=LS3', 20, 5000, '客訂出貨，出貨時間約15天', 0, '2021-11-28 18:06:49'),
(14, '乾糧1號', 8, '我是好吃的乾糧1號，方便健康，營養多又多，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/f28482/ffffff?text=GL1', 1, 1000, '', 0, '2021-11-28 18:06:49'),
(15, '乾糧2號', 8, '我是好吃的乾糧2號，方便健康，營養多又多，YA~YA~YA~YA~YA~', 1, 'https://fakeimg.pl/640x480/f28482/ffffff?text=GL2', 1, 2000, '', 0, '2021-11-28 18:06:49'),
(16, '衣物1號', 11, '我是好吃的衣物1號111，穿鞋回家好乾淨，Wowowow', 1, 'https://fakeimg.pl/640x480/2a9d8f/ffffff?text=YW2', 1, 180, '', 0, '2021-11-28 18:06:49'),
(17, '衣物2號', 11, '我是好吃的衣物2號222，穿鞋回家好乾淨，Wowowow', 1, 'https://fakeimg.pl/640x480/2a9d8f/ffffff?text=YW2', 1, 200, '', 0, '2021-11-28 18:06:49'),
(18, '儀器1號', 12, '我是精準的儀器1號，YAYAYAYA，Wowowow', 1, 'https://fakeimg.pl/640x480/76c893/ffffff?text=YQ2', 1, 100, '', 0, '2021-11-28 18:06:49'),
(19, '儀器2號', 12, '我是精準的儀器2號，YAYAYAYA，Wowowow', 1, 'https://fakeimg.pl/640x480/76c893/ffffff?text=YQ2', 1, 200, '', 0, '2021-11-28 18:06:49'),
(20, '測試劑1號', 13, '我是不需要藥物許可證的測試劑1號，YAYAYAYA，Wowowow', 1, 'https://fakeimg.pl/640x480/c2c5aa/ffffff?text=CSJ2', 1, 1500, '', 0, '2021-11-28 18:06:49'),
(21, '測試劑2號', 13, '我是不需要藥物許可證的測試劑2號，YAYAYAYA，Wowowow', 1, 'https://fakeimg.pl/640x480/c2c5aa/ffffff?text=CSJ2', 1, 800, '', 0, '2021-11-28 18:06:49');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `account` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `priority` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `account`, `password`, `priority`) VALUES
(1, 'admin', 'Admin1234', 0),
(2, 'john', '1234Test', 1),
(3, 'amy', 'Test1234', 1),
(4, 'jimmy', 'Test1234', 2),
(9, 'tom', 'Qwer1234', 2),
(10, 'jim', 'Qwer1234', 2),
(11, 'klm', 'Qwerty12', 2);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `inquiry_details`
--
ALTER TABLE `inquiry_details`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `inquiry_details`
--
ALTER TABLE `inquiry_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--

-- 資料庫: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
