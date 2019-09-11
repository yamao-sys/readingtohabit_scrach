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
<!-- <script type="text/javascript" src = "http://chibaapp.xsrv.jp/myscripts/booktohabit/js/jquery_ui_1_12_1/jquery.js"></script> -->
<script src="https://readingtohabit.jp/js/jquery-3.3.1.min.js"></script>
<!-- <script type="text/javascript" src = "http://chibaapp.xsrv.jp/myscripts/booktohabit/js/jquery_ui_1_12_1/jquery-ui.js"></script> -->
<title>Reading to habit | 記事詳細</title>
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

<?php
if(isset($_GET['article']) || isset($_SESSION['article'])){
    try {
        if(isset($_GET['article'])){
            $_SESSION['article'] = htmlspecialchars($_GET['article'], ENT_QUOTES, 'UTF-8');
        }

        $delflag = 0;

        $dbh  = db_connect('chibaapp_readingtohabit');
        $sql = 'SELECT * FROM rth_article WHERE (uid = ? AND bookname = ?) AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

        $stmt->bindParam(1, $_SESSION['uid']);
        $stmt->bindParam(2, $_SESSION['article']);
        $stmt->bindParam(3, $delflag);

        $stmt->execute();

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    }catch(Exception $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        echo $e->getMessage();
        exit();
    }
}

switch($rec['bookcategory']){
    case 'bussiness':
        $bookcategory = 'ビジネス';
        break;
    case 'enlightenment':
        $bookcategory = '自己啓発';
        break;
    case 'communication':
        $bookcategory = 'コミュニケーション';
        break;
    case 'schedule':
        $bookcategory = '時間管理';
        break;
    case 'psychology':
        $bookcategory = '心理学';
        break;
    case 'else':
        $bookcategory = 'その他';
        break;
}

/*
function echoImagePath($path){
    if($path == 'https://readingtohabit.jp/images/'){
        echo 'https://readingtohabit.jp/images/noimage.png';
    }
    else{
        echo $path;
    }
}*/

?>

<div class = "container">
<form action="https://readingtohabit.jp/updateArticle/updateArticle.php" method = "POST" enctype = "multipart/form-data">
	<div class = "img-wrapper border centering">
		<div class = "imgzone" style = "background-image: url(<?php echo $rec['bookimg'];?>); background-size: 100% 100%; background-repeat: no-repeat;
"></div>
	<input type = "hidden" name = "bookimg" value = <?php echo $rec['bookimg']?>>
	</div>

	<div class = "row mt-4 justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">著書名</div>
		<div class = "col-9 text-center border border-primary p-3"><input type = "text" name = "bookname" class = "textform" value = <?php echo $rec['bookname']?> readonly></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border-primary border">カテゴリ</div>
		<div class = "col-9 d-flex align-items-center border  border-primary p-3">
			 <input type = "text" name = "bookcategory" class = "textform" value = <?php echo $bookcategory;?> readonly>
		</div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">この本を読もうと思ったきっかけ</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "reason" readonly><?php echo $rec['reason']?></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">この本で学んだこと</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "learn" readonly><?php echo $rec['learn']?></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">学んだことを明日からどのように実践するか</div>
		<div class = "col-9 text-center border border-primary p-3"><textarea class = "textareasize" name = "activity" readonly><?php echo $rec['activity']?></textarea></div>
	</div>
	<div class = "row justify-content-center">
		<div class = "col-3 text-center d-flex align-items-center border border-primary">メール配信</div>
		<div class = "col-9 text-center border border-primary p-3">
			<input type = "text" name = "mailflag" class = "textform" value = <?php if($rec['mailflag'] == 1){echo '配信する';}else{echo '配信しない';}?> readonly = "readonly">
		</div>
	</div>

	<div class = "row my-3 justify-content-center">
		<input type = "submit"  class = "btn btn-info mr-1" name = "updateAriticle" value = "編集する">
		<a class = "btn btn-danger text-white mr-1" data-toggle = "modal" data-target = "#deleteCheck">削除する</a>
		<a class = "btn btn-secondary" href = "https://readingtohabit.jp/read//top.php">一覧へ戻る</a>
	</div>
</form>

<div class = "modal fade" id = "deleteCheck">
		<div class = "modal-dialog modal-dialog-centered">
			<div class = "modal-content">
				<div class = "modal-header bg-info"></div>
				<div class = "modal-body">
					<div class = "text-center mb-4">選択した記事を削除します。<br>よろしいでしょうか？</div>
					<div class = "row justify-content-center">
						<div><a class = "btn btn-danger mr-3" href = "https://readingtohabit.jp/deleteArticle/deleteArticle_done.php?article=<?php echo $_SESSION['article'];?>">削除する</a></div>
						<div><button class = "btn btn-secondary" data-dismiss = "modal">キャンセル</button></div>
					</div>
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
</div>
</body>
</html>

<script src="https://readingtohabit.jp/js/bootstrap.bundle.min.js"></script>