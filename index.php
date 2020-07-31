<?php 
	include('navbar-home.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>PRMS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Create two unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
height:400px;
margin-top:20px;  /* Should be removed. Only for demonstration */
}
.right {
width:33%;
height:400px;
color:black;
font-family:vendana;
font-size:20px;
box-shadow:5px 5px grey;
border:2px solid grey;
overflow-y:auto;


}


.left {
width:65%;
height:600px;
color:black;
font-family:vendana;
font-size:20px;

margin-right:5px;
  
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.head {
padding:3px; /* some padding */
  text-align: center; /* center the text */
background:#696969; /* green background */
  color: white;
border:1px solid grey;
}


</style>
</head>
<body>


<!-- Slide Show -->
<section>
<center>
<img class="mySlides" src="/images/pp.jpg" style="width:1000px;height:500px;margin-top:14px">
<img class="mySlides" src="/images/Court.jpeg" style="width:1000px;height:500px;margin-top:14px">
<img class="mySlides" src="/images/p2.jpg" style="width:1000px;height:500px;margin-top:14px">
</section>
<script>
// Automatic Slideshow - change image every 3 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  setTimeout(carousel,3000);
}
</script>


<div class="row">
<div class="column left" style="background-color:#ffffff;"> 
<h1>POLICE</h1>
  <p>The police are a constituted body of persons empowered by a state to enforce the law, to protect the lives, liberty and possessions
  of citizens, and to prevent crime and civil disorder. Their lawful powers include arrest and the legitimized use of force. 
  The term is most commonly associated with the police forces of a sovereign state that are authorized to exercise the police power of
  that state within a defined legal or territorial area of responsibility. </p><p>Police forces are often defined as being separate from the
  military and other organizations involved in the defense of the state against foreign aggressors; however, gendarmerie are military 
  units charged with civil policing.The police are a constituted body of persons empowered by a state to enforce the law, to protect the lives, liberty and possessions
  of citizens, and to prevent crime and civil disorder. Their lawful powers include arrest and the legitimized use of force. </p><p>
  The term is most commonly associated with the police forces of a sovereign state that are authorized to exercise the police power of
  that state within a defined legal or territorial area of responsibility. Police forces are often defined as being separate from the
  military and other organizations involved in the defense of the state against foreign aggressors; however, gendarmerie are military 
  units charged with civil policing.<p>
  </div>  

  <div class="column right" style="background-color:#ddd;">
 <div class="head">
<h3>NOTIFICATION</h3>
</div>
<marquee behavior="scroll" direction="up" style="height:300px;">
<p>1. UPSC exams will be conducted on 02/12/2019 date at Delhi
  </p>
 
  <p>2. Goa Police will be in charge of the patrol for the Police gallentry award cermony at Goa.
  </p>
  
  <p>3. Police conference will be conducted on 23-12-19 in Jaipur</p>
  
  <p>4. Maharshtra Police award ceremony is postponed to 29/12/2019.
  </p>
 
  <p>5. Last day to fill the application for special police force operation at spfo@gov.in is on 05/12/2019.
  </p>
  
  <p>6. Police conference will be conducted on 24-12-19 in Bangalore</p>
  </br>
  </marquee>
</div>
</div>
<style>
.footer {
background-color:#ddd;
padding:5px;
margin-top:30px;
  text-align: center;
border:1px solid grey;  
  
  
}
</style>

<div class="footer">
<h3>CONTACT</h3>
<p>INFO@PRMS.COM</p>
<p>INDIA</p>
<p>POLICE RECORD MANAGEMENT SYSTEM</p>
</div>


</body>
</html>





 

 