<?php
//都道府県ごとにデータベースを作るためのページ
require('dbc.php');
error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();


/**
 * 
 * 【入力すべき情報】
 *  URL → videoid → 店名・住所 → 緯度・経度
 * 
 */


/**
 * 
 * youtube_urlを準備
 * 
 */

$youtube_url = '';
$youtube_url2 = '';
$youtube_url3 = '';
$youtube_url4 = '';


/****
 * 
 * $youtube_url ⇒ $youtube_url_array に分割  (1桁　93)
 * 
*/

$wordwrap_str = wordwrap($youtube_url4,93,"','",true);
$youtube_url_array = explode(',', $wordwrap_str);

/***
 * 
 * URLをINSERTする
 * 
 * */ 
$url1 = ['https://www.youtube.com/watch?v=StnYrArRfDM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=110 ','https://www.youtube.com/watch?v=IZE38Q8uHn8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=109 ','https://www.youtube.com/watch?v=_gsYGdOlA4I&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=108 ','https://www.youtube.com/watch?v=_ZOYGi3OZYE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=107 ','https://www.youtube.com/watch?v=GSqkOjHgvnA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=106 ','https://www.youtube.com/watch?v=VqoO9qOeD4E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=105 ','https://www.youtube.com/watch?v=CxVTddcTLLw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=104 ','https://www.youtube.com/watch?v=Ckx70YiA3D0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=103 ','https://www.youtube.com/watch?v=nBnFaLe4uGE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=102 ','https://www.youtube.com/watch?v=5D1MoVneny4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=101 ','https://www.youtube.com/watch?v=hJSSsM4uEJY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=100'];
$url2 = ['https://www.youtube.com/watch?v=23651ZOz5SI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=99 ','https://www.youtube.com/watch?v=VHlvs9m-5PA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=98 ','https://www.youtube.com/watch?v=XppRNsTJZnE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=97 ','https://www.youtube.com/watch?v=ADm_B0QUPFk&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=96 ','https://www.youtube.com/watch?v=odQ26JGGbjw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=95 ','https://www.youtube.com/watch?v=-aFEYY5KO20&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=94 ','https://www.youtube.com/watch?v=PwQQhmLrS-w&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=93 ','https://www.youtube.com/watch?v=2EhNrdj4Il8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=92 ','https://www.youtube.com/watch?v=ISYjUG7Rhio&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=91 ','https://www.youtube.com/watch?v=FZffA87hS6k&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=90 ','https://www.youtube.com/watch?v=WerU1DD1ID0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=89 ','https://www.youtube.com/watch?v=w6QGKWxoJeo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=88 ','https://www.youtube.com/watch?v=jySGGnIUpEg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=87 ','https://www.youtube.com/watch?v=j_rCYmzGwlk&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=86 ','https://www.youtube.com/watch?v=OnIrhC5u-PE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=85 ','https://www.youtube.com/watch?v=1Pjx6iN9m4M&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=84 ','https://www.youtube.com/watch?v=ZynIxmq1yxA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=83 ','https://www.youtube.com/watch?v=Nf8bK29t6Vc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=82 ','https://www.youtube.com/watch?v=7PPO0wshLn0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=81 ','https://www.youtube.com/watch?v=9jgmW8b9KoU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=80 ','https://www.youtube.com/watch?v=LJH1zQj9Vvg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=79 ','https://www.youtube.com/watch?v=ddLBQkTBSwo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=78 ','https://www.youtube.com/watch?v=hOhrx0p1M0I&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=77 ','https://www.youtube.com/watch?v=y0ab5lvpg-U&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=76 ','https://www.youtube.com/watch?v=3EoMofIymqM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=75 ','https://www.youtube.com/watch?v=uPfBBhO8Nnk&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=74 ','https://www.youtube.com/watch?v=9VXWHot3EQU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=73 ','https://www.youtube.com/watch?v=pj9tB39cOJM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=72 ','https://www.youtube.com/watch?v=IMXnOo7O6YU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=71 ','https://www.youtube.com/watch?v=tCsdv5YQAzU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=70 ','https://www.youtube.com/watch?v=a6iWmQFyNH0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=69 ','https://www.youtube.com/watch?v=dxJVta3Wofc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=68 ','https://www.youtube.com/watch?v=BMNTaFozMQA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=67 ','https://www.youtube.com/watch?v=iGoIhMwoSCY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=66 ','https://www.youtube.com/watch?v=goOACA4-b98&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=65 ','https://www.youtube.com/watch?v=uVibIkSFNPY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=64 ','https://www.youtube.com/watch?v=WAh2sSaH1OM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=63 ','https://www.youtube.com/watch?v=g2wjoNLCijA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=62 ','https://www.youtube.com/watch?v=9A0fBeJUeX0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=61 ','https://www.youtube.com/watch?v=hmBJltj2DA0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=60 ','https://www.youtube.com/watch?v=-WsmXbgza6M&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=59 ','https://www.youtube.com/watch?v=1yP1bIx_2hA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=58 ','https://www.youtube.com/watch?v=UFfWGQ0kUm0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=57 ','https://www.youtube.com/watch?v=ysY65ZWhQbg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=56 ','https://www.youtube.com/watch?v=oKrdct69qq0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=55 ','https://www.youtube.com/watch?v=OpuI9KQfO8w&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=54 ','https://www.youtube.com/watch?v=_x01dcJanbg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=53 ','https://www.youtube.com/watch?v=1nDQj3n_32M&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=52 ','https://www.youtube.com/watch?v=B_6FDfJGFM8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=51 ','https://www.youtube.com/watch?v=VJdvVOp-sVs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=50 ','https://www.youtube.com/watch?v=gHYfr56lQGM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=49 ','https://www.youtube.com/watch?v=c_zwTk6TkEc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=48 ','https://www.youtube.com/watch?v=DMIIR1e__DE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=47 ','https://www.youtube.com/watch?v=6uTCS1XFYA4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=46 ','https://www.youtube.com/watch?v=U1Ne-ISi5gM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=45 ','https://www.youtube.com/watch?v=N3mJMM9hJf8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=44 ','https://www.youtube.com/watch?v=8xJc_gI4HNw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=43 ','https://www.youtube.com/watch?v=hxw2n-X2pS8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=42 ','https://www.youtube.com/watch?v=vJF67vg3hBc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=41 ','https://www.youtube.com/watch?v=T_oz5N3Cmj4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=40 ','https://www.youtube.com/watch?v=p192my-ZaY8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=39 ','https://www.youtube.com/watch?v=hViymPTQtKY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=38 ','https://www.youtube.com/watch?v=sBjt2TmO2f0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=37 ','https://www.youtube.com/watch?v=GtL_6mwwFM4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=36 ','https://www.youtube.com/watch?v=jVDjI7q4ZFo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=35 ','https://www.youtube.com/watch?v=QGZ8_3eHpJE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=34 ','https://www.youtube.com/watch?v=mHw4vlF0r7E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=33 ','https://www.youtube.com/watch?v=d2Y02uaNueY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=32 ','https://www.youtube.com/watch?v=gDzh4Z0Ezao&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=31 ','https://www.youtube.com/watch?v=KIhQVxywc64&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=30 ','https://www.youtube.com/watch?v=bFQfqINm8es&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=29 ','https://www.youtube.com/watch?v=0h7HqldkOiI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=28 ','https://www.youtube.com/watch?v=0fe8vKHU3IM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=27 ','https://www.youtube.com/watch?v=AbvOzIxt9Hw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=26 ','https://www.youtube.com/watch?v=8eKGPXkfSvE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=25 ','https://www.youtube.com/watch?v=szGg9FNt6Oo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=24 ','https://www.youtube.com/watch?v=RdOQU3Zjhrs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=23 ','https://www.youtube.com/watch?v=mA97m9KD5XE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=22 ','https://www.youtube.com/watch?v=tVccIXjh5mU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=21 ','https://www.youtube.com/watch?v=7Xm9iFfbXHI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=20 ','https://www.youtube.com/watch?v=3M_2ef2ha0c&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=19 ','https://www.youtube.com/watch?v=biBJ-yPfuqs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=18 ','https://www.youtube.com/watch?v=-Sr7b1UNBa4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=17 ','https://www.youtube.com/watch?v=8L3R1-nyXNc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=16 ','https://www.youtube.com/watch?v=s1t41turm9E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=15 ','https://www.youtube.com/watch?v=Pk6qpWyX58Y&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=14 ','https://www.youtube.com/watch?v=n5z8q5Vg2No&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=13 ','https://www.youtube.com/watch?v=9FphDfRE7ng&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=12 ','https://www.youtube.com/watch?v=ki9JYmSTLMI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=11 ','https://www.youtube.com/watch?v=ebcQfXN6mLo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=10'];
$url3 = ['https://www.youtube.com/watch?v=ayFy6WhNbzM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=9 ','https://www.youtube.com/watch?v=eBhphySntU8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=8 ','https://www.youtube.com/watch?v=-FsDQiYBkBs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=7 ','https://www.youtube.com/watch?v=9_5XAjFTW6A&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=6 ','https://www.youtube.com/watch?v=MlMCbnNr4LM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=5 ','https://www.youtube.com/watch?v=Rx8h51Q_NHM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=4 ','https://www.youtube.com/watch?v=u5cCjy7ccUE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=3 ','https://www.youtube.com/watch?v=mi7LOVzKh_U&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=2 ','https://www.youtube.com/watch?v=XayCi-_ci4o&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=1'];


