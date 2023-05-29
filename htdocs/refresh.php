<?php
session_start();
require('connect.php');


// retrieving candidate(s) results based on position
if (isset($_POST['Submit'])){   
/*
$resulta = mysqli_query($con, "SELECT * FROM tbCandidates where candidate_name='Luis Nani'");

while($row1 = mysqli_fetch_array($resulta))
  {
  $candidate_1=$row1['candidate_cvotes'];
  }
  */
  $position = addslashes( $_POST['position'] );
  
    $results = mysqli_query($con, "SELECT * FROM tbCandidates where candidate_position='$position'");

    $row1 = mysqli_fetch_array($results); // for the first candidate
    $row2 = mysqli_fetch_array($results); // for the second candidate
      if ($row1){
      $candidate_name_1=$row1['candidate_name']; // first candidate name
      $candidate_1=$row1['candidate_cvotes']; // first candidate votes
      }

      if ($row2){
      $candidate_name_2=$row2['candidate_name']; // second candidate name
      $candidate_2=$row2['candidate_cvotes']; // second candidate votes
      }
}
    else
        // do nothing
?> 
<?php
// retrieving positions sql query
$positions=mysqli_query($con, "SELECT * FROM tbPositions");
?>
<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}
?>

<?php if(isset($_POST['Submit'])){$totalvotes=$candidate_1+$candidate_2;} ?>

<html>
	<head>

<link rel="stylesheet" href="style1.css">
<link rel="stylesheet" type="text/css" href="style2.css">
<link rel="stylesheet" type="text/css" href="admin2.css">
<link href="adminsty.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
   	 href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script language="JavaScript" src="js/admin.js">	

<script language="javascript" src="js/jquery-1.2.6.min.js"></script>
<script language="javascript" src="js/jquery.timers-1.0.0.js"></script>
<script type="text/javascript">

$(document).ready(function(){
   var j = jQuery.noConflict();
	j(document).ready(function()
	{
		j(".refresh").everyTime(1000,function(i){
			j.ajax({
			  url: "refresh.php",
			  cache: false,
			  success: function(html){
				j(".refresh").html(html);
			  }
			})
		})
		
	});
   j('.refresh').css({color:"green"});
});
</script>
	</head>
<body>
	<header>
    <div class="wrapper">
        <div class="logo">
            <img src="https://i.postimg.cc/GpdP362Q/logo.png" alt="">
        </div>
<ul class="nav-area">
<li><a href="admin.php">Control Panel</a></li>
<li><a href="positions.php">Manage Positions</a></li>
<li><a href="candidates.php">Manage Candidates</a></li>
<li><a href="refresh.php">Poll Results</a> </li>
<li><a href="manage-admins.html">Manage Account</a></li>
<li><a href="logout.php">Logout</a></li>
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
</style>


</ul>
</div>
<br>


<div id="page">
<div id="header">	
<center><h2 style= "color:white;"> POLL RESULTS </h2></center>
<br /><br /><br /><br /><br />
<div class="login-box">
<style>
{
.login-box
{
    position: absolute;
    top: 50%;
    left: 50%;
    width: 1200px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,0.5);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,10);
    border-radius: 10px;
}
}
</style>
<div class="container">
<table width="420" align="center">
<br />
<div class="row">
<div class="col-md-6">

<form name="fmNames" id="fmNames" method="post" action="refresh.php" onSubmit="return positionValidate(this)">
<tr>
    <td><font color = "white" size="4">Choose Position</font><br><br></td>
    <td><SELECT NAME="position" id="position">
    <OPTION VALUE="select">select
    <?php 
    //loop through all table rows
    while ($row=mysqli_fetch_array($positions)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    	</OPTION>
    </SELECT></td>
    <td><input type="submit" name="Submit" value="See Results" /></td>
<style>
input[type=button], input[type=submit], input[type=reset] {
  background-color: #000000;
  border: none;
  color: skyblue;
  padding: 5px 25px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
</tr>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
</tr>
</form> 
</div>
</div>
</div>
</table>

	<div class="row">
		<div class="col-md-6">

<font color = "white" size="4">
<?php if(isset($_POST['Submit'])){echo $candidate_name_1;} ?>:<br>
<img src="candidate-1.gif"
width='<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>'
height='20'>
<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
<br>votes <?php if(isset($_POST['Submit'])){ echo $candidate_1;} ?>
<br>
<br>
<?php if(isset($_POST['Submit'])){ echo $candidate_name_2;} ?>:<br>
<img src="candidate-2.gif"
width='<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>'
height='20'>
<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
<br>votes <?php if(isset($_POST['Submit'])){ echo $candidate_2;} ?>
</font>
</div>
<div id="footer">
<div class="bottom_addr"></div>
</div>
</div>


			</form>
			<br />
		</div>
		
	</div>

	<br />
	<br />
	<br />
	</div>
</body>
</html>



