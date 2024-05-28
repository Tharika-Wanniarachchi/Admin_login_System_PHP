<?php
include('../conn/conn.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){ // Checking form submission
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isset($_POST["submit"])){
        $errors = [];
        $fields = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'contact_number' => $contactNumber,
            'email' => $email,
            'username' => $username,
            'password' => $password
        ];

        // Check if the first name is empty
        if (empty($firstName)) {
            $errors['reg_msg1'] = "First name is required.";
        }

        // Check if the last name is empty
        if (empty($lastName)) {
            $errors['reg_msg2'] = "Last name is required.";
        }

        // Check if the contact number is empty or invalid
        if (empty($contactNumber)) {
            $errors['reg_msg3'] = "Contact number is required.";
        } elseif (!preg_match('/^0\d{9}$/', $contactNumber)) {
            $errors['reg_msg3'] = "Contact number must be in the format 0XXXXXXXXX.";
        }

        // Check if the email is empty
        if (empty($email)) {
            $errors['reg_msg4'] = "Email is required.";
        }

        // Check if the username is empty
        if (empty($username)) {
            $errors['reg_msg5'] = "Username is required.";
        } else {
            // Check if the username already exists
            $check_user_query = "SELECT * FROM tbl_user WHERE username= '$username'";
            $check_user_result = mysqli_query($conn, $check_user_query);

            if (mysqli_num_rows($check_user_result) > 0) {
                $errors['reg_msg5'] = "Username is already in use.";
            }
        }

        // Check if the password is empty
        if (empty($password)) {
            $errors['reg_msg6'] = "Password is required.";
        }

        // If there are any errors, redirect back with the error messages and form values
        if (!empty($errors)) {
            $query_string = http_build_query(array_merge($errors, $fields));
            header("Location: ../registration.php?$query_string");
            exit();
        }
    }

    // Check if the user_id exists in the user table
    $check_user_query = "SELECT * FROM tbl_user WHERE username= '$username'";
    $check_user_result = mysqli_query($conn, $check_user_query);

    if (mysqli_num_rows($check_user_result) > 0) {
        header('Location: ../registration.php?reg_msg=User Already Exists');
        exit();
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Corrected SQL query syntax
        $sql = "INSERT INTO tbl_user (first_name, last_name, contact_number, email, username, password) VALUES ('$firstName', '$lastName', '$contactNumber', '$email', '$username', '$hashedPassword')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header('Location: ../index.php?reg_msg=User successfully Registered!');
            exit();
        } else {
            die(mysqli_error($conn));
            exit();
        }
    }
}
?>
