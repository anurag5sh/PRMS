<?php 
include('session-admin.php');

include('navbar.html');
$all = "SELECT * from user";
	$result = mysqli_query($db,$all);


?>

<html>
<head>
<title>ALL USERS</title>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h1 class="display-5 text-center">ALL USERS</h1>
  </div></div>
	<div class="container">
		<table class="table table-hover">
		<thread>
		<tr>
		<th>#</th>
		<th>Name</th>
		<th>Police ID</th>
		<th>Rank</th>
		<th></th>
		</tr>
		</thread>
		 
		<tbody>
	<?php 
	$i=1;
		while($row = mysqli_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $i++ . "</td>";
		  echo "<td>" . $row['first_name']." ".$row['last_name'] . "</td>";
		  echo "<td>" . $row['police_id'] . "</td>";
		  echo "<td>" . $row['rank'] . "</td>";
		  echo "</tr>";
		  }
		echo "</tbody></table>";?>
	
</div>
</body>

</html>