// //insertするときの最初のid(※必ずチェック)
// $insert_id_first = 1221;
// for ($i=0; $i<count($url1); $i++) {
//   $url_content = $url1[$i];
//   $stmt = $dbh->query("INSERT INTO `ramen_db_tokyo` (id, youtube_url) VALUES ('$insert_id_first', '$url_content')");
//   echo $insert_id_first;
//   echo "</br>";
//   $insert_id_first++;
// }


/*****
 * 
 * $youtube_url_array ⇒ $stack (video_idの配列)
 * 
 * */
$stack = [];
for ($j=0; $j < count($youtube_url_array); $j++) {
  $yt_url = $youtube_url_array[$j];
  $yt_url2 = strstr($yt_url, 'watch?v=');
  $yt_url3 = strstr($yt_url2, '&list=', true);
  $yt_url4 = str_replace('watch?v=', '', $yt_url3);
  array_push($stack, $yt_url4);
}
//video_idを表示
//print_r($stack);


/**
 * 
 * video_idをUPDATE
 * 
 */
//updateするときの最初のid(※必ずチェック)
// $update_videoid_first = 1221;
// for ($i=0; $i<count($stack); $i++) {
//   $video_id_content = $stack[$i];
//   $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`video_id`='".$video_id_content."'WHERE id = '".$update_videoid_first."'");
//   echo $i;
//   echo "<br />";
//   $update_videoid_first++;
// }




