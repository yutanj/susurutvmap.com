<?php
require('dbc.php');
//error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
$output_db_array = $dbc->getAllRequestf();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="top_page.css">
    <title>clusterer</title>
  </head>
  <body>
    <div id="loading">
      <div class="spinner"></div>
    </div>
    <div id="map"></div>
  <script>
  const js_test = <?php echo $output_db_array; ?>;
  console.log(js_test);
  function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 3,
      center: { lat: -28.024, lng: 140.887 },
    });
    const markers = locations.map((location, i) => {
      return new google.maps.Marker({
        position: location,
      });
    });
      console.log(locations);
   console.log(markers);
    // Add a marker clusterer to manage the markers.
    new markerClusterer.MarkerClusterer({ map, markers });
  }
  const locations = [
    { key:1, lat: -31.56391, lng: 147.154312 },
    { key:2, lat: -33.718234, lng: 150.363181 },
    { key:3, lat: -33.727111, lng: 150.371124 },
    { key:4, lat: -33.848588, lng: 151.209834 },
    { key:5, lat: -33.851702, lng: 151.216968 },
    { key:6, lat: -34.671264, lng: 150.863657 },
    { key:7, lat: -35.304724, lng: 148.662905 },
    { key:8, lat: -36.817685, lng: 175.699196 },
    { key:9, lat: -36.828611, lng: 175.790222 },
    { key:10, lat: -37.75, lng: 145.116667 },
    { key:11, lat: -37.759859, lng: 145.128708 },
    { key:12, lat: -37.765015, lng: 145.133858 },
    { key:13, lat: -37.770104, lng: 145.143299 },
    { key:14, lat: -37.7737, lng: 145.145187 },
    { key:15, lat: -37.774785, lng: 145.137978 },
    { key:16, lat: -37.819616, lng: 144.968119 },
    { key:17, lat: -38.330766, lng: 144.695692 },
    { key:18, lat: -39.927193, lng: 175.053218 },
    { key:19, lat: -41.330162, lng: 174.865694 },
    { key:20, lat: -42.734358, lng: 147.439506 },
    { key:21, lat: -42.734358, lng: 147.501315 },
    { key:22, lat: -42.735258, lng: 147.438 },
    { key:23, lat: -43.999792, lng: 170.463352 },
  ];
  </script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDodZcfXqmf6oAGQs4wTLzCWz2mTwZY-qE&callback=initMap"></script>
    <script type="text/javascript">
    window.onload = function() {
    const spinner = document.getElementById('loading');
    spinner.classList.add('loaded');
    }
    </script>
  </body>
</html>
