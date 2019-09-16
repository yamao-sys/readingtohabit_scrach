<?php
session_start();
session_regenerate_id(true);
require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';

try{
    $delflag = 0;
    $dbh  = db_connect('chibaapp_readingtohabit');

    // クエリに渡す変数
    $bookname = htmlspecialchars($_POST['bookname'], ENT_QUOTES, 'UTF-8');
    $bookcategory = htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8');
    $reason = htmlspecialchars($_POST['reason'], ENT_QUOTES, 'UTF-8');
    $learn = htmlspecialchars($_POST['learn'], ENT_QUOTES, 'UTF-8');
    $activity = htmlspecialchars($_POST['activity'], ENT_QUOTES, 'UTF-8');
    $postdate = date("Y/m/d H:i:s");
    $mailflag = htmlspecialchars($_POST['mailflag'], ENT_QUOTES, 'UTF-8');
    $delflag = 0;

    $dbh->beginTransaction();

    $sql = 'SELECT * FROM rth_article WHERE (uid = ? AND bookname = ?) AND delflag = ? FOR UPDATE'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

    $stmt->bindParam(1, $_SESSION['uid']);
    $stmt->bindParam(2, $_SESSION['article']);
    $stmt->bindParam(3, $delflag);

    $stmt->execute(); // 排他ロック。メール送信と衝突(記事編集のほうが先の時)の際、記事編集結果をもとにメール送信するため。

    if(!empty($_FILES['upload_file']['tmp_name'])){
        $bookimg = 'https://readingtohabit.jp/images/'.$_FILES['upload_file']['name'];
        $bookimgPath = '/home/chibaapp/readingtohabit.jp/public_html/images/'.$_FILES['upload_file']['name'];
        move_uploaded_file($_FILES['upload_file']['tmp_name'], $bookimgPath);

        $sql2 = 'UPDATE rth_article SET bookimg = ?,bookname = ?,bookcategory = ?,reason = ? ,learn = ?,activity = ?,postdate = ?,mailflag = ?  WHERE (uid = ? AND bookname = ?) AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        $stmt2 = $dbh->prepare($sql2); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

        $stmt2->bindParam(1, $bookimg);
        $stmt2->bindParam(2, $bookname);
        $stmt2->bindParam(3, $bookcategory);
        $stmt2->bindParam(4, $reason);
        $stmt2->bindParam(5, $learn);
        $stmt2->bindParam(6, $activity);
        $stmt2->bindParam(7, $postdate);
        $stmt2->bindParam(8, $mailflag);
        $stmt2->bindParam(9, $_SESSION['uid']);
        $stmt2->bindParam(10, $_SESSION['article']);
        $stmt2->bindParam(11, $delflag);
    }
    else{
        $sql2 = 'UPDATE rth_article SET bookname = ?,bookcategory = ?,reason = ? ,learn = ?,activity = ?,postdate = ?,mailflag = ?  WHERE (uid = ? AND bookname = ?) AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        $stmt2 = $dbh->prepare($sql2); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

        $stmt2->bindParam(1, $bookname);
        $stmt2->bindParam(2, $bookcategory);
        $stmt2->bindParam(3, $reason);
        $stmt2->bindParam(4, $learn);
        $stmt2->bindParam(5, $activity);
        $stmt2->bindParam(6, $postdate);
        $stmt2->bindParam(7, $mailflag);
        $stmt2->bindParam(8, $_SESSION['uid']);
        $stmt2->bindParam(9, $_SESSION['article']);
        $stmt2->bindParam(10, $delflag);
    }
    $stmt2->execute();

    $dbh->commit();

    $dbh = null;

    header('Location: https://readingtohabit.jp/read/top.php');

}catch(Exception $e) {
    $dbh->rollback();
    throw $e;

    echo 'ただいま障害により大変ご迷惑をおかけしております';
    //echo $e->getMessage();
    exit();
}
?>