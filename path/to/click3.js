function initMap() {

    // マップの初期化
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 16,
      center: {lat: 35.68201, lng: 139.76842}
    });
//35.682019606153254, 139.76842486738724
    // クリックイベントを追加
    map.addListener('click', function(e) {
      var getc = getClickLatLng(e.latLng, map);
      console.log(getc + "SUCCESS");
      function setValue(getc){
          //const geodata = initMap();
          console.log("setvalue読み込み完了");
          console.log(getc);
          document.sampleForm.total1.value = getc[0];
          document.sampleForm.total2.value = getc[1];
          document.forms["sampleForm"].submit();
      };
    });
    //var riku = 'riku';
    function getClickLatLng(lat_lng, map) {

        // 座標を表示
        //console.log(document.getElementById('lat').textContent);
        //console.log(riku);
        document.getElementById('lat').textContent = lat_lng.lat();
        document.getElementById('lng').textContent = lat_lng.lng();
        //console.log(lat_lng.lat());
        console.log('hellllo');

        // マーカーを設置
        var marker = new google.maps.Marker({
          position: lat_lng,
          map: map
        });
        // 座標の中心をずらす
        // http://syncer.jp/google-maps-javascript-api-matome/map/method/panTo/
        map.panTo(lat_lng);
        //lat_lng.lat();
        var place = [lat_lng.lat(), lat_lng.lng()];
        //console.log(place + "こんにちは");
        return place;
    };
      //const getc = getClickLatLng();


  };
