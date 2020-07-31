<?php
	include('session.php');
	include('navbar.html');
	
	$award_sql = "SELECT awards from user where username='$login_session'";
	$result = mysqli_query($db,$award_sql);

	$row_award = mysqli_fetch_array($result);
	$award = preg_split ("/\,/",$row_award['awards']);  
?>

<html>
<head>
<title> Awards </title>
<script> 
let element = document.getElementById("awards");
  element.classList.add("active");
</script>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h1 class="display-5 text-center">AWARDS</h1>
  </div></div>
	<div class="container">
	<ul class="list-group">
	
	<?php 
	
	for($i=0;$i<count($award);$i++){
		echo '<li class="list-group-item">'.$award[$i].'</li>';
	}
	?>
	
	
	</ul>
	</div>
	

</body>

</html>