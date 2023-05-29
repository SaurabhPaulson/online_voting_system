<?php
require('connect.php');
// retrieving candidate(s) results based on position
if (isset($_POST['Submit'])){                                    
  $position = addslashes( $_POST['position'] );
  
    $results = mysqli_query($con,"SELECT candidate_name,candidate_cvotes FROM tbcandidates WHERE candidate_position='$position' ORDER BY candidate_cvotes DESC LIMIT 2");
    
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
$tot=mysqli_query($con,"SELECT SUM(candidate_cvotes) FROM tbcandidates. WHERE candidate_position='$position'");
$positions=mysqli_query($con, "SELECT * FROM tbPositions");
?>
<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied-admin.php");
}
?>

<?php if(isset($_POST['Submit'])){$totalvotes=$candidate_1+$candidate_2;} ?>

<html><head>
<title>Poll Results</title>
 <link rel="stylesheet"  type="text/css" href="twotable.css">
    <link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
body{
background: linear-gradient(rgb(17 96 239 / 62%),rgb(212 212 226));
background-size: auto;
background-position: left;
}
input[type=button], input[type=submit], input[type=reset] {
  background-color: #000000;
  border: none;
  color: white;
  padding: 5px 15px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
.login-box{
   max-width: 800px;
   float: none;
   margin: 50px auto;
    position: absolute;
    top: 65%;
    left: 50%;
    width: 800px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: white;
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,10);
    border-radius: 10px;
}
 
 h1 { 
        margin: 3px auto; 
        text-align: top; 
        color: white; 
        font-size: 3em; 
        transition: 0.5s; 
        font-family: Arial, Helvetica, sans-serif; 
    }
 .wrapper{
    width: 1170px;
    margin: auto;
}
.nav-area{
    float: right;
    list-style: none;
    margin-top: 1px;
}
.nav-area li{
    display: inline-block;
}
.nav-area li a {
color: #fff;
text-decoration: none;
padding: 5px 10px;
font-family: poppins;
font-size: 16px;
text-transform: uppercase;
}
.nav-area li a:hover{
    background: #fff;
    color: #333;
}
</style>
<script language="JavaScript" src="js/admin.js">
</script>
</head><body>
<body>
<header>
    <div class="wrapper">
        <div class="logo">
            <img src="logo.jpg" alt="">
        </div>
<ul class="nav-area">
<li><a href="admin.php">Control Panel</a></li>
<li><a href="positions.php">Manage Positions</a></li>
<li><a href="candidates.php">Manage Candidates</a></li>
<li><a href="home.php">Manage Student Registration</a></li>
<li><a href="manage-admins.php">Manage Account</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<br>

<div class="container">
<br><br> <b><h1 style="color:white;">POLL RESULTS</h1></b>
    <div class="login-box">
 
<table width="420" align="center">
<form name="fmNames" id="fmNames" method="post" action="refresh.php" onSubmit="return positionValidate(this)">
<tr>
    <td>Choose Position</td>
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
    </SELECT></td>
    <td><input type="submit" name="Submit" value="See Results" /></td>
</tr>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
</tr>
</form> 
</table>
<?php if(isset($_POST['Submit'])){echo $candidate_name_1;} ?>:<br>
<img src="images/candidate-1.gif"
width='<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>'
height='20'>

<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
<br>votes <?php if(isset($_POST['Submit'])){ echo $candidate_1;} ?>
<br>
<br>
<?php if(isset($_POST['Submit'])){ echo $candidate_name_2;} ?>:<br>
<img src="images/candidate-2.gif"
width='<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>'
height='20'>
<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
<br>votes <?php if(isset($_POST['Submit'])){ echo $candidate_2;} ?>
</div>
<div id="footer">
<div class="bottom_addr"></div>
</div>
</div>
</body></html>