/**
 * 
 * $stackに配列として入っているvideo_idから、店名の配列を作成
 * 
 */

// foreach ($stack as $video_id) {
//   $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=AIzaSyDowI75TIuk3j4UAkp2kGeKUlqyH3X1tuw&part=snippet,contentDetails,statistics,status";
//   $json = file_get_contents($get_api_url);
//   $getData = json_decode( $json , true);

//   foreach((array)$getData['items'] as $key => $gDat){
//   	$description = $gDat['snippet']['description'];

//     $result = strstr($description, '【本日の');
//     $result2 = str_replace('食べログＵＲＬ', '', $result);
//     $result3 = strstr($result2, 'http://tabelog', true);
//     $result31 = strstr($result2, 'https://tabelog', true);

//     $replace4 = str_replace('【本日のお店情報】', "'),('", $result3);
//     $replace5 = str_replace('【本日のラーメン情報】', "'),('", $replace4);
//     $replace6 = str_replace('【本日のお店】', "'),('", $replace5);
//     $replace41 = str_replace('【本日のお店情報】', "'),('", $result31);
//     $replace51 = str_replace('【本日のラーメン情報】', "'),('", $replace41);
//     $replace61 = str_replace('【本日のお店】', "'),('", $replace51);

//     echo $replace6;
//     echo $replace61;
// }
// }

//PDOでデータベース操作 INSERT UPDATE


/**
 * 
 * pdo_latlng.php に移動
 * 座標を取得する
 * 
 */

/**
 * 
 * 住所・座標をいれる
 * 
 */
