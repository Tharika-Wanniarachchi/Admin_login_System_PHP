<?php
include('./conn/conn.php');
session_start();

$tbl_user_id="";
$oldtbl_user_id = "";
$oldFirstName = "";
$oldLastName = "";
$oldContactNumber = "";
$oldEmail = "";
$oldUsername = "";
$oldPassword = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Login System</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
       
        th:nth-child(5), td:nth-child(5),th:nth-child(7), td:nth-child(7) {
            max-width: 170px; /* Set max-width for password column to 200px */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand ml-5" href="home.php">User Registration and Login System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px; margin-left: 80%;">
                <li class="nav-item dropdown" style="display:flex; justify-content: center; align-items: center;">
                    <i class="fa-solid fa-user"></i>
                    <?php
                        if (isset($_SESSION['user_name'])) {
                            echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    ' . $_SESSION['user_name'] . '
                                </a>';
                        } else {
                            echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    
                                </a>';
                        }
                    ?>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="modal fade mt-5" id="updateUserModal" tabindex="-1" aria-labelledby="updateUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content update">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModal">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./action/update-user.php" method="POST">
                        <input type="hidden" name="tbl_user_id" id="updatetbl_user_id">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="updateFirstName">First Name:</label>
                                <input type="text" class="form-control" id="updateFirstName" name="first_name" value="" autocomplete="off">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['up_msg1'])){
                                            $display_up_msg = $_GET['up_msg1'];  
                                            echo $display_up_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="updateLastName">Last Name:</label>
                                <input type="text" class="form-control" id="updateLastName" name="last_name" value="" autocomplete="off">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['up_msg2'])){
                                            $display_up_msg = $_GET['up_msg2'];  
                                            echo $display_up_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-5">
                                <label for="updateContactNumber">Contact Number:</label>
                                <input type="number" class="form-control" id="updateContactNumber" name="contact_number" maxlength="12" value="" autocomplete="off">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['up_msg3'])){
                                            $display_up_msg = $_GET['up_msg3'];  
                                            echo $display_up_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-7">
                                <label for="updateEmail">Email:</label>
                                <input type="email" class="form-control" id="updateEmail" name="email" value="" autocomplete="off">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['up_msg4'])){
                                            $display_up_msg = $_GET['up_msg4'];  
                                            echo $display_up_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateUsername">Username:</label>
                            <input type="text" class="form-control" id="updateUsername" name="username" value="" autocomplete="off" readonly>
                            <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['up_msg5'])){
                                            $display_up_msg = $_GET['up_msg5'];  
                                            echo $display_up_msg; 
                                        }
                                    ?>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="updatePassword">Password:</label>
                            <input type="password" class="form-control" id="updatePassword" name="password" value="" autocomplete="off" readonly>
                            <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['up_msg6'])){
                                            $display_up_msg = $_GET['up_msg6'];  
                                            echo $display_up_msg; 
                                        }
                                    ?>
                                </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark login-register form-control">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container p-5">
        <div class="content use-content col-md-12 ">
            <h4>Registered users</h4>
            <hr>

            <div class="my-3" style="color:rgb(2, 161, 2); font-size: 18px; font-weight: 500; display:flex; justify-content: center; align-items: center;">
                <?php
                    if (isset($_GET['update_msg'])) {
                        $display_msg = $_GET['update_msg'];
                        echo $display_msg;
                    }
                ?>
            </div>
            <div class="my-3" style="color:rgb(168, 6, 6); font-size: 18px; font-weight: 500; display:flex; justify-content: center; align-items: center;">
                <?php
                    if (isset($_GET['delete_msg'])) {
                        $display_msg = $_GET['delete_msg'];
                        echo $display_msg;
                    }
                ?>
            </div>

            <table class="table table-hover table-collapse table-bordered border-primary col-md-12 text-center">
                <thead class="">
                    <tr class="text-center">
                        <th scope="col">User ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <?php
                        $sql = "SELECT * FROM tbl_user";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $tbl_user_id = $row['tbl_user_id'];
                                $firstName = $row['first_name'];
                                $lastName = $row['last_name'];
                                $contactNumber = $row['contact_number'];
                                $email = $row['email'];

                                echo '<tr>
                                    <th scope="row">' . $tbl_user_id . '</th>
                                    <td>' . $firstName . '</td>
                                    <td>' . $lastName . '</td>
                                    <td>' . $contactNumber . '</td>
                                    <td>' . $email . '</td>
                                    <td>
                                        <button style="font-size:12px;" class="btn btn-success" onclick="update_user(' . $tbl_user_id . ', \'' . $firstName . '\', \'' . $lastName . '\', \'' . $contactNumber . '\', \'' . $email . '\', \'' . $username . '\')" title="Update"><i class="fa-solid fa-pen-to-square"></i> </button>
                                        <button style="font-size:12px;" class="btn btn-danger" onclick="delete_user(' . $tbl_user_id . ')"><i class="fa-solid fa-trash"></i> </button>
                                    </td>
                                </tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Update user
        function update_user(id, firstName, lastName, contactNumber, email, username) {
            $("#updateUserModal").modal("show");

            $("#updatetbl_user_id").val(id);
            $("#updateFirstName").val(firstName);
            $("#updateLastName").val(lastName);
            $("#updateContactNumber").val(contactNumber);
            $("#updateEmail").val(email);
            $("#updateUsername").val(username);
        }

        // Delete user
        function delete_user(id) {
            if (confirm("Do you want to delete this user?")) {
                window.location = "./action/delete-user.php?user=" + id;
            }
        }
    </script>

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
