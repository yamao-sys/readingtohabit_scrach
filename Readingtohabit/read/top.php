<?php
session_start();
session_regenerate_id(true);
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';

$delflag = 0;

// アカウント情報取得
if(empty($_SESSION['uid'])){ // ログイン直後
    $usrname = isset($_POST['usrname'])? htmlspecialchars($_POST['usrname'], ENT_QUOTES, 'UTF-8'): '';

    try {
        $dbh  = db_connect('chibaapp_readingtohabit');
        $sql = 'SELECT * FROM rth_member WHERE usrname = ? AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

        $stmt->bindParam(1, $usrname);
        $stmt->bindParam(2, $delflag);

        $stmt->execute();

        $dbh = null;

        if($rec = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['uid'] = $rec['uid'];
            $_SESSION['usrname'] = $rec['usrname'];
            $_SESSION['mailadd'] = $rec['mailadd'];
        }
    }catch(Exception $e){
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }
}
else{
    try {
        $dbh  = db_connect('chibaapp_readingtohabit');
        $sql = 'SELECT * FROM rth_member WHERE uid = ? AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

        $stmt->bindParam(1, $_SESSION['uid']);
        $stmt->bindParam(2, $delflag);

        $stmt->execute();

        $dbh = null;

        if($rec = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['usrname'] = $rec['usrname'];
            $_SESSION['mailadd'] = $rec['mailadd'];
        }
    }catch(Exception $e){
        echo 'ただいま障害により大変ご迷惑をおかけしております';
        exit();
    }
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

<!-- <script type="text/javascript" src = "https://readingtohabit.jp/index/js/deleteArticle.js"></script> -->
<title>Reading to habit | 記事一覧</title>
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
      		<li class="nav-item"><a href="https://readingtohabit.jp//updateAccount/updateAccount.php" class="nav-link">アカウント編集</a></li>
      		<li class="nav-item active"><a href="https://readingtohabit.jp/auth/logout.php" class="nav-link">ログアウト</a></li>
    	</ul>
    </div>
  </nav>
</div>


<div class = "row my-3">
	<div class = "col-1 offset-1"><button class = "btn btn-info" data-toggle = "modal" data-target = "#search">検索</button></div>
	<div class = "col-1 offset-1"><a class = "btn btn-info" href = "https://readingtohabit.jp/createArticle/createArticle.php">新規</a></div>
</div>

<?php

function setSession($nm){
    if(isset($_POST[$nm])){
        $_SESSION[$nm] = htmlspecialchars($_POST[$nm], ENT_QUOTES, 'UTF-8');
    }
}

try {
    // 「検索フラグ」のチェック
    // top.phpから「検索」ボタン押下⇒検索フラグ = 1に更新

    if(is_null($_SESSION['searchflag'])){
        $_SESSION['searchflag'] = 0;
    }

    if(isset($_POST['searchbtn'])){
        $_SESSION['searchflag'] = 1;
    }

    // 基本表示、検索表示に共通する変数の定義
    // URLパラメータから始点を算出する
    // 始点 = 10*(n-1)
    $page = isset($_GET['pg'])? $_GET['pg']: 1;
    $recstart = 10 * ($page - 1);

    // DB接続
    $dbh  = db_connect('chibaapp_readingtohabit');

    // 「検索フラグ」によって分岐、記事および記事数の取得
    if($_SESSION['searchflag'] == 0){ // 基本表示
        $sql = 'SELECT * FROM rth_article where uid = ? AND delflag = ? ORDER BY postdate DESC LIMIT ?, 10';
        $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

        $stmt->bindParam(1, $_SESSION['uid']);
        $stmt->bindParam(2, $delflag);
        $stmt->bindParam(3, $recstart, PDO::PARAM_INT);

        $stmt->execute(); // バインド、クエリ実行

        $sql2 = 'SELECT COUNT(*) AS recnum FROM rth_article WHERE uid = ? AND delflag = ?'; // 記事を取ってくる先頭の行を算出する
        $stmt2 = $dbh->prepare($sql2); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

        $stmt2->bindParam(1, $_SESSION['uid']);
        $stmt2->bindParam(2, $delflag);

        $stmt2->execute(); // バインド、クエリ実行
    }
    elseif($_SESSION['searchflag'] == 1){ // 検索表示
        setSession('bookcategory');
        setSession('mailflag');
        setSession('when');
        setSession('researchflag');

        // ブール検索ごとにクエリの場合分け
        if($_SESSION['researchflag'] == 'and'){ // AND検索
            $sql  = 'SELECT * FROM rth_article WHERE (uid = ? AND delflag = ?) AND (bookcategory = ? AND (mailflag = ? AND (postdate BETWEEN ? AND ?))) ORDER BY postdate DESC LIMIT ?, 10'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
            $sql2 = 'SELECT COUNT(*) AS recnum FROM rth_article WHERE (uid = ? AND delflag = ?) AND (bookcategory = ? AND (mailflag = ? AND (postdate BETWEEN ? AND ?)))'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        }
        elseif($_SESSION['researchflag'] == 'or'){ // OR検索
            $sql  = 'SELECT * FROM rth_article WHERE (uid = ? AND delflag = ?) AND (bookcategory = ? OR (mailflag = ? OR (postdate BETWEEN ? AND ?))) ORDER BY postdate DESC LIMIT ?, 10'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
            $sql2 = 'SELECT COUNT(*) AS recnum FROM rth_article WHERE (uid = ? AND delflag = ?) AND (bookcategory = ? OR (mailflag = ? OR (postdate BETWEEN ? AND ?)))'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        }

        $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に
        $stmt2 = $dbh->prepare($sql2); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

        $stmt->bindParam(1, $_SESSION['uid']);
        $stmt2->bindParam(1, $_SESSION['uid']);
        $stmt->bindParam(2, $delflag);
        $stmt2->bindParam(2, $delflag);
        $stmt->bindParam(3, $_SESSION['bookcategory']);
        $stmt2->bindParam(3, $_SESSION['bookcategory']);
        $stmt->bindParam(4, $_SESSION['mailflag']);
        $stmt2->bindParam(4, $_SESSION['mailflag']);

        $curdate = new DateTime();

        $stmt->bindParam(6, $curdate->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt2->bindParam(6, $curdate->format('Y-m-d H:i:s'), PDO::PARAM_STR);

        if($_SESSION['when'] == '未選択'){
            $startdate = $curdate->modify('-365 days');
        }
        if($_SESSION['when'] == '7'){
            $startdate = $curdate->modify('-7 days');
        }
        elseif($_SESSION['when'] == '30'){
            $startdate = $curdate->modify('-30 days');
        }
        elseif($_SESSION['when'] == '90'){
            $startdate = $curdate->modify('-90 days');
        }

        $stmt->bindParam(5, $startdate->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt2->bindParam(5, $startdate->format('Y-m-d H:i:s'), PDO::PARAM_STR);

        $stmt->bindParam(7, $recstart, PDO::PARAM_INT);

        $stmt->execute();
        $stmt2->execute();
    }

    $dbh = null;

    // 記事を表示する
    $count = 0;
    echo '<div class = "container">';

    while($rec = $stmt->fetch(PDO::FETCH_ASSOC)){
        switch ($rec['bookcategory']){
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
                $bookcategory = '時間術';
                break;
            case 'psychology':
                $bookcategory = '心理学';
                break;
            case 'else':
                $bookcategory = 'その他';
                break;
        }

        print '<div class = "media border border-info p-3 mt-3 article">';
        if($rec['bookimg'] == 'https://readingtohabit.jp/images/'){
            print '<div class = "mr-3 img-wrapper border"><div class = "imgzone" width = "1rem" height = "1rem" style = "background-image: url('.'https://readingtohabit.jp/images/noimage.png'.'); background-size: 100% 100%; background-repeat: no-repeat;
"></div></div>';
        }
        else{
            print '<div class = "mr-3 img-wrapper border"><div class = "imgzone" width = "1rem" height = "1rem" style = "background-image: url(\''.$rec['bookimg'].'\'); background-size: 100% 100%; background-repeat: no-repeat;
"></div></div>';
        }

        // print '<div class = "mr-3 imgzone"><img alt="画像" src='.$rec['bookimg'].' class = "imgsize"></div>';
        print '<div class = "media-body mbody">';
        print '<p class = "title-fsize">'.$rec['bookname'].'</p>';
        print '<p class = "category-fsize">'.$bookcategory.'</p>';
        print '<div><a href = "https://readingtohabit.jp/read/readArticle.php?article='.$rec['bookname'].'">詳細を見る</a></div>';
        print '</div>';
        print '</div>';
        $count++;
    }

    $rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if($count == 0){
        if($_SESSION['searchflag'] == 0){
            echo '<div class = "bg-secondary text-white text-center my-5 p-2" id = "noarticles">まだ投稿記事がありません</div>';
        }
        else if($_SESSION['searchflag'] == 1){
            echo '<div class = "bg-secondary text-white text-center my-5 p-2" id = "noarticles">検索条件に合致する記事がありません</div>';
        }
    }
    else{
        // ページング
        if($rec2['recnum'] % 10 == 0){ // 記事数が10の倍数のとき
            $maxpagenum = floor($rec2['recnum'] / 10);
        }
        else{
            $maxpagenum = floor($rec2['recnum'] / 10) + 1;
        }

        if($maxpagenum > 1 && $maxpagenum <= 15){
            $pg = 1;
            echo '<div class = "text-center">';
            while($pg <= $maxpagenum){
                if(($pg <= $maxpagenum) && ($pg != $page)){
                    print ' | <a href = "https://readingtohabit.jp/read/top.php?pg='.$pg.'">'.$pg.'</a>';
                }

                if($pg == $maxpagenum){
                    echo ' |';
                }
                $pg++;
            }
            echo '</div>';
        }
    }

    if($_SESSION['searchflag'] == 1){
        print '<div class = "text-center my-2">';
        print '<a class = "btn btn-secondary" href = "https://readingtohabit.jp/read/changeResearchFlag.php">全記事表示に戻す</a>';
        print '</div>';
    }

    print '</div>';

}catch(Exception $e){
    echo 'ただいま障害により大変ご迷惑をおかけしております';
    echo $e->getMessage();
    exit();
}
?>

<div class = "modal fade" id = "search">
<form action="https://readingtohabit.jp/read/top.php" method = "POST">
	<div class = "modal-dialog modal-dialog-centered">
		<div class = "modal-content">
			<div class = "modal-header bg-info">
				<button class = "close" data-dismiss = "modal"><span>&times;</span></button>
			</div>
			<div class = "modal-body">
				<div class = "form-group mb-4">
					<label for = "bookcategory">カテゴリ</label>
					<select name = "bookcategory" class = "form-control" id = "bookcategory">
						<option value = "未選択">未選択</option>
						<option value = "bussiness">ビジネス</option>
						<option value = "enlightenment">自己啓発</option>
						<option value = "communication">コミュニケーション</option>
						<option valeu = "schedule">時間術</option>
						<option value = "psychology">心理学</option>
						<option value = "else">その他</option>
					</select>
				</div>

				<div class = "form-group mb-4">
					<div class = "my-1">
						メール配信
					</div>
					<div class="form-check form-check-inline">
  						<input class="form-check-input" type="radio" name="mailflag" value="1" checked>
  						<label class="form-check-label">配信する</label>
					</div>
					<div class="form-check form-check-inline">
  						<input class="form-check-input" type="radio" name="mailflag" value="0">
  						<label class="form-check-label">配信しない</label>
					</div>
				</div>

				<div class = "form-group mb-4">
					<label for = "when">読んだ時期</label>
					<select name = "when" class = "form-control" id = "when">
						<option value = "未選択">未選択</option>
						<option value = "7">1週間以内</option>
						<option value = "30">1か月以内</option>
						<option value = "90">3か月以内</option>
					</select>
				</div>

				<div class = "form-group mb-4">
					<div class = "my-1">
						検索条件
					</div>
					<div class="form-check form-check-inline">
  						<input class="form-check-input" type="radio" name="researchflag" value="or" checked>
  						<label class="form-check-label">いずれかを満たす</label>
					</div>
					<div class="form-check form-check-inline">
  						<input class="form-check-input" type="radio" name="researchflag" value="and">
  						<label class="form-check-label">すべてを満たす</label>
					</div>
				</div>

				<div class = "text-center"><input type = "submit" name = "searchbtn" value = "検索"></div>
			</div>
			<div class = "modal-footer">
				<button class = "btn btn-secondary" data-dismiss = "modal">閉じる</button>
			</div>
		</div>
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