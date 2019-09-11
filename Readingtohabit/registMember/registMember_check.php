<?php
$usrname = isset($_POST['usrname']) ? htmlspecialchars($_POST['usrname'], ENT_QUOTES, 'UTF-8') : '';
$mailadd = isset($_POST['mailadd']) ? htmlspecialchars($_POST['mailadd'], ENT_QUOTES, 'UTF-8') : '';
$passwd = isset($_POST['passwd']) ? htmlspecialchars($_POST['passwd'], ENT_QUOTES, 'UTF-8') : '';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width">
<link rel="stylesheet" href="https://readingtohabit.jp/css/bootstrap.min.css">
<link rel="stylesheet" href="https://readingtohabit.jp/css/font-awesome.min.css">
<script type="text/javascript" src = "https://readingtohabit.jp/js/jquery_ui_1_12_1/jquery.js"></script>
<title>Reading to habit | 会員登録内容確認</title>
</head>
<body>
<div id = "wrapper">
<div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  	<h2 class = "text-primary">
  		<a href="https://readingtohabit.jp/index/">Reading to habit</a>
  	</h2>
  	<button type = "button" class = "navbar-toggler" data-toggle = "collapse" data-target = "#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Reading to habit">
  		<span class = "navbar-toggler-icon"></span>
  	</button>
    <div class = "collapse navbar-collapse justify-content-end" id = "navBar">
    	<ul class = "navbar-nav">
      		<li class="nav-item"><a href="https://readingtohabit.jp/index/index.html#detail" class="nav-link">Reading to habitとは</a></li>
      		<li class="nav-item active"><a href="https://readingtohabit.jp/registMember/registMember.html" class="nav-link">会員登録</a></li>
      		<li class="nav-item"><a href="https://readingtohabit.jp/auth/login.html" class="nav-link">ログイン</a></li>
    	</ul>
    </div>
  </nav>
</div>

<div class = "container">
	<div class = "d-flex justify-content-center mt-5">
		<div class = "d-flex justify-content-center border">
			<div class = "m-2">
				<form action="https://readingtohabit.jp/registMember/registMember_done.php" method = "POST">
					<div class = "my-3">
					以下の内容でよろしければ「登録」を、<br>修正する場合は「戻る」を押下してください
					</div>
					<div class = "form-group mb-4">
						<label for = "usrname">ユーザー名</label>
						<input type = "text" name = "usrname" class = "form-control" id = "usrname" value = <?php echo $usrname?> readonly = "readonly">
					</div>

					<div class = "form-group mb-4">
						<label for = "mailadd">メールアドレス</label>
						<input type = "text" name = "mailadd" class = "form-control" id = "mailadd" value = <?php echo $mailadd?> readonly = "readonly">
					</div>

					<div class = "form-group mb-4">
						<label for = "passwd">新しいパスワード</label>
						<input type = "password" name = "passwd" class = "form-control" id = "passwd" value = <?php echo $passwd?> readonly = "readonly">
					</div>

					<div class = "d-flex justify-content-center">
						<input type = "submit"  class = "btn btn-info mr-3" name = "member_regestry_check" value = "登録">
						<a class = "btn btn-secondary" href = "https://readingtohabit.jp/registMember/registMember.html">戻る</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<footer class = "bg-light">
	<div class = "text-center">
		<a class = "text-dark" href = "https://readingtohabit.jp/rule/">利用規約</a> | <a class = "text-dark" href = "https://readingtohabit.jp/privacyPolicy/">プライバシーポリシー</a>
	</div>
	<div class = "text-center">
		© Reading to habit
	</div>
</footer>
</body>
<script src="https://readingtohabit.jp/js/bootstrap.bundle.min.js"></script>
</html>