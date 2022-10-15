<?php
require_once('dbc.php');
//include 'dbc.php';
//header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");
//error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
$posted_url = $_POST['url'];
$db_link = mysqli_connect( 'localhost', 'root', '785HuezRS', 'ramen_maps');

if( mysqli_connect_errno($db_link) ) {
	echo mysqli_connect_errno($db_link) . ' : ' . mysqli_connect_error($db_link);
}

mysqli_set_charset( $db_link, 'utf8');

var_dump( mysqli_real_escape_string( $db_link, $posted_url) );

$v_id_sample = "LaFiSxDIIQs";
//$ull = $dbc->videoidToGetColumn($v_id_sample);
$video_id = $dbc->urlToVideoid($posted_url);
echo $video_id;
$result_json = $dbc->videoidToGetColumn($video_id);
$result_array = json_decode($result_json, true);
//echo $result_array[""];
echo $result_array["stores_name"];
echo $result_array["stores_address"];
echo $result_array["video_id"];
echo $result_array["youtube_url"];
echo $result_array["latitude"];
echo $result_array["longitude"];
var_dump($result_array["stores_name"]);
var_dump($result_array["stores_address"]);
var_dump($result_array["video_id"]);
var_dump($result_array["youtube_url"]);
var_dump((double)$result_array["latitude"]);
var_dump((double)$result_array["longitude"]);

//var_dump($urlLatlng);
//$output_db_array = $dbc->testgetAllRequestf();
//var_dump($output_db_array);
 ?>
