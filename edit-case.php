<?php
	include('session.php');
	include('navbar.html');

	if (isset($_GET['case'])) {
		$case_no = $_GET['case'];
		$auth=mysqli_query($db,"SELECT police_id from cases WHERE case_no='$case_no'");
		if(mysqli_num_rows($auth) <=0){
			echo "Case not found!";
			die();
		}
		$pid=mysqli_fetch_array($auth);
		if($pid['police_id']!=$user_id){
			echo "Not authorized!";
			die();
		}
	}
	else{
		header("location:dashboard.php");
	}

	$result = mysqli_query($db,"SELECT * from cases WHERE case_no = '$case_no'");
    $row=mysqli_fetch_array($result);
	
	$victims = mysqli_query($db,"SELECT * FROM victim WHERE case_no = '$case_no'");
	$accused = mysqli_query($db,"SELECT * FROM accused WHERE case_no = '$case_no'");
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		 $case_name = $_POST['case_name'];
		 $case_type = $_POST['case_type'];
		 $date = date('Y-m-d', strtotime($_POST['date']));
		 $status = $_POST['status'];
		 $address = $_POST['address'];
		 $description = $_POST['description'];
		 
		 $update_case = mysqli_query($db,"UPDATE cases SET case_name = '$case_name',
                      case_type = '$case_type', date = '$date',status='$status',address='$address',
					  description='$description' WHERE case_no = '$case_no'");
					  
					  
		if($_POST['new_victim_name'][0])
		{	$vic_name = $_POST['new_victim_name'];
			$vic_dob = $_POST['new_victim_dob'];
			$vic_gender = $_POST['new_vg'];
			for($i=0;$i<count($vic_name);$i++){
				mysqli_query($db,"INSERT INTO victim (gender,case_no,name,dob) VALUES ('$vic_gender[$i]','$case_no','$vic_name[$i]','$vic_dob[$i]')");
		}}
		
		if($_POST['new_accused_name'][0])
		{	$ac_name = $_POST['new_accused_name'];
			$ac_dob = $_POST['new_accused_dob'];
			$ac_gender = $_POST['new_ag'];
			for($j=0;$j<count($ac_name);$j++){
				mysqli_query($db,"INSERT INTO accused (gender,case_no,name,dob) VALUES ('$ac_gender[$j]','$case_no','$ac_name[$j]','$ac_dob[$j]')");
		}}
		
		if ($update_case) {
			echo '<script type="text/javascript">';
		echo ' alert("Case updated Successfully!");
		document.location = "view-case.php?case='.$case_no.'"';
		echo '</script>';
			
		   //header("Location: view-case.php?case=$case_no");
	    } else {
		  echo mysqli_error;
	    }
	 }
	
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $row['case_name'] ?></title>
		<script type="text/javascript">


    $(document).ready(function() {


      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });
	  
	  $(".add-more1").click(function(){ 
          var html = $(".copy1").html();
          $(".after-add-more1").after(html);
      });


      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
	  


    });


</script>
	</head>
<body>
	<br>
	<br>
	<div class="container">
		
		<h3>Update Case:<?php $row['case_name']?></h3>
		<form method="post" action="edit-case.php?case=<?php echo $case_no; ?>">
			<div class="form-group">
			<label >Case Name:</label>
			<input class="form-control" type="text" name="case_name" required value="<?php echo $row['case_name'] ?>" />
			</div>
			<div class="form-group">
			<label>Case Type:</label>
			<select class="form-control" name="case_type" required >
			<option value="Civil" <?php if($row['case_type']=="Civil") echo "selected" ?>>Civil</option>
			<option value="Criminal" <?php if($row['case_type']=="Criminal") echo "selected" ?>>Criminal</option>
			</select>
			</div>
			<div class="form-group">
			<label>Date</label>
			<input class="form-control" type="date" name="date" required value="<?php echo $row['date'] ?>" />
			</div>
			<div class="form-group">
			<label>Status</label>
			<select name="status" required class="form-control">
			<option value="Solved" <?php if($row['status']=="Solved") echo 'selected="selected"'; ?>>Solved </option>
			<option value="Unsolved" <?php if($row['status']=="Unsolved") echo 'selected="selected"'; ?>>Unsolved </option>
			</select>
			</div>
			<div class="form-group">
			<label>Address</label>
			<input class="form-control" type="text" name="address" required value="<?php echo $row['address'] ?>" />
			</div>
			<div class="form-group">
			<label>Description</label>
			<textarea class="form-control" name="description" required rows="5"><?php echo $row['description'] ?></textarea>
			</div>
			
			
			<?php while($vic = mysqli_fetch_array($victims,MYSQLI_ASSOC)){
				echo '<div class="form-group row">
      <label class="col-form-label col-sm-2" >VICTIM INFO:</label>
      <div class="col-sm-10">
       <div class="form-row after-add-more">
	   <div class="form-group col-md-4">
      <label for="victim_name">NAME :</label>
      <input type="text" name="victim_name[]" class="form-control" placeholder="Enter Victim Name Here" id="victim_name" value="'.$vic['name'].'">
    </div>
          <div class="form-group col-md-4">
      <label for="victim_dob"> ENTER DOB :</label>
          <input type="date" id="victim_dob" name="victim_dob[]" class="form-control" placeholder="Enter DOB Here" value="'.$vic['dob'].'">
    </div>
          
		
		<div class="form-group col-md-3" >
      <label >VICTIM GENDER:</label>
    <select name="vg[]" id="vg" class="custom-select">
	<option  disabled="disabled" >Select </option>
	<option value="Male" '.(($vic['gender']=='Male')?'selected="selected"':"").'> Male </option>
	<option value="Female" '.(($vic['gender']=='Female')?'selected="selected"':"").'> Female </option>
	<option value="Other" '.(($vic['gender']=='Other')?'selected="selected"':"").' > Other </option>
	</select></div>
	
          <div class="form-group col-md-1"> 
            <button class="btn btn-info add-more" type="button"><i class="fa fa-plus"></i></button>
          </div>
        </div>
    </div>
  </div>';

			}				?>
			

