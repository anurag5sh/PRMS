<?php 
include('../config.php'); 
 
// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = mysqli_query($db,"SELECT * FROM user WHERE first_name LIKE '%".$searchTerm."%' ORDER BY first_name ASC"); 
 
// Generate array with name data 
$nameData = array(); 
if(mysqli_num_rows($query) > 0){ 
    while($row = mysqli_fetch_assoc($query)){ 
	
        $data['id'] = $row['police_id']; 
        $data['value'] = $row['first_name'].' '.$row['last_name'].", Police-ID=".$row['police_id']; 
        array_push($nameData, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($nameData); 
?>