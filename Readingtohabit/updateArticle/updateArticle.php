<?php
session_start();
session_regenerate_id(true);
require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width">
<link rel="stylesheet" href="https://readingtohabit.jp/css/bootstrap.min.css">
<link rel="stylesheet" href="https://readingtohabit.jp/css/font-awesome.min.css">
<script src="https://readingtohabit.jp/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src = "https://readingtohabit.jp/js/errCheck.js"></script>
<title>Reading to habit | 記事修正</title>
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
<form action="https://readingtohabit.jp/updateArticle/updateArticle_done.php" method = "POST" enctype = "multipart/form-data">
	<div class = "centering img-wrapper">
		<div class = "imgzone" style = "background-image: url('<?php echo htmlspecialchars($_POST['bookimg'], ENT_QUOTES, 'UTF-8');?>'); background-size: 100% 100%; background-repeat: no-repeat;
"></div>
	</div>
	<div class = "uploadFile text-center">
		<input type = "file"  name = "upload_file"><br>
		※画像を変更する場合、<br>お好みの画像をご選択ください。
	</div>

	<div class = "row mt-5 justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">著書名</div>
		<div class = "col-9 text-center border border-primary p-3"><input type = "text" name = "bookname" class = "textform" value = <?php echo htmlspecialchars($_POST['bookname'], ENT_QUOTES, 'UTF-8')?>></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border-primary border">カテゴリ</div>
		<div class = "col-9 d-flex align-items-center border  border-primary p-3">
			 <select name = "bookcategory">
			 	<option value = "bussiness" <?php if(htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8') == 'ビジネス'){echo 'selected';}?>>ビジネス</option>
			 	<option value = "enlightenment" <?php if(htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8') == '自己啓発'){echo 'selected';}?>>自己啓発</option>
				<option value = "communication" <?php if(htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8') == 'コミュニケーション'){echo 'selected';}?>>コミュニケーション</option>
				<option value = "schedule" <?php if(htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8') == '時間管理'){echo 'selected';}?>>時間術</option>
				<option value = "psychology" <?php if(htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8') == '心理学'){echo 'selected';}?>>心理学</option>
				<option value = "else" <?php if(htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8') == 'その他'){echo 'selected';}?>>その他</option>
			</select>
		</div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">この本を読もうと思ったきっかけ</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "reason"><?php echo htmlspecialchars($_POST['reason'], ENT_QUOTES, 'UTF-8');?></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">この本で学んだこと</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "learn"><?php echo htmlspecialchars($_POST['learn'], ENT_QUOTES, 'UTF-8');?></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">学んだことを明日からどのように実践するか</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "activity"><?php echo htmlspecialchars($_POST['activity'], ENT_QUOTES, 'UTF-8');?></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">メール配信</div>
		<div class = "col-9 text-center border border-primary p-3">
			<input type="radio" name="mailflag" value="1" <?php if(htmlspecialchars($_POST['mailflag'], ENT_QUOTES, 'UTF-8') == '配信する'){echo 'checked';}?>>配信する
			<input type="radio" class = "ml-3" name="mailflag" value="0" <?php if(htmlspecialchars($_POST['mailflag'], ENT_QUOTES, 'UTF-8') == '配信しない'){echo 'checked';}?>>配信しない
		</div>
	</div>

	<div class = "row my-3 justify-content-center">
		<input type = "submit"  class = "btn btn-info mr-3" name = "updateAriticleDone" value = "この内容に変更する">
		<a class = "btn btn-secondary" href = "https://readingtohabit.jp/read/readArticle.php">キャンセル</a>
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