<?php while($ac = mysqli_fetch_array($accused,MYSQLI_ASSOC)){
  echo '<div class="form-group row">
      <label class="col-form-label col-sm-2" for="booked_date">ACCUSED INFO:</label>
      <div class="col-sm-10">

      	<div class="form-row after-add-more1">
		<div class="form-group col-md-4">
      <label for="accused_name">NAME :</label>
      <input type="text" id="accused_name" name="accused_name[]" class="form-control" placeholder="Enter Accused Name Here" value="'.$ac['name'].'">
    </div>
		
          <div class="form-group col-md-4">
      <label for="accused_dob" > ENTER DOB :</label>
          <input type="date" id="accused_dob" name="accused_dob[]" class="form-control" placeholder="Enter Accused DOB Here" value="'.$ac['dob'].'">
    </div>
         
		 
         <div class="form-group col-md-3" >
      <label >ACCUSED GENDER:</label>
    <select name="ag[]" id="ag" class="custom-select">
	<option disabled="disabled" >Select </option>
	<option value="Male" '.(($ac['gender']=='Male')?'selected="selected"':"").'> Male </option>
	<option value="Female" '. (($ac['gender']=='Female')?'selected="selected"':"").'> Female </option>
	<option value="Other" '. (($ac['gender']=='Other')?'selected="selected"':"").'> Other </option>
	</select></div>
          <div class="form-group col-md-1"> 
            <button class="btn btn-info add-more1" type="button"><i class="fa fa-plus"></i></button>
          </div>
        </div>


    </div>
</div>'; } ?>
			
			
			
			
			
			<input class="btn btn-primary" type="submit" value="Update Case" />        
		</form>  
		
		
		  <!-- Copy Fields -->
        <div class="copy d-none">
          <div class="form-row control-group">
	   <div class="form-group col-md-4">
      <label for="victim_name">NAME :</label>
      <input type="text" name="new_victim_name[]" class="form-control" placeholder="Enter Victim Name Here" id="victim_name">
    </div>
          <div class="form-group col-md-4">
      <label for="victim_dob"> ENTER DOB :</label>
          <input type="date" id="new_victim_dob" name="victim_dob[]" class="form-control" placeholder="Enter DOB Here">
    </div>
          
		
		<div class="form-group col-md-3" >
      <label >VICTIM GENDER:</label>
    <select name="new_vg[]" id="vg" class="custom-select">
	<option selected="true" disabled="disabled" >Select </option>
	<option value="Male"> Male </option>
	<option value="Female"> Female </option>
	<option value="Other" > Other </option>
	</select></div>
	
          <div class="form-group col-md-1"> 
            <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        </div>
		
		
		<!-- Copy Fields -->
        <div class="copy1 d-none">
          <div class="form-row control-group">
		<div class="form-group col-md-4">
      <label for="accused_name">NAME :</label>
      <input type="text" id="accused_name" name="new_accused_name[]" class="form-control" placeholder="Enter Accused Name Here">
    </div>
		
          <div class="form-group col-md-4">
      <label for="accused_dob" > ENTER DOB :</label>
          <input type="date" id="accused_dob" name="new_accused_dob[]" class="form-control" placeholder="Enter Accused DOB Here">
    </div>
         
		 
         <div class="form-group col-md-3" >
      <label >ACCUSED GENDER:</label>
    <select name="new_ag[]" id="ag" class="custom-select">
	<option selected="true" disabled="disabled" >Select </option>
	<option value="Male"> Male </option>
	<option value="Female"> Female </option>
	<option value="Other" > Other </option>
	</select></div>
          <div class="form-group col-md-1"> 
            <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        </div>
		
		
		
		<form class="form-row"action="upload.php?case=<?php echo $case_no;?>" method="post" enctype="multipart/form-data">
    Select file to upload:  
    <input class="form-control w-25"  type="file" name="fileToUpload" id="fileToUpload"><br><pre> &#09 </pre>
    <input class="btn btn-primary"type="submit" value="Upload Image" name="submit">
</form>
	</div>  
</body>
</html>