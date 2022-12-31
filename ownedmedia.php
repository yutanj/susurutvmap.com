<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style >
        html, body {
            height: 100%;
            background-color: #fff;
            font-family: "ヒラギノ角ゴシック", "游ゴシック", "メイリオ";
        }
        body {
             padding: 15px 10px; 
        }
        
        h1 {
            font-size: 22px;
        }
        h2 {
            font-size: 15px;
        }
        .inner {
            display: flex;
        }
        .inner img {
            width: 100px;
            height: auto;
            margin-right: 15px;
        }
        .inner h3 {
            margin: 0;
        }

        
    </style>
    <link rel="stylesheet" href="media.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div>
          <a href="top_page_production.php"><img src="header_icon.png" class="header_icon"></a>
        </div>
      </header>
      <div id="map"></div>
      <div class="btn_wrapper">
        <a href="#" id="get_current_position" class="btn btn--orange">現在地付近の<br class="br-sp"/>お店を探す</a>
      </div>

    <div id="ramen-shop-list"></div>
    <h1>渋谷駅近くのラーメン</h1>
    <h2>SUSURU TV.で紹介された新宿区のラーメン/つけ麺/油そばのお店をまとめています。ラーメンYouTuber・SUSURU(すする)さんのコメント、Youtube動画、Instagramの投稿も一緒に紹介しているのでお店選びの参考にしてみてください。</h2>
    <div class="container">
        <div class="inner">
            <a href="#"><img src="http://img.youtube.com/vi/GeFizukHkQc/mqdefault.jpg" alt=""></a>
            <h3>阿見 蜂と蝶</h3>
        </div>
    </div>
</body>
</html>

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
      //rObj.name_address = obj.name_address
      rObj.stores_name = obj.stores_name
      rObj.stores_address = obj.stores_address
      rObj.youtube_url = obj.youtube_url
      //rObj.video_id = obj.youtube_url.substring(32, 43);
      rObj.video_id = obj.video_id
      //console.log(rObj.video_id);
      return rObj
    });
    //console.log(result99[3].lat);

    const markers = result99.map((location, i) => {
      const marker = new google.maps.Marker({
      position: {lat: location.lat, lng: location.lng},
    });
    const infoWindow = new google.maps.InfoWindow({
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