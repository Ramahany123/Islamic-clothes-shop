<?php
include 'connection.php';
session_start();

if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $query = "SELECT * FROM `product` WHERE `product_id` = $product_id";
  $result = mysqli_query($con, $query);
  $product = mysqli_fetch_assoc($result);

  if (isset($_SESSION['cart'])) {
    $session_array_id = array_column($_SESSION['cart'], "product_id");

    if (!in_array($product_id, $session_array_id)) {
      $session_array = array(
        'product_id' => $product['product_id'],
        'name' => $product['product_name'],
        'price' => $product['product_price'],
        'quantity' => 1
      );
      $_SESSION['cart'][] = $session_array;
    } else {
      foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
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

if (isset($_POST['remove_from_cart'])) {
  $remove_product_id = $_POST['remove_product_id'];
  foreach ($_SESSION['cart'] as $key => $value) {
    if ($value['product_id'] == $remove_product_id) {
      unset($_SESSION['cart'][$key]);
    }
  }
}

//////////* Category section *////////////
$category_id = isset($_GET['Category_id']) ? $_GET['Category_id'] : null;
$category_name = isset($_GET['Category_name']) ? $_GET['Category_name'] : null;
// Fetch products based on the category ID
$category_query = "SELECT p.*, c.category_name 
                    FROM product p 
                    JOIN category c ON p.category_id = c.category_id 
                    WHERE p.category_id = $category_id";
$category_query_result = mysqli_query($con, $category_query);

// Fetch category name separately
$category_name_query = "SELECT category_name FROM category WHERE category_id = $category_id";
$category_name_result = mysqli_query($con, $category_name_query);
$category_name_row = mysqli_fetch_assoc($category_name_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Islamic outfit shop</title>
  <link rel="stylesheet" href="styles/styles.css" />
  <link rel="shortcut icon" href="" />

  <!-- poppins -->

</head>

<body>
  <!-- Navigation bar -->
  <nav class="navigation">
    <!-- Logo -->
    <img id="logo" src="images/logo.png"></li>

    <!-- menu -->
    <ul class="menu">

      <li><a href="index.html">Home</a></li>
      <li><a href="clothes.html">Shop</a></li>
      <li><a href="about-us.html">About us</a></li>
      <li><a href="mailto:aa4894713@gmail.com" id="contact">Contact us</a></li>
    </ul>
    <!-- right -->
    <div class="right-elements">

      <!-- cart -->
      <a href="#">
        <i><a href="shopping_cart.php"><img id="cart" src="Images/cart.png"></a></i>
      </a>

      <!-- user -->
      <a href="login.php">
        <i><img id="user" src="Images/user.png"></i>
      </a>
    </div>
  </nav>
  <!-- end navigation -->

  <!-- products -->

  <section id="feature-product">
    <!-- heading -->
    <h2><?php echo $category_name_row['category_name']; ?></h2>
    <!-- box-container -->
    <div class="feature-product-container">
      <!-- box 1 -->
      <?php

      while ($row = mysqli_fetch_assoc($category_query_result)) {
      ?>
        <div class="feature-product-box">
          <!-- img -->
          <div class="product-feature-img">
            <a href="productDetails.php?id=<?php echo $row['product_id']; ?>"><img src="uploaded/<?php echo $row['product_image']; ?>" alt=""></a>
          </div>
          <!-- text-container -->
          <div class="product-feature-text-container">
            <!-- text -->
            <div class="product-feature-text">
              <strong><?php echo $row['product_name']; ?></strong>
              <span><?php echo $row['product_price']; ?> LE</span>
            </div>
            <!-- cart like icon -->
            <div class="cart-like">
              <!-- cart icon -->
              <form method="post" action="">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <button class="item-button" type="submit" name="add_to_cart"><a><img id="cart1" src="Images/cart.png"></a></button>
              </form>
              <!-- heart icon -->
              <a><img id="love" src="Images/love.png"></a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>

  <!-- product end -->

  <footer>

    <div class="footer-container">
      <!-- logo container -->

      <div class="footer-logo-container">
        <!-- logo -->
        <div class="footer-logo">
          Hey!
        </div>
        <!-- text -->
        <span>copyright &copy; Islamic outfit shop</span>

      </div>


      <!-- footer menu -->
      <div class="footer-menu">
        <!-- footer menu box -->
        <div class="footer-menu-box">
          <strong>
            Product
          </strong>
          <ul>
            <li><a href="clothes.php">Women</a></li>
            <li><a href="clothes.php">Latest girls Clothes</a></li>
            <li><a href="category_clothes.php?Category_id=4">New women Shoes</a></li>
          </ul>
        </div>


  </footer>

  <!-- footer end -->

  <!-- copyrights -->

  <span class="copyright">copyright &copy; Islamic outfit shop</span>
</body>