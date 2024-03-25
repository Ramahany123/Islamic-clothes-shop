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
    <?php include 'admin-head.php'; ?>
    <!-- end navigation -->

    <!-- main -->

    <section id="main">
        <!-- main content -->
        <div class="main-content">
            <!-- text -->
            <div class="main-text">
                <span>Collection</span>
                <h1>Comfortable Skirts With Great Comfort</h1>
                <p>
                    Our Islamic Skirt collection is meticulously designed with your comfort in mind. Crafted from the finest fabrics, each skirt boasts a classic silhouette that exudes sophistication and grace.
                    Embrace your fearless style while enjoying the familiar comfort of these timeless pieces, perfect for any occasion.
                </p>
                <a href="admin_category_clothes.php?Category_id=1">Shop Now</a>
            </div>
            <!-- main image -->
            <div class="main-img">
                <img src="Images/main.jpg" alt="Skirts" />
            </div>
        </div>
    </section>

    <!-- end main -->
    <!-- Category -->

    <section id="categories">
        <!-- heading -->
        <h2>Categories</h2>

        <!--box container-->
        <div class="category-container">

            <!-- box 1-->
            <a href="admin_category_clothes.php?Category_id=1" class="category-box">
                <img src="Images/main.jpg" alt="category" />
                <span>Skirts</S></span>
            </a>

            <!-- box 2-->
            <a href="admin_category_clothes.php?Category_id=2" class="category-box">
                <img src="Images/c-2png.jpg" alt="category" />
                <span>Hijab</S></span>
            </a>

            <!-- box 3-->
            <a href="admin_category_clothes.php?Category_id=3" class="category-box">
                <img src="Images/c-3.png" alt="category" />
                <span>dresses</S></span>
            </a>

            <!-- box 4-->
            <a href="admin_category_clothes.php?Category_id=4" class="category-box">
                <img src="Images/c-4.png" alt="category" />
                <span>Shoes</S></span>
            </a>
        </div>
    </section>

    <!-- End Category -->


    <!-- products -->

    <section id="feature-product">
        <!-- heading -->
        <h2>Our Product</h2>

        <!-- box-container -->
        <div class="feature-product-container">
            <!-- box 1 -->
            <?php
            $query = "SELECT * FROM `product`";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="feature-product-box">
                    <!-- img -->
                    <div class="product-feature-img">
                        <a href="admin-productDetails.php?id=<?php echo $row['product_id']; ?>"><img src="uploaded/<?php echo $row['product_image']; ?>" alt=""></a>
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

    <!-- Banner 2 -->

    <section id="banner" class="banner-reverse">

        <!-- text -->
        <div class="banner-text">
            <strong>Luxury Shoes</strong>
            <span>From 230EGP</span>
            <p>Long Lasting And Comfortable to use.This is only For You.</p>
            <a href="admin_category_clothes.php?Category_id=4">Shop Now</a>
        </div>
        <!-- img -->
        <div class="banner-img">
            <img src="Images/banner-2.png" alt="Banner">
        </div>

    </section>

    <!-- Banner 2 End -->



    <!-- footer -->

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
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Latest girls Clothes</a></li>
                        <li><a href="#">New women Shoes</a></li>
                    </ul>
                </div>


    </footer>

    <!-- footer end -->

    <!-- copyrights -->

    <span class="copyright">copyright &copy; Islamic outfit shop</span>

</body>

</html>