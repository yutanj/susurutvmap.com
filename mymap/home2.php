<?php
session_start();
//echo $_SESSION['user_id'];
require('../dbc.php');
header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");
//error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

if (!empty($_POST)) {
    /* 入力情報の不備を検知 */
    if ($_POST['url'] === "") {
        $error['email'] = "blank";
    }

    /* エラーがなければ次のページへ */
    if (!isset($error)) {
        $_SESSION['addfav'] = $_POST;   // フォームの内容をセッションで保存
        header('Location: add.php');   // check.phpへ移動
        exit();
    }
}
$output_db_array = $dbc->getAllRequestMymap($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="../top_page.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta http-equiv="x-dns-prefetch-control" content="on">
  <link rel="preconnect dns-prefetch" href="https://www.google.com/maps">
  <link rel="preconnect dns-prefetch" href="https://fonts.google.com/">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <title>SUSURU TV.map | 近くのラーメン店</title>

  <link rel="icon" href="../favicon.ico" id="favicon">
  <meta name="description" content="YouTuber SUSURU TV.さんが紹介したラーメン店を地図上から探すことができます。">
</head>
<body>
  <header>
    <div>
      <a href="home2.php"><img src="../header_icon_mymap.png" class="header_icon_mymap"></a>
      <!--
      <h1>SUSURU TV. map</h1>
      <h2>SUSURU TV.で紹介された近くのラーメン店</h2>
    -->
    </div>
    <!--
    <nav class="header_nav">
      <ul>
        <li><a class="nav_list" href="about_website.html">SUSURU TV. map   とは？</a></li>
        <li><a class="nav_list" href="https://docs.google.com/forms/d/e/1FAIpQLScBeeJlCakzFg-Y3H_bQVE7KnjgCuIa_3kxGSuSvndNFFInpQ/viewform?usp=sf_link">お問い合わせ</a></li>
      </ul>
    </nav>
  -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <nav class="NavMenu">
    <ul>
      <li><a href="../top_page_production.php">ホーム</a></li>
      <li><a href="about_website.html">SUSURU TV. map の使い方</a></li>
      <li><a href="../login/login.php">ログイン</a></li>
      <li><a href="../login/signup/entry.php">新規会員登録</a></li>
      <li><a href="https://docs.google.com/forms/d/e/1FAIpQLScBeeJlCakzFg-Y3H_bQVE7KnjgCuIa_3kxGSuSvndNFFInpQ/viewform?usp=sf_link">お問い合わせ</a></li>
    </ul>
  </nav>

  <!-- ハンバーガーメニュー -->
  <div class="Toggle">
    <span class="toggle-span"></span>
    <span></span>
    <span></span>
  </div>
  </header>
  <div id="loading">
    <div class="spinner"></div>
  </div>
  <!--検索窓-->
  <!--
  <form method="post" action="" class="search_container">
  <input type="text" size="100" name="url" placeholder="YouTubeのURLを入力">
  <input type="submit" value="&#xf002;">
</form>
-->

<div class="search_wrap">
  <form method="post" action="" class="Box">
  <input type="search" class="Box-SearchInput" name="url" placeholder="YouTubeのURLを入力">
  <button type="submit" class="Box-Btn" name=""><img src="https://yuyauver98.me/develop-html/blog-demo/img/area-search-icon.png" class="Box-Btn-Icon" alt=""></button>
</form>
</div>

  <div id="map"></div>

  <div class="btn_wrapper">
    <a href="#" id="get_current_position" class="btn btn--orange">現在地付近の<br class="br-sp"/>お店を探す</a>
  </div>

  <p>都道府県を選択してください</p>
  <form action="home.php" method = "POST">
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


　
  <footer>
    <div class="footer_wrapper">
      <p class="footer_copyright">© 2021 SUSURU TV. maps</p>
    </div>
  </footer>

  <script>
  const js_test = <?php echo $output_db_array; ?>;
  //const pref = <?php //echo $DB_table_name_json; ?>;
  function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 8,
      center: {lat: 35.693047, lng: 139.699341},
      //center: { lat: -28.024, lng: 140.887 },
      gestureHandling: 'greedy',
      fullscreenControl: true
      /*styles: */
    });

    setMarkers(map);
    getCurrentPosition(map);
    selectedPrefecture(pref, map);
  }