$address_1 = [(' まぜそば (麺)マゼロー 小岩店 東京都江戸川区南小岩8-14-7 第2杉浦ビルディング '),(' 河辺大勝軒 東京都青梅市師岡町3-19-8 102 '),(' つけ麺 たけもと 東京都大田区南雪谷2-12-6 '),(' さつまっこ 平和島店 東京都大田区大森本町2-27-7 '),(' ラーメン鷹の目 北千住店 東京都足立区千住2-29 '),(' 麺屋こころ 自由が丘店 東京都目黒区自由が丘1-13-10 山田ビル 1F '),(' ラーメンショップ マルキチェーン拝島店 東京都昭島市松原町4-13-20 '),(' 勢得 東京都世田谷区桜丘3-24-4 '),(' らぁ麺や 嶋 東京都渋谷区本町3-41-12 '),(' ぱたぱた家 東京都立川市羽衣町2-45-11 32')];
$latlng1 = [35.689761,139.7706115,35.6728296,139.7365492,35.6588489,139.3358428,35.7018808,139.3901227,35.7322436,139.7293673,35.5618597,139.7125216,35.6929241,139.6983149,35.7257168,139.5877895,35.7687448,139.8713463,35.6500979,139.68688];

//配列の個数を調べる

//echo $lat_aomori2.$rrr;
//echo count($lat_aomori2);


//UPDATE用

/**
 * 
 * 住所をUPDATE
 * 
 */

// $update_first = 1221;
// for ($i=0; $i<count($address_3); $i++) {
//   $key = $address_3[$i];
//   $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`name_address`='".$key."'WHERE id = '".$update_first."'");
//   echo $update_first;
//   echo "<br />";
//   $update_first++;
// }


/**
 * 
 * 緯度・経度をUPDATE
 * 
 */

// $id_start = 1221;
// $i = 0;
// //&iには配列の２倍の数を入れる
// while ($i < 2*count($latlng7)) {
//   $key = $latlng7[$i];
//   $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`latitude`='".$key."'WHERE id = '".$id_start."'");
//   $i++;
//   $key = $latlng7[$i];
//   $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`longitude`='".$key."'WHERE id = '".$id_start."'");
//   echo $id_start;
//   $id_start++;
//   $i++;
// }


/**
 * 
 * name_addressを店名＋住所に切り分ける
 * sqlが入っているので実行時に確認する
 * 
 * 
 */

// $DB_table_name = 'ramen_db_tokyo';
// $output_db_array = $dbc->getAllRequest($DB_table_name);
// $array = json_decode($output_db_array , true);
// //print_r($array);
// $stack = array();


// //id入力！
// $j = 1221;
// $kiriwake_id_start = 1171;
// for ($i = $kiriwake_id_start; $i < ($kiriwake_id_start+10); $i++) {
// $bn1_id = $array[$i]["id"];
// $bn1_na = $array[$i]["name_address"];

// if (strpos($bn1_na, '東京都')){
//   $str = strstr($bn1_na, '東京都',true);
//   echo $str;
//   $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`stores_name`='".$str."'WHERE id = '".$j."'");
//   array_push($stack, $str);
//   $j++;
// } else {
//   $str = '#####';
//   echo $str;
//   $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`stores_name`='".$str."'WHERE id = '".$j."'");
//   array_push($stack, $str);
//   $j++;
// }
// }



/**
 * 
 * ここまで
 * 
 */



//INSERT用

