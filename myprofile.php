<?php
	include('session.php');
	include('navbar.html');

	if(isset($_SESSION['login_user']))
	{
	$user = $login_session;
	$get_user = mysqli_query($db,"SELECT * FROM user WHERE username = '$user'");
	if ($count = mysqli_num_rows($get_user)== 1)
	{
		$profile_data = mysqli_fetch_array($get_user);
			   
	}
		   
	} else{
		header("location:login.php");
	}
?>

<html>    
<head>        
	<meta charset="UTF-8">
	<title><?php echo $profile_data['first_name'] ?>'s Profile</title>
	<script> 
	let element = document.getElementById("myprofile");
	element.classList.add("active");
	</script>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h1 class="display-5 text-center">Personal Information</h1>
  </div>
</div>
	<div class="container">     
	<div class="col-md-6">    
        <table class="table ">
                    <tr>                
                    	<td><b>Name:</b></td><td><?php echo $profile_data['first_name']." ".$profile_data['last_name'] ?></td>   
                    </tr>
					<tr>                
                    	<td><b>Police ID:</b></td><td><?php echo $profile_data['police_id']; ?></td>   
                    </tr>
                    <tr>                
                    	<td><b>DOB:</b></td><td><?php echo $profile_data['dob'] ?></td> 
                    </tr> 
                    <tr>
                        <td><b>Gender:</b></td><td><?php echo $profile_data['gender'] ?></td>
                    </tr>
					<tr>
                        <td><b>DOJ:</b></td><td><?php echo $profile_data['doj'] ?></td>
                    </tr>
					<tr>
                        <td><b>Rank:</b></td><td><?php echo $profile_data['rank'] ?></td>
                    </tr>
					<tr>
                        <td><b>Station Code:</b></td><td><?php echo $profile_data['station_code'] ?></td>
                    </tr>
                    <tr>
                        <td><b>No. of Solved Cases</b></td><td><?php echo $profile_data['solved_cases'] ?></td> 
                    </tr>        
        </table> 
		</div>
		<?php $visitor = $profile_data['username'];
           if ($user == $visitor)
{ ?>      <a role="button" class="btn btn-info" href="edit-profile.php">Edit Profile</a> 
           <?php } ?>
		   </div>
    </body>
</html> 



