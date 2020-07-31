<?php
	include('session.php');
	include('navbar.html');
	
	if (isset($_GET['case'])) {
		$case_no = $_GET['case'];
		
	}
	else{
		header("location:dashboard.php");
	}

	$result = mysqli_query($db,"SELECT * from cases WHERE case_no = '$case_no'");
	if(mysqli_num_rows($result) <=0){
			echo "Case not found!";
			die();
		}
	
	$count = mysqli_num_rows($result);
      if($count == 1) {
         $row=mysqli_fetch_array($result);
      }else {
         $error = "Invalid Case NO.";
      }
	
	$victims = mysqli_query($db,"SELECT * FROM victim WHERE case_no = '$case_no'");
	$accused = mysqli_query($db,"SELECT * FROM accused WHERE case_no = '$case_no'");
	
	if (file_exists('./uploads/'.$case_no."/")) {
	$path    = './uploads/'.$case_no."/";
	$files = array_diff(scandir($path), array('.', '..'));}
	else{
		$files=[];
	}
	
?>

<html>    
<head>        
	<meta charset="UTF-8">
	<title><?php echo $row['case_name'] ?></title>
	

<script>
function goBack() {
  window.history.back();
}
</script>
</head>
<body>
<div class="container">
<button class="btn btn-primary" onclick="goBack()">Go Back</button>
<a class="btn btn-primary" href="view-fir.php?id=<?php echo $case_no; ?>">View FIR</a><br><br>
	<table class="table ">
    <h3>Case: <?php echo $row['case_name']; ?></h3>
                    <tr>                
                    	<td><b>Case ID:</b></td><td><?php echo $row['case_no']?></td>
                    </tr>
					<tr>                
                    	<td><b>Police ID:</b></td><td><?php echo $row['police_id']?></td>
                    </tr>
                    <tr>
                    	<td><b>Case Type:</b></td><td><?php echo $row['case_type'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Created on:</b></td><td><?php echo $row['created'] ?></td>
                    </tr>
					<tr>
                        <td><b>Date:</b></td><td><?php echo $row['date'] ?></td>
                    </tr>
					<tr>
                        <td><b>Status:</b></td><td><?php echo $row['status'] ?></td>
                    </tr>
					<tr>
                        <td><b>Address:</b></td><td><?php echo $row['address'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Description:</b></td><td><?php echo $row['description'] ?></td>
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
	<?php 
		while($vic = mysqli_fetch_array($victims,MYSQLI_ASSOC))
		  {
		  echo "<tr>";
		  echo "<td>" . $vic['name'] . "</td>";
		  echo "<td>" . $vic['gender'] . "</td>";
		  echo "<td>" . $vic['dob'] . "</td>";
		  echo "</tr>";
		  }
		echo "</tbody></table>";
?>
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
	<?php 
		while($ac = mysqli_fetch_array($accused,MYSQLI_ASSOC))
		  {
		  echo "<tr>";
		  echo "<td>" . $ac['name'] . "</td>";
		  echo "<td>" . $ac['gender'] . "</td>";
		  echo "<td>" . $ac['dob'] . "</td>";
		  echo "</tr>";
		  }
		echo "</tbody></table>";
?>
</div>

<div class="container">
		<h3> Documents </h3><br>
		<table class="table">
		<thread>
		<tr>
		<th>#</th>
		<th>File Name</th>
		</tr>
		</thread>
		 
		<tbody>
		<?php $i=2;
		
		if( count($files)>0){
		while($i<(count($files)+2))
		  {
		  echo "<tr>";
		  echo "<td>" . ($i - 1) . "</td>";
		  echo "<td><a target='_blank' href='/uploads/". $row['case_no'] ."/".$files[$i] ."'>" . $files[$i] . "</a></td>";
		  echo "</tr>";
		  
		  $i++;
		}}
		echo "</tbody></table>";
?>
</div>
		
		<?php 
           if ($user_id == $row['police_id'])
{ ?>    <a role="button" class="btn btn-info" href="edit-case.php?case=<?php echo $row['case_no']; ?>">Edit Case</a><br><br>
           <?php } ?>
		   </div>
    </body>
</html> 



