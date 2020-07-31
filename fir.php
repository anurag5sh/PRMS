<?php 
include('session.php');
include('navbar.html');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$ct = $_POST['case_type'];
	$cn = $_POST['case_name'];
	$od = date('Y-m-d', strtotime($_POST['occured_date']));
	$bd = date('Y-m-d', strtotime($_POST['booked_date']));
	$sc = $_POST['stat_code'];
	$desc = $_POST['description'];
	$addr = $_POST['place'];
	$c_name = $_POST['c_name'];
	$c_num = $_POST['c_num'];
	
	if($_POST['c_relationship'])
		$c_relationship = $_POST['c_relationship'];
	
	if($bd<$od)
	{
		echo '<script type="text/javascript">';
		echo ' alert("Error - Invalid Date ")document.location = "fir.php";';
		echo '</script>';
		die();
	}

	$insert_fir = mysqli_query($db,"INSERT INTO fir (police_id,case_name,case_type,date_occured,date_booked,station_code,description,c_name,c_num,c_relationship) 
	VALUES ('$user_id','$cn','$ct','$od','$bd','$sc','$desc','$c_name','$c_num','$c_relationship')");
	
	if($insert_fir)
	{
		$last_id = mysqli_insert_id($db);
		$insert_case = mysqli_query($db,"INSERT INTO cases VALUES ('$user_id','$last_id','$ct','$cn','$bd','$od','Not Solved','$addr','$desc')");
		
		if($_POST['victim_name'][0])
		{	$vic_name = $_POST['victim_name'];
			$vic_dob = $_POST['victim_dob'];
			$vic_gender = $_POST['vg'];
			for($i=0;$i<count($vic_name);$i++){
			mysqli_query($db,"INSERT INTO victim (gender,case_no,name,dob) VALUES ('$vic_gender[$i]','$last_id','$vic_name[$i]','$vic_dob[$i]')");}
		}
		
		if($_POST['accused_name'][0])
		{	$ac_name = $_POST['accused_name'];
			$ac_dob = $_POST['accused_dob'];
			$ac_gender = $_POST['ag'];
			for($j=0;$j<count($ac_name);$j++){
			mysqli_query($db,"INSERT INTO accused (gender,case_no,name,dob) VALUES ('$ac_gender[$j]','$last_id','$ac_name[$j]','$ac_dob[$j]')");}
		}
		
		echo '<script type="text/javascript">';
		echo ' alert("FIR added Successfully!");document.location = "fir.php";';
		echo '</script>';
	}
	else{
		echo '<script type="text/javascript">';
		echo ' alert("Error'. mysqli_error($db) .' ");';
		echo '</script>';
	}
}


?>
<html lang="en">
<head>
  <title>FIR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
  <script> 
		let element = document.getElementById("fir");
		element.classList.add("active");
		</script>
  
</head>
<body>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h1 class="display-5 text-center">FIRST INFORMATION REPORT (FIR)</h1>
  </div></div>
<div class="container">
  <form class="fir-form" action="" method="POST">


    <div class="form-group row ">
      <label class="col-form-label col-sm-2" for="case_type">CASE TYPE:</label>
      <div class="col-sm-10">      
        <select class="form-control w-25" id="case_type" name="case_type" required>
        <option selected="true" disabled="disabled" >Select Type</option>
      <option value="Criminal">CRIMINAL</option>
      <option value="Civil">CIVIL</option>
    </select>
      </div>
    </div>

    <div class="form-group row ">
      <label class="col-form-label col-sm-2" for="case_name">CASE NAME:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control w-50	" id="case_name" placeholder="Enter case name" name="case_name" required>
      </div>
    </div>

    <div class="form-group row ">
      <label class="col-form-label col-sm-2" for="occured_date">OCCURED DATE:</label>
      <div class="col-sm-10">          
        <input type="date" class="form-control w-25" id="occured_date" placeholder="Choose the date" name="occured_date" required>
      </div>
    </div>

    <div class="form-group row ">
      <label class="col-form-label col-sm-2" for="booked_date">BOOKED DATE:</label>
      <div class="col-sm-10">          
        <input type="date" class="form-control w-25" id="bd" placeholder="Choose the date" name="booked_date" required>
    </div>
</div>



<div class="form-group row">
      <label class="col-form-label col-sm-2" >COMPLAINANT INFO:</label>
      <div class="col-sm-10">
       <div class="form-row">
	   <div class="form-group col-md-4">
      <label for="c_name">NAME :</label>
      <input type="text" name="c_name" class="form-control" placeholder="Enter Complainant Name" id="c_name" required>
    </div>
          <div class="form-group col-md-4">
      <label > PHONE NO. :</label>
          <input type="number" min="0" name="c_num" class="form-control" placeholder="Enter phone no." required >
    </div>
	<div class="form-group col-md-4">
      <label > RELATIONSHIP:</label>
          <input type="text" name="c_relationship" class="form-control"  >
    </div>
	</div>
	</div>
	</div>
	
	
	
	

