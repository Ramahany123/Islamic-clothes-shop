<?php
include 'connection.php';
session_start();

if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $query = "SELECT * FROM `product` WHERE `product_id` = $product_id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if(isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], "product_id");

        if(!in_array($product_id, $session_array_id)) {
            $session_array = array(
                'product_id' => $product['product_id'],
                'name' => $product['product_name'],
                'price' => $product['product_price'],
                'quantity' => 1
            );
            $_SESSION['cart'][] = $session_array;
        } else {
            foreach($_SESSION['cart'] as &$item) {
                if($item['product_id'] == $product_id) {
                    $item['quantity']++;
                    break;
                }
            }
        }
    } else {
        $session_array = array(
            'product_id' => $product['product_id'],
            'name' => $product['product_name'],
            'price' => $product['product_price'],
            'quantity' => 1
        );
        $_SESSION['cart'][] = $session_array;
    }
}

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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Islamic Outfit Store</title>
    <link rel="stylesheet" href="styles/clothes.css">
    <link rel="icon" href="images/logo.png">
</head>

<body>
    <header class="main-header">
        <nav>
            <ul>
                <li><img id="logo" src="images/logo.png"></li>
                <li><a href="index.html">Home</a></li>
                <li><a href="storeclothes.html">Shop</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><img id="cart-icon" src="images/shopping-cart.png" alt="Shopping Cart"></li>
            </ul>
        </nav>

        <h1 class="band-name band-name-large">ISLAMIC <strong>OUTFIT</strong> STORE</h1>
    </header>
    
    <div id="cart-window" class="cart-window">
    <span class="close-button" onclick="closeCart()">X</span>
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
        $totalAmount = 0; 
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
</div>

    <section class="container content-section women">
        <?php
        $query = "SELECT * FROM `product`";
        $result = mysqli_query($con, $query);
        
        while ($row = mysqli_fetch_assoc($result)){
        ?>
            <div class="shop-items">
                <div class="shop-item">
                    <span class="shop-item-title"><?php echo $row['product_name']; ?></span>
                    <img class="shop-item-image" src="images/<?php echo $row['product_image']; ?>">
                    <p class="shop-item-price"><?php echo $row['product_price']; ?> LE</p>
                    <div class="shop-item-details">
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <button class="btn btn-primary shop-item-button" type="submit" name="add_to_cart">ADD TO CART</button><br>
                        </form>
                        <a href="#content-section"><button class="btn btn-primary shop-item-button">VIEW DETAILS</button></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>

    <script>
        // Function to open the cart window
        function openCart() {
            document.getElementById("cart-window").style.display = "block";
            // Call a function to populate the cart table with items
            populateCart();
        }
        // Function to close the cart window
        function closeCart() {
            document.getElementById("cart-window").style.display = "none";
        }
        // Function to populate the cart table with items
        function populateCart() {
            var cartTable = document.getElementById("cart-table");
            cartTable.innerHTML = "<tr><th>Product ID</th><th>Item Name</th><th>Item Price</th><th>Item Quantity</th><th>Total Price</th><th>Action</th></tr>";
            <?php if(isset($_SESSION['cart'])): ?>
                <?php foreach($_SESSION['cart'] as $item): ?>
                    var row = "<tr>";
                    row += "<td><?php echo $item['product_id']; ?></td>";
                    row += "<td><?php echo $item['name']; ?></td>";
                    row += "<td><?php echo $item['price']; ?></td>";
                    row += "<td><?php echo $item['quantity']; ?></td>";
                    row += "<td><?php echo $item['price'] * $item['quantity']; ?></td>";
                    row += "<td><form method='post' action=''><input type='hidden' name='remove_product_id' value='<?php echo $item['product_id']; ?>'><button class='btn btn-primary' type='submit' name='remove_from_cart'>Remove</button></form></td>";
                    row += "</tr>";
                    cartTable.innerHTML += row;
                <?php endforeach; ?>
            <?php endif; ?>
        }
        // Event listener
        document.getElementById("cart-icon").addEventListener("click", openCart);
        
    </script>


    <footer class="main-footer">
        <p>Copyright &copy; Islamic outfit shop</p>
    </footer>

</body>
</html>