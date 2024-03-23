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
            <li><a href="storeclothes.html">shop</a></li>
            <li><a href="contact.html">contact us</a></li>
        </ul>
        <!-- right -->
        <div class="right-elements">

            <!-- cart -->
            <a href="#">
                <i><img id="cart" src="Images/cart.png"></i>
            </a>

            <!-- user -->
            <a href="login.html">
                <i><img id="user" src="Images/user.png"></i>
            </a>
        </div>
    </nav>
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
                <a href="#">Shop Now</a>
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
            <a href="#" class="category-box">
                <img src="Images/main.jpg" alt="category" />
                <span>Skirts</S></span>
            </a>

            <!-- box 2-->
            <a href="#" class="category-box">
                <img src="Images/c-2png.jpg" alt="category" />
                <span>Hijab</S></span>
            </a>

            <!-- box 3-->
            <a href="#" class="category-box">
                <img src="Images/c-3.png" alt="category" />
                <span>dresses</S></span>
            </a>

            <!-- box 4-->
            <a href="#" class="category-box">
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
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <!-- box 1 -->
                <div class="feature-product-box">
                    <!-- img -->
                    <div class="product-feature-img">
                        <img src="<?php echo $row['product_image']; ?>" alt="">
                    </div>
                    <!-- text-container -->
                    <div class="product-feature-text-container">
                        <!-- text -->
                        <div class="product-feature-text">
                            <strong><?php echo $row['product_name']; ?></strong>
                            <span><?php echo $row['product_price']; ?></span>
                        </div>
                        <!-- cart like icon -->
                        <div class="cart-like">
                            <!-- cart icon -->
                            <a><img id="cart1" src="Images/cart.png"></a>
                            <!-- heart icon -->
                            <a><img id="love" src="Images/love.png"></a>
                        </div>
                    </div>
                <?php endwhile; ?>
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
            <a href="#">Shop Now</a>
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
                <!-- Social -->
                <div class="footer-social">
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
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