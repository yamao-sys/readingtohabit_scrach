<?php
function db_connect($dbname){
    $dsn = "mysql:dbname=$dbname;host=mysql7073.xserver.jp;charset=utf8";
    $user = 'chibaapp_admin';
    $password = 'fipbz8ys';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}
?>