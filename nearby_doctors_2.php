<?php 
  $connection=mysqli_connect('localhost','root','hesennivas','adc');
  session_start();
  // error_reporting(E_ALL ^ E_NOTICE);
  if (isset($_POST['continue'])) {
    $latitude = mysqli_real_escape_string($connection,$_POST['latitude']);
    $longitude = mysqli_real_escape_string($connection,$_POST['longitude']);
    // echo $uid;
    echo $latitude;
    echo $longitude;
    $result1=mysqli_query($connection,"SELECT max(id) from doctor_details");
    $max = mysqli_fetch_array($result1);
    $result1=mysqli_query($connection,"SELECT min(id) from doctor_details");
    $distance_lat=array();
    $min = mysqli_fetch_array($result1);
    for ($i=$min[0]; $i <=$max[0] ; $i++) { 
      $result2=mysqli_query($connection,"SELECT * from doctor_details WHERE id=$i");
      $value = mysqli_fetch_array($result2);
      $distance_lat[$i]=$value['lat']-(float)$latitude;
      $distance_lat[$i]=abs($distance_lat[$i]);
    }
    for ($i=$min[0]; $i <=$max[0] ; $i++) { 
      $result2=mysqli_query($connection,"SELECT * from doctor_details WHERE id=$i");
      $value = mysqli_fetch_array($result2);
      $distance_long[$i]=$value['lon']-(float)$longitude;
      $distance_long[$i]=abs($distance_long[$i]);
    }
    for ($i=$min[0]; $i <=$max[0] ; $i++) { 
      $distance[$i]=$distance_lat[$i]+$distance_long[$i];
    }
      for ($i=$min[0]; $i <=$max[0] ; $i++) { 
      	 $insert=mysqli_query($connection,"UPDATE doctor_details SET temp='$distance[$i]' where id='$i'");
      }

  }
  if(isset($_POST['next'])){
  	header("Location: login_doctor_2.php");
  }
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>After Death Care</title>
</head>
<body>
	<nav class="navbar navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand text-white"><h3>After Death Care</h3></a>
 
</nav>
<br>
	<form method="POST" class="container text-dark">
	<div>
    <div id="map">
    </div>
    <div id="vanish">
    	<label>You are here</label>
      <input type="float" name="latitude" id="latitude" />
      <input type="float" name="longitude" id="longitude" />     
       <!-- <script type="text/javascript">
        confirm("Proceed to book the car?");
      </script> -->
          </div>
      <!-- <input type="submit" name="continue" value="Show Details" /> -->
      <br>
      <br>
      <?php
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result11 = mysqli_query($connection,"SELECT id,license_no,name,phn_no FROM doctor_details order by temp");
echo "<table border='3' class='table'>";

$i = 0;
while($row = $result11->fetch_assoc())
{
    if ($i == 0) {
      $i++;
      echo "<tr>";
      foreach ($row as $key => $value) {
        echo "<th>" . $key . "</th>";
      }
      echo "</tr>";
    }
    echo "<tr>";
    foreach ($row as $value) {
      echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</div></body>";

mysqli_close($connection);
?>
<input class="form-control btn btn-primary" type="submit" name="next" value="Continue" />
    <script>
    	document.getElementById("vanish").style.display="none";
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 17
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
          	repeat();
            function repeat(){
            var la=position.coords.latitude;
            var lo=position.coords.longitude;
            document.getElementById("latitude").value=la;
            document.getElementById("longitude").value=lo;
            var pos = {
              lat: la,
              lng: lo
            };
            // alert(la);
            // alert(lo);
            var t = setTimeout(repeat, 10000);
        	}
            
            //infoWindow.setContent('Location found.');
            //infoWindow.open(map);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        }
      }

    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1rwMo_jsKLTnp5RI244_00jkA6Z-aUEM&callback=initMap"
  type="text/javascript"></script>
  </form>
		</div>
	</div>
	</form>
</body>
</html>