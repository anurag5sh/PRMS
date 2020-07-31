<?php
   include("../config.php");
   include('../navbar-home.php');
   session_start();
   if(isset($_SESSION['login_user'])){
	   header("location:myprofile-admin.php");
	   die();
   }
   
   $error="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($db,$_POST['username_f']);
      $password = mysqli_real_escape_string($db,$_POST['password_f']); 
      
      $sql = "SELECT id FROM admin WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("username");
         $_SESSION['login_admin'] = $username;
         
         header("location: myprofile-admin.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div align = "center">
         <div style = "width:600px; border: solid 1px #333333;align =center;height:330px;">
            <div style = "background-color:#333333; color:#FFFFFF; padding:25px;font-size:22px;font-family:Eras Bold ITC;"><b>LOGIN</b></div>
				
            <div style = "margin:30px">
               
               <form action="" method = "post">
<br />
                  <label>USERNAME  :    </label> <input type = "text" name = "username_f" class = "box"/><br /><br /><br />

                  <label>PASSWORD  :    </label> <input type = "password" name = "password_f" class = "box" /><br/><br /><br />
                  <input type = "submit" value =" SUBMIT "<br />

               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>
  
  
  </body>
  </html>