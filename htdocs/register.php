<?php
require('connect.php');
//Process
if (isset($_POST['submit']))
{

$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];
$myPassword = $_POST['password'];

$newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash

$sql = mysqli_query($con, "INSERT INTO tbMembers(first_name, last_name, email,password) 
VALUES ('$myFirstName','$myLastName', '$myEmail', '$newpass') ");

die( "You have registered for an account.<br><br>Go to <a href=\"index.php\">Login</a>" );
}

?>