<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<title>Invalid Credentials</title>
 <link rel="stylesheet"  type="text/css" href="twotable.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
#page{
width:1000px;
margin:0 auto; 
margin-top:200px;
padding-top:0px;
background: beige;
height:auto;
}

#header{
text-align:center;
background:#000000;
}

#header{
	font-size:20px;
}
#container{
border:#000000 solid 1px;
padding:4px 6px 2px 6px;
width:970px; 
margin:0 auto; 
background:#c52030;  
font-size:12px; 
text-align:justify;
margin-top:20px;
margin-bottom:20px;
}

</style>
</head>
<body>
<body>
<div id="page">
<div id="header">
<div id="container">


<center><h1>Invalid Credentials Provided!!!</h1></center>
<p align="center">&nbsp;</p>
</div>
<p style="color:white;">

<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
require('connect.php');


// Defining your login details into variables
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$encrypted_mypassword=md5($mypassword); //MD5 Hash for security
// MySQL injection protections
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
//$myusername = mysqli_real_escape_string($myusername);
//$mypassword = mysqli_real_escape_string($mypassword);

$sql=mysqli_query($con, "SELECT * FROM tbmembers WHERE email='$myusername' and password='$encrypted_mypassword'");

// Checking table row
$count=mysqli_num_rows($sql);
// If username and password is a match, the count will be 1

if($count==1){
// If everything checks out, you will now be forwarded to student.php
$user = mysqli_fetch_assoc($sql);
$_SESSION['member_id'] = $user['member_id'];
header("location:student.php");
}
//If the username or password is wrong, you will receive this message below.
else {
echo "Wrong Username or Password";
}

ob_end_flush();

?> 
<br><br>Return to <a href="Login.html">login</a>
</p></div></div>
</body></html>