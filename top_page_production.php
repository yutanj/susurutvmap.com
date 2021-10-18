<?php
require_once('dbc_production.php');
error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
if (!isset($_POST['prefecture'])) {
    $output_db_array = $dbc->getAllRequestf();
} elseif ($_POST['prefecture'] === '') {
} else {
    $DB_table_name = $_POST['prefecture'];
    $output_db_array = $dbc->getAllRequest($DB_table_name);
    $_POST['prefecture'] == '';
}
$DB_table_name_json = json_encode($DB_table_name, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta http-equiv="x-dns-prefetch-control" content="on">
  <link rel="preconnect dns-prefetch" href="https://www.google.com/maps">
  <link rel="preconnect dns-prefetch" href="https://fonts.google.com/">
  <title>SUSURU TV.map | 近くのラーメン店</title>
  <link rel="stylesheet" href="top_page.css">
  <link rel="icon" href="favicon.ico" id="favicon">
  <meta name="description" content="YouTuber SUSURU TV.さんが紹介したラーメン店を地図上から探すことができます。">
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <!--
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GNTCWSEP0G"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-GNTCWSEP0G');
</script>
-->
</head>
<body>
  <header>
    <div>
      <h1>SUSURU TV. map</h1>
      <h2>SUSURU TV.で紹介された近くのラーメン店</h2>
    </div>
    <nav class="header_nav">
      <ul>
        <li><a class="nav_list" href="about_website.html">SUSURU TV. map   とは？</a></li>
        <li><a class="nav_list" href="https://docs.google.com/forms/d/e/1FAIpQLScBeeJlCakzFg-Y3H_bQVE7KnjgCuIa_3kxGSuSvndNFFInpQ/viewform?usp=sf_link">お問い合わせ</a></li>
      </ul>
    </nav>
  </header>
  <div id="loading">
    <div class="spinner"></div>
  </div>
  <div id="map"></div>
  <div class="btn_wrapper">
    <a href="#" id="get_current_position" class="btn btn--orange">現在地付近の<br class="br-sp"/>お店を探す</a>
    <!--<input type="button" value="ページ読み込み" onclick="initMap()">-->
  </div>
  <p>都道府県を選択してください</p>
  <form action="top_page_production.php" method = "POST">
    <select name= "prefecture">
      <option selected>選択してください</option>
      <option value= 'ramen_db_hokkaido'>北海道</option>
      <option value= 'ramen_db_aomori'>青森県</option>
      <option value= 'ramen_db_iwate'>岩手県</option>
      <option value= 'ramen_db_miyagi'>宮城県</option>
      <option value= 'ramen_db_akita'>秋田県</option>
      <option value= 'ramen_db_yamagata'>山形県</option>
      <option value= 'ramen_db_fukushima'>福島県</option>
      <option value= 'ramen_db_ibaraki'>茨城県</option>
      <option value= 'ramen_db_tochigi'>栃木県</option>
      <option value= 'ramen_db_gunma'>群馬県</option>
      <option value= 'ramen_db_saitama'>埼玉県</option>
      <option value= 'ramen_db_chiba'>千葉県</option>
      <option value= 'ramen_db_tokyo'>東京都</option>
      <option value= 'ramen_db_kanagawa'>神奈川県</option>
      <option value= 'ramen_db_niigata'>新潟県</option>
      <option value= 'ramen_db_toyama'>富山県</option>
      <option value= 'ramen_db_ishikawa'>石川県</option>
      <option value= 'ramen_db_fukui'>福井県</option>
      <option value= 'ramen_db_yamanashi'>山梨県</option>
      <option value= 'ramen_db_nagano'>長野県</option>
      <option value= 'ramen_db_gifu'>岐阜県</option>
      <option value= 'ramen_db_shizuoka'>静岡県</option>
      <option value= 'ramen_db_aichi'>愛知県</option>
      <option value= 'ramen_db_mie'>三重県</option>
      <option value= 'ramen_db_shiga'>滋賀県</option>
      <option value= 'ramen_db_kyoto'>京都府</option>
      <option value= 'ramen_db_osaka'>大阪府</option>
      <option value= 'ramen_db_hyogo'>兵庫県</option>
      <option value= 'ramen_db_nara'>奈良県</option>
      <option value= 'ramen_db_wakayama'>和歌山県</option>
      <option value= 'ramen_db_tottori'>鳥取県</option>
      <option value= 'ramen_db_shimane'>島根県</option>
      <option value= 'ramen_db_okayama'>岡山県</option>
      <option value= 'ramen_db_hiroshima'>広島県</option>
      <option value= 'ramen_db_yamaguchi'>山口県</option>
      <option value= 'ramen_db_tokushima'>徳島県</option>
      <option value= 'ramen_db_kagawa'>香川県</option>
      <option value= 'ramen_db_ehime'>愛媛県</option>
      <option value= 'ramen_db_kochi'>高知県</option>
      <option value= 'ramen_db_fukuoka'>福岡県</option>
      <option value= 'ramen_db_saga'>佐賀県</option>
      <option value= 'ramen_db_nagasaki'>長崎県</option>
      <option value= 'ramen_db_kumamoto'>熊本県</option>
      <option value= 'ramen_db_oita'>大分県</option>
      <option value= 'ramen_db_miyazaki'>宮崎県</option>
      <option value= 'ramen_db_kagoshima'>鹿児島県</option>
      <option value= 'ramen_db_okinawa'>沖縄県</option>
    </select>
    <input type="submit"name="submit"value="決定"/>
  </form>
  <!--
  <div align="center">
    <a href="https://px.a8.net/svt/ejp?a8mat=3HGHQA+7B5M5U+2CYM+65EOH" rel="nofollow">
<img border="0" width="200" height="200" alt="" src="https://www22.a8.net/svt/bgt?aid=210721474442&wid=001&eno=01&mid=s00000011011001033000&mc=1"></a>
<img border="0" width="1" height="1" src="https://www13.a8.net/0.gif?a8mat=3HGHQA+7B5M5U+2CYM+65EOH" alt="">
　</div>
　-->
  <footer>
    <div class="footer_wrapper">
      <p class="footer_copyright">© 2021 SUSURU TV. maps</p>
    </div>
  </footer>
  <script>
  const js_test = <?php echo $output_db_array; ?>;
  console.log(js_test);
  const pref = <?php echo $DB_table_name_json; ?>;
  function initMap(js_test) {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 13,
      center: {lat: 35.693047, lng: 139.699341},
      gestureHandling: 'greedy',
      fullscreenControl: true
      /*styles: */
    });
    setMarkers(map);
    getCurrentPosition(map);
    selectedPrefecture(pref, map);
  }

  function selectedPrefecture(prefecture, map) {
      if (prefecture == 'ramen_db_tokyo') {
      user_prefecture = 'tokyo';
      console.log('user_prefecture is tokyo');
      let latlng = new google.maps.LatLng(35.6585, 139.7454);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_hokkaido') {
      user_prefecture = 'hokkaido';
      let latlng = new google.maps.LatLng(43.0588, 141.3641);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_aomori') {
      user_prefecture = 'aomori';
      let latlng = new google.maps.LatLng(40.8314, 140.7327);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_iwate') {
      user_prefecture = 'iwate';
      let latlng = new google.maps.LatLng(39.4497, 141.1206);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_miyagi') {
      user_prefecture = 'miyagi';
      let latlng = new google.maps.LatLng(38.2586, 140.8813);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_akita') {
      user_prefecture = 'akita';
      let latlng = new google.maps.LatLng(39.6109, 140.2933);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_yamagata') {
      user_prefecture = 'akita';
      let latlng = new google.maps.LatLng(38.5731, 140.1288);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_fukushima') {
      user_prefecture = 'akita';
      let latlng = new google.maps.LatLng(37.3984, 140.3690);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_ibaraki') {
      user_prefecture = 'ibaraki';
      let latlng = new google.maps.LatLng(36.1122, 140.2265);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_tochigi') {
      user_prefecture = 'tochigi';
      let latlng = new google.maps.LatLng(36.6015, 139.8436);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_gunma') {
      user_prefecture = 'gunma';
      let latlng = new google.maps.LatLng(36.3705, 139.1996);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_saitama') {
      user_prefecture = 'saitama';
      let latlng = new google.maps.LatLng(35.9216, 139.6178);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_chiba') {
      user_prefecture = 'chiba';
      let latlng = new google.maps.LatLng(35.8019, 140.2263);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kanagawa') {
      user_prefecture = 'kanagawa';
      let latlng = new google.maps.LatLng(35.4359, 139.5871);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_niigata') {
      user_prefecture = 'niigata';
      let latlng = new google.maps.LatLng(37.9129, 139.0617);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_toyama') {
      user_prefecture = 'toyama';
      let latlng = new google.maps.LatLng(36.7281, 137.0615);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_ishikawa') {
      user_prefecture = 'ishikawa';
      let latlng = new google.maps.LatLng(36.514, 136.5886);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_yamanashi') {
      user_prefecture = 'yamanashi';
      let latlng = new google.maps.LatLng(35.6601, 138.5375);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_fukui') {
      user_prefecture = 'fukui';
      let latlng = new google.maps.LatLng(36.0639, 136.224);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_nagano') {
      user_prefecture = 'nagano';
      let latlng = new google.maps.LatLng(36.2384, 137.9698);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_gifu') {
      user_prefecture = 'gifu';
      let latlng = new google.maps.LatLng(36.514, 136.5886);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_shizuoka') {
      user_prefecture = 'shizuoka';
      let latlng = new google.maps.LatLng(34.979, 138.3837);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_aichi') {
      user_prefecture = 'aichi';
      let latlng = new google.maps.LatLng(34.9756, 137.1605);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_mie') {
      user_prefecture = 'mie';
      let latlng = new google.maps.LatLng(34.9219, 136.6022);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_shiga') {
      user_prefecture = 'shiga';
      let latlng = new google.maps.LatLng(35.1337, 136.1096);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_osaka') {
      user_prefecture = 'osaka';
      let latlng = new google.maps.LatLng(34.6938, 135.5023);
      map.setCenter(latlng);
  　} else if (prefecture == 'ramen_db_kyoto') {
      user_prefecture = 'kyoto';
      let latlng = new google.maps.LatLng(34.9671, 135.7726);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_hyogo') {
      user_prefecture = 'hyogo';
      let latlng = new google.maps.LatLng(34.7369, 135.3721);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_nara') {
      user_prefecture = 'nara';
      let latlng = new google.maps.LatLng(34.6353, 135.8133);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_wakayama') {
      user_prefecture = 'wakayama';
      let latlng = new google.maps.LatLng(33.9298, 135.5655);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_tottori') {
      user_prefecture = 'tottori';
      let latlng = new google.maps.LatLng(35.4664, 133.8905);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_shimane') {
      user_prefecture = 'shimane';
      let latlng = new google.maps.LatLng(35.4752, 133.0513);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_okayama') {
      user_prefecture = 'okayama';
      let latlng = new google.maps.LatLng(34.6667, 133.9179);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_hiroshima') {
      user_prefecture = 'hiroshima';
      let latlng = new google.maps.LatLng(34.3404, 132.9137);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_yamaguchi') {
      user_prefecture = 'yamaguchi';
      let latlng = new google.maps.LatLng(34.0098, 131.8654);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_tokushima') {
      user_prefecture = 'tokushima';
      let latlng = new google.maps.LatLng(34.0744, 134.5430);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kagawa') {
      user_prefecture = 'kagawa';
      let latlng = new google.maps.LatLng(34.3461, 134.0515);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_ehime') {
      user_prefecture = 'ehime';
      let latlng = new google.maps.LatLng(33.8299, 132.7774);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kochi') {
      user_prefecture = 'kochi';
      let latlng = new google.maps.LatLng(33.5687 ,133.5449);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_fukuoka') {
      user_prefecture = 'fukuoka';
      let latlng = new google.maps.LatLng(33.3215, 130.5003);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_saga') {
      user_prefecture = 'saga';
      let latlng = new google.maps.LatLng(33.2901, 130.196);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_nagasaki') {
      user_prefecture = 'nagasaki';
      let latlng = new google.maps.LatLng(32.7528, 129.8699);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kumamoto') {
      user_prefecture = 'kumamoto';
      let latlng = new google.maps.LatLng(32.8005, 130.7032);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_oita') {
      user_prefecture = 'oita';
      let latlng = new google.maps.LatLng(33.2328, 131.6088);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_miyazaki') {
      user_prefecture = 'miyazaki';
      let latlng = new google.maps.LatLng(31.874, 131.4002);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_kagoshima') {
      user_prefecture = 'kagoshima';
      let latlng = new google.maps.LatLng(31.6675, 130.6684);
      map.setCenter(latlng);
    } else if (prefecture == 'ramen_db_okinawa') {
      user_prefecture = 'okinawa';
      let latlng = new google.maps.LatLng(26.3293, 127.8045);
      map.setCenter(latlng);
    }
    }

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
      var marker = new google.maps.Marker({
        position: { lat: parseFloat(beach['latitude']), lng: parseFloat(beach['longitude']) },
        map,
        icon: image,
        shape: shape,
      });
      setMarkerListener(marker, beach['name_address'], beach['youtube_url']);
      changeMarkerSize(marker);
    }


    function setMarkerListener(marker, title, url) {
      // 情報ウィンドウの生成
      var infoWindow = new google.maps.InfoWindow({
        content: '<div id="infowindow_content">'+'<p class=infowindow_title>' + title+ '</p>' + '<a href=' +url +' target="_blank" rel="noopener noreferrer" class=infowindow_url>動画を見る</a>'+"</div>",
        maxWidth: 200
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
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDodZcfXqmf6oAGQs4wTLzCWz2mTwZY-qE&signed_in=true&callback=initMap"></script>
<script type="text/javascript">
window.onload = function() {
const spinner = document.getElementById('loading');
spinner.classList.add('loaded');
}
</script>
</body>
</html>
