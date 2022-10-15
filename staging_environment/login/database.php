<?php
// ログイン処理
require("../dbc.php");
$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();
//echo 'require database';
function login($email, $password, $dbh){
  //$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  //$dbh->query('SET NAMES utf8');
  //$sql = "SELECT * FROM members WHERE email = :email AND  password = :password";
  $stt = $dbh->prepare('SELECT * FROM members WHERE email = :email');
  //入力されたパスワードをhash化する
  $pw_hash = password_hash($password, PASSWORD_DEFAULT);
  //echo $pw_hash;
  //echo $email;
  $stt->bindParam(':email', $email);
  //$stt->bindParam(':password', $pw_hash);
  $stt->execute();
  while($row=$stt->fetch()){
    $result['user_id'] = $row['user_id'];
    $result['name'] = $row['name'];
    $result['email'] = $row['email'];
    $result['password'] = $row['password'];
  }

  //echo $result['password'];
  //echo "<br />";
  //var_dump($result['user_id']);

  $ss0 = '0000';
  $pw0 = password_hash($ss0, PASSWORD_DEFAULT);
  //var_dump(password_verify($password, $pw0));
  //$password->入力されたパスワード　
  //$result['password']->DBに保管されたハッシユ値
  if(password_verify($password, $result['password'])){
    //echo $result;
    //return 'great!!';
    return $result['user_id'];
  }
}
// ログイン認証
/*
function authCheck($email, $password){
  //$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
  //$dbh->query('SET NAMES utf8');
  $sql = "SELECT * FROM members WHERE email = :email AND password = :password ";
  $pw_hash = password_hash($password, PASSWORD_BCRYPT);
  $stt = $dbh->prepare($sql);
  $stt->bindParam(':email', $email);
  $stt->bindParam(':password', $pw_hash);
  $stt->execute();
  while($row=$stt->fetch()){
    $result['user_id'] = $row['user_id'];
    $result['name'] = $row['name'];
    $result['email'] = $row['email'];
    $result['password'] = $row['password'];
  }
  if(isset($result)){
    echo 'authcheck';
    echo "<br />";
    echo $result;
    return $result;
  }
}
*/
?>
