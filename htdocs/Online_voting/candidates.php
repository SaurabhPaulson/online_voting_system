<?php
session_start();
require('connect.php');
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied-admin.php");
} 
//retrive candidates from the tbcandidates table
$result=mysqli_query($con,"SELECT * FROM tbCandidates");
if (mysqli_num_rows($result)<1){
    $result = null;
}
?>
<?php
// retrieving positions sql query
$positions_retrieved=mysqli_query($con, "SELECT * FROM tbPositions");
/*
$row = mysqli_fetch_array($positions_retrieved);
 if($row)
 {
 // get data from db
 $positions = $row['position_name'];
 }
 */
?>
<?php
// inserting sql query
if (isset($_POST['Submit']))
{

$newCandidateName = addslashes( $_POST['name'] ); //prevents types of SQL injection
$newCandidatePosition = addslashes( $_POST['position'] ); //prevents types of SQL injection

$sql = mysqli_query($con, "INSERT INTO tbCandidates(candidate_name,candidate_position) VALUES ('$newCandidateName','$newCandidatePosition')" );

// redirect back to candidates
 header("Location: candidates.php");
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
 $result = mysqli_query($con, "DELETE FROM tbCandidates WHERE candidate_id='$id'");
 
 // redirect back to candidates
 header("Location: candidates.php");
 }
 else
 // do nothing   
?>
<html>
<head>
    <title> Administration Contol Panel:Candidates</title>
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
.login-box{
   max-width: 800px;
   float: none;
   margin: 50px auto;
    position: absolute;
    top: 100%;
    left: 50%;
    width: 800px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: rgb(27 44 74 / 90%);
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
</style>
<script language="JavaScript" src="js/admin.js">
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
<li><a href="positions.php">Manage Positions</a></li>
<li><a href="home.php">Manage Student Registration</a></li>
<li><a href="refresh.php">Poll Results</a> </li>
<li> <a href="manage-admins.php">Manage Account</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<br>

  
<div class="container">
 <br><br><br><h1 style="color:white;">MANAGE CANDIDATES</h1>
    <div class="login-box">
    <div class="row">
    <div class="col-md-6 login-left">
         <h2 style="font:poppins;"> Add Candidate </h2><br>
         <form name="fmCandidates" id="fmCandidates" action="candidates.php" method="post" onsubmit="return candidateValidate(this)">
          <div class="user-box">
        <input type="text" name="name" required="">
          <label>Name of the Candidate</label>
         </div>
          <label style="color:white;">Position</label><br>
         <SELECT NAME="position" id="position">select
    <OPTION VALUE="select">select
    <?php
    //loop through all table rows
    while ($row=mysqli_fetch_array($positions_retrieved)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    </SELECT>
        
         
           
          <br><br>    <input type="submit" name="Submit" value="Add" />
        </form>
   </div>

        <div class="col-md-6 login-right">
        <h2> Available Candidates</h2>
        <table border="0" width="620" align="center">
<tr>
<th>Candidate ID</th>
<th>Candidate Name</th>
<th>Candidate Position</th>
</tr>

<?php
//loop through all table rows
$inc=1;
while ($row=mysqli_fetch_array($result)){
    
echo "<tr>";
echo "<td>" . $inc."</td>";
echo "<td>" . $row['candidate_name']."</td>";
echo "<td>" . $row['candidate_position']."</td>";
echo '<td><a href="candidates.php?id=' . $row['candidate_id'] . '">Delete Candidate</a></td>';
echo "</tr>";
$inc++;
}

mysqli_free_result($result);
mysqli_close($con);
?>
</table>

   </div>
   </div> 
   </div>
</div>
</body>
</html>