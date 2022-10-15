<!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>検索機能作る</title>
     <style>
       .search-result{
         width: 90%;
         margin: 0 auto;
         border: dashed 2px #333;
       }
       .sr-container{
         display: flex;
       }
       .sr-text{
         font-size: 18px;
       }
       .sr-img{
         margin-right: 10px;
       }
       .sr-text-shopname{
         font-weight: bold;
         display: block;
         margin-top: 8px;
       }
       .sr-location{
         /*display: inline-block;*/
         display: flex;
         vertical-align: bottom;
         margin-bottom: 8px;
       }
       .sr-location-img{
         margin-right: 8px;
       }
     </style>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   </head>
   <body>
     <?php
     require('dbc.php');
     error_reporting(E_ALL & ~E_NOTICE);
     //error_reporting(0);
     $dbc = new Dbc;
     //$dbh = $dbc->dbConnectRamenMap();
     /*
     $user_lat = $_POST['no'];
     //var_dump($user_lat);
     $user_lng = $_POST['no2'];
     var_dump($user_lat);
     echo $user_lat;
     echo $user_lng;
     var_dump($user_lat);
     var_dump($user_lng);
     echo 'mmm';
     $user_coordinate = [$user_lat, $user_lng];
     echo $user_coordinate[0];
     var_dump($user_coordinate[0]);
     */


     if (isset($_GET['name'])) {
       $target_html = file_get_contents('search.php');
       $target_html = mb_convert_encoding($target_html, 'HTML-ENTITIES', 'auto');
       var_dump($target_html);

       $dom = new DOMDocument;
       @$dom->loadHTML($target_html);
       echo '--------------';
       $ul_node1 = $dom->getElementById('id1')->nodeValue;
       $ul_node2 = $dom->getElementById('id2')->nodeValue;
       var_dump($ul_node1);
       var_dump($ul_node2);
       if(preg_match("/^[0-9]+$/",$ul_node1)) {
         $output = $dbc->searchByDistance($ul_node1, $ul_node2);

         return $output;
       }
       //var_dump($output);
     }
     if (isset($_GET['name2'])) {
         $dbc->searchByKeyword();
         var_dump('2');
     }

     //URLからラーメン店を検索する
     //Coming Soon!!
     function searchByYoutubeUrl(){

     }
     ?>
     <ul id="loop-list"></ul>
     <script>
     //検索結果(search_result)を入れる
     function initMap(){
       getCurrentPosition();
     }
     /*
     const sr_arr = <?php echo $output; ?>;
     const sr_arr_map = sr_arr.map(obj => {
       let rObj = {}
       //console.log(obj);
       rObj.name_address = obj.name_address
       //rObj.video_id = obj.youtube_url.substring(32, 43)
       //let yt_url = obj.substr(obj.indexOf('watch?v='), obj.indexOf('&'));
       //rObj.video_id = yt_url.replace('watch?v=', '')
       rObj.video_id = String(obj.youtube_url).match(/\?v=([^&]+)/)[1]
       rObj.youtube_url = obj.youtube_url
       rObj.distance = obj.distance.substring(0, 4)
       return rObj
     });
     */
     //距離順に取得したURLが入っている
     //console.log(sr_arr_map);
     //console.log(sr_arr_map[5].name_address);
     function getCurrentPosition() {
     document.addEventListener("DOMContentLoaded", function(){
     var get_cp_btn = document.getElementById('kinbo');
     console.log(get_cp_btn);
     get_cp_btn.addEventListener('click', function() {
       console.log('--------');
     //ユーザー位置情報取得
     if (navigator.geolocation) {
       // 現在地を取得
       navigator.geolocation.getCurrentPosition(
         // 取得成功した場合
         function(position) {
           // 緯度・経度を変数に格納
           var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
           console.log(mapLatLng);
           // 要素を作成
           /*
            var elem1 = document.createElement('ul');
            var elem2 = document.createElement('ul');
            // id
            elem1.id = 'id1';
            elem2.id = 'id2';
            // テキスト内容
            elem1.innerHTML = position.coords.latitude;
            elem2.innerHTML = position.coords.longitude;
            // 親要素を取得
            var parent = document.getElementById('idd');

            // 要素を追加
            parent.appendChild(elem1);
            parent.appendChild(elem2);
            */
           document.getElementById('id1').textContent = position.coords.latitude;
           document.getElementById('id2').textContent = position.coords.longitude;
           console.log('--------')
         }),
           //console.log(mapLatLng);
           //return mapLatLng;

         // 取得失敗した場合
         function(error) {
           // エラーメッセージを表示
           switch(error.code) {
             case 1: // PERMISSION_DENIED
             alert("位置情報の利用が許可されていません");
             break;
             case 2: // POSITION_UNAVAILABLE
             alert("現在位置が取得できませんでした");
             break;
             case 3: // TIMEOUT
             alert("タイムアウトになりました");
             break;
             default:
             alert("その他のエラー(エラーコード:"+error.code+")");
             break;
           }
         }

       // Geolocation APIに対応していない
     } else {
       alert("この端末では位置情報が取得できません");
     }
   })
 });
}

     //
/*
     $(function(){
       //配列なので，iは0から9までの数を指定
       for (var i = 0; i < 10; i++){
         /*$('#loop-list').append('<li><img class="lazy" src="../lazyload/dummy.gif" data-original="images/'+i+'.jpg" alt="'+i+'" /><p class="caption">'+i+'</p></li>');*/
         /*$('#loop-list').append(`<div class="search-result">
           <div class="sr-container">
             <img class="sr-img" src="https://img.youtube.com/vi/${sr_arr_map[i].video_id}/mqdefault.jpg" alt="">
             <div class="sr-text">
               <a><span class="sr-text-shopname">${sr_arr_map[i].name_address}</span></a>
               <div class="sr-location"><img class="sr-location-img" src="location_navy.png" width="20" height="25"></img><span>${sr_arr_map[i].distance}km</span></div>
             </div>
           </div>
         </div>`);
       }
       });
       /*
       $(window).load(function () {
       $('.lazy').lazyload({
         effect: 'fadeIn',
         effectspeed: 1000
         });
       });
       */
     </script>
     <h1>検索画面</h1>
            Name:<input type="text" name="keyword"><br>
            近くの店を検索：<a href='search.php?name=true' id='kinbo'>近傍検索</a>
            キーワード検索：<a href='search.php?name2=true'>店名検索</a>
            <ul id="id1">

            </ul>
            <ul id="id2">

            </ul>
   <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDodZcfXqmf6oAGQs4wTLzCWz2mTwZY-qE&callback=initMap"></script>
   </body>
 </html>
