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
  $encpass= $row['password'];
}
?>
<?php
// updating sql query
if (isset($_POST['changepass'])){
$myId =  $_REQUEST['id'];
$oldpass = md5($_POST['oldpass']);
$newpass = $_POST['newpass'];
$conpass = $_POST['conpass'];
if($encpass == $oldpass)
{
  if($newpass == $conpass)
  {
    $newpassword = md5($newpass); //This will make your password encrypted into md5, a high security hash
    $sql = mysqli_query($con,"UPDATE tbmembers SET password='$newpassword' WHERE member_id = '$myId'" );
    echo "<script>alert('Password Change')</script>";
  }
  else
  {
    echo "<script>alert('New and Confirm Password Not Match')</script>";
  }

}
else
{
    echo "<script>alert('Old password not match')</script>";
}


// redirect back to profile
// header("Location: manage-profile.php");
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
   max-width: 400px;
   float: none;
   margin: 50px auto;
    position: absolute;
    top: 60%;
    left: 50%;
    width: 400px;
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
<li><a href="manage-profile.html">Manage Profile</a></li>

<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<br>

  
<div class="container">
 <br><h1 style="color:white;">MANAGE PROFILE</h1>
<div class="login-box">
    <div class="row">
 <center><h2>CHANGE PASSWORD</h2></center><br><br><br>
<form action="changepass.php?id=<?php echo $_SESSION['member_id']; ?>" method="post">
<div class="form-group">
<label>Old Password</label>
<input type="password"  name="oldpass" maxlength="15"  class="form-control" value=""  required>
 </div>
<div class="form-group">
<label>New Password</label>
<input type="password"  name="newpass" maxlength="15"  class="form-control" value=""  required>
</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password"  name="conpass" maxlength="15"  class="form-control" value=""  required>
    </div>
<br>
<input type="submit" name="changepass" value="Update Profile">

</form>

</form>


   
   </div> 
   </div>
</div>
</body>
</html>