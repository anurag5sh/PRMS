<?php 
include('session-admin.php');
include('navbar.html');

if($_SERVER["REQUEST_METHOD"] == "POST") {
		$pid = $_POST['pid'];
		$message = $_POST['message'];
		
		$send = mysqli_query($db,"INSERT INTO notification (police_id,message) VALUES ('$pid','$message')");
		
		if($send)
		{
			 echo '<script type="text/javascript">';
		echo ' alert("Message Sent Successfully!");document.location = "notification-admin.php";';
		echo '</script>';
		}
		else
		{echo '<script type="text/javascript">';
		echo ' alert("Error'. mysqli_error($db) .' ");';
		echo '</script>';
		}
}


?>

<html>
<head>
<script> 
$(function() {
    $("#p_name").autocomplete({
        source: "users.php",
        select: function( event, ui ) {
            event.preventDefault();
            $("#p_name").val(ui.item.value.split(',')[0]);
			$("#pid").val(ui.item.id);
			
        }
    });
});
</script>
<title>Notification</title></head>
</head>

<body>
<div class="container w-50 p-3">
<form method="POST" action="">
	<label>Police Name</label>
	<input type="text" name="p_name" class="form-control" id="p_name" required >
	<input type="number" name="pid" style="display:none" id="pid"><br>
	<label>Message</label>
	<textarea name="message" size="50" class="form-control" required ></textarea><br>
	<input type="submit" value="Send Message" class="btn btn-success">
</div>
</form>
</body>

</html>