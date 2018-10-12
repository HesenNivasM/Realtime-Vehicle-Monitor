<?php 
  $connection=mysqli_connect('localhost','root','hesennivas','adc');
  session_start();
  error_reporting(E_ALL ^ E_NOTICE);
  $uid=$_SESSION['uid'];
  if(isset($_POST['continue'])){

    $latitude = mysqli_real_escape_string($connection,$_POST['latitude']);
    $longitude = mysqli_real_escape_string($connection,$_POST['longitude']);
    // echo $uid;
    // echo $latitude;
    // echo $longitude;
    $result = mysqli_query($connection, "INSERT INTO user_details (uid,lat,lon) values ($uid,$latitude,$longitude) " );
    $result1=mysqli_query($connection,"SELECT max(id) from driver_details");
    $max = mysqli_fetch_array($result1);
    $result1=mysqli_query($connection,"SELECT min(id) from driver_details");
    $distance_lat=array();
    $min = mysqli_fetch_array($result1);
    for ($i=$min[0]; $i <=$max[0] ; $i++) { 
      $result2=mysqli_query($connection,"SELECT * from driver_details WHERE id=$i");
      $value = mysqli_fetch_array($result2);
      $distance_lat[$i]=$value['latitude']-(float)$latitude;
      $distance_lat[$i]=abs($distance_lat[$i]);
    }
    for ($i=$min[0]; $i <=$max[0] ; $i++) { 
      $result2=mysqli_query($connection,"SELECT * from driver_details WHERE id=$i");
      $value = mysqli_fetch_array($result2);
      $distance_long[$i]=$value['longitude']-(float)$longitude;
      $distance_long[$i]=abs($distance_long[$i]);
    }
    for ($i=$min[0]; $i <=$max[0] ; $i++) { 
      $distance[$i]=$distance_lat[$i]+$distance_long[$i];
    }
      asort($distance);
      $nearest= key($distance);
      $result3=mysqli_query($connection,"SELECT * from driver_details WHERE id=$nearest");
      $final = mysqli_fetch_array($result3);
      $driver_uid = $final['uid'];
      $result4=mysqli_query($connection,"UPDATE user_details SET driver_uid=$driver_uid where uid=$uid");
      $summa=1;
    }
?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>After Death Care</title>
  </head>
  <nav class="navbar navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand text-white"><h3>After Death Care<h3></a>
 <form class="form-inline my-2 my-lg-0" action="login_aadhar_1.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Back</button>
    </form>
</nav>
  <body>
    <form method="POST" class="container">
    <div id="map">
    </div>
    <div>
      <input type="hidden" name="latitude" id="latitude" />
      <input type="hidden" name="longitude" id="longitude" />
      <!-- <script type="text/javascript">
        confirm("Proceed to book the car?");
      </script> -->
      <br>
      <input class="form-control btn btn-primary " type="submit" name="continue" value="Book a Driver" onclick="show();" />
    </div>
    <br>
    <div class="row" id="hide">
      <div class="col-sm">
      <label>Driver Name</label>
      <input class="form-control" type="text" name="name" value="<?php echo($final['username'])?>"/>
    </div>
    <div class="col-sm">
      <label>Phone Number</label>
      <input class="form-control" type="text" name="number" value="<?php echo($final['contact_no'])?>" />
      </div>
    </div>
    <br>
    <?php if($summa==1){ ?>
    <div id="akhila" class="alert alert-info">
        <p class="text-align-center">The vehicle is approaching your place</p>
    </div>
    <?php } ?>
    <script>
        
        document.getElementById("hide").style.visibility="none";
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
            var la=position.coords.latitude;
            var lo=position.coords.longitude;
            document.getElementById("latitude").value=la;
            document.getElementById("longitude").value=lo;
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
              
          },);
        }
      }
    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1rwMo_jsKLTnp5RI244_00jkA6Z-aUEM&callback=initMap"
  type="text/javascript"></script>
  </form>
  </body>
</html>

<script type="text/javascript">
  document.getElementById("hide").style.visibility="none"
  function show(){
    document.getElementById("hide").style.visibility="block";
  }
</script>