<?php
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
require('dbc.php');
$dbc = new Dbc;
$user_lat = (int)$_POST['no'];

//var_dump($user_lat);
$user_lng = (int)$_POST['no2'];
//echo $user_lat;
//echo $user_lng;
$user_coordinate = [$user_lat, $user_lng];
//var_dump('------------------');
//gettype($user_coordinate[0]);
//var_dump('------------------');
//var_dump($user_coordinate);
$output = $dbc->searchByDistance($user_coordinate[0], $user_coordinate[1]);
echo json_encode($output);
exit;
//$output2 = $dbc->searchByDistance(35.6901, 139.6993);
//var_dump($output);
//var_dump($output2);
//$output = $dbc->searchByDistance($user_coordinate[0], $user_coordinate[0]);


//途中までajaxで実装しようと思ったができなかったので以下に残しておく
/*
$.ajax({
    url: 'search_ajax.php',
    type: 'POST',
    dataType: 'json',
    data: { no : position.coords.latitude,
            no2: position.coords.longitude}
}).done(function(data){
    console.log(data);
    function is_json(data) {
     try {
       JSON.parse(data);
     } catch (error) {
       return false;
     }
     return true;
   }
   console.log(is_json(data));

    console.log('uuuuuuu');
    console.log(typeof data);
      var sr_arr_map = $.each(data, function(index, val) {
      var rObj = {}
      console.log(val);
      rObj.name_address = val['name_address']
      console.log(rObj.name_address);
      //rObj.video_id = obj.youtube_url.substring(32, 43)
      //let yt_url = obj.substr(obj.indexOf('watch?v='), obj.indexOf('&'));
      //rObj.video_id = yt_url.replace('watch?v=', '')
      rObj.video_id = String(val['youtube_url']).match(/\?v=([^&]+)/)[1]
      rObj.youtube_url = val['youtube_url']
      rObj.distance = val['distance'].substring(0, 4)
      return rObj
    });
    console.log('^^^^^^^^^^^^^^');
    console.log(sr_arr_map);
    //$('.result').text(data);
    */
?>
