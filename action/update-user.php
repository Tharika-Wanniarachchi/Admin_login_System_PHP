<?php
include('../conn/conn.php');

$oldtbl_user_id = "";
$oldFirstName = "";
$oldLastName = "";
$oldContactNumber = "";
$oldEmail = "";
$oldUsername = "";
$oldPassword = "";

if (isset($_GET['tbl_user_id'])) {
    $updatetbl_user_id = $_GET['tbl_user_id'];
    $sql = "SELECT * FROM tbl_user WHERE tbl_user_id='$updatetbl_user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $oldtbl_user_id = $row['tbl_user_id'];
        $oldFirstName = $row['first_name'];
        $oldLastName = $row['last_name'];
        $oldContactNumber = $row['contact_number'];
        $oldEmail = $row['email'];
        $oldUsername = $row['username'];
        $oldPassword = $row['password'];
    }
}

if (isset($_POST['submit'])) {
    $newtbl_user_id = $_POST['tbl_user_id'];
    $newFirstName = $_POST['first_name'];
    $newLastName = $_POST['last_name'];
    $newContactNumber = $_POST['contact_number'];
    $newEmail = $_POST['email'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

        $errors = [];
        $fields = [
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
            'contact_number' => $contactNumber,
            'email' => $newEmail,
            'username' => $newUsername,
            'password' => $password
        ];

        // Check if the first name is empty
        if (empty($newFirstName)) {
            $errors['up_msg1'] = "First name is required.";
        }

        // Check if the last name is empty
        if (empty($newLastName)) {
            $errors['up_msg2'] = "Last name is required.";
        }

        // Check if the contact number is empty or invalid
        if (empty($newContactNumber)) {
            $errors['up_msg3'] = "Contact number is required.";
        } elseif (!preg_match('/^0\d{9}$/', $newContactNumber)) {
            $errors['up_msg3'] = "Contact number must be in the format 0XXXXXXXXX.";
        }

        // Check if the email is empty
        if (empty($newEmail)) {
            $errors['up_msg4'] = "Email is required.";
        }


        // If there are any errors, redirect back with the error messages and form values
        if (!empty($errors)) {
            $query_string = http_build_query(array_merge($errors, $fields));
            header("Location: ../home.php?$query_string");
            exit();
        }
        
        else {
        $sql = "UPDATE tbl_user SET first_name='$newFirstName', last_name='$newLastName', contact_number='$newContactNumber', email='$newEmail' WHERE tbl_user_id='$newtbl_user_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: ../home.php?update_msg=Update User Successfully');
            exit();
        } else {
            header('Location: ../home.php?update_msg=Failed to update data!');
            exit();
        }
    }
}
?>
