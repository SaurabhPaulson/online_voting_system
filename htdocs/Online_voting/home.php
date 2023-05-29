<?php
    session_start(); //we need session for the log in thingy XD 
    require('connect.php');
    include("functions.php");
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied-admin.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

<title>Administration Control Panel:Students</title>
<link rel="stylesheet" href="admin2.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
body{
  width: 100%;
  height: 100vh;
  background: linear-gradient(rgba(0,0,50,0.5),rgba(0,0,50,0.5)),url(image.jpg);
  justify-content: center;
  align-items: center;
   
}
 h1 { 
        margin: 3px auto; 
        text-align: top; 
        color: white; 
        font-size: 2em; 
        transition: 0.5s; 
        font-family: Arial, Helvetica, sans-serif; 
    } 
.login-box
{
    position: absolute;
    top: 80%;
    left: 50%;
    width: 400px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,0.9);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,10);
    border-radius: 10px;
}

</style>
</head>
<body>

<header>
    <div class="wrapper">
        <div class="logo">
            <img src="logo.jpg" alt="">
        </div></div>
<ul class="nav-area">
<li><a href="admin.php">Control Panel</a></li>
<li><a href="positions.php">Manage Positions</a></li>
<li><a href="candidates.php">Manage Candidates</a></li>
<li><a href="refresh.php">Poll Results</a> </li>
<li><a href="manage-admins.php">Manage Account</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<br><br><font color = "white" size="7">MANAGE STUDENT REGISTRATION</font>
    <main role="main">

      
        <div class="login-box">
            <?php
              $query = "select * from `requests`;";
                if(count(fetchAll($query))>0){
                    foreach(fetchAll($query) as $row){
                        ?>
            
                
                    <h1 class="jumbotron-heading"><?php echo $row['message'] ?></h1>
                      
                      <p  style="color:white;">Class: <?php echo $row['class'] ?></p>
                        <p  style="color:white;">Roll No: <?php echo $row['rollno'] ?></p>
                       <p  style="color:white;">Email: <?php echo $row['email'] ?></p>
                      <p>
                        <a href="accept.php?id=<?php echo $row['id'] ?>" class="btn btn-primary my-2">Accept</a>
                        <a href="reject.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary my-2">Reject</a>
                      </p>
                    <small style="color:white;"><i><?php echo $row['date'] ?></i></small>
            <?php
                    }
                }else{
                    echo "<p> <font color=white>No Pending Requests.</p>";
                }
            ?>
          
        
          
      </div>

    </main>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>