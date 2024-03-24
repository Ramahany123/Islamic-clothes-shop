<?php
include 'connection.php';
session_start();

// Check if the user is logged in, and get their customer ID
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    
} else {
    // Redirect the user to the login page or display an error message if they're not logged in
    exit('Access denied: Please log in first.');
}

// Get product IDs from session
$product_ids = isset($_SESSION['product_id']) ? $_SESSION['product_id'] : array();





if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $fullName = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $zipCode = isset($_POST['zip']) ? $_POST['zip'] : '';
    $paymentMethod = isset($_POST['payment_methods']) ? $_POST['payment_methods'] : '';
    $nameOnCard = isset($_POST['name_on_card']) ? $_POST['name_on_card'] : '';
    $creditCardNumber = isset($_POST['credit']) ? $_POST['credit'] : '';
    $expMonth = isset($_POST['month']) ? $_POST['month'] : '';
    $expYear = isset($_POST['year']) ? $_POST['year'] : '';

    // Insert data into the orders table
    $sql = "INSERT INTO orders (Order_date, Order_total_amount, Order_status, Customer_id)
            VALUES (NOW(), NULL, 'Pending', $customer_id)";

    if ($con->query($sql) === TRUE) {
        $orderId = $con->insert_id; // Get the ID of the inserted order

        // Insert data into the ordersdetails table
        foreach ($product_ids as $product_id) {
            $shippingAddress = $con->real_escape_string($address . ', ' . $city . ', ' . $country . ', ' . $zipCode);
            $sqlDetails = "INSERT INTO ordersdetails (OrdersDetails_Quantity, OrdersDetails_payment_methods, OrdersDetails_shipping_address, OrdersDetails_orders_id, OrdersDetails_product_id)
                           VALUES (1, '$paymentMethod', '$shippingAddress', $orderId, $product_id)";

            if ($con->query($sqlDetails) !== TRUE) {
                echo "Error inserting order details: " . $con->error;
                // Rollback transaction or handle error as needed
            }
        }

        echo "<script>alert('Your order has been successfully placed. Thank you!'); window.location.href = 'clothes.php';</script>";
        exit; // Ensure no more code is executed after redirection
    } else {
        echo "Error inserting order: " . $con->error;
    }

    $con->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="styles\check_out.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>

<div class="container">

    <form action="" method="post" >

        <div class="row">

            <div class="col">

                <h3 class="title">billing address</h3>

                <div class="inputBox">
                    <label for="name">full name :</label>
                    <input id="name" type="text" name="fullname" placeholder="Full  Name.." required>
                </div>
                <div class="inputBox">
                    <label for="email">email :</label>
                    <input id="email" type="email" name="email" placeholder="example@example.com" required>
                </div>
                <div class="inputBox">
                    <label for="address">address :</label>
                    <input id="address" type="text" name="address" placeholder="room - street - locality" required>
                </div>
                <div class="inputBox">
                    <label for="city">city :</label>
                    <input id="city" type="text" name="city" placeholder="cairo" required>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <label for="country">country :</label>
                        <input id="state" type="text" name="country" placeholder="egypt" required>
                    </div>
                    <div class="inputBox">
                        <label for="zip code">zip code :</label>
                        <input id="zip code" type="text" name="zip" placeholder="123 456" required>
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="images\card_img.png" alt="">
                    <select id="payment_methods" name="payment_methods" required>
                        <option value="" selected disabled hidden>Select card type</option>
                        <option value="visa">Visa</option>
                        <option value="master-card">Master Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="american_express">American Express</option>
                    </select>
                </div>
                <div class="inputBox">
                    <label for="name on card">name on card :</label>
                    <input id="name_on_card" name="name_on_card" type="text" placeholder="mr. john deo" required>
                </div>
                <div class="inputBox">
                    <label for="credit">credit card number :</label>
                    <input id="credit" type="number" name="credit" placeholder="1111-2222-3333-4444" required>
                </div>
                <div class="inputBox">
                    <label for="month">exp month :</label>
                    <input id="month" type="text" name="month" placeholder="january" required>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <label for="year">exp year :</label>
                        <input id="year" type="number" name="year" placeholder="2022" required>
                    </div>
                   
                </div>

            </div>
    
        </div>

        <input type="submit" name="submit" value="Order Now" class="submit-btn">

    </form>

</div>    
    
</body>
</html>

