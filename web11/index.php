<?php include_once "./api/base.php";

// $test =[
// 	'1' => '456',
// 	'2' =>'789'
// ];

// echo $Test->count($test);

//  dd(q("select sum(`total`) as 'total' from `total`")) 

?>


<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>健康促進網</title>
	<link href="./css/css.css" rel="stylesheet" type="text/css">
	<script src="./js/jquery-1.9.1.min.js"></script>
	<script src="./js/js.js"></script>
	<style>
		.alert {
			background: #999;
			color: #FFF;
			height: 350px;
			width: 300px;
			display: none;
			z-index: 100;
			overflow: auto;
		}
	</style>
</head>

<body>
	<div id="all">
		<div id="title">
			<?= date("m 月 d 號 l") ?> | 今日瀏覽: <?= $_SESSION['total']; ?> | 累積瀏覽:
			<?= q("select sum(`total`) as 'total' from `total`")[0]['total']; ?>
			<a href="index.php" style="float:right">回首頁</a>
		</div>
		<div id="title2">
			<a href="index.php" title="健康促進網－回首頁"><img src="./icon/02B01.jpg" alt=""></a>
		</div>
		<div id="mm">
			<div class="hal" id="lef">
				<a class="blo" href="?do=po">分類網誌</a>
				<a class="blo" href="?do=news">最新文章</a>
				<a class="blo" href="?do=pop">人氣文章</a>
				<a class="blo" href="?do=know">講座訊息</a>
				<a class="blo" href="?do=que">問卷調查</a>
			</div>
			<div class="hal" id="main">
				<div>
					<span style="width:78%; display:inline-block;">
						<marquee behavior="" direction="">請民眾踴躍投稿電子報，讓電子報成為大家相
							互交流、分享的園地！詳見最新文章</marquee>
					</span>
					<span style="width:20%; display:inline-block;">
						<?php
						if (isset($_SESSION['user'])) {
							echo "歡迎,{$_SESSION['user']}";
							echo "<button onclick='location.href=&#39;./api/logout.php&#39;'>登出</button>";
						} else {
							echo "<a href='?do=login'>會員登入</a>";
						}
						?>

					</span>
					<div class="contect">
						<?php
						$do = $_GET['do'] ?? 'main';
						// 例如，$do 變量在 "./frontend/{$do}.php" 中被包裹在 {} 中，這樣 PHP 能正確地解析變量 $do，而不是誤認為 $do.php 是一個完整的變量名。
						$file = "./frontend/{$do}.php";
						// file_exists($file)：這個函數會檢查 $file 所指定的文件或目錄是否存在。如果存在，函數會返回 true，如果不存在，則返回 false。
						if (file_exists($file)) {
							include $file;
						} else {
							include "./frontend/main.php";
						}

						?>
					</div>
				</div>
			</div>
		</div>
		<div id="bottom">
			本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © 2024健康促進網社群平台 All Right Reserved
			<br>
			服務信箱：health@test.labor.gov.tw<img src="./icon/02B02.jpg" width="45">
		</div>
	</div>

</body>

</html>