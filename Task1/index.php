<?php
session_start();
if (isset($_SESSION['loggedUserName'])) header("location: dashboard.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>

    <div class="container">
        <div class="row">
            <header class="col-lg-12">
                <h1>Welcome to Greenverz</h1>
            </header>
            <section>
                <div class="image-container col-lg-8 col-md-6">
                    <img src="images/main-image.jpg" alt="main-image">
                </div>
                <div class="signup-container col-lg-4 col-md-6">
                    <h2>Join the Community Now!</h2>
                    <form autocomplete="off" action="" method="post">
                        <input id="username" name="username" type="text" placeholder="Enter Name" required>
                        <input id="useremail" name="useremail" type="email" placeholder="Enter Email" required>
                        <p>
                            <input id="newPassword" name="userpassword" type="password" placeholder="New Password"
                                required>
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                            <input id="confirmPassword" name="confirmpassword" type="password"
                            placeholder="Confirm Password" required>
                        </p>
                        <a href="#" id="submit" onclick="validatePassword();">Signup</a>
                    </form>
                    <h6>Already have an account? <a href="login.php">Login</a></h6>
                    <?php require 'script.php'; ?>
                </div>
            </section>
        </div>
    </div>

    <!-- Jquery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src='script.js'></script>

</body>

</html>