<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Icon</title>
    <style>
        /* Styling for the profile icon */
        .profile-icon {
            width: 100px; /* Set the width of the profile icon */
            height: 100px; /* Set the height of the profile icon */
            border-radius: 50%; /* Make the profile icon circular */
            background-color: #ccc; /* Set a background color for the profile icon */
            display: flex; /* Use flexbox for centering */
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            font-size: 24px; /* Set font size for the content */
            margin-bottom: 20px; /* Add margin to create space between the profile icon and the table */
        }
        /* Styling for the customer details table */
        table {
            width: 80%; /* Set the width of the table */
            margin: 0 auto; /* Center the table horizontally */
            border-collapse: collapse;
            background-color: #f9f9f9; /* Add background color to the table */
        }
        th, td {
            padding: 12px; /* Increase padding for better spacing */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold; /* Add bold font weight to table header cells */
        }
    </style>
</head>
<body>
    <!-- Profile Icon Container -->
    <div class="profile-icon">
        <!-- PHP code to fetch user data from database -->
        <?php
        // Include your database connection file
        include("connection.php");

        // Check if the user is logged in and their ID is set in the session
        session_start();
        if(isset($_SESSION['customer_id'])) {
            // Retrieve the customer ID from the session
            $customer_id = $_SESSION['customer_id'];

            // Query to fetch user data based on the logged-in customer ID
            $query = "SELECT * FROM `customer` WHERE `customer_id` = $customer_id"; // Adjust the query as needed

            // Execute the query
            $result = mysqli_query($con, $query);

            // Check if there is any data fetched
            if (mysqli_num_rows($result) > 0) {
                // Fetch the data
                $row = mysqli_fetch_assoc($result);
                // Display user initials inside the profile icon
                echo "<span>" . strtoupper(substr($row['customer_name'], 0, 1)) . "</span>";

                // Display the customer details in a table
                echo "<table>";
                echo "<tr><th colspan='2'>Customer Details</th></tr>";
                echo "<tr><td>Customer ID:</td><td>{$row['customer_id']}</td></tr>";
                echo "<tr><td>Name:</td><td>{$row['customer_name']}</td></tr>";
                echo "<tr><td>Username:</td><td>{$row['customer_username']}</td></tr>";
                echo "<tr><td>Email:</td><td>{$row['customer_Email']}</td></tr>";
                echo "<tr><td>order id: </td><td>{$row['Order_id']}</td></tr>";
                
                echo "</table>";
            } else {
                // If no data found, display a default content
                echo "<span>JD</span>"; // Default content, change as needed
            }
        } else {
            // If the user is not logged in, you may display a default content or redirect them to the login page
            echo "<span>Guest</span>"; // Display "Guest" if the user is not logged in
        }
        ?>
    </div>
</body>
</html>
