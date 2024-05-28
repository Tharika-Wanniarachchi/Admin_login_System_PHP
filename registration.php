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

</head>
<body>
    
<div class="main-container">
    <div class="reg-container col-md-6 col-sm-8 ">
        <div class="login-img  col-md-6">
            <img src="assets/images/login1.png" alt="login">
        </div>
        <div class="registration " id="registrationForm">
                <h1 class="text-center form-topic">Registration</h1>
                <div class="registration-form">
                    <form action="./action/add-user.php" method="POST">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="firstName">First Name:</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First name" autocomplete="off" value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg1'])){
                                            $display_reg_msg = $_GET['reg_msg1'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="lastName">Last Name:</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last name" autocomplete="off" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg2'])){
                                            $display_reg_msg = $_GET['reg_msg2'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="updateContactNumber">Contact Number:</label>
                                <input type="number" class="form-control" id="updateContactNumber" name="contact_number" maxlength="11" autocomplete="off" placeholder="077 1167 156" value="<?php echo isset($_POST['contact_number']) ? htmlspecialchars($_POST['contact_number']) : ''; ?>">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg3'])){
                                            $display_reg_msg = $_GET['reg_msg3'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="updateEmail">Email:</label>
                                <input type="email" class="form-control" id="updateEmail" name="email" autocomplete="off" placeholder="example@gmail.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg4'])){
                                            $display_reg_msg = $_GET['reg_msg4'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registerUsername">Username:</label>
                            <input type="text" class="form-control" id="registerUsername" name="username" autocomplete="off" placeholder="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                            <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg5'])){
                                            $display_reg_msg = $_GET['reg_msg5'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registerPassword">Password:</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" autocomplete="off" placeholder="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
                            <div style="color:red; font-size: 12px; font-weight: 400;">
                                <?php
                                    if(isset($_GET['reg_msg6'])){
                                        $display_reg_msg = $_GET['reg_msg6'];  
                                        echo $display_reg_msg; 
                                    }
                                ?>
                            </div>
                        </div>
                        <p class="registrationForm" onclick="showLoginForm()">Already have an account? <span> Log in</span></p>
                        <button type="submit" name="submit" class="btn btn btn-style login-register form-control">Register</button>
                    </form>
                </div>
        </div>
    </div>
</div>

<script>
    // Constant variables
    const loginForm = document.getElementById('loginForm');
    const registrationForm = document.getElementById('registrationForm');

    function showRegistrationForm() {
        window.location.href = 'registration.php';
    }

    function showLoginForm() {
        window.location.href = 'index.php';
    }
</script>

<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
