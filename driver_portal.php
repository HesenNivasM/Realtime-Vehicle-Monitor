<?php 
	$connection=mysqli_connect('localhost','root','hesennivas','adc');
	if(mysqli_connect_errno()){
			echo "Failed to connect";
	}
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
	if(isset($_POST['ready'])){
		$username = mysqli_real_escape_string($connection,$_POST['username']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		$result = mysqli_query($connection, "SELECT * FROM driver_details WHERE username='$username' " );
		$row = mysqli_fetch_array($result);
		$original_password=$row['password'];
		if ($original_password===$password) {
			$summa=1;
			$_SESSION['username']=$username;
			// while(1){
				$latitude = mysqli_real_escape_string($connection,$_POST['latitude']);
				$longitude = mysqli_real_escape_string($connection,$_POST['longitude']);
				$result1=mysqli_query($connection,"UPDATE driver_details SET latitude='$latitude' WHERE username='$username'");
				$result2=mysqli_query($connection,"UPDATE driver_details SET longitude='$longitude' WHERE username='$username'");
			// 	for ($i=0; $i < 127500; $i++)
			// 		$j++;
			// 		$k++;
			// 		$l++;
			// }
		}
	}
	else if(isset($_POST['notready'])){
			$username = mysqli_real_escape_string($connection,$_POST['username']);
			$password = mysqli_real_escape_string($connection,$_POST['password']);
			$result = mysqli_query($connection, "SELECT * FROM driver_details WHERE username='$username' " );
			$row = mysqli_fetch_array($result);
			$original_password=$row['password'];
			if ($original_password===$password) {
				$summa=1;
				$_SESSION['username']=$username;
				// while(1){
					$result1=mysqli_query($connection,"UPDATE driver_details SET latitude=0 WHERE username='$username'");
					$result2=mysqli_query($connection,"UPDATE driver_details SET longitude=0 WHERE username='$username'");
				// 	for ($i=0; $i < 127500; $i++)
				// 		$j++;
				// 		$k++;
				// 		$l++;
				// }
		}
		else{
			echo "Enter Valid Details";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>After Death Care</title>
	<title>After Death Care</title>
</head>
<body>
	<nav class="navbar navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand text-white"><h3>After Death Care</h3></a>
 	<form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success"><a href="driver_signup.php" >Sign Up</a></button>
      <button class="btn btn-outline-success"><a href="login_aadhar_1.php">Back</a></button>
    </form>

</nav>
<br>
	<form method="POST" class="container text-dark">
	<div >
		<div class="form-group">
			<label>Username</label>
			<input class="form-control" type="text" name="username" />
			<label>Password</label>
			<input class="form-control" type="password" name="password" /><br>
			
				<div class="float-left">
					<input class="btn btn-primary" type="submit" name="ready" value="Vehicle Ready" />
				</div>
				<div class="float-right">
					<input class="btn btn-primary" type="submit" name="notready" value="Vehicle Not Ready" />
				</div>
			<br>
		</div>
		<div class="card" id="card_display">
	  		<div class="card-body">
		  	  	<h5 class="card-title">Current Status</h5>
		    	<h6 class="card-subtitle mb-2 text-muted">UserName:<?php echo $username; ?></h6>
		    	<p class="card-text">Your vehicle is <?php if(isset($_POST['notready'])){echo "not";} ?> available online and is waiting for customers</p>
		    	<?php $result = mysqli_query($connection, "SELECT * FROM driver_details WHERE username='$username' " );$row = mysqli_fetch_array($result);if($row>0){$driver_uid=$row['uid'];$result1 = mysqli_query($connection, "SELECT * FROM user_details WHERE driver_uid='$driver_uid' " );$row = mysqli_fetch_array($result1);if($row!=0){$latt=$row['lat'];$long=$row['lon'];} ?>
		    	<?php if($row>0&&!isset($_POST['notready'])&&($latt>0||$latt<0)&&($long>0||$long<0)){?>
		    	<a target="_blank" href=<?php echo ("https://www.google.com/maps/search/?api=1&query="."$latt".","."$long") ?> class="card-link">Map link</a>
		    	<?php }}else if($row<0){ ?>
		    	<p>Still Searching</p>
		    	<?php } ?>
	  		</div>
		</div>
		<div id="vanish">
			 <form method="POST">
    <div>
      <label>You are here</label>
    </div>
    <div id="map">
    </div>
    <div>
      <input type="float" name="latitude" id="latitude" />
      <input type="float" name="longitude" id="longitude" />     
       <!-- <script type="text/javascript">
        confirm("Proceed to book the car?");
      </script> -->
      <input type="submit" name="continue" value="Continue" />
    </div>
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