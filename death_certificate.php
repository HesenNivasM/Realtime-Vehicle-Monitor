<?php 
	$connection=mysqli_connect('localhost','root','hesennivas','adc');
	if(mysqli_connect_errno()){
			echo "Failed to connect";
	}
	if(isset($_POST['submit'])){
		$uid = mysqli_real_escape_string($connection,$_POST['uid']);
		$c_no = mysqli_real_escape_string($connection,$_POST['c_no']);
		$result = mysqli_query($connection, "INSERT INTO death_certificate (uid,certificate_no) VALUES ($uid,$c_no)" );
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>After Death Care</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
  <a class="navbar-brand" href="#">After Death Care</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="login_aadhar_1.php">Home</a>
      <a class="nav-item nav-link active" href="death_certificate.php">Death Certificate <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="insurance.php">Insurance</a>
      <a class="nav-item nav-link" href="organ_donation.php">Organ Donation</a>
    </div>
  </div>
</nav>
<br>
<br>
	<form method="POST">
	<div class="container">
		<div>
			<label>Aadhar UID</label>
			<input class="form-control" type="number" name="uid" id="uid" placeholder="Enter the Aadhar ID of the deceased person" />
		</div>
		<br>
		<div>
			<label>Certificate Number</label>
			<input class="form-control" type="number" name="c_no" id="c_no" placeholder="Enter the Certificate of the deceased person" />
		</div>
		<br>
		<input class="btn btn-primary" type="submit" name="submit"/>
	</div>
	</form>
</body>
</html>