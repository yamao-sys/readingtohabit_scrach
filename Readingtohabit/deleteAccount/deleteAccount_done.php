<?php
session_start();
session_regenerate_id(true);
require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';

$successflag = 0;

try {
    $dbh  = db_connect('chibaapp_readingtohabit');
    $delete = 1;
    $delflag = 0;

    $dbh->beginTransaction();

    $sql = 'SELECT * FROM rth_member WHERE uid = ? AND delflag = ? FOR UPDATE'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

    $stmt->bindParam(1, $_SESSION['uid']);
    $stmt->bindParam(2, $delflag);

    $stmt->execute(); // レコードを排他ロック。メール送信と衝突した際(アカウント削除のほうが先のとき)、削除を反映し、送信しないようにするため。

    $sql2 = 'UPDATE rth_member SET delflag = ? WHERE uid = ? AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt2 = $dbh->prepare($sql2); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

    $stmt2->bindParam(1, $delete);
    $stmt2->bindParam(2, $_SESSION['uid']);
    $stmt2->bindParam(3, $delflag);

    $stmt2->execute();

    $dbh->commit();

    $dbh = null;

    $_SESSION = null;
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();

    $successflag = 1;

}catch(Exception $e){
    $dbh->rollback();

    echo 'ただいま障害により大変ご迷惑をおかけしております';
    echo $e->getMessage();
    exit();
}
?>

<?php if($successflag == 1):?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width">
<link rel="stylesheet" href="https://readingtohabit.jp/css/bootstrap.min.css">
<link rel="stylesheet" href="https://readingtohabit.jp/css/font-awesome.min.css">
<script type="text/javascript" src = "https://readingtohabit.jp/js/jquery_ui_1_12_1/jquery.js"></script>
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
		<div>
			アカウントを削除しました。ご利用いただき、誠にありがとうございました。<br>
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
<?php endif;?>