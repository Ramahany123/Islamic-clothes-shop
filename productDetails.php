<?php
include('connection.php');
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
  <?php include_once 'header.html'; ?>

  <div class="container">
    <h1><?php echo $product['product_name']; ?></h1>
    <div class="product-details">
      <img src="<?php echo $product['product_image']; ?>" alt="Product Image">
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
        <a href="#" class="btn">Add to Cart</a>
      </div>
    </div>
  </div>
</body>

</html>