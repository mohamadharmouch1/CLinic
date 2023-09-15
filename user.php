<?php
session_start();
if($_SESSION['isloggedin']!=1){
    header('location:index.php');
}
else{
    require_once 'connect.php';
}



?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/c.css">
</head>
<body>
    <center>
    <div class="container">
    <a href="user.php">Store</a>
    <a href="cart.php">Cart</a>
    <a href="order.php">Order</a>
    <a href="logout.php">Log out</a>

    </div>
    </center>
    
    <div class="row content">
    <h1>Our Cars</h1>
    <div class="grid">
       <?php 
        $sql = "SELECT * FROM products";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="grid-item">';
                echo '<img src="image/' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p class="price">$' . $row['price'] . '</p>';
                if (isset($_SESSION['user_id'])) {
                    echo '<a class="btn" href="cart.php?id=' . $row['id'] . '">Add to Cart</a>';
                } else {
                    echo '<a class="btn" href="signin_up.php">Add to cart</a>';
                }
                echo '</div>';
            }
        }
    ?>
</body>
</html>