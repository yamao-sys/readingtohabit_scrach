<?php
require '/home/chibaapp/readingtohabit.jp/public_html/db_connection.php';
// レスポンスデータの定義
$res = array('is_success' => false);

// エラーメッセージを格納する配列
$errors = array();

$delflag = 0;

// 会員登録
if(array_key_exists('member_registry', $_POST)){
    $usrname = array_key_exists('usrname', $_POST) ? htmlspecialchars($_POST['usrname'], ENT_QUOTES, 'UTF-8') : '';
    $mailadd = array_key_exists('mailadd', $_POST) ? htmlspecialchars($_POST['mailadd'], ENT_QUOTES, 'UTF-8') : '';
    $passwd = array_key_exists('passwd', $_POST) ? htmlspecialchars($_POST['passwd'], ENT_QUOTES, 'UTF-8') : '';
    $passwd_ck = array_key_exists('passwd_ck', $_POST) ? htmlspecialchars($_POST['passwd_ck'], ENT_QUOTES, 'UTF-8') : '';
    $termofservice = array_key_exists('termofservice', $_POST) ? htmlspecialchars($_POST['termofservice'], ENT_QUOTES, 'UTF-8') : '';

    // ユーザー名 未入力チェック
    if($usrname == ''){
        $errors[] = array('nm' => 'usrname', 'message' => 'ユーザー名を入力してください。半角英数、全角文字のどちらもご利用いただけます。');
    }else{
        $dbh  = db_connect('chibaapp_readingtohabit');
        $sql = 'SELECT * FROM rth_member WHERE usrname = ? AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に
        $stmt->bindParam(1, $usrname);
        $stmt->bindParam(2, $delflag);
        $stmt->execute();

        $dbh = null;

        if($rec = $stmt->fetch(PDO::FETCH_ASSOC)){
            $errors[] = array('nm' => 'usrname', 'message' => 'すでに存在するユーザー名です。恐れ入りますが、他のユーザー名で登録してください');

        }
    }

    // メールアドレス 未入力チェック
    if($mailadd == ''){
        $errors[] = array('nm' => 'mailadd', 'message' => 'メールアドレスを入力してください。');
    }
    elseif(!preg_match('/^[0-9a-z_.\?-]+@([0-9a-z-_]+\.)+[0-9a-z]+$/', $mailadd)){ // メールアドレス 文字チェック
        $errors[] = array('nm' => 'mailadd', 'message' => 'メールアドレスは半角英数文字および半角記号、また@と.が必要です');
    }

    // パスワード 未入力チェック
    if($passwd == ''){
        $errors[] = array('nm' => 'passwd', 'message' => 'パスワードを入力してください。');
    }
    elseif(!preg_match('/^[0-9a-zA-Z]{6,12}$/', $passwd)){ // パスワード 文字チェック
        $errors[] = array('nm' => 'passwd', 'message' => 'パスワードは半角英数文字6文字以上12文字以下で入力してください。');
    }

    // パスワード 未入力チェック
    if($passwd_ck == ''){
        $errors[] = array('nm' => 'passwd_ck', 'message' => 'パスワードを入力してください。');
    }
    elseif($passwd_ck != $passwd){
        $errors[] = array('nm' => 'passwd_ck', 'message' => 'パスワードが一致しません。');
    }

    // 利用規約チェック
    if($termofservice == ''){
        $errors[] = array('nm' => 'termofservice', 'message' => '利用規約チェックは必須です。');
    }
}

