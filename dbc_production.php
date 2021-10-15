<?php
//本番環境！！
/*
$dsn = 'mysql:dbname=4rgdb_ramenmap;host=mysql64.conoha.ne.jp;charset=utf8';
$user = '4rgdb_yutadb';
$password = 'Yuta_0224';
*/
class Dbc {
  function dbConnectRamenMap(){
    $dsn = 'mysql:dbname=ramen_maps;host=localhost;charset=utf8';
    $user = 'root';
    $password = '785HuezRS';

    try {
        $dbh = new PDO($dsn, $user, $password,[
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

        //echo "接続成功\n";
    } catch(PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
    };

    return $dbh;
  }

  function insertTable($user_input){
    $sql = "INSERT INTO basic_request (user_name, content, coordinate, lat, lng, type)
            VALUES (:user_name, :content, ST_GeomFromText(:coordinate), :lat, :lng, :type)";

    $dbh = $this-> dbConnectRamenMap();
    $dbh->beginTransaction();

    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':user_name', $user_input['user_name'], PDO::PARAM_STR );
      $stmt->bindValue(':content', $user_input['content'], PDO::PARAM_STR );
      $stmt->bindValue(':coordinate', 'POINT('.(float)$user_input['lat'].' '.(float)$user_input['lng'].')', PDO::PARAM_STR );
      $stmt->bindValue(':lat', $user_input['lat'], PDO::PARAM_STR);
      $stmt->bindValue(':lng', $user_input['lng'], PDO::PARAM_STR);
      $stmt->bindValue(':type', $user_input['type'], PDO::PARAM_INT );
      $stmt->execute();
      $dbh->commit();
      echo '投稿に成功しました';
    } catch(PDOException $e) {
      $dbh->rollBack();
      exit($e);
    };
  }

  function getAllRequest($DB_name){
    $dbh = $this->dbConnectRamenMap();
    $sql = "SELECT name_address, youtube_url, latitude, longitude FROM ".$DB_name." WHERE status = 0";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }
  //ページ読み込み時（初回）には東京を表示する。
  function getAllRequestf(){
    $dbh = $this->dbConnectRamenMap();
    $DB_name = 'ramen_db_tokyo';
    $sql = "SELECT name_address, youtube_url, latitude, longitude FROM ".$DB_name." WHERE status = 0";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }

  function output_db_array($db_data){
    $output_data = array();
    foreach ($db_data as $output) {
      $output_data[] = [$output['name_address'], $output['youtube_url'], $output['latitude'], $output['longitude']];
    }
    return $output_data;
  }
} ?>
<?php
//conohaで使う本番環境をコピペ↓
/*
<?php
class Dbc {
  function dbConnectRamenMap(){
    $dsn = 'mysql:dbname=4rgdb_ramenmap;host=mysql64.conoha.ne.jp;charset=utf8';
    $user = '4rgdb_yutadb';
    $password = 'Yuta_0224';

    try {
        $dbh = new PDO($dsn, $user, $password,[
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

        //echo "接続成功\n";
    } catch(PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
    };

    return $dbh;
  }

  function insertTable($user_input){
    $sql = "INSERT INTO basic_request (user_name, content, coordinate, lat, lng, type)
            VALUES (:user_name, :content, ST_GeomFromText(:coordinate), :lat, :lng, :type)";

    $dbh = $this-> dbConnectRamenMap();
    $dbh->beginTransaction();

    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':user_name', $user_input['user_name'], PDO::PARAM_STR );
      $stmt->bindValue(':content', $user_input['content'], PDO::PARAM_STR );
      $stmt->bindValue(':coordinate', 'POINT('.(float)$user_input['lat'].' '.(float)$user_input['lng'].')', PDO::PARAM_STR );
      $stmt->bindValue(':lat', $user_input['lat'], PDO::PARAM_STR);
      $stmt->bindValue(':lng', $user_input['lng'], PDO::PARAM_STR);
      $stmt->bindValue(':type', $user_input['type'], PDO::PARAM_INT );
      $stmt->execute();
      $dbh->commit();
      echo '投稿に成功しました';
    } catch(PDOException $e) {
      $dbh->rollBack();
      exit($e);
    };
  }

  function getAllRequest($DB_name){
    $dbh = $this->dbConnectRamenMap();
    $sql = "SELECT * FROM ".$DB_name." WHERE status = 0";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }
  //ページ読み込み時（初回）には東京を表示する。
  function getAllRequestf(){
    $dbh = $this->dbConnectRamenMap();
    $DB_name = 'ramen_db_tokyo';
    $sql = "SELECT * FROM ".$DB_name." WHERE status = 0";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }

  function output_db_array($db_data){
    $output_data = array();
    foreach ($db_data as $output) {
      $output_data[] = [$output['id'], $output['stores_name'], $output['stores_address'], $output['name_address'], $output['youtube_url'], $output['video_id'], $output['latitude'], $output['longitude']];
    }
    return $output_data;
  }
} ?>
*/
 ?>
