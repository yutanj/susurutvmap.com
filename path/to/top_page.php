<?php
require_once('dbc.php');
error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;

if (!isset($_POST['prefecture'])) {
    var_dump('Eメールアドレスが送信されていません');
    $request = $dbc->getAllRequestf();
} elseif ($_POST['prefecture'] === '') {
    var_dump('Eメールアドレスが入力されていません');
} else {
    $DB_table_name = $_POST['prefecture'];
    $request = $dbc->getAllRequest($DB_table_name);
    //var_dump('postされています');
    $_POST['prefecture'] == '';
    var_dump($_POST['prefecture']);
}

//一時的にコメントアウト 上で$requestに代入
//$request = $dbc->getAllRequest();
$DB_table_name_json = json_encode($DB_table_name, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
$user_input_array = $dbc->output_db_array_proto($request);
$output_db_json = json_encode($user_input_array, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>開発環境</title>
  <link rel="stylesheet" href="top_page.css">
  <meta name="description" content="YouTuber SUSURU TV.さんが紹介したラーメン店を地図上から探すことができます。">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GNTCWSEP0G');
</script>
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<style type="text/css">
@keyframes heartAnimation {
0% {
/* アイコンサイズをもとのより小さくする */
transform: scale(0.5);
}
10% {
transform: scale(0.7);
}
30% {
transform: scale(0.9);
}
50% {
transform: scale(1.2);
}
80% {
transform: scale(1.5);
}
100% {
/* もとのサイズに戻す */
transform: scale(1.0);
}
}
.LikesIcon-fa-heart{
font-size: 30px;
}
.LikesIcon-fa-heart.heart{
/* heartAnimationアニメーションを200ミリ秒かけて実行する */
animation: heartAnimation .2s;
/* アイコン色を黒から赤へ変更する */
color: #e2264d;
}

</style>
</head>
<body>
  <header>
    <div>
      <h1>SUSURU TV. map</h1>
      <h2>SUSURU TV.で紹介された近くのラーメン店</h2>
    </div>
    <nav class="header_nav">
      <ul>
        <li><a class="nav_list" href="about_website.html">使い方</a></li>
        <li><a class="nav_list" href="https://docs.google.com/forms/d/e/1FAIpQLScBeeJlCakzFg-Y3H_bQVE7KnjgCuIa_3kxGSuSvndNFFInpQ/viewform?usp=sf_link">お問い合わせ</a></li>
      </ul>
    </nav>
  </header>

  <div id="map"></div>
  <div class="btn_wrapper">
    <a href="#" id="get_current_position" class="btn btn--orange">現在地付近の<br class="br-sp"/>お店を探す</a>
  </div>

  <p>都道府県を選択してください</p>
  <form action="top_page.php" method = "POST">
    <select name= "prefecture">
      <option selected>選択してください</option>
      <option value = 'current_location'>現在地付近から探す</option>
      <option value= 'ramen_db_hokkaido'>北海道</option>
      <option value= 'ramen_db_aomori'>青森県</option>
      <option value= 'ramen_db_iwate'>岩手県</option>
      <option value= 'ramen_db_miyagi'>宮城県</option>
      <option value= 'ramen_db_akita'>秋田県</option>
      <option value= 'ramen_db_yamagata'>山形県</option>
      <option value= 'ramen_db_fukushima'>福島県</option>
      <option value= 'ramen_db_ibaraki'>茨城県</option>
      <option value= 'ramen_db_tochigi'>栃木県</option>
      <option value="群馬県">群馬県</option>
      <option value="埼玉県">埼玉県</option>
      <option value= 'ramen_db_chiba'>千葉県</option>
      <option value= 'ramen_db_tokyo'>東京都</option>
      <option value= 'ramen_db_kanagawa'>神奈川県</option>
      <option value= 'ramen_db_niigata'>新潟県</option>
      <option value= 'ramen_db_toyama'>富山県</option>
      <option value= 'ramen_db_ishikawa'>石川県</option>
      <option value= 'ramen_db_fukui'>福井県</option>
      <option value="山梨県">山梨県</option>
      <option value="長野県">長野県</option>
      <option value= 'ramen_db_gifu'>岐阜県</option>
      <option value="静岡県">静岡県</option>
      <option value="愛知県">愛知県</option>
      <option value= 'ramen_db_mie'>三重県</option>
      <option value= 'ramen_db_shiga'>滋賀県</option>
      <option value= 'ramen_db_kyoto'>京都府</option>
      <option value= 'ramen_db_osaka'>大阪府</option>
      <option value= 'ramen_db_hyogo'>兵庫県</option>
      <option value="奈良県">奈良県</option>
      <option value= 'ramen_db_wakayama'>和歌山県</option>
      <option value="鳥取県">鳥取県</option>
      <option value="島根県">島根県</option>
      <option value="岡山県">岡山県</option>
      <option value="広島県">広島県</option>
      <option value="山口県">山口県</option>
      <option value= 'ramen_db_tokushima'>徳島県</option>
      <option value= 'ramen_db_kagawa'>香川県</option>
      <option value= 'ramen_db_ehime'>愛媛県</option>
      <option value= 'ramen_db_kochi'>高知県</option>
      <option value="福岡県">福岡県</option>
      <option value="佐賀県">佐賀県</option>
      <option value="長崎県">長崎県</option>
      <option value="熊本県">熊本県</option>
      <option value="大分県">大分県</option>
      <option value="宮崎県">宮崎県</option>
      <option value="鹿児島県">鹿児島県</option>
      <option value="沖縄県">沖縄県</option>
    </select>
    <input type="submit"name="submit"value="送信"/>
  </form>

  <div align="center">
    <!--<a href="https://px.a8.net/svt/ejp?a8mat=3HC6R6+A079RM+4R6I+601S1" rel="nofollow">
<img class="ad_img" border="0" width="300" height="250" alt="" src="https://www25.a8.net/svt/bgt?aid=210520626605&wid=001&eno=01&mid=s00000022185001008000&mc=1"></a>
<img border="0" width="1" height="1" src="https://www15.a8.net/0.gif?a8mat=3HC6R6+A079RM+4R6I+601S1" alt="">
-->
  </div>

  <footer>
    <div class="footer_wrapper">
      <p class="footer_copyright">© 2021 SUSURU TV. maps</p>
    </div>
    <button id="clear">localStorage全削除</button>
    <!--
    <button id="remove_from_likelist">削除</button>
    <button id="test_btn">test_btn</button>
  -->
  </footer>
  <script>
  /*
  var testBtn = document.getElementById('test_btn');
  testBtn.addEventListener('click', function(){
    console.log('testBtn関数！');
  });
  */
  //
  $('#clear').click(function() {
      localStorage.clear();
      showStorage();
  });

  const js_test = <?php echo $output_db_json; ?>;
  //console.log('js_test1↓');
  //console.log(js_test);
  const pref = <?php echo $DB_table_name_json; ?>;
  //console.log('pref1↓');
  //console.log(pref);
  //console.log(js_test);
  //一番大元の関数
  function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 9,
      center: { lat: 35.730630, lng: 139.710763},
      gestureHandling: 'greedy',
      fullscreenControl: true
      /*styles: */
    });
    setMarkers(map);
    getCurrentPosition(map);
    selectedPrefecture(pref, map);
  }
  //選択した都道府県に移動
