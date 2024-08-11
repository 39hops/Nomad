<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: edit-profile.php
    Date: 8/11/2024
    Description: PHP file to provide the user the ability to edit their profile.
-->
<?php
/**
 * Starting session to access user information.
 */
session_start();
/**
 * Retrieving user information.
 */
$userObj = $_SESSION["user"];
$userID = $userObj[0]->id;

/**
 * Including the DB connection script.
 */
include ("../php/db_connection.php");

/**
 * Making the user object an array.
 */
$userObj = array();

/**
 * Query to find all users where their ID is equal to the current user logged in.
 */
$sql = "SELECT * FROM user
WHERE id = $userID";
$result = $conn->query($sql);
/**
 * Fetching query results.
 */
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userObj[] = (object) $row;
        $_SESSION['user'] = $userObj;
    }
}
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
        <div class='nav'>
            <a href='../pages/index.php'><span id='nomad'>NOMAD</span></a>
            <p id='topName'></p>
            <a href='../pages/profile.php'>PROFILE</a>
            <a href='../php/logout.php'>LOGOUT</a>
        </div>

        <div class="content-wrapper">
            <div class="avi">
                <img id="avi" src="">
            </div>
            <div class="edit-wrapper glass">
                <div id="edit-avi">
                    <form type="submit" method="post" action="../php/edit-avi.php">
                        <input name="avi_url" type="text" placeholder="avi.url">
                        <button><i class="fa-solid fa-check"></i></button>
                    </form>
                </div>

                <div id="edit-username">
                    <form type="submit" method="post" action="../php/edit-username.php">
                        <input name="username" id="username" type="text" placeholder="username">
                        <button><i class="fa-solid fa-check"></i></button>
                    </form>
                </div>

                <div id="edit-email">
                    <form method="post" action="../php/edit-email.php">
                        <input name="email" type="text" placeholder="email">
                        <button type="submit"><i class="fa-solid fa-check"></i></button>
                    </form>
                </div>

                <div id="edit-bio">
                    <form method="post" action="../php/edit-bio.php">
                        <input name="bio" type="text" placeholder="bio">
                        <button type="submit" method="post" action="edit-bio.php"><i
                                class="fa-solid fa-check"></i></button>
                    </form>
                </div>

                <div id="edit-password">
                    <form method="post" action="../php/edit-password.php">
                        <input name="password" type="text" placeholder="password">
                        <button type="submit" method="post" action="edit-password.php"><i
                                class="fa-solid fa-check"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    /**
     * topName variable to change the users username and display it to them.
     */
    var topName = document.getElementById('topName');
    var avi = document.getElementById('avi');
    var aviUrl = <?php echo json_encode($userObj[0]->avi_url)?>;
    
    topName.innerHTML = <?php echo json_encode($userObj[0]->u_username) ?>;

    if (aviUrl) {
        avi.src = aviUrl;
    } else {
        avi.src = '../images/default-anouar-olh.jpg';
    }
    console.log(aviUrl);
    </script>

</body>

</html>