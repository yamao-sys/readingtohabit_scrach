# Reading to habitのソースコードの概要説明
■使用言語：PHP, JavaScript(jQuery), HTML, CSS, Bootstrap4
■データベース：MySQL
■サーバー：Xserver
■FTPクライアントソフト：FileZilla

## index
トップページ

## registMember
会員登録関連

## rule
利用規約

## privacyPolicy
プライバシーポリシー

## auth
ログイン・ログアウトのコードのディレクトリ

## changePassword
ログイン時にパスワードを忘れた場合のパスワード変更画面

## updateAccount
会員情報の編集関連

## deleteAccount
退会用のアカウント削除

## createArticle
読書記録の記事作成関連

## read
読書記録の表示関連

## updateArticle
読書記録の記事編集

## deleteArticle
読書記録の記事削除

## db_connection.php
DB(Mysql)への接続

## errCheck.php
正規表現等を用いたエラーチェック

## sendingMail.php
読書記録の記事をメールで定期配信
メールは記事投稿日(最終更新日)から下記日数経過後、cronで配信

メール配信日数：

## js
jqueryライブラリ、エラーチェック用スクリプト

## css
Bootstrap4、fontawesome

