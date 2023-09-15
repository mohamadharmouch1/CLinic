<?php
require_once 'connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass =md5($_POST['password']) ;

    // تأكد من استخدام عبارات استعلام مستعارة لتجنب ثغرات الأمان
    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
    
    $result = mysqli_query($con, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION['isloggedin'] = 1;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email']=$row['email'];

        header('location: user.php');
    }
}

    
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/LogIn.css">
</head>
<body>
    <div class="form-container">
        <center>
        <form action="" method="post">
            <h3 id="xy">Login now</h3>
           <input type="email"name="email" required placeholder="Enter your email">
           <div class="password">
            <input type="password" name="password" required placeholder="Enter your password" style="margin-left:30px ;" id="password">
            <input type="submit" name="submit" value="Login now" class="form-btn">
            <p>Don't have an account? <a id="bc" href="register.php">Register now</a></p>

        </form>
    </center>
    </div> 
</body>
</html>