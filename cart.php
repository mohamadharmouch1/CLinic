<?php

require_once 'connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['isloggedin']!=1){
    header('location:index.php');
}

if (isset($_POST['remove'])) {
    $sql = "DELETE FROM cart WHERE user_id = $_SESSION[user_id] AND id = $_POST[cart_id]";
    $con->query($sql);
}

if (isset($_POST['checkout'])) {
    $sql = "INSERT INTO orders (user_id, product_id, quantity) SELECT $_SESSION[user_id], product_id, quantity FROM cart WHERE user_id = $_SESSION[user_id]";
    $con->query($sql);
    $sql = "DELETE FROM cart WHERE user_id = $_SESSION[user_id]";
    $con->query($sql);
}

if (isset($_POST['quantity']) && $_POST['quantity'] > 0) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
    $result = $con->query($sql);
    if ($result) {
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['noti'] = ["$quantity $row[name] Added to cart!"];
    } else {
        $_SESSION['noti'] = ["Failed to add to cart!"];
    }
}
?>
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
<?php if (isset($_GET['id'])){ ?>
    <div class="cart_add">
        <!--- Select quantity and display price and place order -->
        <h1 style="color:red;">Add to Cart</h1>
        <?php
        $product_id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <h2 style="color:red;" ><?php echo $row['name']; ?></h2>
        <img src="image/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="400px">
        <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
            <label for="quantity" style="font-size:28px;color:red;">Amount:</label>
            <input type="number" name="quantity" id="quantity" min="1" max="100" value="1">
            <input type="submit" name="submit" value="Add to cart" class="form-btn" >
        </form>
    </div>
<?php } else { ?>
        <div>
        <!--- Display all products in cart as table with remove button -->
            <?php
            $sql = "SELECT * FROM cart WHERE user_id = $_SESSION[user_id]";
            $result = $con->query($sql);
            if ($result->num_rows > 0) { ?>
                <h1>Your Cart</h1>
                <center>
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    $total = 0;
                    while ($row = $result->fetch_assoc()) {
                        $sql = "SELECT * FROM products WHERE id = $row[product_id]";
                        $result2 = $con->query($sql);
                        $row2 = $result2->fetch_assoc();
                        $total += $row2['price'] * $row['quantity'];
                        echo '<tr>';
                        echo '<td><form action="cart.php" method="post">';
                        echo '<input type="hidden" name="cart_id" value="' . $row['id'] . '">';
                        echo '<input type="hidden" name="remove">';
                        echo '</form>' . $row2['name'] . '</td>';
                        echo '<td>' . $row['quantity'] . '</td>';
                        echo '<td>$' . $row2['price'] . '</td>';
                        echo '<td>$' . $row['quantity'] * $row2['price'] . '</td>';
                        echo '</tr>';
                    } ?>
                </table>
                <div class="cart_checkout">
                    <h3>Total: $<?php echo $total; ?></h3>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="checkout">
                        <input type="submit" name="submit" value="Checkout" style="color:red;">
                    </form>
                </div>
            <?php } else {
               echo" <center>";
                echo '<h1 style="color:red;">Your cart is empty !</h1>';
                echo" </center>";
            }?>
        </div>
    
<?php }

echo '</div>';
echo"</center>";

?>