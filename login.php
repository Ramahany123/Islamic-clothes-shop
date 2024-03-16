<?php
session_start();

if(isset($_POST['submit']) && $_POST['submit'] == 'Login') {
    
    include 'connection.php';

    $user_name = mysqli_real_escape_string($con, $_POST['User_Username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $user_type = mysqli_real_escape_string($con, $_POST['who']); 

    if($user_type == 'Admin') {
        $table = 'admin';
        $id_key = 'Admin_ID';
        $username_column = 'Admin_Username';
        $password_column = 'Admin_Password';
    } else {
        $table = 'customer';
        $id_key = 'customer_id';
        $username_column = 'customer_Email'; 
        $password_column = 'customer_password'; 
    }

    
    $query = "SELECT * FROM `$table` WHERE `$username_column`='$user_name' AND `$password_column`='$password'";
    $sql = mysqli_query($con, $query);

    
    if(mysqli_num_rows($sql) > 0) {
        
        $row = mysqli_fetch_assoc($sql);

        
        $_SESSION[$id_key] = $row[$id_key];

        
        echo "<script>alert('Logged in successfully'); window.location.href = 'index.html';</script>";
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
    <header></header>
    <section id="image">
        <img src="images/WhatsApp Image 2024-03-08 at 18.33.19_469f94d8.jpg">
    </section>

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
                    <span>Dont Have an Account? </span><a href="register.html"> Register</a>
                </div>
            </section>

        </section>
    </main>

</body>

</html>