// ログイン
if(array_key_exists('login', $_POST)){

    $usrname = array_key_exists('usrname', $_POST) ? htmlspecialchars($_POST['usrname'], ENT_QUOTES, 'UTF-8') : '';
    $passwd = array_key_exists('passwd', $_POST) ? htmlspecialchars($_POST['passwd'], ENT_QUOTES, 'UTF-8') : '';

    if($usrname == ''){
        $errors[] = array('nm' => 'usrname', 'message' => 'ユーザー名が未入力です');
    }else{
        $dbh  = db_connect('chibaapp_readingtohabit');
        $sql = 'SELECT * FROM rth_member WHERE usrname = ? AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
        $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に
        $stmt->bindParam(1, $usrname);
        $stmt->bindParam(2, $delflag);
        $stmt->execute();

        $dbh = null;

        if(!($rec = $stmt->fetch(PDO::FETCH_ASSOC))){
            $errors[] = array('nm' => 'usrname', 'message' => '存在しないユーザー名です');
        }else{
            if(!password_verify($passwd, $rec['passwd'])){
                $errors[] = array('nm' => 'passwd', 'message' => 'パスワードが不一致です');
            }
        }
    }

}

// パスワード変更
if(array_key_exists('member_regestry', $_POST)){

    $usrname = array_key_exists('usrname', $_POST) ? htmlspecialchars($_POST['usrname'], ENT_QUOTES, 'UTF-8') : '';
    $mailadd = array_key_exists('mailadd', $_POST) ? htmlspecialchars($_POST['mailadd'], ENT_QUOTES, 'UTF-8') : '';
    $passwd = array_key_exists('passwd', $_POST) ? htmlspecialchars($_POST['passwd'], ENT_QUOTES, 'UTF-8') : '';
    $passwd_ck = array_key_exists('passwd_ck', $_POST) ? htmlspecialchars($_POST['passwd_ck'], ENT_QUOTES, 'UTF-8') : '';

    $dbh  = db_connect('chibaapp_readingtohabit');
    $sql = 'SELECT * FROM rth_member WHERE (usrname = ? AND mailadd = ?) AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に
    $stmt->bindParam(1, $usrname);
    $stmt->bindParam(2, $mailadd);
    $stmt->bindParam(3, $delflag);
    $stmt->execute();

    $dbh = null;

    if(!($rec = $stmt->fetch(PDO::FETCH_ASSOC))){
        $errors[] = array('nm' => 'mailadd', 'message' => '存在しないユーザー名またはメールアドレスです。');
    }

    // パスワード 未入力チェック
    if($passwd == ''){
        $errors[] = array('nm' => 'passwd', 'message' => 'パスワードを入力してください。');
    }
    elseif(!preg_match('/^[0-9a-zA-Z]{6,12}$/', $passwd)){ // パスワード 文字チェック
        $errors[] = array('nm' => 'passwd', 'message' => 'パスワードは半角英数文字6文字以上12文字以下で入力してください。');
    }

    // パスワード 未入力チェック
    if($passwd_ck == ''){
        $errors[] = array('nm' => 'passwd_ck', 'message' => 'パスワードを入力してください。');
    }
    elseif($passwd_ck != $passwd){
        $errors[] = array('nm' => 'passwd_ck', 'message' => 'パスワードが一致しません。');
    }
}

// 記事投稿or記事編集
if(array_key_exists('createAriticle', $_POST) || array_key_exists('updateAriticleDone', $_POST)){
    $upload_file = array_key_exists('name', $_POST) ? htmlspecialchars($_POST['upload_file'], ENT_QUOTES, 'UTF-8') : '';
    $bookname = array_key_exists('bookname', $_POST) ? htmlspecialchars($_POST['bookname'], ENT_QUOTES, 'UTF-8') : '';
    $bookcategory = array_key_exists('bookcategory', $_POST) ? htmlspecialchars($_POST['bookcategory'], ENT_QUOTES, 'UTF-8') : '';
    $reason = array_key_exists('reason', $_POST) ? htmlspecialchars($_POST['reason'], ENT_QUOTES, 'UTF-8') : '';
    $learn = array_key_exists('learn', $_POST) ? htmlspecialchars($_POST['learn'], ENT_QUOTES, 'UTF-8') : '';
    $activity = array_key_exists('activity', $_POST) ? htmlspecialchars($_POST['activity'], ENT_QUOTES, 'UTF-8') : '';

    if($bookname == ''){
        $errors[] = array('nm' => 'bookname', 'message' => '著書名を入力してください');
    }
    if($reason == ''){
        $errors[] = array('nm' => 'reason', 'message' => 'この本を読もうと思ったきっかけを入力してください');
    }
    if($learn == ''){
        $errors[] = array('nm' => 'learn', 'message' => 'この本で学んだことを入力してください');
    }
    if($activity == ''){
        $errors[] = array('nm' => 'activity', 'message' => '明日から実践したい行動を入力してください');
    }
}

