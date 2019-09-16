<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';

// 「配信する」記事をすべて取得
try{
    $mailflag = 1;
    $delflag = 0;

    $dbh  = db_connect('chibaapp_readingtohabit');

    $dbh->beginTransaction(); // メール送信のほうが記事編集および記事削除よりも先の時を考慮

    $sql = 'SELECT uid,bookname,learn,activity,postdate FROM rth_article WHERE mailflag = ? AND delflag = ? FOR UPDATE'; // 共有ロックではなく排他ロックにしているのはデッドロック防止のため
    $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に
    $stmt->bindParam(1, $mailflag);
    $stmt->bindParam(2, $delflag);

    $stmt->execute();

    $dbh->commit(); // メールで送信する記事が取得出来たら、記事編集および記事削除が行えるように

    while($rec = $stmt->fetch(PDO::FETCH_ASSOC)){
        $uid = $rec['uid'];

        // 最終更新日時と現在の日時の差=1,7,30*nのものに対し、その投稿をしたユーザーのメールアドレス(delflag!=1)を取得
        $postdate = new DateTime(substr($rec['postdate'], 0, 10));
        $curdate  = new DateTime();

        $diffday  = $postdate->diff($curdate);
        //echo $rec['bookname'];
        //var_dump($diffday->format('%a'));
        //print '<br>';

        if($diffday->format('%a') == '1' || $diffday->format('%a') == '7'|| $diffday->format('%a') == '14'|| (floor(((int)$diffday->format('%a'))/30) > 0 && ((int)$diffday->format('%a'))%30 == 0)){
            $dbh->beginTransaction(); // メール送信とアカウント編集が衝突した際、メール送信のほうが先の時を考慮

            $sql2 = 'SELECT usrname,mailadd FROM rth_member WHERE uid = ? AND delflag = ? FOR UPDATE'; // 共有ロックではなく排他ロックにしているのはデッドロック防止のため
            $stmt2 = $dbh->prepare($sql2); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に
            $stmt2->bindParam(1, $uid);
            $stmt2->bindParam(2, $delflag);

            $stmt2->execute();

            $rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            $to = $rec2['mailadd'];
            $subject = "[Reading to habit]".$rec['bookname'];

            $body = "おはようございます。\n";
            $body .= "Reading to habit事務局です。\n";
            $body .= "\n";
            $body .= "読書して得た学びを人生に生かせるよう、今日も行動しましょう!\n";
            $body .= "\n\n";
            $body .= "======================================================================\n";
            $body .= "■著書名\n";
            $body .= $rec['bookname']."\n\n";
            $body .= "■学んだこと\n";
            $body .= $rec['learn']."\n\n";
            $body .= "■学びをもとにどう行動するか\n";
            $body .= $rec['activity']."\n";
            $body .= "======================================================================\n";
            $header = "From:".mb_encode_mimeheader('Reading to habit事務局')."<info@readingtohabit.jp>"."\n";
            $header .= "Sender: info@readingtohabit.jp"."\n";
            $header .= "Organization: Reading to habit事務局";

            mb_send_mail($to, $subject, $body, $header);

            $dbh->commit();// ひとつのuidに対して2つ以上記事があった場合、ここでコミットしておかないと、ロック解除待ちで処理が進まない状況になる
        }
    }
    $dbh = null;
}catch(Exception $e){
    $dbh->rollback();
    exit();
}

?>