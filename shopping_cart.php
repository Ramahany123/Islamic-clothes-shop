<?php
session_start();
$totalAmount = 0;

if(isset($_POST['remove_from_cart'])) {
    $remove_product_id = $_POST['remove_product_id'];
    foreach($_SESSION['cart'] as $key => $value) {
        if($value['product_id'] == $remove_product_id) {
            unset($_SESSION['cart'][$key]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="" />
</head>
<body>
    <div id="cart-window" class="cart-window">
    
    <h2>Shopping Cart</h2>
    <table id="cart-table" border="5">
        <tr>
            <th>Product ID</th>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Item Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
        <?php 
        if (isset($_SESSION['cart'])) : ?>
            <?php foreach ($_SESSION['cart'] as $item) : ?>
                <tr>
                    <td><?php echo $item['product_id']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php $totalPrice = $item['price'] * $item['quantity']; echo $totalPrice; $totalAmount += $totalPrice; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="remove_product_id" value="<?php echo $item['product_id']; ?>">
                            <button class="btn btn-primary" type="submit" name="remove_from_cart">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    
    <p>Total Amount: <?php echo $totalAmount; ?> LE</p>
    <button onclick="location.href='check_out.php'">proceed to checkout</button>
    
</div>
</body>
</html>
