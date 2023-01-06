<?php

/*データベース作成用コード*/ 

require('dbc.php');
header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");
//error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();
$output_db_array = $dbc->getRequestAllOverJapan();

//$DB_table_name_json = json_encode($DB_table_name, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    //echo $output_db_array;

    $array = json_decode($output_db_array , true);
    $stack = array();
    // var_dump(count($array));
     //var_dump($array);

  /**
   *
   *  lat, lng (int) をlocation(Geometry)に変換する
   * 
   */

    // for ($i=1; $i < 1232; $i++) { 
    //   $lat = $array[$i]["latitude"];
    //   $lng = $array[$i]["longitude"];
    //   $latlng = $lng.' '.$lat;
    //   echo $latlng;
    //   $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET `location`=ST_GEOMFROMTEXT('POINT(".$latlng.")', 4326) WHERE id= '".$i."'");
    // }

  /**
   * 
   * 基準点lat,lngから半径distance km以内の店をcount件検索する
   * 
   */
    
      //$latlng = $lng.' '.$lat;
      // $stmt = $dbh->query("SELECT id, ST_AsText(location) p , 
      // ST_Distance_Sphere(sp, ST_GeomFromText('POINT(".$latlng.")', 4326)) d 
      // FROM ramen_db_tokyo
      // WHERE ST_Distance_Sphere(sp, ST_GeomFromText('POINT(35.685 139.762)', 4326)) <200
      // ORDER BY d");
       $stmt = $dbh->query("SELECT id, ST_AsText(location) p , 
       ST_Distance_Sphere(location, ST_GeomFromText('POINT(35.685 139.762)', 4326)) d 
       FROM ramen_db_tokyo
      WHERE ST_Distance_Sphere(location, ST_GeomFromText('POINT(35.685 139.762)', 4326)) <5000
      ORDER BY d");
    

    /*
    //idをここに入力
    $j = 1080;
    for ($i = 0; $i < count($array); $i++) {
    //print_r($array[$i]["name_address"]);
    //print_r($array[$i]);
    $bn1_id = $array[$i]["id"];
    $bn1_na = $array[$i]["name_address"];

    if (strpos($bn1_na, '東京都')){
      $str = strstr($bn1_na, '東京都');
      echo $str;
      $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`stores_address`='".$str."'WHERE id = '".$j."'");
      array_push($stack, $str);
      $j++;
    } else {
      $str = '#####';
      echo $str;
      $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`stores_address`='".$str."'WHERE id = '".$j."'");
      array_push($stack, $str);
      $j++;
  }
}
*/

//youtubeurlからvideoidを抽出
/*
$j = 1080;
for ($i = 0; $i < count($array); $i++) {
  $bn1_yt = $array[$i]["youtube_url"];
  $yt_url2 = strstr($bn1_yt, 'watch?v=');
  $yt_url3 = strstr($yt_url2, '&list=', true);
  $yt_url4 = str_replace('watch?v=', '', $yt_url3);
  $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`video_id`='".$yt_url4."'WHERE id = '".$j."'");
  array_push($stack, $yt_url4);
  $j++;
}
var_dump($stack);
*/


/*
for ($i=0; $i < 10; $i++) {
  // code...
  //print_r($s);
  //print_r('@@@@');
  echo $stack[0][i];
  //$stmt = $dbh->query("UPDATE `ramen_db_gunma` SET`name_address`='".$key."'WHERE id = '".$update_first."'");
  //echo $update_first;
  echo "<br />";
}
*/
// hogehogefugafuga[piyo]
/*
echo $str;
    $bn1 = $array[$i]["name_address"];
    $bn2 = str_replace('東京都', '@@東京都', $bn1);
    $bn3 = str_replace('神奈川県', '@@神奈川県', $subject)
    print_r($bn2);
    */
    //var_dump( mb_strstr($string, '入') );
    //var_dump( mb_strstr($string, '入', true) );


    ?>;
    <script>
      const js_test = <?php echo $output_db_array; ?>;
      console.log(js_test);
    </script>
  </body>
</html>
