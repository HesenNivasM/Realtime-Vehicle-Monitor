<?php 
	$connection=mysqli_connect('localhost','root','hesennivas','adc');
	if(mysqli_connect_errno()){
			echo "Failed to connect";
	}
	session_start();
	$otp=$_SESSION['randomno'];
	echo $otp;
	if(isset($_POST['otpvalue'])){
		$otpvalue = mysqli_real_escape_string($connection,$_POST['otpvalue']);
		if($otp==$otpvalue){
			header("Location: nearby_doctors_2.php");
		}
		else{
			echo "Enter valid details";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>After Death Care
	</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand text-white"><h3>After Death Care<h3></a>
</nav>
<div class="container">
	<form method="POST">
		<label>Enter the OTP</label>
		<input class="form-control" type="number" name="otpvalue" />
		<br>
		<input class="btn btn-primary" type="submit" name="submit">
	</form>
</div>
</body>
</html>