<?php
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width">
<link rel="stylesheet" href="https://readingtohabit.jp/css/bootstrap.min.css">
<link rel="stylesheet" href="https://readingtohabit.jp/css/font-awesome.min.css">
<!-- <script type="text/javascript" src = "http://chibaapp.xsrv.jp/myscripts/booktohabit/js/jquery_ui_1_12_1/jquery.js"></script> -->
<script src="https://readingtohabit.jp/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src = "https://readingtohabit.jp/js/errCheck.js"></script>
<!-- <script type="text/javascript" src = "http://chibaapp.xsrv.jp/myscripts/booktohabit/js/jquery_ui_1_12_1/jquery-ui.js"></script> -->
<title>Reading to habit | 記事作成</title>
</head>

<body>
<div id = "wrapper">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  	<div class = "text-dark">
  		ようこそ<?php echo $_SESSION['usrname'];?>さん
  	</div>
  	<!-- data-toggle: 「なにをするか」の指定  -->
  	<button class = "navbar-toggler" data-toggle = "collapse" data-target = "#navBar" aria-expand = "false" aria-label = "Readint to habit">
  		<span class = "navbar-toggler-icon"></span>
  	</button>
    <div class = "collapse navbar-collapse justify-content-end" id = "navBar">
    	<ul class = "navbar-nav">
      		<li class="nav-item active"><a href="https://readingtohabit.jp/auth/logout.php" class="nav-link">ログアウト</a></li>
    	</ul>
    </div>
</nav>

<div class = "container">
<form action="https://readingtohabit.jp/createArticle/createArticle_done.php" method = "POST" enctype = "multipart/form-data">
	<div class = "uploadFile text-center">
		<input type = "file"  name = "upload_file"><br>
		※お好みの画像をご選択ください。
	</div>

	<div class = "row mt-5 justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">著書名</div>
		<div class = "col-9 text-center border border-primary p-3"><input type = "text" name = "bookname" class = "textform"></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border-primary border">カテゴリ</div>
		<div class = "col-9 d-flex align-items-center border  border-primary p-3">
			 <select name = "bookcategory">
			 	<option value = "bussiness" selected>ビジネス</option>
			 	<option value = "enlightenment">自己啓発</option>
				<option value = "communication">コミュニケーション</option>
				<option value = "schedule">時間術</option>
				<option value = "psychology">心理学</option>
				<option value = "else" >その他</option>
			</select>
		</div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">この本を読もうと思ったきっかけ</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "reason"></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">この本で学んだこと</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "learn"></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">学んだことを明日からどのように実践するか</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "activity"></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">メール配信</div>
		<div class = "col-9 text-center border border-primary p-3">
			<input type="radio" name="mailflag" value="1" checked>配信する
			<input type="radio" class = "ml-3" name="mailflag" value="0">配信しない
		</div>
	</div>

	<div class = "row my-3 justify-content-center">
		<input type = "submit" class = "btn btn-info mr-3" name = "createAriticle" value = "保存する">
		<a class = "btn btn-secondary" href = "https://readingtohabit.jp/read/top.php">キャンセル</a>
	</div>
</form>
</div>

<footer class = "bg-light">
	<div class = "text-center">
		<a class = "text-dark" href = "https://readingtohabit.jp/rule/">利用規約</a> | <a class = "text-dark" href = "https://readingtohabit.jp/privacyPolicy/">プライバシーポリシー</a>
	</div>
	<div class = "text-center">
		© Reading to habit
	</div>
</footer>
</div>
</body>
<script src="https://readingtohabit.jp/js/bootstrap.bundle.min.js"></script>
</html>