<?php
require_once('dbc.php');
error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
$user_input = $_POST;
$dbh = $dbc->dbConnect();
//var_dump($dbc->dbConnect());
$dbc->blogCreate($user_input);
//var_dump($dbc->blogCreate($blogs));
$request = $dbc->getAllRequest();

echo $request;

?>
<!--<a href="posted_confirmation.php">投稿を確認する→</a>-->
<a href="mark_to_map2.php">地図で確認する</a>
