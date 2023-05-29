<?php
session_start();
require('connect.php');
?>
<html><head>
<title>Admin Account Management</title>
<link rel="stylesheet"  type="text/css" href="twotable.css">
<link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script language="JavaScript" src="js/admin.js">
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
<li><a href="admin.php">Control Panel</a></li>
<li><a href="positions.php">Manage Positions</a></li>
<li><a href="candidates.php">Manage Candidates</a></li>
<li><a href="refresh.php">Poll Results</a> </li>
<li><a href="home.php">Manage Student Registration</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<br>

  
<div class="container">
 <br><h1 style="color:white;">MANAGE ACCOUNT</h1>
<div class="login-box">
  
<?php
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied-admin.php");
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
    $mypassword = $_POST['oldpass'];
    $newpass= $_POST['newpass'];
    $confpass= $_POST['confpass'];
    if($encPass==$mypassword)
    {
        if($newpass==$confpass)
        {
       
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
  <div class="row">
 <center><h2>CHANGE PASSWORD</h2></center><br><br><br>
<form action="change-pass.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
<div class="form-group">
<label>Old Password</label>
        
<input type="password"  name="oldpass" maxlength="15" class="form-control" value=""  required>
   </div>
<div class="form-group">
<label>New Password</label>
        
<input type="password"  name="newpass" maxlength="15" class="form-control" value=""  required>
 </div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password"  name="confpass" maxlength="15" class="form-control" value=""  required>

         </div>
<br>
<input type="submit" name="update" value="Update Account">

</form>


   
   </div> 
   </div>
</div>
</body>
</html>