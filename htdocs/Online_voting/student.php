<?php
require('connect.php');

session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Control Panel</title>
<link rel="stylesheet" href="style1.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header>
    <div class="wrapper">
        <div class="logo">
            <img src="logo.jpg" alt="">
        </div>
<ul class="nav-area">
<li><a href="index.html">Home</a></li>
<li><a href="Aboutus.html">About</a></li>
<li><a href="Login.html">User Login</a></li>
<li><a href="admin1.html">Admin Login</a></li>
</ul>
</div>
<br><br><br><br><center> <b><font color = "white" size="7">STUDENT CONTROL PANEL</font></b></center>
<div class="welcome-text">


<a href="student.php">Control Panel</a>
&nbsp &nbsp &nbsp
 <a href="vote.php">Vote</a><br>
<br>
 <a href="manage-profile.php">Manage Profile</a>&nbsp &nbsp &nbsp &nbsp <a href="my profile.php">My Profile</a> <br><br>  <a href="logout.php">Logout</a>
</div>
<p align="center">&nbsp;</p>
<div id="container">


<marquee><p style="color:white;">Click a link below to perform an operation.</p></marquee>


</div>

</div>
</body></html>