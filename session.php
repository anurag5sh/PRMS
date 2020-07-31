<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username,police_id,first_name from user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $user_id = $row['police_id'];
   $fname_session = $row['first_name']; 
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>