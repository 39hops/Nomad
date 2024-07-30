<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/login.js"></script>
    <title>NOMAD | Login</title>
</head>

<body>

    <div class="login-window">

        <div class="nav">
            <span><a href="./index.php">NOMAD</a></span>
            <div><a href="../pages/signup.html">SIGN UP</a></div>
        </div>

        <div class="form-container glass">
            <form action="./checklogin.php" method="POST">
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
