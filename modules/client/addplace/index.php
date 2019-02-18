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
<link rel="stylesheet" type="text/css" href="assets/css/main.css">

<script type="text/javascript"> 


  var map;
  var marker;
  var myLatlng = new google.maps.LatLng(10.6840,122.9563);
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


<div class="logincontainer" >
    <section>
        <div class="loginform">
             <h2> <b>Add new place</b></h2>
            <br>
<form method="POST" id="placeform">

<select name="type" id="type" required>
    <option>
   Restaurant
    </option>
      <option>
   Tourist Spot
    </option>
</select>
<br>

  <input name="latitude" type="text" id="latitude" placeholder="Latitude" required/> <br>
  <input name="longitude" type="text" id="longitude" placeholder="Longitude" required/><br>
  <input name="name" type="text" id="place_name" placeholder="Place name"/> <span id="check_place"></span><br>
  <input name="address" type="text" id="address" placeholder="Address"/><br>
  <input name="pricerate" type="number" step="0.00" id="pricerate" placeholder="Price rate"/><br>
  <input name="contact" type="text"  id="contact" placeholder="Contact No. / Email"/><br>
  <label> &nbsp; Rate this place </label> 
    <select name="rate" id="rating" required>
        <option>
       1
        </option>
          <option>
       2 
        </option>
              <option>
       3
        </option>
              <option>
       4
        </option>
              <option>
       5
        </option>
    </select>
  <br>
  <label> &nbsp; Upload photo </label>
  <input type="file" name="image">
  <br>
  <br>
  <input type="submit" name="submit">
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
  </form>

          
        </div>
  </section>
</div>



</body>
</html>

<script type="text/javascript"> 
  $(document).on('submit', '#placeform', function(event) {
    event.preventDefault();
      $.ajax({
        url:"modules/client/addplace/insert.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType: 'JSON',
        success:function(data)
        {
          alert("Place successfully added! Sending to admin for approval.")
          window.location.reload()
        }
      });
  });


  $('#place_name').on('keyup click change', function(){
    var placename = $('#place_name').val();


    $.ajax({
      url: "modules/client/addplace/process.php",
      method:'POST',
      data:{placename:placename},
      success:function(data)
      {
        $('#check_place').html(data);
      }
    });
  });
</script>