//
$url1 = ['https://www.youtube.com/watch?v=StnYrArRfDM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=110 ','https://www.youtube.com/watch?v=IZE38Q8uHn8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=109 ','https://www.youtube.com/watch?v=_gsYGdOlA4I&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=108 ','https://www.youtube.com/watch?v=_ZOYGi3OZYE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=107 ','https://www.youtube.com/watch?v=GSqkOjHgvnA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=106 ','https://www.youtube.com/watch?v=VqoO9qOeD4E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=105 ','https://www.youtube.com/watch?v=CxVTddcTLLw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=104 ','https://www.youtube.com/watch?v=Ckx70YiA3D0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=103 ','https://www.youtube.com/watch?v=nBnFaLe4uGE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=102 ','https://www.youtube.com/watch?v=5D1MoVneny4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=101 ','https://www.youtube.com/watch?v=hJSSsM4uEJY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=100'];
$url2 = ['https://www.youtube.com/watch?v=23651ZOz5SI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=99 ','https://www.youtube.com/watch?v=VHlvs9m-5PA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=98 ','https://www.youtube.com/watch?v=XppRNsTJZnE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=97 ','https://www.youtube.com/watch?v=ADm_B0QUPFk&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=96 ','https://www.youtube.com/watch?v=odQ26JGGbjw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=95 ','https://www.youtube.com/watch?v=-aFEYY5KO20&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=94 ','https://www.youtube.com/watch?v=PwQQhmLrS-w&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=93 ','https://www.youtube.com/watch?v=2EhNrdj4Il8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=92 ','https://www.youtube.com/watch?v=ISYjUG7Rhio&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=91 ','https://www.youtube.com/watch?v=FZffA87hS6k&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=90 ','https://www.youtube.com/watch?v=WerU1DD1ID0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=89 ','https://www.youtube.com/watch?v=w6QGKWxoJeo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=88 ','https://www.youtube.com/watch?v=jySGGnIUpEg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=87 ','https://www.youtube.com/watch?v=j_rCYmzGwlk&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=86 ','https://www.youtube.com/watch?v=OnIrhC5u-PE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=85 ','https://www.youtube.com/watch?v=1Pjx6iN9m4M&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=84 ','https://www.youtube.com/watch?v=ZynIxmq1yxA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=83 ','https://www.youtube.com/watch?v=Nf8bK29t6Vc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=82 ','https://www.youtube.com/watch?v=7PPO0wshLn0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=81 ','https://www.youtube.com/watch?v=9jgmW8b9KoU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=80 ','https://www.youtube.com/watch?v=LJH1zQj9Vvg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=79 ','https://www.youtube.com/watch?v=ddLBQkTBSwo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=78 ','https://www.youtube.com/watch?v=hOhrx0p1M0I&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=77 ','https://www.youtube.com/watch?v=y0ab5lvpg-U&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=76 ','https://www.youtube.com/watch?v=3EoMofIymqM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=75 ','https://www.youtube.com/watch?v=uPfBBhO8Nnk&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=74 ','https://www.youtube.com/watch?v=9VXWHot3EQU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=73 ','https://www.youtube.com/watch?v=pj9tB39cOJM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=72 ','https://www.youtube.com/watch?v=IMXnOo7O6YU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=71 ','https://www.youtube.com/watch?v=tCsdv5YQAzU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=70 ','https://www.youtube.com/watch?v=a6iWmQFyNH0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=69 ','https://www.youtube.com/watch?v=dxJVta3Wofc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=68 ','https://www.youtube.com/watch?v=BMNTaFozMQA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=67 ','https://www.youtube.com/watch?v=iGoIhMwoSCY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=66 ','https://www.youtube.com/watch?v=goOACA4-b98&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=65 ','https://www.youtube.com/watch?v=uVibIkSFNPY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=64 ','https://www.youtube.com/watch?v=WAh2sSaH1OM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=63 ','https://www.youtube.com/watch?v=g2wjoNLCijA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=62 ','https://www.youtube.com/watch?v=9A0fBeJUeX0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=61 ','https://www.youtube.com/watch?v=hmBJltj2DA0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=60 ','https://www.youtube.com/watch?v=-WsmXbgza6M&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=59 ','https://www.youtube.com/watch?v=1yP1bIx_2hA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=58 ','https://www.youtube.com/watch?v=UFfWGQ0kUm0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=57 ','https://www.youtube.com/watch?v=ysY65ZWhQbg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=56 ','https://www.youtube.com/watch?v=oKrdct69qq0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=55 ','https://www.youtube.com/watch?v=OpuI9KQfO8w&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=54 ','https://www.youtube.com/watch?v=_x01dcJanbg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=53 ','https://www.youtube.com/watch?v=1nDQj3n_32M&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=52 ','https://www.youtube.com/watch?v=B_6FDfJGFM8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=51 ','https://www.youtube.com/watch?v=VJdvVOp-sVs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=50 ','https://www.youtube.com/watch?v=gHYfr56lQGM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=49 ','https://www.youtube.com/watch?v=c_zwTk6TkEc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=48 ','https://www.youtube.com/watch?v=DMIIR1e__DE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=47 ','https://www.youtube.com/watch?v=6uTCS1XFYA4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=46 ','https://www.youtube.com/watch?v=U1Ne-ISi5gM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=45 ','https://www.youtube.com/watch?v=N3mJMM9hJf8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=44 ','https://www.youtube.com/watch?v=8xJc_gI4HNw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=43 ','https://www.youtube.com/watch?v=hxw2n-X2pS8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=42 ','https://www.youtube.com/watch?v=vJF67vg3hBc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=41 ','https://www.youtube.com/watch?v=T_oz5N3Cmj4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=40 ','https://www.youtube.com/watch?v=p192my-ZaY8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=39 ','https://www.youtube.com/watch?v=hViymPTQtKY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=38 ','https://www.youtube.com/watch?v=sBjt2TmO2f0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=37 ','https://www.youtube.com/watch?v=GtL_6mwwFM4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=36 ','https://www.youtube.com/watch?v=jVDjI7q4ZFo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=35 ','https://www.youtube.com/watch?v=QGZ8_3eHpJE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=34 ','https://www.youtube.com/watch?v=mHw4vlF0r7E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=33 ','https://www.youtube.com/watch?v=d2Y02uaNueY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=32 ','https://www.youtube.com/watch?v=gDzh4Z0Ezao&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=31 ','https://www.youtube.com/watch?v=KIhQVxywc64&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=30 ','https://www.youtube.com/watch?v=bFQfqINm8es&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=29 ','https://www.youtube.com/watch?v=0h7HqldkOiI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=28 ','https://www.youtube.com/watch?v=0fe8vKHU3IM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=27 ','https://www.youtube.com/watch?v=AbvOzIxt9Hw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=26 ','https://www.youtube.com/watch?v=8eKGPXkfSvE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=25 ','https://www.youtube.com/watch?v=szGg9FNt6Oo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=24 ','https://www.youtube.com/watch?v=RdOQU3Zjhrs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=23 ','https://www.youtube.com/watch?v=mA97m9KD5XE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=22 ','https://www.youtube.com/watch?v=tVccIXjh5mU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=21 ','https://www.youtube.com/watch?v=7Xm9iFfbXHI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=20 ','https://www.youtube.com/watch?v=3M_2ef2ha0c&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=19 ','https://www.youtube.com/watch?v=biBJ-yPfuqs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=18 ','https://www.youtube.com/watch?v=-Sr7b1UNBa4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=17 ','https://www.youtube.com/watch?v=8L3R1-nyXNc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=16 ','https://www.youtube.com/watch?v=s1t41turm9E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=15 ','https://www.youtube.com/watch?v=Pk6qpWyX58Y&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=14 ','https://www.youtube.com/watch?v=n5z8q5Vg2No&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=13 ','https://www.youtube.com/watch?v=9FphDfRE7ng&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=12 ','https://www.youtube.com/watch?v=ki9JYmSTLMI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=11 ','https://www.youtube.com/watch?v=ebcQfXN6mLo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=10'];
$url3 = ['https://www.youtube.com/watch?v=ayFy6WhNbzM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=9 ','https://www.youtube.com/watch?v=eBhphySntU8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=8 ','https://www.youtube.com/watch?v=-FsDQiYBkBs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=7 ','https://www.youtube.com/watch?v=9_5XAjFTW6A&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=6 ','https://www.youtube.com/watch?v=MlMCbnNr4LM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=5 ','https://www.youtube.com/watch?v=Rx8h51Q_NHM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=4 ','https://www.youtube.com/watch?v=u5cCjy7ccUE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=3 ','https://www.youtube.com/watch?v=mi7LOVzKh_U&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=2 ','https://www.youtube.com/watch?v=XayCi-_ci4o&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=1'];


