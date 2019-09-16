<?php
/****************受け取ったフォームデータをDBに登録******************/

require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';
date_default_timezone_set('Asia/Tokyo');

// postデータをサニタイジングして変数に格納

$usrname = htmlspecialchars($_POST['usrname'], ENT_QUOTES, 'UTF-8');
$mailadd = htmlspecialchars($_POST['mailadd'], ENT_QUOTES, 'UTF-8');
$passwd = password_hash(htmlspecialchars($_POST['passwd'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT);
$regdate = date("Y/m/d H:i:s");
try {
    // DB接続

    $dbh  = db_connect('chibaapp_readingtohabit');

    // SQL実行

    $sql = 'INSERT INTO rth_member(usrname, mailadd, passwd, regdate) VALUES(?,?,?,?)'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

    $stmt->bindParam(1, $usrname);
    $stmt->bindParam(2, $mailadd);
    $stmt->bindParam(3, $passwd);
    $stmt->bindParam(4, $regdate);

    $stmt->execute(); // バインド、クエリ実行

    // DB切断
    $dbh = null;
    // $sucflag = true;

} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております';
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width">
<link rel="stylesheet" href="https://readingtohabit.jp/css/bootstrap.min.css">
<link rel="stylesheet" href="https://readingtohabit.jp/css/font-awesome.min.css">
<script src="https://readingtohabit.jp/js/jquery-3.3.1.slim.min.js"></script>
<title>Reading to habit | 会員登録成功</title>
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
	<div class = "text-center my-5">
		会員登録が完了しました。<br>
		ご登録ありがとうございます。
	</div>
	<div class = "text-center">
		<a href = "https://readingtohabit.jp/auth/login.html">ログイン画面へ</a>
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