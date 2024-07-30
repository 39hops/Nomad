<?php


?>

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
            <a href="../pages/login.html">LOGIN</a>
            <a href="../pages/signup.html">SIGNUP</a>
        </div>

        <div class="content-wrapper">
            <div class="avi">
                <img id="avi" src="../images/default-anouar-olh.jpg">
            </div>

            <div class="edit-wrapper">
                <div id="edit-avi">
                    <form>
                        <input type="text" placeholder="avi.url">
                        <button type="button">x</button>
                    </form>
                </div>

                <div id="edit-username">
                    <form>
                        <input type="text" placeholder="username">
                        <button type="button">x</button>
                    </form>
                </div>

                <div id="edit-email">
                    <form>
                        <input type="text" placeholder="email">
                        <button type="button">x</button>
                    </form>
                </div>

                <div id="edit-bio">
                    <form>
                        <input type="text" placeholder="bio">
                        <button type="button">x</button>
                    </form>
                </div>

                <div id="edit-password">
                    <form>
                        <input type="text" placeholder="password">
                        <button type="button">x</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        docucument.addEventListener('click', )

                $.ajax({
                    url: 'edit-profile.php', 
                    type: 'POST',
                    data: 
                    
                });
        
    </script>


</body>

</html>