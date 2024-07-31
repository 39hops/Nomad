<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit-profile.css?v=<?php echo time(); ?>">
    <title>NOMAD | Edit Profile</title>
</head>

<body>

    <div class="edit-container">
        <div class="nav">
            <a href="../php/index.php"><span id="nomad">NOMAD</span></a>
            <a href="../php/login.php">LOGIN</a>
            <a href=".signup.html">SIGNUP</a>
        </div>

        <div class="content-wrapper">
            <div class="avi">
                <img name="avi_url" id="avi" src="../images/default-anouar-olh.jpg">
            </div>
            <div class="edit-wrapper">
                <div id="edit-avi">
                    <form type="submit" method="post" action="../php/edit-avi.php">
                        <input name="avi_url" type="text" placeholder="avi.url">
                        <button>x</button>
                    </form>
                </div>

                <div id="edit-username">
                    <form type="submit" method="post" action="../php/edit-username.php">
                        <input name="username" id="username" type="text" placeholder="username">
                        <button>x</button>
                    </form>
                </div>

                <div id="edit-email">
                    <form method="post" action="../php/edit-email.php">
                        <input name="email" type="text" placeholder="email">
                        <button type="submit">x</button>
                    </form>
                </div>

                <div id="edit-bio">
                    <form method="post" action="../php/edit-bio.php">
                        <input name="bio" type="text" placeholder="bio">
                        <button type="submit" method="post" action="edit-bio.php">x</button>
                    </form>
                </div>

                <div id="edit-password">
                    <form method="post" action="../php/edit-password.php">
                        <input name="password" type="text" placeholder="password">
                        <button type="submit" method="post" action="edit-password.php">x</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>