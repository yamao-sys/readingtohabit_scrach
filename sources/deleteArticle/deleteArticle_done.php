<?php
session_start();
session_regenerate_id(true);
require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';

try {
    $bookname = isset($_GET['article']) ? htmlspecialchars($_GET['article'], ENT_QUOTES, 'UTF-8') : '';
    $delflag = 1;

    $dbh  = db_connect('chibaapp_readingtohabit');

    $dbh->beginTransaction();

    $sql = 'SELECT * FROM rth_article WHERE uid = ? AND bookname = ? FOR UPDATE'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

    $stmt->bindParam(1, $_SESSION['uid']);
    $stmt->bindParam(2, $bookname);
    $stmt->execute(); // レコード排他ロック。メール送信と衝突した(記事削除のほうが先のとき)際、記事削除を反映し、メール送信をしないため。ギャップロックだが、本当はレコード単体のロックがしたかった...今後はDB設計の時、トランザクション制御のことをしっかり考慮しよう

    $sql2 = 'UPDATE rth_article SET delflag = ?  WHERE uid = ? AND bookname = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt2 = $dbh->prepare($sql2); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に

    $stmt2->bindParam(1, $delflag);
    $stmt2->bindParam(2, $_SESSION['uid']);
    $stmt2->bindParam(3, $bookname);
    $stmt2->execute();

    $dbh->commit();

    $dbh = null;

    header('Location: https://readingtohabit.jp/read/top.php');

}catch(Exception $e){
    $dbh->rollback();

    echo 'ただいま障害により大変ご迷惑をおかけしております';
    echo $e->getMessage();
    exit();
}
?>