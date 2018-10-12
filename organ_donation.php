<?php 
	$connection=mysqli_connect('localhost','root','hesennivas','adc');
	if(mysqli_connect_errno()){
			echo "Failed to connect";
	}
	if(isset($_POST['submit'])){
		$uid = mysqli_real_escape_string($connection,$_POST['uid']);
		$donor = mysqli_real_escape_string($connection,$_POST['donor']);
		$agency = mysqli_real_escape_string($connection,$_POST['agency']);
		$result = mysqli_query($connection, "INSERT INTO organ_donation (uid,donor_id,donor_agency) VALUES ($uid,$donor,'$agency')" );
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
      <a class="nav-item nav-link" href="death_certificate.php">Death Certificate</a>
      <a class="nav-item nav-link" href="insurance.php">Insurance</a>
      <a class="nav-item nav-link active" href="organ_donation.php">Organ Donation <span class="sr-only">(current)</span></a>
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
			<label>Donor ID</label>
			<input class="form-control" type="number" name="donor" id="donor" placeholder="Enter the donor ID" />
		</div>
		<br>
		<div>
			<label>Donor Agency</label>
			<input class="form-control" type="text" name="agency" id="agency" placeholder="Enter the Agency name" />
			</div>
			<br>
		<input class="btn btn-primary" type="submit" name="submit"/>
	</div>
	</form>
</body>
</html>