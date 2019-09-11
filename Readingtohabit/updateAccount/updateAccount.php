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
<script type="text/javascript" src = "https://readingtohabit.jp/js/jquery_ui_1_12_1/jquery.js"></script>
<script type="text/javascript" src = "https://readingtohabit.jp/js/errCheck.js"></script>
<title>Reading to habit | アカウント編集</title>
</head>
<body>
<div id = "wrapper">
<div>
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
      		<li class="nav-item"><a href="https://readingtohabit.jp/updateAccount/updateAccount.php" class="nav-link">アカウント編集</a></li>
      		<li class="nav-item active"><a href="https://readingtohabit.jp/auth/logout.php" class="nav-link">ログアウト</a></li>
    	</ul>
    </div>
  </nav>
</div>

<div class = "container">
	<div class = "d-flex justify-content-center mt-5">
		<div class = "d-flex justify-content-center border">
			<div class = "m-2">
			<span class = "font-weight-bold my-3">アカウント情報変更</span><br>
				<form action="https://readingtohabit.jp/updateAccount/updateAccount_done.php" method = "POST">
					<div>
						変更する項目を編集し、「変更内容を確認する」をクリックしてください。
					</div>
					<div class = "form-group my-4">
						<label for = "usrname">ユーザー名</label>
						<input type = "text" name = "usrname" class = "form-control" id = "usrname" value = <?php echo $_SESSION['usrname'];?>>
					</div>

					<div class = "form-group mb-4">
						<label for = "mailadd">メールアドレス</label>
						<input type = "text" name = "mailadd" class = "form-control" id = "mailadd" value = <?php echo $_SESSION['mailadd'];?>>
					</div>

					<div class = "form-group mb-4">
						<label for = "passwd">パスワード<br>※変更する場合のみ入力してください<br>※半角英数6文字以上12文字以下で入力してください</label>
						<input type = "password" name = "passwd" class = "form-control" id = "passwd">
					</div>

					<div class = "form-group mb-4">
						<label for = "passwd_ck">パスワード確認<br>※パスワードを変更する場合のみ入力してください</label>
						<input type = "password" name = "passwd_ck" class = "form-control" id = "passwd_ck">
					</div>

					<div class = "form-group mb-4">
						<label for = "upw">現在のパスワード</label>
						<input type = "password" name = "upw" class = "form-control" id = "upw">
					</div>
					<input type = "hidden" name = "uid" value = <?php echo $_SESSION['uid'];?>>

					<div class = "d-flex justify-content-center">
						<input type = "submit"  class = "btn btn-info mr-3" name = "account_update" value = "変更内容を確認する">
						<a class = "btn btn-secondary" href = 'https://readingtohabit.jp/read/top.php'>キャンセル</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class = "d-flex justify-content-center mt-5">
		<div class = "d-flex justify-content-center" style = "width: 60%">
			<div class = "m-2">
				<div class = "d-flex justify-content-center">
					<button class = "btn btn-danger" data-toggle = "modal" data-target = "#taikai">退会する</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class = "modal fade" id = "taikai">
	<div class = "modal-dialog modal-dialog-centered">
		<div class = "modal-content">
			<div class = "modal-header bg-info">
				<button class = "close" data-dismiss = "modal"><span>&times;</span></button>
			</div>
			<div class = "modal-body">
				<div class = "text-center">
					アカウントを削除すると復元はできません。
				</div>
				<div class = "text-center my-2">
					<a class = "btn btn-danger" href = "https://readingtohabit.jp/deleteAccount/deleteAccount_done.php">退会する</a>
				</div>
			</div>
			<div class = "modal-footer">
				<button class = "btn btn-secondary" data-dismiss = "modal">閉じる</button>
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
</div>
</body>
<script src="https://readingtohabit.jp/js/bootstrap.bundle.min.js"></script>
</html>