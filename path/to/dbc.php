<?php
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
    //echo 'blllog';

  }


  function getAllRequestf(){
    $dbh = $this->dbConnectRamenMap();
    //###これ１
    //$DB_name = 'ramen_db_tokyo';
    //①SQL文の準備
    //###これ２
    //$sql = "SELECT * FROM ".$DB_name." WHERE status = 0";
    $sql = "SELECT id, name_address, youtube_url, latitude, longitude FROM ramen_db_tokyo WHERE status = 0";
    //②SQL文の実行
    //$stmt = $dbh->query("SELECT * FROM `ramen_db_tokyo` where `status`= 0");
    //$stmt = $dbh->query("UPDATE `ramen_db_aomori` SET `status`= 0 WHERE id = '".$i."'");

    //これで東京と青森表示↓
    //$sql = 'SELECT * FROM ramen_db_tokyo WHERE status = 0 UNION SELECT * FROM ramen_db_aomori WHERE status = 0';
    $stmt = $dbh->query($sql);
    //$stmt = $dbh->prepare($sql);
    //$stmt= $dbh->prepare('SELECT * FROM '.$DB_table_name.' WHERE status = 0');
    //$stmt->execute(array('ramen_db_tokyo'));
    //$stmt->execute();
    //③SQLの結果を受け取る
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }

  function getAllRequest($DB_name){
    $dbh = $this->dbConnectRamenMap();
    //これでできた↓
    //$DB_name = 'ramen_db_tokyo';
    //①SQL文の準備
    $sql = "SELECT id, name_address, youtube_url, latitude, longitude FROM ".$DB_name." WHERE status = 0";
    //②SQL文の実行
    //$stmt = $dbh->query("SELECT * FROM `ramen_db_tokyo` where `status`= 0");
    //$stmt = $dbh->query("UPDATE `ramen_db_aomori` SET `status`= 0 WHERE id = '".$i."'");

    //これで東京と青森表示↓
    //$sql = 'SELECT * FROM ramen_db_tokyo WHERE status = 0 UNION SELECT * FROM ramen_db_aomori WHERE status = 0';
    $stmt = $dbh->query($sql);
    //$stmt = $dbh->prepare($sql);
    //$stmt= $dbh->prepare('SELECT * FROM '.$DB_table_name.' WHERE status = 0');
    //$stmt->execute(array('ramen_db_tokyo'));
    //$stmt->execute();
    //③SQLの結果を受け取る
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }

  //データベースに東京のURL950件を挿入
  function insertYoutubeUrl() {
    for ($i=202; $i <= 950; $i++) {

      $sql = "INSERT INTO ramen_stores (youtube_url) VALUES (:youtube_url)";
      $dbh = $this->dbConnectRamenMap();
      $dbh->beginTransaction();

      try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':youtube_url', "https://www.youtube.com/watch?v=JlIL4BInvqU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index={$i}", PDO::PARAM_STR );
        $stmt->execute();
        $dbh->commit();

      } catch(PDOException $e) {
        $dbh->rollBack();
        exit($e);
      };
    }
  }

  //動画のタイトルと概要欄を出力します
  function exportYoutubeData() {
    $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=Ht6lcYg9Zfo&key=AIzaSyDowI75TIuk3j4UAkp2kGeKUlqyH3X1tuw&part=snippet,contentDetails,statistics,status";
    $json = file_get_contents($get_api_url);
    $getData = json_decode( $json , true);
    foreach((array)$getData['items'] as $key => $gDat){
    $video_title = $gDat['snippet']['title'];
    $description = $gDat['snippet']['description'];
    echo $video_title;
    echo $description;
  }
  }

  function output_db_array_proto($db_data){
    $output_data = array();
    foreach ($db_data as $output) {
      //echo $output;
      //echo $output['content'];
      $output_data[] = [$output['id'], $output['name_address'], $output['youtube_url'], $output['latitude'], $output['longitude']];
    }
    //var_dump($output_data);
    return $output_data;
  }

  function output_db_array($db_data){
    $output_data = array();
    foreach ($db_data as $output) {
      //echo $output;
      //echo $output['content'];
      $output_data[] = [$output['id'], $output['stores_name'], $output['stores_address'], $output['name_address'], $output['youtube_url'], $output['video_id'], $output['latitude'], $output['longitude']];
    }
    //var_dump($output_data);
    return $output_data;
  }
} ?>