　function selectedPrefecture(prefecture, map) {
    if (prefecture == 'ramen_db_tokyo') {
        user_prefecture = 'tokyo';
        console.log('user_prefecture is tokyo');
        let latlng = new google.maps.LatLng(35.6585, 139.7454);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_hokkaido') {
        user_prefecture = 'hokkaido';
        console.log('user_prefecture is hokkaido');
        let latlng = new google.maps.LatLng(43.0588, 141.3641);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_aomori') {
        user_prefecture = 'aomori';
        console.log('user_prefecture is aomori');
        let latlng = new google.maps.LatLng(40.8314, 140.7327);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_iwate') {
        user_prefecture = 'iwate';
        console.log('user_prefecture is iwate');
        let latlng = new google.maps.LatLng(39.4497, 141.1206);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_miyagi') {
        user_prefecture = 'miyagi';
        console.log('user_prefecture is miyagi');
        let latlng = new google.maps.LatLng(38.2586, 140.8813);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_akita') {
        user_prefecture = 'akita';
        console.log('user_prefecture is akita');
        let latlng = new google.maps.LatLng(39.6109, 140.2933);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_yamagata') {
        user_prefecture = 'yamagata';
        console.log('user_prefecture is yamagata');
        let latlng = new google.maps.LatLng(38.5731, 140.1288);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_fukushima') {
        user_prefecture = 'fukushima';
        console.log('user_prefecture is fukushima');
        let latlng = new google.maps.LatLng(37.3984, 140.3690);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_ibaraki') {
        user_prefecture = 'ibaraki';
        console.log('user_prefecture is ibaraki');
        let latlng = new google.maps.LatLng(36.1122, 140.2265);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_tochigi') {
        user_prefecture = 'tochigi';
        console.log('user_prefecture is tochigi');
        let latlng = new google.maps.LatLng(36.6015, 139.8436);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_chiba') {
        user_prefecture = 'chiba';
        console.log('user_prefecture is chiba');
        let latlng = new google.maps.LatLng(35.8019, 140.2263);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kanagawa') {
        user_prefecture = 'kanagawa';
        console.log('user_prefecture is kanagawa');
        let latlng = new google.maps.LatLng(35.4359, 139.5871);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_niigata') {
        user_prefecture = 'niigata';
        console.log('user_prefecture is niigata');
        let latlng = new google.maps.LatLng(37.9129, 139.0617);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_toyama') {
        user_prefecture = 'toyama';
        console.log('user_prefecture is toyama');
        let latlng = new google.maps.LatLng(36.7281, 137.0615);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_ishikawa') {
        user_prefecture = 'ishikawa';
        console.log('user_prefecture is ishikawa');
        let latlng = new google.maps.LatLng(36.514, 136.5886);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_fukui') {
        user_prefecture = 'fukui';
        console.log('user_prefecture is fukui');
        let latlng = new google.maps.LatLng(36.0639, 136.224);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_gifu') {
        user_prefecture = 'gifu';
        console.log('user_prefecture is gifu');
        let latlng = new google.maps.LatLng(36.514, 136.5886);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_mie') {
        user_prefecture = 'mie';
        console.log('user_prefecture is mie');
        let latlng = new google.maps.LatLng(34.9219, 136.6022);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_shiga') {
        user_prefecture = 'shiga';
        console.log('user_prefecture is shiga');
        let latlng = new google.maps.LatLng(35.1337, 136.1096);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_osaka') {
        user_prefecture = 'osaka';
        console.log('user_prefecture is osaka');
        let latlng = new google.maps.LatLng(34.6938, 135.5023);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kyoto') {
        user_prefecture = 'kyoto';
        console.log('user_prefecture is kyoto');
        let latlng = new google.maps.LatLng(34.9671, 135.7726);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_hyogo') {
        user_prefecture = 'hyogo';
        console.log('user_prefecture is hyogo');
        let latlng = new google.maps.LatLng(34.7369, 135.3721);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_wakayama') {
        user_prefecture = 'wakayama';
        console.log('user_prefecture is wakayama');
        let latlng = new google.maps.LatLng(33.9298, 135.5655);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_tokushima') {
        user_prefecture = 'tokushima';
        console.log('user_prefecture is tokushima');
        let latlng = new google.maps.LatLng(34.0744, 134.5430);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kagawa') {
        user_prefecture = 'kagawa';
        console.log('user_prefecture is kagawa');
        let latlng = new google.maps.LatLng(34.3461, 134.0515);
        map.setCenter(latlng);//33.829984 経度: 132.777464
    } else if (prefecture == 'ramen_db_ehime') {
        user_prefecture = 'ehime';
        console.log('user_prefecture is ehime');
        let latlng = new google.maps.LatLng(33.8299, 132.7774);
        map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kochi') {
        user_prefecture = 'kochi';
        console.log('user_prefecture is kochi');
        let latlng = new google.maps.LatLng(33.5687 ,133.5449);
        map.setCenter(latlng);
    }
    //return user_prefecture;
  }
