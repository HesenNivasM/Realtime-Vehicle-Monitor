<?php
	include('way2sms-api.php');
	$connection=mysqli_connect('localhost','root','hesennivas','adc');
	if(mysqli_connect_errno()){
			echo "Failed to connect";
	}
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
		
	$uid = mysqli_real_escape_string($connection,$_POST['uid_no']);
	$_SESSION['uid']=$uid;
	if(isset($_POST['enter'])){
		$result = mysqli_query($connection, "SELECT * FROM aadhar_details WHERE uid='$uid' " );
		$row = mysqli_fetch_array($result);
		$name=$row['name'];
		$dob=$row['dob'];
		$gender=$row['gender'];
		$address=$row['address'];
	}
	if(isset($_POST['continue'])){
		$randomno=date("s").date("i");
		$_SESSION['randomno']=$randomno;
		$type = mysqli_real_escape_string($connection,$_POST['type']);
		$phn_no = mysqli_real_escape_string($connection,$_POST['phn_no']);
		$death_type = mysqli_real_escape_string($connection,$_POST['death_type']);
		sendWay2SMS(8190038383,'dhanusuya16',$phn_no,$randomno);
		$_SESSION['type']=$type;
		$_SESSION['phn_no']=$phn_no;
		$_SESSION['death_type']=$death_type;
		if($death_type=="natural"){
			header("Location:otp.php");
	}
	else{
		$result12 = mysqli_query($connection, "SELECT * FROM forensic_table WHERE uid='$uid' " );
		$row = mysqli_fetch_array($result12);
		if($row>=1){
			header("Location: login_map_3.php");
		}
		else{
			$message="The person is ALIVE!!!";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>After Death Care</title>
</head>
<body style="background-image: url(bg.png); background-repeat: no-repeat;  background-size: 1440px 900px;">
	
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
  <a class="navbar-brand" href="#">After Death Care</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="login_aadhar_1.php">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="death_certificate.php">Death Certificate</a>
      <a class="nav-item nav-link" href="insurance.php">Insurance</a>
      <a class="nav-item nav-link" href="organ_donation.php">Organ Donation</a>
    </div>
  </div>
  <form class="form-inline my-2 my-lg-0" action="driver_portal.php">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Driver's Login</button>
    </form>
</nav>
<br>
<br>
		<form class="container" method="POST">
		<div class="row">
			<div class="col-sm">
			<label>Aadhar UID</label>
			<br>
			<input class="form-control" type="text" name="uid_no" value="<?php echo($uid)?>" placeholder="Enter the deceased person's Aadhar UID"/>
			<br>
			<input class="btn btn-primary" type="submit" name="enter" value="Submit" />
		</div>
		<?php if(is_string($name)){?>
		<div class="col-sm">
			<label>Name</label>
			<br>
			<input class="form-control" type="text" name="name" value="<?php echo($name)?>"/>
			<br>
			<label>Date Of Birth</label>
			<br>
			<input class="form-control"type="text" name="dob" value="<?php echo($dob)?>" />
			<br>
			<label>Gender</label><br>
			<input class="form-control" type="text" name="gender" value="<?php echo($gender)?>" /><br>
			<label>Address</label><br>
			<input class="form-control" type="text" name="address" value="<?php echo($address)?>"/>
			<br>
			<label>Select</label>
			<select class="form-control" name="type">
				<option value="mortuary">Mortuary Van</option>
				<option value="crematorium">Crematorium Van</option>
			</select><br>
			<label>Cause of death</label>
			<select class="form-control" name="death_type">
				<option value="natural">Natural Cause</option>
				<option value="others">Forensic Cause</option>
			</select><br>
			<label>User's Mobile Number</label>
			<input class="form-control" type="number" name="phn_no" placeholder="Enter the user's mobile number" /><br>
			<input class="btn btn-primary" type="submit" name="continue" value="Continue" />
		</div>
	</form>
</body>
</html>
<?php }else if($uid>0&&(!isset($_POST['continue']))){?>
	<script type="text/javascript">
			alert("Enter Valid Details!");
	</script>
<?php }?>