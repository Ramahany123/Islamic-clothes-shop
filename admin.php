<?php
session_start(); // Start session

// Include database connection and initialize message array
@include 'connection.php';
$message = array();

// Function to set messages in session
function set_message($msg)
{
    $_SESSION['message'][] = $msg;
}
function getCategoryID($c_name)
{
    switch ($c_name) {
        case 'Skirts':
            return 1;
        case 'Hijabs':
            return 2;
        case 'Dresses':
            return 3;
        case 'Shoes':
            return 4;
        default:
            return -1; // Or any other default value indicating no match
    }
}

// Check if session messages exist and assign them to $message array
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Clear session messages after assigning
}

if (isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_size = $_POST['p_size'];
    $p_color = $_POST['p_color'];
    $p_quantity = $_POST['p_quantity'];
    $p_describtion = $_POST['p_describtion'];
    $c_name = $_POST['c_name'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded/' . $p_image;

    $c_id = getCategoryID($c_name);
    $insert_query = mysqli_query($con, "INSERT INTO product(product_name,product_price,product_Size,product_Color,product_QuantityInStock,product_image, product_details, Category_id) VALUES('$p_name', '$p_price','$p_size','$p_color','$p_quantity','$p_image', '$p_describtion','$c_id')") or die('query failed');
    if ($insert_query) {
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        set_message('Product added successfully'); // Set success message
        header('location:admin.php'); // Redirect to admin.php after adding product
        exit(); // Stop further execution
    } else {
        set_message('Could not add the product'); // Set error message
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($con, "DELETE FROM product WHERE product_id = $delete_id ") or die('query failed');
    if ($delete_query) {
        set_message('Product has been deleted'); // Set success message
        header('location:admin.php'); // Redirect to admin.php after deleting product
        exit(); // Stop further execution
    } else {
        set_message('Product could not be deleted'); // Set error message
    }
}

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_size = $_POST['update_p_size'];
    $update_p_color = $_POST['update_p_color'];
    $update_p_quantity = $_POST['update_p_quantity'];
    $update_p_describtion = $_POST['upadate_p_describtion'];
    $update_c_name = $_POST['update_c_name'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/' . $update_p_image;
    $update_c_id = getCategoryID($update_c_name);
    $update_query = mysqli_query($con, "UPDATE product SET product_name = '$update_p_name', product_price = '$update_p_price', product_Size ='$update_p_size', product_Color = '$update_p_color', product_QuantityInStock = '$update_p_quantity', product_details = '$update_p_describtion', Category_id = '$update_c_id', product_image = '$update_p_image' WHERE product_id = '$update_p_id'");

    if ($update_query) {
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        set_message('Product updated successfully'); // Set success message
        header('location:admin.php'); // Redirect to admin.php after updating product
        exit(); // Stop further execution
    } else {
        set_message('Product could not be updated'); // Set error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="styles/admin.css">
    <title>Admin Panel</title>
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };
    ?>

    <?php include 'admin-head.php'; ?>

    <div class="container">
        <section>
            <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
                <h3>Add a new product </h3>
                <input type="text" name="p_name" placeholder="Enter the product name" class="box" required>
                <input type="number" name="p_price" min="0" placeholder="Enter the product price" class="box" required>
                <input type="text" name="p_size" placeholder="Enter the product size" class="box" required>
                <input type="text" name="p_color" placeholder="Enter the product color" class="box" required>
                <input type="number" name="p_quantity" placeholder="Enter the product quantity in stock" class="box" required>
                <input type="text" name="p_describtion" placeholder="Enter the product describtion" class="box" required>
                <input type="text" name="c_name" placeholder="Enter the category name" class="box" required>
                <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
                <input type="submit" value="Add the product" name="add_product" class="btn">
            </form>
        </section>

        <section class="display-product-table">
            <table>
                <thead>
                    <th>product image</th>
                    <th>product name</th>
                    <th>product price</th>
                    <th>product size</th>
                    <th>product color</th>
                    <th>product quantity</th>
                    <th>category name</th>
                    <th>product describtion</th>
                    <th>action</th>
                </thead>
                <tbody>
                    <?php
                    $select_products = mysqli_query($con, "SELECT p.*, c.Category_name FROM product p 
                    JOIN category c ON p.Category_id = c.Category_id");

                    if (mysqli_num_rows($select_products) > 0) {
                        while ($row = mysqli_fetch_assoc($select_products)) {



                    ?>
                            <tr>
                                <td><img src="uploaded/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo "\$" . $row['product_price']; ?>/-</td>
                                <td><?php echo  $row['product_Size']; ?></td>
                                <td><?php echo  $row['product_Color']; ?></td>
                                <td><?php echo  $row['product_QuantityInStock']; ?></td>
                                <td><?php echo  $row['Category_name']; ?></td>
                                <td><?php echo  $row['product_details']; ?></td>
                                <td>
                                    <a href="admin.php?delete=<?php echo $row['product_id']; ?>" class="delete-btn" onclic="return confirm('are your sure you want to delete this ?')"> <i class="fas fa-trash"></i> delete </a>
                                    <a href="admin.php?edit=<?php echo $row['product_id']; ?>" class="option-btn"><i class="fas fa-edit"></i>update</a>
                                </td>
                            </tr>
                    <?php
                        };
                    } else {
                        echo "<div class='empty'>no product added</div>";
                    };
                    ?>
                </tbody>

            </table>

        </section>
        <section class="edit-form-container">
            <?php
            if (isset($_GET['edit'])) { // Added curly braces here
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($con, "SELECT p.*, c.Category_name FROM product p 
                JOIN category c ON p.Category_id = c.Category_id WHERE product_id = $edit_id");
                if (mysqli_num_rows($edit_query) > 0) {
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
            ?>




                        <form action="" method="post" enctype="multipart/form-data">
                            <img src="uploaded/<?php echo $fetch_edit['product_image']; ?>" height="200" alt="">
                            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['product_id']; ?>">
                            <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['product_name']; ?>">
                            <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['product_price']; ?>">
                            <input type="text" name="update_p_size" class="box" required value="<?php echo $fetch_edit['product_Size']; ?>">
                            <input type="text" name="update_p_color" class="box" required value="<?php echo $fetch_edit['product_Color']; ?>">
                            <input type="number" name="update_p_quantity" class="box" required value="<?php echo $fetch_edit['product_QuantityInStock']; ?>">
                            <input type="text" name="update_c_name" class="box" required value="<?php echo $fetch_edit['Category_name']; ?>">
                            <input type="hidden" name="update_c_id" value="<?php echo $fetch_edit['Category_id']; ?>"> <!-- Hidden input for Category_id -->
                            <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                            <input type="submit" value="Update the product" name="update_product" class="btn">
                            <input type="reset" value="Cancel" id="close-edit" class="option-btn">
                        </form>


            <?php
                    };
                    echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
                };
            }
            ?>

        </section>

    </div>
    <script src="admin-script.js"></script>
</body>

</html>