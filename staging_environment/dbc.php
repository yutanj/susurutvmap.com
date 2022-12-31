<?php
class Dbc {
  function dbConnectRamenMap(){
    
    $dsn = 'mysql:dbname=ramen_maps;host=localhost;charset=utf8';
    $user = 'root';
    $password = '785HuezRS';
    

    // $dsn = 'mysql:dbname=4rgdb_ramenmap;host=mysql64.conoha.ne.jp;charset=utf8';
    // $user = '4rgdb_yutadb';
    // $password = 'Yuta_0224';
    

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
    $sql = "SELECT * FROM ramen_db_tokyo WHERE status = 0";
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
    $output_db_json = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    //echo $output_db_json;
    return $output_db_json;
    $dbh = null;
  }

  function getAllRequestMymap($user_id){
    $dbh = $this->dbConnectRamenMap();
    //$sql = "SELECT id, name_address, youtube_url, latitude, longitude FROM ".$DB_name." WHERE status = 0";
    $sql = "SELECT * FROM favorites WHERE user_id  = ${user_id}";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $output_db_json = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //echo $output_db_json;
    return $output_db_json;
    $dbh = null;
  }

  function getRequestAllOverJapan(){
    $dbh = $this->dbConnectRamenMap();
    $sql = "SELECT name_address, youtube_url, latitude, longitude FROM ramen_db_hokkaido WHERE status = 0";

    $stmt = $dbh->query($sql);
    //③SQLの結果を受け取る
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $output_db_json = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    return $output_db_json;
    $dbh = null;
  }

  function getRequestKen(){
    $dbh = $this->dbConnectRamenMap();
    $sql = "SELECT name_address, youtube_url, latitude, longitude FROM ramen_db_tokyo WHERE status = 0";

    $stmt = $dbh->query($sql);
    //③SQLの結果を受け取る
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $output_db_json = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    return $output_db_json;
    $dbh = null;
  }

  //test用，終わったら消す！
  function testgetAllRequestf(){
    $dbh = $this->dbConnectRamenMap();
    //$sql = "SELECT id, name_address, youtube_url, latitude, longitude FROM ramen_db_tokyo WHERE status = 0";
    $sql = "SELECT id, name_address, youtube_url, latitude, longitude FROM ramen_db_tokyo";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $output_db_json = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //echo $output_db_json;
    return $output_db_json;
    $dbh = null;
  }
  //test用，終わったら消す！
  function testgetAllRequest($DB_name){
    $dbh = $this->dbConnectRamenMap();
    $sql = "SELECT id, name_address, youtube_url, latitude, longitude FROM ".$DB_name." WHERE status = 0";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $output_db_json = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //echo $output_db_json;
    return $output_db_json;
    $dbh = null;
  }