// //insertするときの最初のid(※必ずチェック)
// $insert_id_first = 1221;
// for ($i=0; $i<count($url3); $i++) {
//   $url_content = $url2[$i];
//   $stmt = $dbh->query("INSERT INTO `ramen_db_tokyo` (id, youtube_url) VALUES ('$insert_id_first', '$url_content')");
//   echo $insert_id_first;
//   echo "</br>";
//   $insert_id_first++;
// }

$arrrrry = [(' らーめん飛粋 東京都大田区蒲田5-2-5 '),(' 池谷精肉店 東京都あきる野市秋川1-2-5 '),(' 麺屋 周郷 東京都港区新橋4-19-1 '),(' 札幌味噌らーめん ひつじの木 大森本店 東京都大田区大森北1-3-9 春日ビル 1F '),(' 中華蕎麦 はる 東京都杉並区下井草3-30-14 '),(' 麺 やまらぁ 東京都中央区日本橋人形町2-29-3 '),(' 入鹿TOKYO 六本木 東京都港区六本木4-12-12 穂高ビル 1F '),(' らぁ麺 はやし田 池袋店 東京都豊島区東池袋1-40-10 川又ビル1F '),(' らーめん平太周 神保町店 東京都千代田区神田神保町1-12-1 富田ビル 1F '),(' 中華そば 西川 東京都世田谷区砧2-15-10 メゾンドオーポン 1F '),(' 自家製麺 ロビンソン 東京都港区虎ノ門1-16-9 双葉ビル 1F '),(' ふく流らーめん 轍 東京高田馬場本店 東京都新宿区高田馬場2-14-3 三桂ビル 1F '),(' 喜多方屋 本店 東京都板橋区板橋3-27-3 '),(' 自家製麺 まさき 東京都昭島市福島町1011-13 '),(' 楓 東京都八王子市大和田町5-10-1 '),(' 西満ラーメン 東京都町田市相原町4449-1 '),(' 成城青果 東京都世田谷区南烏山3-1-11 '),(' 中華そば 吾衛門 東京都八王子市千人町3-3-3 '),(' 中洲屋台長浜ラーメン初代 健太 東京都中野区大和町1-66-6 '),(' つけめん金龍 東京都千代田区神田司町2-15-16 サトウビル 1F '),('天下一品 中野店 東京都中野区新井1-9-3'),(' ぱたぱた家 東京都立川市羽衣町2-45-11 '),(' らぁ麺や 嶋 東京都渋谷区本町3-41-12 '),(' 勢得 東京都世田谷区桜丘3-24-4 '),(' ラーメンショップ マルキチェーン拝島店 東京都昭島市松原町4-13-20 '),(' 麺屋こころ 自由が丘店 東京都目黒区自由が丘1-13-10 山田ビル 1F '),(' ラーメン鷹の目 北千住店 東京都足立区千住2-29 '),(' さつまっこ 平和島店 東京都大田区大森本町2-27-7 '),(' つけ麺 たけもと 東京都大田区南雪谷2-12-6 '),(' 河辺大勝軒 東京都青梅市師岡町3-19-8 102 '),(' まぜそば (麺)マゼロー 小岩店 東京都江戸川区南小岩8-14-7 第2杉浦ビルディング'),('台湾まぜそば 禁断のとびら 池袋東口総本店 東京都豊島区東池袋2-60-21')];
echo count($arrrrry);


