<?php 
	include('way2sms-api.php');
	$connection=mysqli_connect('localhost','root','hesennivas','adc');
	if(mysqli_connect_errno()){
		echo "Failed to connect";
	}
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	if(isset($_POST['submit']))
	{
		
		$name = mysqli_real_escape_string($connection,$_POST['name']);
		$uid = mysqli_real_escape_string($connection,$_POST['uid']);
		$no = mysqli_real_escape_string($connection,$_POST['no']);
		$license_no = mysqli_real_escape_string($connection,$_POST['license_no']);
		$username = mysqli_real_escape_string($connection,$_POST['username']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		$type = mysqli_real_escape_string($connection,$_POST['type']);
		$random=date("s").date("i");
		$_SESSION['random']=$random;
		$_SESSION['name']=$name;
		$_SESSION['uid']=$uid;
		$_SESSION['no']=$no;
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		$_SESSION['license_no']=$license_no;
		$_SESSION['type']=$type;
		sendWay2SMS(8190038383,'dhanusuya16',$no,$random);
		$eli=1;
	}
	if(isset($_POST['check'])){
		$random=$_SESSION['random'];
		$name=$_SESSION['name'];
		$uid=$_SESSION['uid'];
		$no=$_SESSION['no'];
		$license_no=$_SESSION['license_no'];
		$username=$_SESSION['username'];
		$password=$_SESSION['password'];
		$type=$_SESSION['type'];
		$otp = mysqli_real_escape_string($connection,$_POST['otp']);
		if($otp==$random){
			$result = mysqli_query($connection,"INSERT INTO driver_details (name,uid,contact_no,license_no,username,password,van_type) values ('$name',$uid,$no,'$license_no','$username','$password','$type')");
		}else
		{
			echo "Enter valid otp";
		}
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
  <a class="navbar-brand text-white"><h3>After Death Care<h3></a>
 <form class="form-inline my-2 my-lg-0" action="driver_portal.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Back</button>
    </form>

</nav>
<br>

	<form method="POST" class="container">
		<?php if($eli!=1){ ?>
		<div>
			<label>Name</label><br>
			<input class="form-control" type="text" name="name" /><br>
			<label>Aadhar UID</label><br>
			<input class="form-control" type="number" name="uid" /><br>
			<label>Contact Number</label><br>
			<input class="form-control" type="number" name="no" /><br>
			<label>License Number</label><br>
			<input class="form-control" type="text" name="license_no" /><br>
			<label>Select the van type</label><br>
			<select class="form-control" name="type">
				<option value="mortuary">Mortuary Van</option>
				<option value="crematorium">Crematorium Van</option>
			</select><br>
			<label>Username</label><br>
			<input class="form-control" type="text" name="username" />
			<label>Password</label><br>
			<input class="form-control" type="password" name="password" /><br>
			<input class="btn btn-primary" type="submit" name="submit">
		</div>
		<?php } ?>
		<?php if($eli==1){ ?>
		<div>
			<label>Enter the OTP</label>
			<input type="text" name="otp" />
			<input type="submit" name="check" value="Continue" />
		</div>
		<?php } ?>
	</form>
</body>
</html>