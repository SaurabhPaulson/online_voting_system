<?php	
session_start();
require('connect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My Profile</title>
	<link rel="stylesheet" href="style1.css">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet"  type="text/css" href="twotable.css">
<link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
body{
    background: linear-gradient(rgba(0, 0, 50, 0.5),rgba(0, 0, 50, 0.5)),url(image.jpg);
    background-size: cover;
    background-position: left;
}
input[type=button], input[type=submit], input[type=reset] {
  background-color: #000000;
  border: none;
  color: skyblue;
  padding: 5px 25px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
.login-box
{
    position: absolute;
    top: 60%;
    left: 50%;
    width: 450px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: #10294ee6;
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,10);
    border-radius: 10px;
}
table, td, th {
  border: transparent;
}
</style>
</head>
<body>



<header>
    <div class="wrapper">
        <div class="logo">
            <img src="logo.jpg" alt="">
        </div></div>
<ul class="nav-area">
<li><a href="student.php">Control Panel</a></li>
<li><a href="vote.php">Vote</a></li>
<li><a href="manage-profile.php">Manage Profile</a></li>
<li><a href="my profile.php">My Profile</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>

<br>
<style>
.nav-area{
    float: right;
    list-style: none;
    margin-top: 1px;
}
.nav-area li{
    display: inline-block;
}
.nav-area  a {
color: #00000;
text-decoration: none;
padding: 5px 20px;
font-family: poppins;
font-size: 16px;
text-transform: uppercase;
}
.nav-area li a:hover{
    background: #fff;
    color: #333;
}
            th, td { 
                
                text-align:center; 
              
                padding:10px 
              
            } 




</style>



<div class="container">	



<style type="text/css">
		.wrapper
		{
			width: 1200px;
			margin: 0 auto;
			style: white;	
		}
</style>
		

<font color = "white" size="4">
			<?php
				$result=mysqli_query($con, "SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'");	
			?>
		

			<?php
				$row = mysqli_fetch_array($result);
				
					if($row)
 					{
 						// get data from db
						$stdId = $row['member_id'];
 						$firstName = $row['first_name'];
 						$lastName = $row['last_name'];
						$class = $row['class'];
						$rollno = $row['rollno'];
 						$email = $row['email'];
						$password = $row['password'];
					 }

				
			?>
		<div class="login-box"> 
<imgsrc="image_avatar.jpg" alt="avatar" class="avatar">
<center><b><h1 style="color:white;">MY PROFILE</h1></b> </center>	<br><center>
			<?php
				echo "<b>";
				echo "<table>";
				echo "<tr>";
					echo "<td>";
						echo "<b> Member id </b>";
					echo "</td>";
                                                                                            echo "<td>";
						echo "<b> : </b>";
					echo "</td>";
					echo "<td>";
						echo $row['member_id'];
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>";
						echo "<b> First Name </b>";
					echo "</td>";
                                                                                              echo "<td>";
						echo "<b> : </b>";
					echo "</td>";
					echo "<td>";
						echo $row['first_name'];
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>";
						echo "<b> Last Name</b>";
					echo "</td>";
                                                                                               echo "<td>";
						echo "<b> : </b>";
					echo "</td>";
					echo "<td>";
						echo $row['last_name']; 
					echo "</td>";
				echo "</tr>";
			
				echo "<tr>";
					echo "<td>";
						echo "<b> Class </b>";
					echo "</td>";
                                                                                                echo "<td>";
						echo "<b> : </b>";
					echo "</td>";
					echo "<td>";
						echo $row['class']; 
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>";
						echo "<b> Rollno </b>";
					echo "</td>";
                                                                                               echo "<td>";
						echo "<b> : </b>";
					echo "</td>";
					echo "<td>";
						echo $row['rollno']; 
					echo "</td>";
				echo "</tr>";
                                                                         	echo "<tr>";
					echo "<td>";
						echo "<b> Email id</b>";
					echo "</td>";
                                                                                                echo "<td>";
						echo "<b> : </b>";
					echo "</td>";
					echo "<td>";
						echo $row['email']; 
					echo "</td>";
				echo "</tr>";
                                                                     
				echo "</table>";
				echo "</b>"
				
			?>
</center>
<table width="20" align="center" style="border-color:transparent;">
<tr>
    <td><br><br>
		<form action="manage-profile.php" id="<?php echo $_SESSION['member_id']; ?>" method="post" onsubmit="return updateProfile(this)">
			<input type="submit" name="Submit" value="Edit" >



		</form>
    </td>
</tr>
</table>
</div> 
</font>
		
</div>
</body>
</html>