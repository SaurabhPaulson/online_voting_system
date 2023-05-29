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
 <br><br><h1 style="color:white;">MANAGE ACCOUNT</h1>
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
  <div class="row">

<form action="manage-admins.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
<div class="form-group">
<label>First Name</label>
<input type="text"  name="firstname" maxlength="15"  class="form-control" value=""  required>
  </div>
<div class="form-group">
<label>Last Name</label>
<input type="text" name="lastname" maxlength="15"  class="form-control"  value=""  required>
</div>
<div class="form-group">
<label>Email Address</label>
<input type="text" name="email" maxlength="100"  class="form-control"  value=""  required>
<br>
<input type="submit" name="update" value="Update Account">

</form>
   </div> 
<a href="change-pass.php" style="color:red;">CHANGE PASSWORD</a>
   </div>
</div>
</body>
</html>

