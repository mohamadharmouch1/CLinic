<?php
session_start();
if($_SESSION['isloggedin']!=1){
    header('location:index.php');
}
else{
    require_once 'connect.php';
}



?>


<!-- Orders List -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/cart.css">
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
</body>
</html>
<div class="row content">
        <?php
    
        $sql = "SELECT orders.id, name, quantity, price FROM orders JOIN products ON orders.product_id = products.id WHERE orders.user_id = $_SESSION[user_id]";
        $result = $con->query($sql);
        if ($result->num_rows > 0) { ?>
            <h1>Your Orders</h1>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '<td>' . $row['price'] . ' $</td>';
                echo '<td>' . $row['quantity']*$row['price'] . ' $</td>';
                echo '</tr>';
            }
        } else {
            echo '<h1 style="color :red;">You have no orders yet !</h1>';
        }
        ?>
    </table>
</div>