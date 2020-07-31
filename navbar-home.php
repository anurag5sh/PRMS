<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body {
  margin:0;
}

/* Style the header */
.header1 {
background-color:#222;
padding:15px;
text-align:center;
color:white;
font-size:30px;
font-family:Bodoni MT;
}
.header1 img{
	margin-left:5px;
float:left;
}
</style>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar1 {
  overflow: hidden;
  background-color:white;
font-family:Calibri;

}

.navbar1 a {
  float: left;
  font-size:22px;
  color:black;
  text-align: center;
  padding: 20px 22px;
  text-decoration: none;
  border-radius:8px;
margin-top:3px;
margin-left:2px;
margin-botton:1px;
margin-right:1px;
}
.navbar1 a.active{
 background-color:dimgrey;
  color:white;  
}


.dropdown1 {
float:left;
  overflow: hidden;
 border-radius:8px;
margin-top:3px;
margin-bottom:1px;
font-family:Calibri;
}

.dropdown1 .dropbtn1 {
  font-size:22px;  
  border: none;
  outline: none;
  color: black;
  padding:20px 22px;
  background-color: inherit;
  font-family: inherit;
  margin:0;
}

.navbar1 a:hover, .dropdown1:hover .dropbtn1 {
  background-color:grey;
}

.dropdown-content1 {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width:190px;
  box-shadow: 0px 4px 8px 0px rgba(0,0,0,0.2);
  z-index: 1;
float:left;

}

.dropdown-content1 a {
  float: none;
  color: black;
  padding:18px 22px;
  text-decoration: none;
  display: block;
  text-align: left;
font-size:19px;
}

.dropdown-content1 a:hover {
  background-color: #ccc;
}

.dropdown1:hover .dropdown-content1 {
  display: block;
}
</style>
</head>
<body>

<div class="header1">
<img src="/images/logo.png" width="150" height="130"><h2>POLICE RECORD MANAGEMENT SYSTEM</h2>
</div>


<div class="navbar1">
  <a class="<?php if(basename($_SERVER['PHP_SELF'])=='index.php') echo 'active';?>" href="/">HOME</a>
  <a class="<?php if(basename($_SERVER['PHP_SELF'])=='login.php') echo 'active';?>"href="/login.php">LOGIN</a>
<a href="/contacts.php">CONTACTS </a>
<a href="/stat_codes.php">STATION CODES </a>
<a class="<?php if(basename($_SERVER['PHP_SELF'])=='login-admin.php') echo 'active';?> "href="/admin/login-admin.php">ADMIN</a>


</div>
</body>
</html>