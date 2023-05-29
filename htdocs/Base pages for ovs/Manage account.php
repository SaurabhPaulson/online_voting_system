<?php
session_start();
require('connect.php');
?>
<html>
<head>
    <title> Administration Control Panel </title>
 <link rel="stylesheet"  type="text/css" href="twotable.css">
    <link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<script language="JavaScript" src="js/admin.js">
</script>
</head>
<body>

<div class="container">
<?php
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}

//fetch data for update file
$result=mysqli_query($con, "SELECT * FROM tbadministrators WHERE admin_id = '$_SESSION[admin_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from db
 $adminId = $row['admin_id'];
 $firstName = $row['first_name'];
 $lastName = $row['last_name'];
 $email = $row['email'];
 }

//Process
if (isset($_GET['id']) && isset($_POST['update']))
{
$myId = addslashes( $_GET['id']);
$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];

$sql = mysqli_query($con, "UPDATE tbAdministrators SET first_name='$myFirstName', last_name='$myLastName', email='$myEmail' WHERE admin_id = '$myId'" );
}
?>
    <div class="login-box">
    <div class="row">
    <div class="col-md-6 login-left">
         <h2>Manage Account </h2>
         
<form action="manage-admins.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
           <div class="form-group">
             <label>First Name</label>
             <input type="text" name="firstname" class="form-control" required>
           </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lastname" class="form-control" required>
          </div>
            <div class="form-group">
            <label>Email Address</label>
            <input type="text" name="email" class="form-control" required>
          </div>
            <input type="submit" name="update" value="Update Account">
        </form>
   </div>
<div class="col-md-6 login-right">
<?php
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}

//fetch data for update file
$result=mysqli_query($con, "SELECT * FROM tbadministrators WHERE admin_id = '$_SESSION[admin_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from db
 $encPass = $row['password'];
 }

//Process
if (isset($_GET['id']) && isset($_POST['update']))
{
    $myId = addslashes( $_GET['id']);
    $mypassword = md5($_POST['oldpass']);
    $newpass= $_POST['newpass'];
    $confpass= $_POST['confpass'];
    if($encPass==$mypassword)
    {
        if($newpass==$confpass)
        {
        $newpass = md5($newpass); //This will make your password encrypted into md5, a high security hash
        $sql = mysqli_query($con, "UPDATE tbadministrators SET password='$newpass' WHERE admin_id = '$myId'" );
        echo "<script>alert('Your password updated');</script>";
        }
        else
        {
            echo "<script>alert('Your new pass and confirm pass not match');</script>";
        }    
    }
    else
    {
        echo "<script>alert('Your old pass not match');</script>";
    }
    
}
?>
        
        <h2> Change Password</h2>
        <form action="change-pass.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
          <div class="form-group">
            <label>Old Password</label>
            <input type="password" name="oldpass" class="form-control" required>
          </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="newpass" class="form-control" required>
        </div>
           <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confpass" class="form-control" required>
        </div>
            <input type="submit" name="update" value="Update Account">
      </form>
   </div>
   </div> 
   </div>
</div>
</body>
</html>