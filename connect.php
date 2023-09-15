<?php
$db_hostname = "localhost";
$db_username = "root";
$password = "";
$db = "car";
$con=mysqli_connect($db_hostname,$db_username,$password,$db);
if(mysqli_connect_errno())
{
    echo"Failed to connect";
}
?>