<div class="form-group row">
      <label class="col-form-label col-sm-2" >VICTIM INFO:</label>
      <div class="col-sm-10">
       <div class="form-row after-add-more">
	   <div class="form-group col-md-4">
      <label for="victim_name">NAME :</label>
      <input type="text" name="victim_name[]" class="form-control" placeholder="Enter Victim Name Here" id="victim_name">
    </div>
          <div class="form-group col-md-4">
      <label for="victim_dob"> ENTER DOB :</label>
          <input type="date" id="victim_dob" name="victim_dob[]" class="form-control" placeholder="Enter DOB Here">
    </div>
          
		
		<div class="form-group col-md-3" >
      <label >VICTIM GENDER:</label>
    <select name="vg[]" id="vg" class="custom-select">
	<option selected="true" disabled="disabled" >Select </option>
	<option value="Male"> Male </option>
	<option value="Female"> Female </option>
	<option value="Other" > Other </option>
	</select></div>
	
          <div class="form-group col-md-1"> 
            <button class="btn btn-info add-more" type="button"><i class="fa fa-plus"></i></button>
          </div>
        </div>
    </div>
  </div>


  <div class="form-group row">
      <label class="col-form-label col-sm-2" for="booked_date">ACCUSED INFO:</label>
      <div class="col-sm-10">

      	<div class="form-row after-add-more1">
		<div class="form-group col-md-4">
      <label for="accused_name">NAME :</label>
      <input type="text" id="accused_name" name="accused_name[]" class="form-control" placeholder="Enter Accused Name Here">
    </div>
		
          <div class="form-group col-md-4">
      <label for="accused_dob" > ENTER DOB :</label>
          <input type="date" id="accused_dob" name="accused_dob[]" class="form-control" placeholder="Enter Accused DOB Here">
    </div>
         
		 
         <div class="form-group col-md-3" >
      <label >ACCUSED GENDER:</label>
    <select name="ag[]" id="ag" class="custom-select">
	<option selected="true" disabled="disabled" >Select </option>
	<option value="Male"> Male </option>
	<option value="Female"> Female </option>
	<option value="Other" > Other </option>
	</select></div>
          <div class="form-group col-md-1"> 
            <button class="btn btn-info add-more1" type="button"><i class="fa fa-plus"></i></button>
          </div>
        </div>


    </div>
  </div>


<div class="form-group row">
      <label class="col-form-label col-sm-2" for="stat_code">Station Code:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="stat_code" placeholder="Enter station code" name="stat_code" required>
      </div>
</div>
 <div class="form-group row row">
      <label class="col-form-label col-sm-2" for="case_name">PLACE:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="place" placeholder="Enter Place" name="place" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-form-label col-sm-2" for="desc">DESCRIPTION:</label>    
      <div class="col-sm-10">     
        <textarea class="form-control" rows="5" id="desc" name="description" required></textarea>
      </div>
    </div>
 <div class="form-group row">    
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success" id="sub">SUBMIT</button>
      </div>
    </div>
	

  </form>
    <!-- Copy Fields -->
        <div class="copy d-none">
          <div class="form-row control-group">
	   <div class="form-group col-md-4">
      <label for="victim_name">NAME :</label>
      <input type="text" name="victim_name[]" class="form-control" placeholder="Enter Victim Name Here" id="victim_name">
    </div>
          <div class="form-group col-md-4">
      <label for="victim_dob"> ENTER DOB :</label>
          <input type="date" id="victim_dob" name="victim_dob[]" class="form-control" placeholder="Enter DOB Here">
    </div>
          
		
		<div class="form-group col-md-3" >
      <label >VICTIM GENDER:</label>
    <select name="vg[]" id="vg" class="custom-select">
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
      <input type="text" id="accused_name" name="accused_name[]" class="form-control" placeholder="Enter Accused Name Here">
    </div>
		
          <div class="form-group col-md-4">
      <label for="accused_dob" > ENTER DOB :</label>
          <input type="date" id="accused_dob" name="accused_dob[]" class="form-control" placeholder="Enter Accused DOB Here">
    </div>
         
		 
         <div class="form-group col-md-3" >
      <label >ACCUSED GENDER:</label>
    <select name="ag[]" id="ag" class="custom-select">
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
		
		
		
</div>
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
</body>
</html>