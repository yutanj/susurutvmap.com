<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Test Map</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #map {
      height: 80%;
      width: 80%;
    }
  </style>
  <script src="click3.js"></script>
</head>

<body>
  
  <div id="map"></div>
  <ul>
    <li>lat: <span id="lat"></span></li>
    <li>lng: <span id="lng"></span></li>
  </ul>
  <script>
    //console.log(initmap4);
  </script>
  <form id="sampleForm" name="sampleForm" method="post" action="test2.php">
    <input type="hidden" name="total1" id="total" value="">
    <input type="hidden" name="total2" id="total" value="">
    <a href="#" onclick="setValue();">Click to submit</a>
  </form>
  <?php
  //session_start();
  require('mapfunc.php');
  $dbc = new Dbc;
  $dbh = $dbc->dbConnect();
   ?>

  <!--<input type="button" onclick="location.href='set_lating_test.php'" value="次へ">-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDodZcfXqmf6oAGQs4wTLzCWz2mTwZY-qE&signed_in=true&callback=initMap" async defer></script>
</body>
</html>
