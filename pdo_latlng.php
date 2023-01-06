<?php
require('dbc.php');
error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();
/**
 * 
 * 住所から座標を取得する
 * 
 */
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
       /*(' らーめん飛粋 東京都大田区蒲田5-2-5 '),(' 池谷精肉店 東京都あきる野市秋川1-2-5 '),(' 麺屋 周郷 東京都港区新橋4-19-1 '),(' 札幌味噌らーめん ひつじの木 大森本店 東京都大田区大森北1-3-9 春日ビル 1F '),(' 中華蕎麦 はる 東京都杉並区下井草3-30-14 '),(' 麺 やまらぁ 東京都中央区日本橋人形町2-29-3 '),(' 入鹿TOKYO 六本木 東京都港区六本木4-12-12 穂高ビル 1F '),(' らぁ麺 はやし田 池袋店 東京都豊島区東池袋1-40-10 川又ビル1F '),(' らーめん平太周 神保町店 東京都千代田区神田神保町1-12-1 富田ビル 1F '),(' 中華そば 西川 東京都世田谷区砧2-15-10 メゾンドオーポン 1F '),(' 自家製麺 ロビンソン 東京都港区虎ノ門1-16-9 双葉ビル 1F '),(' ふく流らーめん 轍 東京高田馬場本店 東京都新宿区高田馬場2-14-3 三桂ビル 1F '),(' 喜多方屋 本店 東京都板橋区板橋3-27-3 '),(' 自家製麺 まさき 東京都昭島市福島町1011-13 '),(' 楓 東京都八王子市大和田町5-10-1 '),(' 西満ラーメン 東京都町田市相原町4449-1 '),(' 成城青果 東京都世田谷区南烏山3-1-11 '),(' 中華そば 吾衛門 東京都八王子市千人町3-3-3 '),(' 中洲屋台長浜ラーメン初代 健太 東京都中野区大和町1-66-6 '),(' つけめん金龍 東京都千代田区神田司町2-15-16 サトウビル 1F '),('天下一品 中野店 東京都中野区新井1-9-3'),(' ぱたぱた家 東京都立川市羽衣町2-45-11 '),(' らぁ麺や 嶋 東京都渋谷区本町3-41-12 '),(' 勢得 東京都世田谷区桜丘3-24-4 '),(' ラーメンショップ マルキチェーン拝島店 東京都昭島市松原町4-13-20 '),(' 麺屋こころ 自由が丘店 東京都目黒区自由が丘1-13-10 山田ビル 1F '),(' ラーメン鷹の目 北千住店 東京都足立区千住2-29 '),(' さつまっこ 平和島店 東京都大田区大森本町2-27-7 '),(' つけ麺 たけもと 東京都大田区南雪谷2-12-6 '),(' 河辺大勝軒 東京都青梅市師岡町3-19-8 102 '),(' まぜそば (麺)マゼロー 小岩店 東京都江戸川区南小岩8-14-7 第2杉浦ビルディング'),('台湾まぜそば 禁断のとびら 池袋東口総本店 東京都豊島区東池袋2-60-21')*/
       //input_place に店名の配列を入れる
       input_place = [(' らぁめん 舎鈴 東京都千代田区内神田2-2-5 光正ビル 1F '),(' 弘富 東京都八王子市明神町3-11-1 '),(' 九段下 中路 東京都千代田区九段北1-7-3 '),(' ラーメン専門店 竹の家 東京都八王子市中町4-2 '),(' 一陽来福 東京都八王子市楢原町472-1 '),(' ハイデン.コッコFACTORY 刹那 東京都福生市南田園2-8-7 '),(' 麺や樽座 小宮店 東京都八王子市小宮町941-1 '),(' Dad’s Ramen 夢にでてきた中華そば 東京都目黒区自由が丘3-7-1 '),(' 担々麺 ほおずき 東京都中野区中野5-52-1 32')];
       console.log(input_place.length);
       var geocoder = new google.maps.Geocoder();
       for (let v=0; v<input_place.length; v++) {
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
