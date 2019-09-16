<?php
session_start();
session_regenerate_id(true);

require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';

$upload_file = isset($_FILES['upload_file'])? $_FILES['upload_file']: '';
if(!empty($upload_file)){
    $bookimg = 'https://readingtohabit.jp/images/'.$upload_file['name'];
    $bookimgPath = '/home/chibaapp/readingtohabit.jp/public_html/images/'.$upload_file['name'];
    move_uploaded_file($upload_file['tmp_name'], $bookimgPath);
}
else{
    $bookimg = 'https://readingtohabit.jp/images/noimage.png';
}

$bookname = isset($_POST['bookname'])? htmlspecialchars($_POST['bookname'], ENT_QUOTES, 'UTF-8'): '';
$bookcategory = isset($_POST['bookcategory'])? htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8'): '';
$reason = isset($_POST['reason'])? htmlspecialchars($_POST['reason'], ENT_QUOTES, 'UTF-8'): '';
$learn = isset($_POST['learn'])? htmlspecialchars($_POST['learn'], ENT_QUOTES, 'UTF-8'): '';
$activity = isset($_POST['activity'])? htmlspecialchars($_POST['activity'], ENT_QUOTES, 'UTF-8'): '';
$mailflag = isset($_POST['mailflag'])? htmlspecialchars($_POST['mailflag'], ENT_QUOTES, 'UTF-8'): '';
$postdate = date("Y/m/d H:i:s");

try {
    // DB接続

    $dbh  = db_connect('chibaapp_readingtohabit');

    // SQL実行
    $sql = 'INSERT INTO rth_article(uid, bookimg, bookname, bookcategory, reason, learn, activity, postdate, mailflag) VALUES(?,?,?,?,?,?,?,?,?)'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

    $stmt->bindParam(1, $_SESSION['uid']);
    $stmt->bindParam(2, $bookimg);
    $stmt->bindParam(3, $bookname);
    $stmt->bindParam(4, $bookcategory);
    $stmt->bindParam(5, $reason);
    $stmt->bindParam(6, $learn);
    $stmt->bindParam(7, $activity);
    $stmt->bindParam(8, $postdate);
    $stmt->bindParam(9, $mailflag);

    $stmt->execute(); // バインド、クエリ実行

    // DB切断
    $dbh = null;

   header('Location: https://readingtohabit.jp/read/top.php');

} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております';
    // echo $e->getMessage();
    exit();
}

?>