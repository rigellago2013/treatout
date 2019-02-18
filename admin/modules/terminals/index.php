<!DOCTYPE html>
<html>
<head>
<style>
  #myMap {
     height: 500px;
     width: 100%;
  }
</style>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWJ95wDORvWwB6B8kNzSNDfVSOeQc8W7k&sensor=false"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"> </script>


<script type="text/javascript"> 


  var map;
  var marker;
  var placeLatLng = new google.maps.LatLng(10.6840,122.9563);
  var myLatlng = new google.maps.LatLng(<?php echo $_GET['lat'].','.$_GET['lng']?>);
  var geocoder = new google.maps.Geocoder();

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
    draggable: true
  });

    placemarker = new google.maps.Marker({
    map: map,
    position: placeLatLng,
    label: `P`,
  });

var placename = document.createElement('placename');
placename.textContent = `<?php echo $_GET['name']; ?>`
var placeNameInfoContent = document.createElement('divtwo');

var placeNameWindow = new google.maps.InfoWindow;

placeNameInfoContent.appendChild(placename);

placemarker.addListener('click', function() {
  placeNameWindow.setContent(placeNameInfoContent);
  placeNameWindow.open(map, placemarker);
});


  var infoWindow = new google.maps.InfoWindow;

  downloadUrl('modules/terminals/map_data.php?placeid=<?php echo $_GET['place_id']; ?>', function(data){
          var xml = data.responseXML;

          var markers = xml.documentElement.getElementsByTagName('marker');

          Array.prototype.forEach.call(markers, function(markerElem) {
            
            var transportation = markerElem.getAttribute('transportation');
            var minfare = markerElem.getAttribute('minfare');
            var maxfare = markerElem.getAttribute('maxfare');
            var type = markerElem.getAttribute('type');
            var point = new google.maps.LatLng(
              parseFloat(markerElem.getAttribute('lat')),
              parseFloat(markerElem.getAttribute('lng')));

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = transportation
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = "Estimated fare rate Php " + minfare + " - " + maxfare
            infowincontent.appendChild(text);

            var image = 'https://static.thenounproject.com/png/331565-200.png';
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
  geocoder.geocode({'latLng': myLatlng }, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        $('#latitude,#longitude').show();
        $('#latitude').val(marker.getPosition().lat());
        $('#longitude').val(marker.getPosition().lng());
      }
    }
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          $('#latitude').val(marker.getPosition().lat());
          $('#longitude').val(marker.getPosition().lng());
          infowindow.setContent(results[0].formatted_address);
          infowindow.open(map, marker);
        }
      }
    });
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

</head>
<body>

<div id="myMap"></div>

<br> 

<center> Public transportations for <h3> <?php echo $_GET['name']; ?></h3></center>

<br>
<form method="POST" id="terminal_form">

<select name="trans_id" id="trans_id" required>
<?php
include 'function.php';
  foreach($data as $value){
    if($value)
  ?>
    <option value="<?php echo $value->trans_id;?>">
    <?php echo $value->trans_name;?>
    </option>
  <?php
  }
?>

</select>
<br>
<input name="latitude" type="text" id="latitude" placeholder="Latitude" required/><br>
<input name="longitude" type="text" id="longitude" placeholder="Longitude" required/><br>
<input name="fare_rate_min" type="number" step="0.01" id="min_rate" placeholder="Minimum fare rate" required/><br>
<input name="fare_rate_max" type="number" step="0.01" id="max_rate" placeholder="Maximum fare rate" required/><br>
<input name="description" type="text" id="max_rate" placeholder="Description"/><br>
<input type="submit" name="submit">
<input name="place_id" type="hidden" id="max_rate" placeholder="" value="<?php echo $_GET['place_id']; ?>" required/> <br>
</form>

</body>
</html>

<script type="text/javascript">
  
  $(document).on('submit', '#terminal_form', function(event) {
    event.preventDefault();
      $.ajax({
        url:"modules/terminals/insert.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType: 'JSON',
        success:function(data)
        {
          alert(data.msg)
          location.reload()
        }
      });
  });



</script>