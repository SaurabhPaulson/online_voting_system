<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>OVS-Request Accepted</title>
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


<center><h1>Account accepted!! </h1></center>
<p align="center">&nbsp;</p>
</div>

<p style="color:white;">
<?php
    include('functions.php');
    $id = $_GET['id'];
    $query = "select * from `requests` where `id` = '$id'; ";
    if(count(fetchAll($query)) > 0){
        foreach(fetchAll($query) as $row){
            $firstname = $row['myFirstname'];
            $lastname = $row['myLastname'];
            $class = $row['class'];
            $rollno = $row['rollno'];
            $email = $row['email'];
            $password = $row['password'];
            $query = "INSERT INTO `tbmembers` (`member_id`, `first_name`, `last_name`,`class`,`rollno`, `email`, `password`) VALUES (NULL,'$firstname', '$lastname', ' $class', '$rollno', '$email', '$password');";
        }
        $query .= "DELETE FROM `requests` WHERE `requests`.`id` = '$id';";
        if(performQuery($query)){
            echo "Account has been accepted.";
        }else{
            echo "Unknown error occured. Please try again.";
        }
    }else{
        echo "Error occured.";
    }
    
?>
<br/><br/>
<a href="home.php">Back</a>
</p></div></div>
</body></html>