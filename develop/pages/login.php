<?
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: login.php
# Date: 8/11/2024
# Description: PHP page to allow user to login to their profile.
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page to allow user to login to their profile.">
    <meta name="keywords" content="Nomad, profile, login, user">
    <meta name="author" content="Artin Azizi, Mohamed Dualeh, Raisa Rahman">
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <title>NOMAD | Login</title>
</head>

<body>
    <div class="login-window">
        <div class="nav">
            <span><a href="../pages/index.php">NOMAD</a></span>
            <div><a href="../pages/signup.html">SIGN UP</a></div>
        </div>

        <div class="form-container glass">
            <form action="../php/checklogin.php" method="POST">
                <h2>welcome</h2>
                <div class="avi-wrapper">
                    <img id="avatar" src="../images/default-anouar-olh.jpg" alt="Avatar">
                </div>

                <div class="loginItems">
                    <input class="glass" placeholder="Username" type="text" name="username" id="username">
                </div>

                <div class="loginItems">
                    <input class="glass" placeholder="Password" type="password" name="password" id="password">
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error" id="user-error">
                        <?php echo $_GET['error']; ?>
                    </p>
                    <?php } ?>
                </div>

                <div class="loginItems">
                    <button class="glass" id="loginButton" type="submit">LOGIN</button>
                </div>
            </form>
        </div>
        <div class="signup">
            <p>New to Nomad? <a href="../pages/signup.html">SIGN UP</a></p>
        </div>
    </div>
</body>

</html>