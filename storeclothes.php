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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Islamic outfit shop</title>
    <link rel="stylesheet" href="styles\clothes.css" />
    <link rel="shortcut icon" href="" />
   
    <!-- poppins -->
    
  </head>

<body>
    <header class="main-header">
        <nav>
            <ul>
                <li><img id="logo" src="images/logo.png"></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="storeclothes.php">Shop</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="shopping_cart.php"><img id="cart-icon" src="images/shopping-cart.png" alt="Shopping Cart"></a></li>
            </ul>
        </nav>

        <h1 class="band-name band-name-large">ISLAMIC <strong>OUTFIT</strong> STORE</h1>
    </header>
    
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

    <footer class="main-footer">
        <p>Copyright &copy; Islamic outfit shop</p>
    </footer>

</body>
</html>
