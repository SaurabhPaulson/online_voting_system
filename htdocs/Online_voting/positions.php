<?php
session_start();
require('connect.php');
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied-admin.php");
}
//retrive positions from the tbpositions table
$result=mysqli_query($con, "SELECT * FROM tbPositions");
if (mysqli_num_rows($result)<1){
    $result = null;
}
?>
<?php
// inserting sql query
if (isset($_POST['Submit']))
{

$newPosition = addslashes( $_POST['position'] ); //prevents types of SQL injection

$sql = mysqli_query($con, "INSERT INTO tbpositions (position_name) VALUES ('$newPosition')");

// redirect back to positions
 header("Location: positions.php");
}
?>
<?php
// deleting sql query
// check if the 'id' variable is set in URL
 if (isset($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $result = mysqli_query($con, "DELETE FROM tbPositions WHERE position_id='$id'");
 
 // redirect back to positions
 header("Location: positions.php");
 }
 else
 // do nothing
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration Control Panel:Positions</title>

<link rel="stylesheet" type="text/css" href="table.css">
 <link rel="stylesheet"  type="text/css" href="twotable.css">
 <style>
input[type=button], input[type=submit], input[type=reset] {
  background-color: #000000;
  border: none;
  color: skyblue;
  padding: 5px 15px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<script  language="JavaScript">
function isValidPosition(val) {
    var re = /[-]/;
    if (!re.test(val)) {
        return false;
    }
    return true;
}
function posValidate(positionForm){

var validationVerified=true;
var errorMessage="";
var okayMessage="click OK to add new position";

if (positionForm.position.value == "")
{
errorMessage+="Please enter the position name!\n";
validationVerified=false;
}
if (!isValidPosition(positionForm.position.value)) {
errorMessage+="Invalid position provided! Don't leave spaces between words i.e. Try to replace spaces with a dash (-)\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
if(validationVerified)
{
alert(okayMessage);
}
return validationVerified;
}

</script>
</head>
<body>

<header>
    <div class="wrapper">
        <div class="logo">
            <img src="logo.jpg" alt="">
        </div>
<ul class="nav-area">
<li><a href="admin.php">Control Panel</a></li>
<li><a href="home.php">Manage Student Registration</a></li>
<li><a href="candidates.php">Manage Candidates</a></li>
<li><a href="refresh.php">Poll Results</a> </li>
<li><a href="manage-admins.php">Manage Account</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<br>

  
<div class="container">
 <br><br><br> <h1 style="color:white;">MANAGE POSITIONS</h1>
  
<div class="login-box">
    <div class="row">
    <div class="col-md-6 login-left">
<h3>ADD NEW POSITION</h3><br>
<form name="fmPositions" id="fmPositions" action="positions.php" method="post" onsubmit="return posValidate(this)">
 <div class="user-box">
        <input type="text" name="position" required="">
          <label>Position</label>
   </div>
   <br> <input type="submit" name="Submit" value="Add" />
</form>


  </div>

        <div class="col-md-6 login-right">
<table border="0" width="420" align="center">
<CAPTION><h3>AVAILABLE POSITIONS</h3></CAPTION>
<tr>
<th>Position ID</th>
<th>Position Name</th>
</tr>

<?php
//loop through all table rows
$inc=1;
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" .$inc."</td>";
echo "<td>" . $row['position_name']."</td>";
echo '<td><a href="positions.php?id=' . $row['position_id'] . '">Delete Position</a></td>';
echo "</tr>";
$inc++;
}

mysqli_free_result($result);
mysqli_close($con);
?>
</table>
</div>
<div id="footer"> 
  <div class="bottom_addr"></div>
</div>
</div>
</body>
</html>