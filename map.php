<?php

// $name = $_POST['name'];
// $email = $_POST['email'];
// $title = $_POST['title'];
// $message = $_POST['message'];

?>



<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 100%; }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script type="text/javascript">
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 35.339802, lng: 139.409177},
          zoom: 14
        });
      }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaMy2LtDAQEE8wrLe0l394finnbX97cow&callback=initMap">
    </script>
  </body>
</html>