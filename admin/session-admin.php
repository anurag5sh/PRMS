<?php
   include('../config.php');
   session_start();
   
   $admin_check = $_SESSION['login_admin'];
   
   $ses_sql = mysqli_query($db,"select username,id from admin where username = '$admin_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $admin_id = $row['id'];
   if(!isset($_SESSION['login_admin'])){
      header("location:login-admin.php");
      die();
   }
?>