// アカウント編集
if(array_key_exists('account_update', $_POST)){
    $usrname = array_key_exists('usrname', $_POST) ? htmlspecialchars($_POST['usrname'], ENT_QUOTES, 'UTF-8') : '';
    $mailadd = array_key_exists('mailadd', $_POST) ? htmlspecialchars($_POST['mailadd'], ENT_QUOTES, 'UTF-8') : '';
    $passwd = array_key_exists('passwd', $_POST) ? htmlspecialchars($_POST['passwd'], ENT_QUOTES, 'UTF-8') : '';
    $passwd_ck = array_key_exists('passwd_ck', $_POST) ? htmlspecialchars($_POST['passwd_ck'], ENT_QUOTES, 'UTF-8') : '';
    $upw = array_key_exists('upw', $_POST) ? htmlspecialchars($_POST['upw'], ENT_QUOTES, 'UTF-8') : '';
    $uid = array_key_exists('uid', $_POST) ? htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8') : '';

    // ユーザー名 未入力チェック
    if($usrname == ''){
        $errors[] = array('nm' => 'usrname', 'message' => 'ユーザー名を入力してください。半角英数、全角文字のどちらもご利用いただけます。');
    }

    // メールアドレス 未入力チェック
    if($mailadd == ''){
        $errors[] = array('nm' => 'mailadd', 'message' => 'メールアドレスを入力してください。');
    }
    elseif(!preg_match('/^[0-9a-z_.\?-]+@([0-9a-z-_]+\.)+[0-9a-z]+$/', $mailadd)){ // メールアドレス 文字チェック
        $errors[] = array('nm' => 'mailadd', 'message' => 'メールアドレスは半角英数文字および半角記号、また@と.が必要です');
    }

    // パスワード 未入力チェック
    if(($passwd != '') && !preg_match('/^[0-9a-zA-Z]{6,12}$/', $passwd)){ // パスワード 文字チェック
        $errors[] = array('nm' => 'passwd', 'message' => 'パスワードは半角英数文字6文字以上12文字以下で入力してください。');
    }

    // パスワード 未入力チェック
    if(($passwd != '') && ($passwd_ck == '')){
        $errors[] = array('nm' => 'passwd_ck', 'message' => 'パスワードを入力してください。');
    }
    elseif($passwd_ck != $passwd){
        $errors[] = array('nm' => 'passwd_ck', 'message' => 'パスワードが一致しません。');
    }

    // 不正防止用ログインユーザのパスワード
    $dbh  = db_connect('chibaapp_readingtohabit');
    $sql = 'SELECT * FROM rth_member WHERE uid = ? AND delflag = ?'; // プリペアードステートメント(SQLインジェクション対策として静的プレースホルダ)
    $stmt = $dbh->prepare($sql); // DB側でクエリのコンパイル⇒クエリの書き換え不可能に
    $stmt->bindParam(1, $uid);
    $stmt->bindParam(2, $delflag);

    $stmt->execute(); // バインド、クエリ実行

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!password_verify($upw, $rec['passwd'])){
        $errors[] = array('nm' => 'upw', 'message' => 'ログインユーザのパスワードと不一致です');
    }
}

// var_dump($errors);

if(!count($errors)){ // エラーがない場合
    $res['is_success'] = true;
}
else{
    $res['errors'] = $errors;
}
header("Content-Type: application/json; charset = utf-8");
echo json_encode($res);
?>