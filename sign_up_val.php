<?php

if(isset($_POST['submit']))
{
$email=$_POST['Email'];
$username=$_POST['username'];
$password=$_POST['password'];
}

$con = mysqli_connect('localhost', 'root', '', 'bl');

 
$stmt = "INSERT INTO login_info (email, uName, pass) VALUES ('$email','$username','$password')";
$result=mysqli_query($con,$stmt);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$count=mysqli_num_rows($result);
if($count==1)
{
    header("url=books2.php");
}
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}







?>