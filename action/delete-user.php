<?php
include('../conn/conn.php');

if (isset($_GET['user'])) {
    $user = $_GET['user'];

    try {
        // Construct the SQL query
        $query = "DELETE FROM `tbl_user` WHERE `tbl_user_id` = '$user'";

        // Execute the query
        $query_execute = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($query_execute) {
            header('Location: ../home.php?delete_msg=Selected record has been Deleted!');
            exit();
        } else {
            header('Location: ../home.php?delete_msg=No record found to delete!');
            exit();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
