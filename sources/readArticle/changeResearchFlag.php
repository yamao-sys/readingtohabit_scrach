<?php
session_start();
session_regenerate_id(true);

$_SESSION['searchflag'] = 0;
header('Location: https://readingtohabit.jp/read/top.php');
?>