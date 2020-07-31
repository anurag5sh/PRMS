<?php
   include('session.php');
   include('navbar.html');
?>

<html>
<head>
<script> 
let element = document.getElementById("notification");
  element.classList.add("active");
</script>
<title> Notifications </title></head>
</head>

<body>

<div class="container">
		<h3>  </h3><br>
		<table class="table table-hover">
		<thread>
		<tr>
		<th># </th>
		<th>Date</th>
		<th>Message</th>
		<th></th>
		</tr>
		</thread>
		 
		<tbody>
<?php  
	$list = mysqli_query($db,"SELECT * from notification WHERE police_id = '$user_id' order by timestamp DESC");
	
	$i=0;
		while($row = mysqli_fetch_array($list))
		  { ++$i;
		  echo "<tr>";
		  echo "<td>" . $i . "</td>";
		  echo "<td>" . $row['timestamp'] . "</td>";
		  echo "<td>" . $row['message'] . "</td>";
		  echo "</tr>";
		  }
		echo "</tbody></table>";
	
?>

</body>

</html>