<?php
    session_start(); //we need session for the log in thingy XD 
    include("functions.php");
    require('connect.php');
?>
 <?php
        if(isset($_POST['submit'])){
            $myFirstName = $_POST['myFirstName'];
            $myLastName = $_POST['myLastName'];
            
           
           $class=$_POST['class']; 
            $rollno=$_POST['rollno'];
             $myEmail = $_POST['myEmail'];
            $myPassword = $_POST['myPassword'];
            $newpass=md5($_POST['newpass']);
          
            $message = "$myFirstName  $myLastName would like to request an account.";
            $query = "INSERT INTO `requests` (`id`,`myFirstname`, `myLastname`, `class`,`rollno`,`email`, `password`, `message`, `date`) VALUES (NULL,'$myFirstName', '$myLastName','$class','$rollno', '$myEmail', '$newpass', '$message', CURRENT_TIMESTAMP)";
            
            $stmt = $con->prepare($query);
             $stmt->execute();
             echo "<script>alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.')</script>";
              header("location:register.php");
  }    
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Request pending</title>
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
background:#b1cecb;  
font-size:12px; 
text-align:justify;
margin-top:20px;
margin-bottom:20px;
}
</style>
</head>
<body>
<div id="page">
<div id="header">
<div id="container">


<h1>Your account request is now pending for approval. Please wait for confirmation. Thank you. </h1>
<p align="center">&nbsp;</p>
</div>

<p style="color:white;">Try logging in to see whether your account has been accepted.<br>
<form action="Login.html">
<button type="submit" class="btn btn-primary" formaction="Login.html"> Login </button><br><br>
</p></div></div>
</body></html>