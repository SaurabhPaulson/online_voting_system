<?php
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Online Voting System</title>
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
background:#25a4ca;  
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


<center><h1>Logged out successfully!!!</h1></center>
<p align="center">&nbsp;</p>
</div>
<?php
session_destroy();
?>
<p style="color:white;">Return to <a href="index.html">Home</a><br>



</p></div></div>
</body></html>