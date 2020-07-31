<?php 
	include('session.php');
	include('navbar.html');
	
	if (isset($_GET['type'])) {
	$case_type = $_GET['type'];}
		
	else{
		header("location:dashboard.php");
	}
	
?>

<html>    
<head>        
	<script> 
		let element = document.getElementById("mycases");
		element.classList.add("active");
		</script>
	 
</head>
<body>
<?php 
	if($case_type == "Civil" || $case_type == "Criminal" ){
		echo "<head><title>".$_GET['type']." Cases</title></head>";
		$result = mysqli_query($db,"SELECT * from cases WHERE police_id = 
		(SELECT police_id from user WHERE username = '$login_session') AND case_type='$case_type'");
		
		//$row=mysqli_fetch_array($result);
		//print_r($row);
		
		if(mysqli_num_rows($result)<=0){
			echo "No cases found.";
			die();
		}
		?>
		<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h1 class="display-5 text-center"><?php echo $case_type;?> Cases </h1>
  </div></div>
		<div class="container">
		<table class="table table-hover">
		<thread>
		<tr>
		<th>Case No</th>
		<th>Case Name</th>
		<th>Date</th>
		<th>Status</th>
		<th></th>
		</tr>
		</thread>
		 
		<tbody>
	<?php 
		while($row = mysqli_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['case_no'] . "</td>";
		  echo "<td>" . $row['case_name'] . "</td>";
		  echo "<td>" . $row['date'] . "</td>";
		  echo "<td>" . $row['status'] . "</td>";
		  echo "<td><a role='button' class='btn btn-outline-primary' href='view-case.php?case=".$row['case_no']."'>View Case</a></td>";
		  echo "</tr>";
		  }
		echo "</tbody></table>";
	}
	else{
		echo "Invalid Case type!";
	}
?>

</div>
</body>
</html>
