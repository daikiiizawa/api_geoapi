<?php
$x = $_POST['x'];
$y = $_POST['y'];
$town = $_POST['town'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $town;?>の周辺地図</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBaMy2LtDAQEE8wrLe0l394finnbX97cow&sensor=false&libraries=places"></script>
    <script>
      var map;
      var infowindow;
      function initialize() {
        // var area = new google.maps.LatLng(35.339802, 139.409177);
        var area = new google.maps.LatLng(<?php echo $y;?>, <?php echo $x;?>);
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: area,
          zoom: 15
        });
        var request = {
          location: area,
          radius: 500,
          type: 'all',
          // query: '施設全て'
        };
        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.textSearch(request, callback);
      }
      function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }
      function createMarker(result) {
        var placeLoc = result.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: result.geometry.location
        });
        google.maps.event.addListener(marker, 'click', function() {
          var request = {
            reference: result.reference
          };
          var service1 = new google.maps.places.PlacesService(map);
          service1.getDetails(request, function(place, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
              content = place.name + "<br />" ;
              content += place.vicinity + "<br />" ;
              content += place.formatted_phone_number + "<br />" ;
              content += place.website + "<br />" ;
              content += place.types.toString() ;
              infowindow.setContent(content);
            }
          });
          infowindow.open(map, this);
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas" style="width: 100%; float:left"></div>

    <!-- 表示箇所の説明 -->
    <div style="width:46%; float:left"></div>
      <pre>
        var request = {
          location: new google.maps.LatLng(35.681382, 139.766084),
          radius: 500,
          type: 'all',
          query: '施設全て'
        };
      </pre>

  </body>
</html>