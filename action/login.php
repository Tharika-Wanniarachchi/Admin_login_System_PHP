<?php
include('../conn/conn.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isset($_POST['submit'])){
        // Check if fields are empty
        if(empty($username)) {
            header('Location: ../index.php?user_msg=Username is required!&pw_msg=Password is required!#loginForm');
            exit();
        }
        if (empty($password)) {
            header('Location: ../index.php?user_msg=Username is required!&pw_msg=Password is required!#loginForm');
            exit();
        }
        
    }

    // Prepare and execute the SQL query to select the hashed password for the provided username
    $query = "SELECT `password` FROM `tbl_user` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if the username exists in the database
        if (mysqli_num_rows($result) > 0) {
            // Fetch the stored hashed password
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            // Verify the password using password_verify function
            if (password_verify($password, $stored_password)) {
                // Retrieve the user's name from the database
                $name_query = "SELECT `first_name`, `last_name` FROM `tbl_user` WHERE `username` = '$username'";
                $name_result = mysqli_query($conn, $name_query);

                if ($name_result && mysqli_num_rows($name_result) > 0) {
                    $user_data = mysqli_fetch_assoc($name_result);
                    $user_first_name = $user_data['first_name'];
                    $user_last_name = $user_data['last_name'];
                    
                    // Store the user's name in a session variable
                    $_SESSION['user_name'] = $user_first_name . ' ' . $user_last_name;
                }

                header('Location: ../home.php');
                exit();
            } else {
                // Incorrect password
                header('Location: ../index.php?login_msg2=Incorrect password!');
                exit();
            }

        } else {
            // User not found
            header('Location: ../index.php?login_msg2=User Not Found!');
            exit();
        }
    } else {
        // Handle database query error
        echo "Error: " . mysqli_error($conn);
    }
}
?>
