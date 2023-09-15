
<?php
require_once 'connect.php' ;
if(isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $pass=md5($_POST['password']);
        $cpass=md5($_POST['cpassword']);
        $select="SELECT * FROM users WHERE email='$email' && password='$pass'";
        $result= mysqli_query($con,$select);
        if(mysqli_num_rows($result)>0)
        {
            echo "user already exist!";
        }
        else{
            
            if($pass!=$cpass) 
                {
                    echo "password not matched";
                }
                else
                    {
                        $insert="INSERT INTO users(email,password)  VALUES ('$email','$pass')";
                        mysqli_query($con,$insert);
                        header('location:login.php');
                    }
            }

};


    
?>
<!--html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Register Form</title>
<!--custom css-->
    <link rel="stylesheet" href="css/LogIn.css">
</head>
<body>
    <div class="form-container">
        <center>
            <form action="" method="post">
                <div class="form">
                    <h3 id="xy">Register now</h3>
                    <input type="email"name="email" required placeholder="Enter your email"><br><br>
                    <input type="password" name="password" required placeholder="Enter your password" id="pass"><br><br>
                    <input type="password" name="cpassword" required placeholder="Confirm your password" id="pass"><br><br>
                    <input type="submit" name="submit" value="Register now" class="form-btn">
                    <p>Already have an account? <a id="bc" href="login.php">login now</a></p>
                </div>
            
            </form>
        </center>
  </div>
</body>
</html>