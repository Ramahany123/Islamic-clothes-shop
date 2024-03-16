<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> | Login</title>
    <link rel="shortcut icon" href="" type="">
    <link rel="stylesheet" href="styles/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Poppins:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet" />
</head>

<body>
    <section id="image">
        <img src="images/WhatsApp Image 2024-03-08 at 18.33.19_469f94d8.jpg">
    </section>

    <main>
        <section id="login-section">
            <h2>Login</h2>
            <form action="" method="post" id="loginForm">
                <input type="text" name="User_Email" id="user_name" placeholder="User Name" autocomplete="off" required />
                <input type="password" name="User_Password" id="password" placeholder="Password" autocomplete="off" required />
                <input type="submit" name="submit" value="Login" id="loginbtn">
            </form>
            <section id="register-and-social-media">
                <div>
                    <span>Dont Have an Account? </span><a href="register.php"> Register</a>
                </div>
            </section>
            <?php
            if (isset($_POST['submit']) && $_POST['submit'] == 'Login') {
                include 'connection.php';

                $customer_Email = mysqli_real_escape_string($con, $_POST['User_Email']);
                $customer_Password = mysqli_real_escape_string($con, $_POST['User_Password']);

                $q1 = "SELECT * FROM `customer` WHERE `customer_Email` ='$customer_Email' AND `customer_password`='$customer_Password'";
                $sql = mysqli_query($con, $q1);

                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                    session_start();
                    $_SESSION['customer_id'] = $row['customer_id'];
                    echo "<script>alert('Logged in successfully'); window.location.href = 'index.html';</script>";;
                } else {
                    echo "<script>alert('Invalid email or password. Please try again.');</script>";
                }
            }
            ?>
        </section>
    </main>
</body>

</html>
