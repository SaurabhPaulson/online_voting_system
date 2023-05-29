<?php
session_start();
require('connect.php');

//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
} 
//retrive student details from the tbmembers table
$result=mysqli_query($con, "SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
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
<?php
// updating sql query
if (isset($_POST['update'])){
$myId = addslashes( $_GET[id]);
$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];

$sql = mysqli_query($con,"UPDATE tbMembers SET first_name='$myFirstName', last_name='$myLastName', email='$myEmail' WHERE member_id = '$myId'" );

// redirect back to profile
 header("Location: manage-profile.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Student Profile Management</title>
<link rel="stylesheet"  type="text/css" href="twotable.css">
<link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script language="JavaScript" src="js/user.js">
</script>


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
   max-width: 300px;
   float: none;
   margin: 50px auto;
    position: absolute;
    top: 60%;
    left: 50%;
    width: 300px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: #56c1a4c2;
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
</head><body>
<header>
    <div class="wrapper">
        <div class="logo">
            <img src="logo.jpg" alt="">
        </div>
<ul class="nav-area">
<li><a href="student.php">Control Panel</a></li>
<li><a href="my profile.php">My Profile</a></li>
<li><a href="vote.php">Vote</a></li>
<li><a href="manage-profile.php">Manage Profile</a></li>

<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<br>

  
<div class="container">
 <br><h1 style="color:white;">MANAGE PROFILE</h1>
<div class="login-box">
    <div class="row">
<form action="manage-profile.php?id=<?php echo $_SESSION['member_id']; ?>" method="post" onsubmit="return updateProfile(this)">
<div class="form-group">
<label>First Name</label>
<input type="text"  name="firstname" maxlength="15"  class="form-control" value=""  required >
 </div>
<div class="form-group">
<label>Last Name</label>
<input type="text"  name="lastname" maxlength="15"  class="form-control" value=""  required >
</div>
<div class="form-group">
<label>Email Address</label>
<input type="text" name="email" maxlength="100"  class="form-control" value=""  required>
<br>
<input type="submit" name="update" value="Update Profile">

</form>

 </div> 
<a href="changepass.php" style="color:red;">CHANGE PASSWORD</a>
   </div>
</div>
</body>
</html>