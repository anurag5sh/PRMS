<?php 
include('session-admin.php');
include('navbar.html');
error_reporting(0);

$id = $_GET['id'];


$user = mysqli_query($db,"SELECT * from user WHERE police_id = '$id'");
$row = mysqli_fetch_assoc($user);

if($_SERVER["REQUEST_METHOD"] == "POST") {
		 $pid = $_POST['police_id'];
		 $fname = $_POST['first_name'];
		 $lname = $_POST['last_name'];
		 $uname  = $_POST['username'];
		 $pass = $_POST['password'];
		 $gender = $_POST['gender'];
		 $dob = date('Y-m-d', strtotime($_POST['dob']));
		 $doj = date('Y-m-d', strtotime($_POST['doj']));
		 $stcode = $_POST['station_code'];
		 $rank = $_POST['rank'];
		 $solved = $_POST['solved'];
		 $description = $_POST['description'];
		 $awards = $_POST['awards'];
		 
		 
		 $update_profile = mysqli_query($db,"UPDATE user SET police_id = '$pid',first_name = '$fname',
                     last_name = '$lname',username = '$uname',password = '$pass',dob = '$dob',
					 gender = '$gender',station_code = '$stcode',rank = '$rank',
					 solved_cases = '$solved',description = '$description', awards = '$awards' WHERE police_id = '$id'");
					  
		if ($update_profile) {
		  echo '<script type="text/javascript">';
		echo ' alert("Changes Saved Successfully!");document.location = "edit.php?id='.$pid.'";';
		echo '</script>';
	    } else {
		  echo '<script type="text/javascript">';
		echo ' alert("Error'. mysqli_error($db) .' ");';
		echo '</script>';
	    }
	 }

?>

<html>
<head>
<title>Edit User</title>
<script>
$(function() {
    $("#name_input").autocomplete({
        source: "users.php",
        select: function( event, ui ) {
            event.preventDefault();
            $("#name_input").val(ui.item.value);
			
			
			window.location.href="edit.php?id="+ui.item.id;
        }
    });
});
$(document).ready(function() {
        $("#edit").on("keydown", ':input:not(textarea):not([type=submit])',function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    });
</script>
</head>
<body>
<div class="container w-75 p-3">
<h3> Select User</h3>
<input class="form-control" type="text" name="name_input" id="name_input" placeholder="Type Name" value="<?php if(isset($_GET['id'])) echo $row['first_name'].' '.$row['last_name']; ?>" /></div><br><br>


<div class="container">
		
		<form method="post" action="" id="edit">
			<div class="form-group">
			<label>Police ID</label>
			<input class="form-control" type="number" name="police_id" required min="0" value="<?php echo $row['police_id'];?>"/>
			</div>
			<div class="form-group">
			<label for="first_name">First Name:</label>
			<input class="form-control" type="text" name="first_name" id="first_name" required value="<?php echo $row['first_name']; ?>" />
			</div>
			<div class="form-group">
			<label>Last Name:</label>
			<input class="form-control" type="text" name="last_name" required value="<?php echo $row['last_name'];?>"/>
			</div>
			<div class="form-group">
			<label>Username</label>
			<input class="form-control" type="text" name="username" required value="<?php echo $row['username'];?>"/>
			</div>
			<div class="form-group">
			<label>Password</label>
			<input class="form-control" type="text" name="password" required value="<?php echo $row['password'];?>"/>
			</div>
			<div class="form-group">
			<label>Gender</label>
			<select class="custom-select" name="gender">
			<option >Select Gender</option>
			<option value="Male" <?php if($row['gender']== "Male") echo "selected" ?> >Male</option>
			<option value="Female" <?php if($row['gender']== "Female") echo "selected" ?>>Female</option>
			<option value="Other" <?php if($row['gender']== "Other") echo "selected" ?>>Other</option>
			</select>
			</div>
			<div class="form-group">
			<label>DOB:</label>
			<input class="form-control" type="date" name="dob" required value="<?php echo $row['dob'];?>" />
			</div>
			<div class="form-group">
			<label>DOJ:</label>
			<input class="form-control" type="date" name="doj" required value="<?php echo $row['doj'];?>"/>
			</div>
			<div class="form-group">
			<label>Station Code</label>
			<input class="form-control" type="number" name="station_code" required min="0" value="<?php echo $row['station_code'];?>"/>
			</div>
			<div class="form-group">
			<label>Rank</label>
			<input class="form-control" type="text" name="rank" required value="<?php echo $row['rank'];?>"/>
			</div>
			<div class="form-group">
			<label>No of Solved Cases</label>
			<input class="form-control" type="number" name="solved" required min="0" value="<?php echo $row['solved_cases'];?>"/>
			</div>
			<div class="form-group">
			<label>About</label>
			<textarea class="form-control"  name="description" required><?php echo $row['description'];?></textarea>
			</div>
			<div class="form-group">
			<label>Awards</label>
			<textarea class="form-control" name="awards" required><?php echo $row['awards'];?></textarea>
			</div>
			<input class="btn btn-success" type="submit" value="Save Changes" />     
		</form> 
		
	</div>

</body>
</html>