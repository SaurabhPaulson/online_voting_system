<?php	
session_start();
require('connect.php');
?>
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
} 

<!doctype html>
<html>
<head>
	<title>Profile</title>
	<style type="text/css">
		.wrapper
		{
			width: 400px;
			margin: 0 auto;
			style: white;	
		}
	</style>
</head>
<body style="background-color: #004528; ">
	<div class="container">
		<form action="profileedit.php?id=<?php echo $_SESSION['member_id']; ?>" method="post" onsubmit="return updateProfile(this)">
			<button class="btn btn-default" style="float: right; width: 70px" name="submit1">Edit</button>
		</form>
		<div class="wrapper">

			<?php
				$result=mysqli_query($con, "SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'");	
			?>
			<h2 style="text-align: center;"> MY PROFILE </h2>

			<?php
				$row = mysqli_fetch_array($result);
				
					if($row)
 					{
 						// get data from db
						$stdId = $row['member_id'];
 						$firstName = $row['first_name'];
 						$lastName = $row['last_name'];
 						$email = $row['email'];
					 }

				
			?>

			<div style="text-align: center;"><b> WELCOME </b></div>
				<h4>
					<?php echo $_SESSION[member_id] ; ?>
				</h4>

			
			<?php
				echo "<b>";
				echo "<table class='table table-bordered'>";
				echo "<tr>";
					echo "<td>";
						echo "<b> Member id: </b>";
					echo "</td>";
					echo "<td>";
						echo $row['member_id'];
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>";
						echo "<b> First Name: </b>";
					echo "</td>";
					echo "<td>";
						echo $row['first_name'];
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>";
						echo "<b> Last Name: </b>";
					echo "</td>";
					echo "<td>";
						echo $row['last_name']; 
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>";
						echo "<b> Email: </b>";
					echo "</td>";
					echo "<td>";
						echo $row['email']; 
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
			                echo "<td>";
						echo "<b> Password: </b>";
					echo "</td>";
					echo "<td>";
						echo $row['password'];
					echo "</td>";
				echo "</tr>";
				echo "</table>";
				echo "</b>"
				
			?>
		</div>
	</div>
</body>
</html>