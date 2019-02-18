<!DOCTYPE html>
<html>
<head>
<style>
  #myMap {
     height: 600px;
     width: 100%;
  }
</style>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWJ95wDORvWwB6B8kNzSNDfVSOeQc8W7k&sensor=truecallback=initialize"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"> </script>


<script type="text/javascript"> 


var myLatlng = new google.maps.LatLng(<?php echo $_GET['lat'].','.$_GET['lng']?>);


function initialize() {

  var mapOptions = {
    zoom: 12,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

  marker = new google.maps.Marker({
    map: map,
    position: myLatlng,
    label: `P`,
  });

var placename = document.createElement('placename');
placename.textContent = `<?php echo $_GET['name']; ?>`
var placeNameInfoContent = document.createElement('divtwo');

var verystrong = document.createElement('verystrong');
verystrong.textContent = placename;
var placeNameWindow = new google.maps.InfoWindow;

placeNameInfoContent.appendChild(placename);

marker.addListener('click', function() {
  placeNameWindow.setContent(placeNameInfoContent);
  placeNameWindow.open(map, marker);
});

        currpossinfowindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            currpossinfowindow.setPosition(pos);
            currpossinfowindow.setContent('Your current location.');
            currpossinfowindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, currpossinfowindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, currpossinfowindow, map.getCenter());
        }


  var infoWindow = new google.maps.InfoWindow;

  downloadUrl('modules/client/terminals/map_data.php?placeid=<?php echo $_GET['place_id']; ?>', function(data){
    
          var xml = data.responseXML;

          var markers = xml.documentElement.getElementsByTagName('marker');


          Array.prototype.forEach.call(markers, function(markerElem) {

            var transportation = markerElem.getAttribute('transportation');
            var minfare = markerElem.getAttribute('minfare');
            var maxfare = markerElem.getAttribute('maxfare');
            var type = markerElem.getAttribute('type');

            var point = new google.maps.LatLng(

              parseFloat(markerElem.getAttribute('lat')),
              parseFloat(markerElem.getAttribute('lng'))

            );

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');

            strong.textContent = transportation

            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = "Estimated fare rate: Php " + minfare + " - " + maxfare

            infowincontent.appendChild(text);


            var terminalMarker = new google.maps.Marker({
              map: map,
              position: point,
              label: 'T',
              draggable: false
            });

            terminalMarker.addListener('click', function() {
              infoWindow.setContent(infowincontent);
              infoWindow.open(map, terminalMarker);
            });
          });
  })

        function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

       function doNothing() {}

         function handleLocationError(browserHasGeolocation, currpossinfowindow, pos) {
        currpossinfowindow.setPosition(pos);
        currpossinfowindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        currpossinfowindow.open(map);
      }

}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

</head>
<body>

<div id="myMap"></div>

<br> 

<center> Public transportations for <h3> <?php echo $_GET['name']; ?></h3></center>

</body>
</html>
