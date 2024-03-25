<?php
include('connection.php');
session_start();
if (isset($_GET['id'])) {
  // Sanitize the input to prevent SQL injection
  $product_id = mysqli_real_escape_string($con, $_GET['id']);

  // Query to retrieve the product details based on the product ID
  $query = "SELECT * FROM product WHERE product_id = '$product_id'";
  $result = mysqli_query($con, $query);

  if ($result) {
    // Check if the product exists
    if (mysqli_num_rows($result) > 0) {
      // Fetch the product details
      $product = mysqli_fetch_assoc($result);

      // Retrieve all colors from the product_color column
      $product_colors = explode(' ', $product['product_Color']);
    } else {
      echo "Product not found.";
    }
  } else {
    echo "Database query failed.";
  }
} else {
  echo "Product ID not provided.";
}
if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];

  // Check if the cart session exists, if not, initialize it  
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  $_SESSION['cart'][] = array(
    'product_id' => $product_id,
    'name' => $product['product_name'],
    'price' => $product['product_price'],
    'quantity' => 1
  );

  echo "<script>alert('Product added to cart successfully!');</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details</title>
  <link rel="stylesheet" href="styles/productDetails.css">
</head>

<body>
  <?php include_once 'admin-head.php'; ?>

  <div class="container">
    <h1><?php echo $product['product_name']; ?></h1>
    <div class="product-details">
      <img src="uploaded/<?php echo $product['product_image']; ?>" alt="Product Image">
      <div class="product-info">
        <h2>Description</h2>
        <p><?php echo $product['product_details']; ?></p>
        <p><strong>Size:</strong> <?php echo $product['product_Size']; ?></p>
        <p><strong>Quantity in Stock:</strong> <?php echo $product['product_QuantityInStock']; ?></p>
        <p class="price"><strong>Price:</strong> <?php echo $product['product_price']; ?></p>
        <div class="colors">
          <div class="color-text"><strong>Colors Available:</strong></div>
          <?php foreach ($product_colors as $color) : ?>
            <div class="color-option" style="background-color: <?php echo $color; ?>; border: 1px solid #000;"></div>
          <?php endforeach; ?>
        </div>
        <form method="post">
          <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
          <button class="btn" type="submit" name="add_to_cart">Add to Cart</button>
        </form>

      </div>
    </div>
  </div>
  <?php include_once 'footer.html'; ?>
</body>

</html>