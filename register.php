<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hejab| Register</title>
    <link rel="shortcut icon" href="images/2.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/register.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Poppins:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet" />

</head>
<header>

</header>


<body>
    <section id="image">
        <img src="images/WhatsApp Image 2024-03-08 at 18.33.19_469f94d8.jpg">
    </section>


    <main>
        <section id="register-div">
            <h2>Register</h2>

            <form action=" register.php" method="post" id="registerForm">

                <input type="text" id="Name" name="User_Name" placeholder="Your Name" autocomplete="off" required />
                <input type="text" id="user_name" name="User_Username" placeholder="User Name" autocomplete="off" required />

                <input type="email" id="email" name="User_Email" placeholder="Email" autocomplete="off" required />
                <input type="tel" id="phone_no" name="User_Phone" placeholder="phone number" autocomplete="off" required />
                <input type="text" id="Address" name="User_Address" placeholder="Your Address" autocomplete="off" required />
                <input type="password" id="pass" name="User_Password" placeholder="Password" autocomplete="off" required />
                <button type="submit" name="submit" id="reg" value="Create Account">Register</button>
            </form>


            <div id="loginsumit">
                <span style="color: red">Already Have Account? </span><a href="login.php">Login</a>
            </div>
        </section>
    </main>

    <?php
    if (@$_POST['submit'] and $_POST['submit'] == 'Create Account') {
        include("connection.php");

        $User_Name = $_POST['User_Name'];
        $User_Username = $_POST['User_Username'];
        $User_Password = $_POST['User_Password'];
        $User_Address = $_POST['User_Address'];
        $User_Phone = $_POST['User_Phone'];
        $User_Email = $_POST['User_Email'];


        $query = "SELECT * FROM `customer` WHERE `customer_Username` ='$User_Username'";
        $sql = mysqli_query($con, $query);

        $row = mysqli_fetch_array($sql);
        if ($row > 0) {
    ?>
            <script type="text/javascript">
                alert(" User Name already exists");
                window.location.href = 'register.php';
            </script>
            <?php
        } else {
            $sql1 = " INSERT INTO `customer` ( `customer_name`, `customer_username`, `customer_password`,
            `customer_address`, `customer_phone_number`, `customer_Email`) 
            VALUES ( '$User_Name', '$User_Username', '$User_Password', '$User_Address', '$User_Phone', '$User_Email');";


            $q1 = "INSERT INTO `customer` ( `customer_name`, `customer_username`, `customer_password`,
            `customer_address`, `customer_phone_number`, `customer_Email`) 
            VALUES ( '$User_Name', '$User_Username', '$User_Password', '$User_Address', '$User_Phone', '$User_Email');";

            if (mysqli_query($con, $q1)) {
            ?>
                <script type="text/javascript">
                    alert(" Membership has been successfully registered");
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert(" Membership has been not registered");
                </script>
    <?php

            }
        }
    } ?>

</body>

</html>