//DELETE用
/*
$insert_id_first = 20;
for ($i=0; $i<10; $i++) {
  $key = $url_aomori2[$i];
  $stmt = $dbh->query("DELETE FROM `ramen_db_aomori` (id, youtube_url) VALUES ('$insert_id_first', '$key')");
  echo $insert_id_first;
  $insert_id_first++;
}
*/

/**
 * 
 * 概要欄からTitleを取得する
 * 
 */

// $stack_title = [];
// for($i=0;$i<$num;$i++){
//   $get_api_url = sprintf('https://www.googleapis.com/youtube/v3/videos?id=%s&key=AIzaSyDowI75TIuk3j4UAkp2kGeKUlqyH3X1tuw&part=snippet,contentDetails,statistics,status', $stack_videoid[$i][0]);
//   $json = file_get_contents($get_api_url);

//   $getData = json_decode($json , true);

//   foreach((array)$getData['items'] as $key => $gDat){
//   	$description = $gDat['snippet']['description'];
//     $title = $gDat['snippet']['title'];
//     //echo $description;
//     //echo $title;
//     array_push($stack_title, $title);
//   }
//   //print_r($stack_videoid[$i][0]);
// }

// titleの配列
//print_r($stack_title);

//最初のID
// $update_first = 1001;
// for ($i=0; $i<count($stack_title); $i++) {
//   $key = $stack_title[$i];
//   $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`title`='".$key."'WHERE id = '".$update_first."'");
//   echo $update_first;
//   echo "<br />";
//   $update_first++;
// }

/**
 * 
 * video_idの配列を作成する
 * 
 */

// $stack_videoid = [];

// $num = 229;

// for($i=1001;$i<=1229;$i++){
//   $stmt = $dbh->query("select video_id from  `ramen_db_tokyo` WHERE id = '".$i."'");
//   $result = $stmt->fetchall(PDO::FETCH_COLUMN);
//   array_push($stack_videoid, $result);
// }
// print_r($stack_videoid);





?>
