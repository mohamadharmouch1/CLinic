<?php
require_once 'connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass =md5($_POST['password']) ;
    $message=$_POST['message'];
    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
    
    $result = mysqli_query($con, $select);

    if (mysqli_num_rows($result) > 0) {
      $insert="INSERT INTO Messages(email,password,message) VALUES ('$email',' $pass',' $message') ";
      mysqli_query($con,$insert);
      echo"<script> alert('YOUr message has been send')</script> ";

    }
    else{
      echo"<script> alert('YOU must Create account')</script> ";
    }
  }
    
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" href="css/contactus.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
 <div class="container">
     <h1> Contact Us! </h1>
        <center>
          <form action="contactus.php" method="post">
            
            <div class="input_text" >
            <i class="fa fa-envelope icon"></i><br><br>
            <input type="email" placeholder ="email@gmail.com" name="email"></div>
            
            <div class="input_text" >
            <i class="fa fa-key icon"></i><br><br>
            <input type="password" required placeholder="password " name="password"></div>
            
            <div class="input_text" >
              <textarea placeholder="your massege..." cols="36 " name="message" rows="6"></textarea>
          </div>
            <input class="btn" type="submit" value="submit" name="submit" style="color: red;"> 
        </form>
        </center>
    </div> 
</body>
</html>