//34.96713519669322, 135.77268179458954
  function setMarkers(map) {
    const image = {
      url: "beachflag.png",
      size: new google.maps.Size(20, 32),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(0, 32),
    };
    const shape = {
      coords: [1, 1, 1, 20, 18, 20, 18, 1],
      type: "poly",
    };
    for (let i = 0; i < js_test.length; i++) {
      const beach = js_test[i];
      //console.log(beach);
      var marker = new google.maps.Marker({
        position: { lat: parseFloat(beach[3]), lng: parseFloat(beach[4]) },
        map,
        icon: image,
        shape: shape,
        title: beach[1],
      });
      setMarkerListener(marker, beach[0], beach[1], beach[2]);
      changeMarkerSize(marker);
      console.log(js_test.length);
    }


    function setMarkerListener(marker, ramen_num, title, url) {
      // 情報ウィンドウの生成
      var infoWindow = new google.maps.InfoWindow({
        content: '<div id="infowindow_content">'+'<p id=ramen_num>'+ ramen_num +'</p>'+'<p class=infowindow_title>' +title+
        '</p>' + '<a href=' +url +' target="_blank" rel="noopener noreferrer" class=infowindow_url>動画を見る</a>'+
        /*'<button type="button" id="set_bookmark">ブックマーク</button>'+'<button type="button" id="remove_bookmark">ブックマークを解除</button>'
        +*/'<div class="LikesIcon" id="LikesIcon"><i id="likesicon_i" class="far fa-heart LikesIcon-fa-heart"></i></div></div>',
        maxWidth: 200
      });
      // '<button type="button" id="set_bookmark">ブックマーク</button>'+'<button type="button" id="remove_bookmark">ブックマークを解除</button>'
      //クリックしたらlocalstorageに追加
      var likesIcon = document.getElementById('LikesIcon');
      infoWindow.addListener("domready", function() {
        //###showStorage();
        console.log(ramen_num + '#0')
        console.log('infoWindow番号' + ramen_num);
        //もし開いた番号がlocalstorageにあれば、ハートマークのクラスを変更;
        /*
        if (localStorage.getItem(ramen_num) !== null) {
          var likesIconI = document.getElementById('likesicon_i');
          likesIconI.className = 'fas fa-heart LikesIcon-fa-heart heart';
          }
          */

        //fontawesomeのハートマーククリックイベント
        $('.LikesIcon').on('click', function() {

          let $btn = $(this);
          // Likeボタンがonクラス持っていたら
          if ($btn.hasClass('on')) {

            $btn.removeClass('on');

            // 白抜きアイコンに戻す
            $btn.children("i").attr('class', 'far fa-heart LikesIcon-fa-heart');
                console.log('removebookmarkクリック' + ramen_num);
                //var key = ramen_num;
                //### var obj = getObject();
                console.log(ramen_num + '#2');
                localStorage.removeItem(ramen_num);
                /*
                if (obj) {
                  　localStorage.removeItem(ramen_num);
                    delete obj[key];
                    setObject(obj);
                    showStorage();
                }
                */
                console.log(ramen_num + '#3');
                console.log('消し終わり' + ramen_num);
                return 0;
          } else {

            $btn.addClass('on');
            console.log(ramen_num + '#4');
            /*
            var getObject = function() {
              var str = localStorage.getItem(key);
              return JSON.parse(str);
            };

            // JSONを文字列でlocalStorageに保存
            var setObject = function(obj, ramen_num, title) {
              var str = JSON.stringify(obj);
              localStorage.setItem(key, str);
              localStorage.setItem(ramen_num, title);
            };
            */
            // ポイントは2つ！！
            // ①アイコンを変更する
            // far fa-heart（白抜きアイコン）
            // ⇒ fas fa-heart（背景色つきアイコン）
            // ②アニメーション+アイコン色変更用のheartクラスを付与する

            $btn.children("i").attr('class', 'fas fa-heart LikesIcon-fa-heart heart');
            console.log('setbookmarkクリック' + ramen_num);
            localStorage.setItem(ramen_num, title);
            //var key = ramen_num;
            /* ###
            var obj = getObject();
            if (!obj) {
                obj = new Object();
            }
            obj[key] = title;
            setObject(obj, ramen_num, title);
            showStorage();
            */ // ###
            console.log('つけ終わり' + ramen_num);
          }
        });
        //ここまでハートマーククリックボタンイベント

      });


      // マーカーのクリックイベントの関数登録
      google.maps.event.addListener(marker, 'click', function(event) {
        // 情報ウィンドウの表示
        infoWindow.open(map, marker);
      });

    }

    function changeMarkerSize(marker) {
      // ズーム値変更時
      map.addListener('zoom_changed', function() {
        //console.log('ズーム値:', map.getZoom());
        // 20未満の場合はマーカーサイズ縮小
        if(map.getZoom() >= 13 && map.getZoom() <= 15) {
          // マーカーのサイズ変更
          marker.setIcon({
            url: 'beachflag.png',
            scaledSize : new google.maps.Size(15, 24)
          });
        // 12以上の場合はマーカーサイズを戻す
      } else if (map.getZoom() <= 12){
        // マーカーのサイズ変更
        marker.setIcon({
          url: 'beachflag.png',
          scaledSize : new google.maps.Size(10, 16)
        });
      } else {
            marker.setIcon('beachflag.png');
        }
    });
  }
}
//ボタンをクリックしたら現在地を取得し座標を返す
function getCurrentPosition(map) {

  var get_cp_btn = document.getElementById("get_current_position");
  get_cp_btn.addEventListener('click', function() {
    if (navigator.geolocation) {
      // 現在地を取得
      navigator.geolocation.getCurrentPosition(
        // 取得成功した場合
        function(position) {
          // 緯度・経度を変数に格納
          var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
          map.setZoom(16);
          map.setCenter(mapLatLng);
        },
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
      );
      // Geolocation APIに対応していない
    } else {
      alert("この端末では位置情報が取得できません");
    }
  })
}
// localStorageのキー
// ### var key = "test";

