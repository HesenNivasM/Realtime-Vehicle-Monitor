<?php 
	$connection=mysqli_connect('localhost','root','hesennivas','adc');
	if(mysqli_connect_errno()){
		echo "Failed to connect";
	}
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	$uid=$_SESSION['uid'];
	$type=$_SESSION['type'];
	$result = mysqli_query($connection, "SELECT * FROM aadhar_details WHERE uid='$uid' " );
	$row = mysqli_fetch_array($result);
	$name=$row['name'];
	$dob=$row['dob'];
	$gender=$row['gender'];
	$address=$row['address'];
	if(isset($_POST['submit'])){
		$id = mysqli_real_escape_string($connection,$_POST['doctor_id']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		if($type==="mortuary"){
			$result = mysqli_query($connection, "SELECT password FROM forensic_doctor_details WHERE id='$id' " );
		}else if($type==="crematorium"){
			$result = mysqli_query($connection, "SELECT password FROM general_doctor_details WHERE id='$id' " );
		}
		$original_password = mysqli_fetch_array($result);
		if ($password===$original_password['password']) {
			header("Location: login_map_3.php");
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
 
</nav>
<br>
	<form method="POST" class="container">
	<div class="row">
		<div class="col-sm">
		<label>Aadhar UID</label><br>
		<input class="form-control" type="text" name="uid_no" value="<?php echo($uid)?>" /><br>
		<label>Name</label><br>
		<input class="form-control" type="text" name="name" value="<?php echo($name)?>" /><br>
		<label>DOB</label><br>
		<input class="form-control" type="text" name="dob" value="<?php echo($dob)?>" /><br>
		<label>Gender</label><br>
		<input class="form-control" type="text" name="gender" value="<?php echo($gender)?>" /><br>
		<label>Address</label><br>
		<input class="form-control" type="text" name="address" value="<?php echo($address)?>"/><br>
		</div>
		<div class="col-sm">
			<label>Doctor's ID</label>
			<input class="form-control" type="text" name="doctor_id" placeholder="Enter doctor's unique username" /><br>
			<label>Password</label>
			<input class="form-control" type="password" name="password" placeholder="Enter the password" /><br>
			<input class="btn btn-primary" type="submit" name="submit" />
		</div>
	</div>
	</form>
</form>
</body>
</html>

 
<?php if ($password!==$original_password['password']) {?>
		<script type="text/javascript">
			alert("Enter Valid Details!");
	</script>
<?php } ?>