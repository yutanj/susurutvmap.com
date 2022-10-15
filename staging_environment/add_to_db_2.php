<?php
//住所から座標を取得する．
require('dbc.php');
error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();
?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDodZcfXqmf6oAGQs4wTLzCWz2mTwZY-qE"></script>
   </head>
   <body>
     <script>
       var a0 = [];
       //input_place に店名の配列を入れる
       input_place = [(' 超絶濃厚鶏そば きりすて御麺 東京都品川区小山台1-33-11 アネックスかむろ坂 1F '),(' 駄目な隣人 新宿店 東京都新宿区歌舞伎町1-27-2 1F '),('らあめん花月嵐 荻窪西口店 東京都杉並区上荻1-10-7'),(' ラーメン富士丸 神谷本店 東京都北区神谷3-29-11 '),(' ワンタンメンの満月 三鷹店 東京都三鷹市下連雀4-16-15 東洋三鷹コーポ 1F '),(' 元祖スタミナ満点らーめん すず鬼 東京都三鷹市下連雀3-28-21 公団三鷹駅前第2アパート B1F '),(' ヌードルボウズ n坊 東京都台東区浅草橋1-33-5 むさしやビル 1F '),(' 麺や独歩 東京都昭島市中神町1157-55 '),(' Ramen FeeL 東京都青梅市梅郷4-695-1 9')];
       console.log(input_place.length);
       var geocoder = new google.maps.Geocoder();
       for (let v=0; v<=8; v++) {
       var geocode_user_location = geocoder.geocode({
         address: input_place[v]
       }, function(results, status) {
         //console.log(input_place[i]);
         //console.log(google.maps.GeocoderStatus);
         if (status == google.maps.GeocoderStatus.OK) {
           //console.log('google.maps.GeocoderStatus.OKです');
           var bounds = new google.maps.LatLngBounds();

           for (var i in results) {
             if (results[0].geometry) {

               var user_lat = results[0].geometry.location.lat();
               var user_lng = results[0].geometry.location.lng();
               var user_location = [user_lat, user_lng];

               a0[v] = user_location;
               (function(a0) {
                 setTimeout(function() {
                     console.log(a0);
                 }, 10000);
             })(v);
               document.getElementById('a0_writter').textContent = a0;
             }
           }
         } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
           alert("見つかりません");
         } else {
           console.log(status);
           alert("エラー発生");
         }
       });
     }
     </script>
     <div id="a0_writter"></div>
     </script>
   </body>
 </html>