// JSONデータ（初期値）
/*
var obj = {
  foo: 'aaa',
  bar: 'bbb',
  hoge: 'ccc'
};
*/
var obj = {
  aaa: 'ccc',
  ccc: 'eee',
  eee: 'ggg'
}


// localStorageに保存したデータの表示
/*
var showStorage = function() {
  $('#result').empty();
  var obj = getObject();
  for(var key in obj){
      $('#result').append('<p>' +/* key + ':' +*/ obj[key] +/* "<button id='open_infowindow'>店探す</button><button id='remove_from_likelist'>お気に入りから削除</button>"+*/ '</p>'//);
  //}

  /* 店探す・お気に入りから削除ボタンに対応　消さない！！
  var removeFromLikeList = document.getElementById('remove_from_likelist');
  removeFromLikeList.addEventListener('click', function(){
    localStorage.removeItem(ramen_num);
    console.log("removeFromLikeList");
  });
  var openInfoWindow = document.getElementById('open_infowindow');
  openInfoWindow.addEventListener('click', function(){
    console.log('openInfoWindow関数！');
    infoWindow.open(map, marker);
  })
  */
//};
// localStorageの文字列をJSONで取得
var getObject = function() {
  var str = localStorage.getItem(key);
  return JSON.parse(str);
};

