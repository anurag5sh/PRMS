<?php
include('session-admin.php');
include('navbar.html');


	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$police_id = $_POST['police_id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$gender = $_POST['gender'];
		$dob = date('Y-m-d', strtotime($_POST['dob']));
		$doj = date('Y-m-d', strtotime($_POST['doj']));
		$station_code = $_POST['station_code'];
		$rank = $_POST['rank'];
		$solved = $_POST['solved'];
		$description = $_POST['description'];
		$awards = $_POST['awards'];
		
		mysqli_query($db,"INSERT INTO user VALUES ('$police_id','$first_name','$last_name','$username','$password'
		,'$gender','$dob','$doj','$station_code','$rank','$solved','$description','$awards');");
		
		if(!mysqli_error($db)){
			echo '<script type="text/javascript">';
		echo ' alert("User added Successfully!");document.location = "add.php";';
		echo '</script>';
		}
		else
		{
			echo '<script type="text/javascript">';
		echo ' alert("Error'. mysqli_error($db) .' ");';
		echo '</script>';
		}
		
	}

?>

<html>
<head>
<title> Add User </title>

</head>
<body>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h1 class="display-5 text-center">ADD USER</h1>
  </div></div>
<div class="container w-75 p-3">
		<form method="post" action="">
			<div class="form-group">
			<label>Police ID</label>
			<input class="form-control" type="number" name="police_id" required min="0" />
			</div>
			<div class="form-group">
			<label for="first_name">First Name:</label>
			<input class="form-control" type="text" name="first_name" id="first_name" required />
			</div>
			<div class="form-group">
			<label>Last Name:</label>
			<input class="form-control" type="text" name="last_name" required />
			</div>
			<div class="form-group">
			<label>Username</label>
			<input class="form-control" type="text" name="username" required />
			</div>
			<div class="form-group">
			<label>Password</label>
			<input class="form-control" type="text" name="password" required />
			</div>
			<div class="form-group">
			<label>Gender</label>
			<select class="custom-select" name="gender">
			<option selected>Select Gender</option>
			<option value="Male" >Male</option>
			<option value="Female" >Female</option>
			<option value="Other" >Other</option>
			</select>
			</div>
			<div class="form-group">
			<label>DOB:</label>
			<input class="form-control" type="date" name="dob" required />
			</div>
			<div class="form-group">
			<label>DOJ:</label>
			<input class="form-control" type="date" name="doj" required />
			</div>
			<div class="form-group">
			<label>Station Code</label>
			<input class="form-control" type="number" name="station_code" required min="0"/>
			</div>
			<div class="form-group">
			<label>Rank</label>
			<input class="form-control" type="text" name="rank" required />
			</div>
			<div class="form-group">
			<label>No of Solved Cases</label>
			<input class="form-control" type="number" name="solved" required min="0" />
			</div>
			<div class="form-group">
			<label>About</label>
			<textarea class="form-control" name="description" required > </textarea>
			</div>
			<div class="form-group">
			<label>Awards</label>
			<textarea class="form-control" name="awards" required ></textarea>
			</div>
			<input class="btn btn-success" type="submit" value="Add" />        
		</form>  
	</div>


</body>
</html>