function setMarkers(map){
    var result99 = js_test.map(obj => {
      let rObj = {}
      rObj.lat = parseFloat(obj.latitude)
      rObj.lng = parseFloat(obj.longitude)
      rObj.stores_name = obj.stores_name
      rObj.stores_address = obj.stores_address
      rObj.youtube_url = obj.youtube_url
      rObj.video_id = obj.video_id
      return rObj
    });
    console.log(result99[3]);
    console.log(result99[33]);
    console.log(result99[123]);
    console.log(result99[234]);
    console.log(result99[88]);
    console.log(result99[467]);
    console.log(result99[333]);

    const markers = result99.map((location, i) => {
      const marker = new google.maps.Marker({
      position: {lat: location.lat, lng: location.lng},
    });
    const infoWindow = new google.maps.InfoWindow({
      //content: `<div id="infowindow_content"><p class=infowindow_title>${location.name_address}</p><a href= "${location.youtube_url}" target="_blank" rel="noopener noreferrer" class=infowindow_url>動画を見るaaa</a><img src="http://img.youtube.com/vi/${location.video_id}/mqdefault.jpg"></div>`,
      //content: '<div id="infowindow_content">'+'<p class=infowindow_title>' + location.name_address+ '</p>' + '<a href=' +location.youtube_url +' target="_blank" rel="noopener noreferrer" class=infowindow_url>動画を見る</a>'+"</div>",
      //'<div id="infowindow">'+'<p class=infowindow_title>' + location.stores_name+ '</p>' +'<p class=infowindow_content>' + location.stores_address+ '</p>' + '<a href=' +location.youtube_url +' target="_blank" rel="noopener noreferrer" class=infowindow_url>動画を見る</a>'+"</div>"
      maxWidth: 200,
      disableAutoPan: true,
    });
    marker.addListener("click", () => {
      infoWindow.setContent(`<div id="infowindow"><a href= "${location.youtube_url}" target="_blank" rel="noopener noreferrer"><img class="infowindow_img" src="http://img.youtube.com/vi/${location.video_id}/mqdefault.jpg"></a><p class=infowindow_title>${location.stores_name}</p><p class=infowindow_content>${location.stores_address}</p><a href= "${location.youtube_url}" target="_blank" rel="noopener noreferrer" class=infowindow_url>動画を見る</a></div>`);
      infoWindow.open(map, marker);
    });
    return marker;
  });
    //setMarkerListener(markers, location.name_address, location.youtube_url);
    new markerClusterer.MarkerClusterer({ map, markers });
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
/*
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


    //new markerClusterer.MarkerClusterer({ map, marker });
    //changeMarkerSize(marker);
    // マーカークリックしたら地名をポップアップさせる

    marker.addListener('click', () => {
      currentWindow && currentWindow.close();
      const infoWindow = new google.maps.InfoWindow({content: d.name});
      infoWindow.open(map, marker);
      currentWindow = infoWindow;
    });

  });
  */


    /*for (let i = 0; i < js_test.length; i++) {
      const beach = js_test[i];
      */
      /*
      const marker = new google.maps.Marker({
        //position: { lat: parseFloat(beach['latitude']), lng: parseFloat(beach['longitude']) },
        position: float_result99,
        map,
        //icon: image,
        //shape: shape,
      });
      */
      //new markerClusterer.MarkerClusterer({ map, marker });
      //setMarkerListener(marker, beach['name_address'], beach['youtube_url']);
      //changeMarkerSize(marker);

    //}




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

//}
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
<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDodZcfXqmf6oAGQs4wTLzCWz2mTwZY-qE&callback=initMap"></script>

<script type="text/javascript">

// ハンバーガー
$(function () {
    $('.Toggle').click(function () {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
           $('.NavMenu').addClass('active');
        } else {
          $('.NavMenu').removeClass('active');
        }
    });
});

window.onload = function() {
const spinner = document.getElementById('loading');
spinner.classList.add('loaded');
}


</script>


</body>
</html>