// JSONを文字列でlocalStorageに保存
var setObject = function(obj, ramen_num, title) {
  var str = JSON.stringify(obj);
  localStorage.setItem(key, str);
  localStorage.setItem(ramen_num, title);
};

//店探すボタンをクリックしたら発火
/*
var openInfoWindow = document.getElementById('open_infowindow');
openInfoWindow.addEventListener('click', function(){
  infoWindow.open(map, marker);
})
*/

//お気に入りから削除ボタンをクリックしたら発火→しない   5/
/*
var removeFromLikeList = document.getElementById("remove_from_likelist");
console.log(removeFromLikeList);
removeFromLikeList.addEventListener('click', function(){
  localStorage.removeItem(ramen_num);
  console.log("removeFromLikeList");
  var key = ramen_num;
  var obj = getObject();
  if (obj) {
      delete obj[key];
      setObject(obj);
      showStorage();
  }
})
*/

/*
var setBookMark = document.getElementById("set_bookmark");
setBookMark.addEventListener('click', function(){
  var key = setBookMark.innerHTML;
  console.log(key);
});
*/


  // キーと値の追加
  /*
  var setBookMark = document.getElementById('set_bookmark');
  setBookMark.addEventListener('click', function(){
      console.log('setbookmarkクリック');
      var key = ramen_num;
      console.log(key);
      var value = title;
      var obj = getObject();
      if (!obj) {
          obj = new Object();
      }
      obj[key] = value;
      setObject(obj);
      console.log('setobject関数');
      showStorage();

  });
  */
$(function(){
  // キーで指定した値の削除

  // データの全削除
  $('#clear').click(function() {
      localStorage.clear();
      showStorage();
  });

  // 初期値をlocalStorageに保存（初回ロード時のみ）
  var data = getObject();
  if (!data) {
      setObject(obj);
  }

  // データの表示
  showStorage();
});



</script>
<script>
  //&callback=initMap
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDodZcfXqmf6oAGQs4wTLzCWz2mTwZY-qE&signed_in=true&callback=initMap"async defer></script>
</body>
</html>
