<?php
session_start();

if (isset($_POST['submit']) && $_POST['submit'] == 'Login') {

    include 'connection.php';

    $user_name = mysqli_real_escape_string($con, $_POST['User_Username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $user_type = mysqli_real_escape_string($con, $_POST['who']);

    if ($user_type == 'Admin') {
        $table = 'admin';
        $id_key = 'Admin_ID';
        $username_column = 'Admin_Username';
        $password_column = 'Admin_Password';
    } else {
        $table = 'customer';
        $id_key = 'customer_id';
        $username_column = 'customer_username';
        $password_column = 'customer_password';
    }


    $query = "SELECT * FROM `$table` WHERE `$username_column`='$user_name' AND `$password_column`='$password'";
    $sql = mysqli_query($con, $query);


    if (mysqli_num_rows($sql) > 0) {

        $row = mysqli_fetch_assoc($sql);


        $_SESSION[$id_key] = $row[$id_key];


        echo "<script>alert('Logged in successfully'); window.location.href = 'index.php';</script>";
        exit;
    } else {

        echo "<script>alert('Invalid username or password. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> | Login</title>
    <link rel="shortcut icon" href="" type="">
    <link rel="stylesheet" href="styles/login.css" />

</head>

<body>
    <header></header>


    <main>
        <section id="login-section">
            <h2>Login</h2>
            <form action="" method="post" id="loginForm">
                <input type="text" id="user_name" name="User_Username" placeholder="User Name" autocomplete="off" required />
                <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required />
                <select name="who" id="who">
                    <option value="Admin">Admin</option>
                    <option value="Customer">Customer</option>
                </select>
                <button type="submit" name="submit" value="Login" id="loginbtn">Login</button>
            </form>

            <section id="register-and-social-media">
                <div>
                    <span>Dont Have an Account? </span><a href="register.php"> Register</a>
                </div>
            </section>

        </section>
    </main>
    <section id="image">
        <img src="images/log_reg.jpg">
    </section>

</body>

</html>
