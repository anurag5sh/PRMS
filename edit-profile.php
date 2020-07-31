<?php
	include('session.php');
	include('navbar.html');

	if(isset($_SESSION['login_user']))
	{
	$user = $login_session;
	$get_user = mysqli_query($db,"SELECT * FROM user WHERE username = '$user'");
	if ($count = mysqli_num_rows($get_user)== 1)
	{
		$user_data = mysqli_fetch_array($get_user);
			   
	}
		   
	} else{
		header("location:login.php");
	}
	
	 if($_SERVER["REQUEST_METHOD"] == "POST") {
		 $first_name = $_POST['first_name'];
		 $last_name = $_POST['last_name'];
		 $dob = date('Y-m-d', strtotime($_POST['dob']));
		 
		 $update_profile = mysqli_query($db,"UPDATE user SET first_name = '$first_name',
                      last_name = '$last_name', dob = '$dob' WHERE username = '$user'");
					  
		if ($update_profile) {
		   header("Location: myprofile.php");
	    } else {
		  echo mysqli_error;
	    }
	 }
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $user_data['first_name'] ?>'s Profile Settings</title>
		<script> 
		let element = document.getElementById("myprofile");
		element.classList.add("active");
		</script>
	</head>
<body>
	<br>
	<br>
	<div class="container">
		<a role="button" class="btn btn-primary" href="myprofile.php">Back to Profile</a>
		<h3>Update Profile Information</h3>
		<form method="post" action="edit-profile.php">
			<div class="form-group">
			<label for="first_name">First Name:</label>
			<input class="form-control" type="text" name="first_name" id="first_name" required value="<?php echo $user_data['first_name'] ?>" />
			</div>
			<div class="form-group">
			<label>Last Name:</label>
			<input class="form-control" type="text" name="last_name" required value="<?php echo $user_data['last_name'] ?>" />
			</div>
			<div class="form-group">
			<label>DOB:</label>
			<input class="form-control" type="date" name="dob" required value="<?php echo $user_data['dob'] ?>" />
			</div>
			<input class="btn btn-primary" type="submit" value="Update Profile" />        
		</form>  
	</div>  
</body>
</html>