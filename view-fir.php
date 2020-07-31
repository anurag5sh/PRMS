<?php
	include('session.php');
	include('navbar.html');
	
	
	
	echo '<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h1 class="display-5 text-center">FIR</h1>
  </div></div>';
	
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		
		$get_fir = mysqli_query($db,"SELECT * FROM fir where case_no = '$id'");
		$row= mysqli_fetch_assoc($get_fir);
		
		if(mysqli_num_rows($get_fir) >0)
		{	$victims = mysqli_query($db,"SELECT * FROM victim WHERE case_no = '$id'");
		$accused = mysqli_query($db,"SELECT * FROM accused WHERE case_no = '$id'");
			echo '<html>    
<head>        
	<meta charset="UTF-8">
	<title>'. $row["case_name"] .'</title>
	

<script>
function goBack() {
  window.history.back();
}
</script>
</head>
<body>
<div class="container">
<button class="btn btn-primary" onclick="goBack()">Go Back</button><br><br>
	<table class="table ">
    <h3>Case:  '. $row["case_name"] .'</h3>
                    <tr>                
                    	<td><b>Case ID:</b></td><td>'. $row["case_no"].'</td>
                    </tr>
					<tr>                
                    	<td><b>Police ID:</b></td><td>'. $row["police_id"].'</td>
                    </tr>
                    <tr>
                    	<td><b>Case Type:</b></td><td>'.$row["case_type"] .'</td>
                    </tr>
                    <tr>
                        <td><b>Created on:</b></td><td>'.  $row["date_booked"] .'</td>
                    </tr>
					<tr>
                        <td><b>Date:</b></td><td>'. $row["date_occured"] .'</td>
                    </tr>
					<tr>
                        <td><b>Complainant Name:</b></td><td>'. $row["c_name"] .'</td>
                    </tr>
					<tr>
                        <td><b>Complainant Phone No.</b></td><td>'. $row["c_num"] .'</td>
                    </tr>
					<tr>
                        <td><b>Complainant Relationship:</b></td><td>'. $row["c_relationship"] .'</td>
                    </tr>
					<tr>
                        <td><b>Place:</b></td><td>'.  $row["place"].'</td>
                    </tr>
                    <tr>
                        <td><b>Description:</b></td><td>'.  $row["description"].'</td>
                    </tr>     
        </table>
		
		<div class="container">
		<h3> Victims </h3><br>
		<table class="table">
		<thread>
		<tr>
		<th>Name</th>
		<th>Gender</th>
		<th>Dob</th>
		</tr>
		</thread>
		 
		<tbody>
	';
		while($vic = mysqli_fetch_array($victims,MYSQLI_ASSOC))
		  {
		  echo "<tr>";
		  echo "<td>" . $vic["name"] . "</td>";
		  echo "<td>" . $vic["gender"] . "</td>";
		  echo "<td>" . $vic["dob"] . "</td>";
		  echo "</tr>";
		  }
		echo "</tbody></table>";
		echo '
</div>

<div class="container">
		<h3> Accused </h3><br>
		<table class="table">
		<thread>
		<tr>
		<th>Name</th>
		<th>Gender</th>
		<th>Dob</th>
		</tr>
		</thread>
		 
		<tbody>
	'; 
		while($ac = mysqli_fetch_array($accused,MYSQLI_ASSOC))
		  {
		  echo "<tr>";
		  echo "<td>" . $ac["name"] . "</td>";
		  echo "<td>" . $ac["gender"] . "</td>";
		  echo "<td>" . $ac["dob"] . "</td>";
		  echo "</tr>";
		  }
		echo "</tbody></table>";
		echo '
</div>
		
		   </div>
    </body>
</html> ';
		}
		else
		{
			echo '<div class="container"><h4>Invalid id</h4></div>';
		}
		
	}
	else{
		echo '<div class="container"><h4>Invalid id</h4></div>';
	}
	
?>

