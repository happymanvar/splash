<?php 
session_start();

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
}else {
    echo $_SESSION['msg'] = "your are logged out";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>
    
    <?php 
    include 'db_conntect.php';
    
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $loginpassword = $_POST['password'];
        
        $email_search = "SELECT * FROM users WHERE EmailID='$email' and IsEmailVarified = b'1' and RoleID IN(1,2)";
        $query = mysqli_query($conn, $email_search);
        
        $email_count = mysqli_num_rows($query);
        
        if($email_count) {
            $email_pass = mysqli_fetch_assoc($query);
            
            $db_pass = $email_pass['Password'];
            
            $_SESSION['username'] = $email_pass['FirstName'];
            $_SESSION['user_id'] = $email_pass['ID'];
            $_SESSION['is_loggedin'] = "yes";
    
            $check_pass = password_verify($loginpassword, $db_pass);
            
            if($check_pass) {            
                if(isset($_POST['rememberme'])) {
                    setcookie('emailcookie', $email, time()+86400);
                    setcookie('passwordcookie', $loginpassword, time()+86400);
                ?>
                   <script>location.replace("admin-dashboard.php");</script>
                <?php
                    
                }else {
                    ?>
                   <script>location.replace("admin-dashboard.php");</script>
                <?php
                }
                
                
    
            }else {
                echo "password incorrect";
            }
        }else {
            echo "Invalid Email";
        }
    }
    
    
    
?>   


    <!-- Login -->

    <section id="login">
        <div class="white-box">
            <div class="logo">
                <div class="text-center">
                    <img src="admin-images/images/top-logo.png" alt="logo">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-12 col-sm-12 col-lg-12">
                    <div class="form-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-heading">
                                    <h3 class="text-center">Login</h3>
                                    <p class="text-center">Enter your email address and password to login</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <form id="login-form" class="form" action="" method="post">

                                    <!-- email -->
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="login-email">Email</label>
                                            <input type="email" name="email" class="form-control" id="login-email" aria-describedby="emailHelp" placeholder="Enter your email" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12 col-12 col-sm-12 col-lg-12">
                                            <div class="password-forgotpass">
                                                <label for="email-password" class="text-left">Password</label>
                                                <a href="admin-forgot-pass.html" class="text-right">Forgot Password ?</a>
                                            </div>
                                            <div class="password-input">
                                                <input id="email-password" type="password" class="form-control" name="password" placeholder="Enter your Password" required>
                                                <img src="admin-images/images/eye.png" toggle="#email-password" class="field-icon toggle-password" />
                                            </div>
                                            <small id="passwordHelpBlock" class="form-text">
                                                The password that you've entered is incorrect
                                            </small>
                                        </div>
                                    </div>

                                    <!-- remember me -->
                                    <div class="form-row">
                                        <div class="form-group form-check col-12 col-lg-12 col-md-12 col-sm-12">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberme">
                                            <label class="form-check-label" for="exampleCheck1"> Remember Me</label>
                                        </div>
                                    </div>

                                    <!-- login btn -->
                                    <div class="head-button form-group">
                                       <button type="submit" name="submit" class="btn pre-login-btns">Login</button>
                                    </div>
                                    <!--<button type="button" href="#" id="login-btn" class="btn pre-login-btns">Login</button>-->
                                    
                                    <p class="text-center sign-up-text">Don't have an account? <a href="signup.html">Sign Up</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Ends -->

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>