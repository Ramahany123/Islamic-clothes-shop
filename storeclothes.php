<?php
include('connection.php');
// Assuming you have already established a database connection
$query = "SELECT * FROM product";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Database query failed.");
}
?>

<!DOCTYPE html>
<html lang="en">

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
                <li><a href="storeclothes.html">shop</a></li>
                <li><a href="contact.html">contact us</a></li>

            </ul>
        </nav>

        <h1 class="band-name band-name-large">ISLAMIC <strong>OUTFIT</strong> STORE</h1>
    </header>

    <section class="container content-section women">

        <div class="shop-items">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="shop-item">
                    <div class="shop-item">
                        <span class="shop-item-title"><?php echo $row['product_name']; ?></span>
                        <img class="shop-item-image" src="<?php echo $row['product_image']; ?>">
                        <p class="shop-item-price"><?php echo $row['product_price']; ?> EGP</p>
                        <div class="shop-item-details">
                            <button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>
                            <a href="#content-section"><button class="btn btn-primary shop-item-button">VIEW DETAILS</button></a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>


    <footer class="main-footer">
        <p>copyright &copy; Islamic outfit shop</p>
    </footer>

</body>

</html>