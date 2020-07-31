<?php
	include('session-admin.php');
	include('navbar.html');

	if(isset($_SESSION['login_admin']))
	{
	$user = $login_session;
	$get_user = mysqli_query($db,"SELECT * FROM admin WHERE username = '$user'");
	if ($count = mysqli_num_rows($get_user)== 1)
	{
		$profile_data = mysqli_fetch_array($get_user);
			   
	}
		   
	} else{
		header("location:login-admin.php");
	}
?>

<html>    
<head>        
	<meta charset="UTF-8">
	<title><?php echo $profile_data['name'] ?>'s Profile</title>
	<script> 
	let element = document.getElementById("myprofile");
	element.classList.add("active");
	</script>
</head>
<body>
	<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h1 class="display-5 text-center">PERSONAL INFORMATION</h1>
  </div></div>
	<div class="container ">     
      
	<div class="col-md-6">    
        <table class="table ">
                    <tr>                
                    	<td><b>Name:</b></td><td><?php echo $profile_data['name'] ?></td>   
                    </tr>
                    <tr>
                        <td><b>Gender:</b></td><td><?php echo $profile_data['gender']?></td>
                    </tr>
					
        </table> 
		</div>
    </body>
</html> 



