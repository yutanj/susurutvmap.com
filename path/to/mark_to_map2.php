<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>

    <?php
    require_once('dbc.php');
    error_reporting(E_ALL & ~E_NOTICE);
    $dbc = new Dbc;
    $request = $dbc->getAllRequest();
    //var_dump($request);
    $user_input_array = $dbc->output_db_array($request);
    // $user_input_arrayをjson配列に変換
    $output_db_json = json_encode($user_input_array, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    //var_dump($output_db_json); ?>
    <script>
    var js_test = <?php echo $output_db_json; ?>;
    //console.log(js_test);
  // The following example creates complex markers to indicate beaches near
  // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
  // to the base of the flagpole.
  /*
  const beaches = [
  ["Bondi Beach", -33.890542, 151.274856, 4],
  ["Coogee Beach", -33.923036, 151.259052, 5],
  ["Cronulla Beach", -34.028249, 151.157507, 3],
  ["Manly Beach", -33.80010128657071, 151.28747820854187, 2],
  ["Maroubra Beach", -33.950198, 151.259302, 1],
  ];
  */

  function initMap(js_test) {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 13,
      center: { lat: 35.681445334183735, lng: 139.76757540784303 },
    });
    setMarkers(map);
    }
    // Data for the markers consisting of a name, a LatLng and a zIndex for the
    // order in which these markers should display on top of each other.

    // ここに配列 beaches 入れる

    function setMarkers(map) {
    // Adds markers to the map.
    // Marker sizes are expressed as a Size of X,Y where the origin of the image
    // (0,0) is located in the top left of the image.
    // Origins, anchor positions and coordinates of the marker increase in the X
    // direction to the right and in the Y direction down.
    const image = {
      url:
        "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
      // This marker is 20 pixels wide by 32 pixels high.
      size: new google.maps.Size(20, 32),
      // The origin for this image is (0, 0).
      origin: new google.maps.Point(0, 0),
      // The anchor for this image is the base of the flagpole at (0, 32).
      anchor: new google.maps.Point(0, 32),
    };
    // Shapes define the clickable region of the icon. The type defines an HTML
    // <area> element 'poly' which traces out a polygon as a series of X,Y points.
    // The final coordinate closes the poly by connecting to the first coordinate.
    const shape = {
      coords: [1, 1, 1, 20, 18, 20, 18, 1],
      type: "poly",
    };

    for (let i = 0; i < js_test.length; i++) {
      const beach = js_test[i];
      new google.maps.Marker({
        position: { lat: parseFloat(beach[2]), lng: parseFloat(beach[3]) },
        map,
        icon: image,
        shape: shape,
        title: beach[1],
        //zIndex: beach[3],
      });
    }
  }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDodZcfXqmf6oAGQs4wTLzCWz2mTwZY-qE&signed_in=true&callback=initMap" async defer></script>
  </body>
</html>