  function getAllRequest($DB_name){
    $dbh = $this->dbConnectRamenMap();
    //これでできた↓
    //$DB_name = 'ramen_db_tokyo';
    //①SQL文の準備
    $sql = "SELECT * FROM ".$DB_name." WHERE status = 0";
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
    $output_db_json = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    //echo $output_db_json;
    return $output_db_json;
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

  //YouTube URL -> videoidに変換
  function urlToVideoid($yt_url) {
    //↓OKだったURL
    //https://www.youtube.com/watch?v=jmfr36eqdRo
    //https://www.youtube.com/watch?v=jmfr36eqdRo&t=59s
    //https://youtu.be/jmfr36eqdRo
    //https://youtu.be/3H9Fjj9V60s&t=60
    //https://youtu.be/3H9Fjj9V60s?t=60
    //https://www.youtube.com/watch?v=jmfr36eqdRo&feature=youtu.be
    //https://www.youtube.com/watch?v=jmfr36eqdRo&list=PLuO18pTvX5NIDP8pdNMnIL0uQWEage7JM
    //https://www.youtube.com/watch?v=jmfr36eqdRo&t=29&list=PLuO18pTvX5NIDP8pdNMnIL0uQWEage7JM

    if(strpos($yt_url,'watch?v=') !== false){
      //yt_urlのなかに'watch?v='が含まれている場合
      $yt_url2 = strstr($yt_url, 'watch?v=');
      if(strpos($yt_url2,'&list') !== false){
        $yt_url2 = strstr($yt_url2, '&list=', true);
        if(strpos($yt_url2,'&t=') !== false){
          $yt_url2 = strstr($yt_url2, '&t=', true);
          if(strpos($yt_url2,'&feature') !== false){
            $yt_url2 = strstr($yt_url2, '&feature', true);
          }
        }
      }
      if(strpos($yt_url2,'&t=') !== false){
        $yt_url2 = strstr($yt_url2, '&t=', true);
        if(strpos($yt_url2,'&list=') !== false){
          $yt_url2 = strstr($yt_url2, '&list=', true);
        }
      }
      if(strpos($yt_url2,'?t=') !== false){
        $yt_url2 = strstr($yt_url2, '?t=', true);
      }
      if(strpos($yt_url2,'&feature=') !== false){
        $yt_url2 = strstr($yt_url2, '&feature=', true);
      }
      $yt_url4 = str_replace('watch?v=', '', $yt_url2);
      if(strlen($yt_url4) == 11){
        return $yt_url4;
      } else {
        return false;
      }
    }
    //yt_urlのなかに'youtu.be'が含まれている場合
    elseif(strpos($yt_url,'youtu.be') !== false) {
      $yt_url2 = strstr($yt_url, 'youtu.be/');
      if(strpos($yt_url2,'&t=') !== false){
        $yt_url2 = strstr($yt_url2, '&t=', true);
      }
      if(strpos($yt_url2,'?t=') !== false){
        $yt_url2 = strstr($yt_url2, '?t=', true);
      }
      $videoid = str_replace('youtu.be/', '', $yt_url2);
      if (strlen($videoid) == 11) {
        return $videoid;
      } else {
        return false;
      }

    }
    // yt_urlのなかに'youtu.be','?watch?V='が含まれていない場合
    else {
      echo 'false';
      return false;
    }
  }
  //videoidからstores_name, stores_address, youtube_url, video_id, latitude, longitudeを取得する
  function videoidToGetColumn($videoid){
    $dbh = $this->dbConnectRamenMap();
    //$videoid = 'fVyx98PJSgE';
    $sql = "SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_hokkaido WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_aomori WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_iwate WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_miyagi WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_akita WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_yamagata WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_ibaraki WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_tochigi WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_gunma WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_saitama WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_chiba WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_tokyo WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_kanagawa WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_niigata WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_toyama WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_ishikawa WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_fukui WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_yamanashi WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_nagano WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_gifu WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_shizuoka WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_aichi WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_mie WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_shiga WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_kyoto WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_osaka WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_hyogo WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_nara WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_wakayama WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_tottori WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_shimane WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_okayama WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_hiroshima WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_yamaguchi WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_tokushima WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_kagawa WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_ehime WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_kochi WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_fukuoka WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_saga WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_nagasaki WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_kumamoto WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_oita WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_miyazaki WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_kagoshima WHERE video_id = '${videoid}'
            UNION ALL
            SELECT stores_name, stores_address, youtube_url, video_id, latitude, longitude FROM ramen_db_okinawa WHERE video_id = '${videoid}'";


    $stmt = $dbh->query($sql);
    //③SQLの結果を受け取る
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $output_db_json = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return $output_db_json;
    $dbh = null;
  }
  //店名・URL・近くの店(3km)検索・ジャンルとかでも検索したい
  //ここからどのくらいの距離
  //ユーザーにどうやっておすすめするか？

  //35.73176970630867, 139.83489728152207

  //半径3km以内のラーメン店を検索する

  //距離・サムネイル・店名・動画のURL(サムネイルに埋め込む？
  //$sql = "SELECT name_address, youtube_url, latitude, longitude FROM ".$DB_name." WHERE status = 0";
  function searchByDistance($lat, $lng){
    $dbh = $this->dbConnectRamenMap();
    $sql = "SELECT id, name_address, youtube_url, latitude, longitude,(6371 * acos(cos(radians(".$lat."))
        * cos(radians(latitude))
        * cos(radians(longitude) - radians(".$lng."))
        + sin(radians(".$lat."))
        * sin(radians(latitude))
      )
    ) AS distance FROM ramen_db_tokyo HAVING distance <= 100
    ORDER BY
    distance
   LIMIT 10";
    $stmt = $dbh->query($sql); //SQL文を実行して、結果を$stmtに代入する。
    //var_dump($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $output = json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    return $output;
    $dbh = null;
  }

  //キーワードからラーメン店を検索する
  function searchByKeyword(){
    if (isset($_POST["search"])){
      $dbh = $this->dbConnectRamenMap();
      $sql = "SELECT id, name_address FROM ramen_db_tokyo WHERE name_address LIKE '%".$_POST["keyword"]."%'";
      $stmt = $dbh->query($sql); //SQL文を実行して、結果を$stmtに代入する。
      $result = $stmt->fetchall(PDO::FETCH_ASSOC);
      var_dump($result);
      //検索結果の数
      $cnt = count($result);
      echo $cnt;
      $_POST['keyword'] = array();
    } else {
      return 'キーワードが入力されていません';
    }
  }
} ?>
