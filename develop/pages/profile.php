<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: profile.php
# Date: 8/11/2024
# Description: PHP page to allow the user to view their name, profile picture, bio, and itineraries.
session_start();

$userObj = $_SESSION["user"];
$userID = $userObj[0]->id;

include ("../php/db_connection.php");

# Load itineraries associated with logged in user for use in javascript
$itinerariesArray = [];
$sql = "SELECT * FROM itinerary
WHERE user_id = $userID
ORDER BY date_created DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $itinerariesArray[] = (object) $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page to allow user to view their profile, inlcuding name, profile picture, bio and itinteraries.">
    <meta name="keywords" content="Nomad, profile, user">
    <meta name="author" content="Artin Azizi, Mohamed Dualeh, Raisa Rahman">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/profile.css?v=<?php echo time(); ?>">
    <title>NOMAD | Profile</title>
</head>

<body>
    <div class="profile-container">
        <div class="nav">
            <a href="../pages/index.php"><span id="nomad">NOMAD</span></a>
            <p id="topName"></p>
            <a href="../php/logout.php">LOGOUT</a>
        </div>
        <div class="user">
            <img id="avi" src="">
            <h1 id="username"></h1>
            <h2 id="bio"></h2>
        </div>
        <div class="functions">
            <a href="../pages/edit-profile.php"><img class="icon" id="edit" src="../images/edit.png"></a>
            <img class="icon" id="create" src="../images/create.png">
        </div>
        <div class="itry-container"></div>
    </div>
    <!-- Dialog box for creating a new itinerary -->
    <div class="glass" id="createModal">
        <div class="close">&times;</div>
        <div class="form-wrapper">
            <form action="../php/create-itinerary.php" method="post">
                <label for="it_name">Create a new itinerary:</label>
                <input type="text" name="it_name" id="it_name">
                <button type="submit" class="glass" id="submit-itry">CREATE</button>
            </form>
        </div>
    </div>

    <script>
    var create = document.getElementById('create');
    var createModal = document.getElementById('createModal');
    var closeCreate = document.querySelector('.close');
    var itinerariesArray = <?php echo json_encode($itinerariesArray) ?>;
    var itryContainer = document.querySelector('.itry-container');
    var usernameEl = document.getElementById('username');
    var bioEl = document.getElementById('bio');
    var topName = document.getElementById('topName');
    var avi = document.getElementById('avi');
    create.addEventListener('click', openModal);
    closeCreate.addEventListener('click', closeModal);

    // Display dialog box for creating a new itinerary
    function openModal() {
        createModal.style.display = "block";
    }

    // Close dialog box
    function closeModal() {
        createModal.style.display = "none";
    }

    // Load itineraries and and dynamically display cards upon page load
    function onLoad() {

        usernameEl.innerText = <?php echo json_encode($userObj[0]->u_username); ?>;
        topName.innerText = <?php echo json_encode($userObj[0]->u_username); ?>;
        var bioVal = <?php echo json_encode($userObj[0]->bio); ?>;
        var aviUrl = <?php echo json_encode($userObj[0]->avi_url); ?>;

        // If the user has a biography listed with their profile, conditionally display
        if (bioVal) {
            bioEl.innerText = bioVal;
        }

        if (aviUrl) {
            avi.src = aviUrl;
        } else {
            avi.src = '../images/default-anouar-olh.jpg';
        }

        // Conditional display if the user does not have any associated itineraries
        if (itinerariesArray && itinerariesArray.length > 0) {
            for (i = 0; i < itinerariesArray.length; i++) {
                var card = document.createElement('div');
                card.classList.add('card');
                card.classList.add('glass');
                card.dataset.itineraryId = itinerariesArray[i].id;
                card.addEventListener('click', getItryAct);
                var itName = document.createElement('p');
                itName.innerText = itinerariesArray[i].it_name;
                card.append(itName);
                itryContainer.append(card);
            }
        } else {
            var p = document.createElement('p');
            p.innerText = 'There are no itineraries to show.';
            p.classList.add('null');
            itryContainer.append(p);
        }
    }

    // Load itinerary cards upon page load
    onLoad();

    // When an itinerary card is clicked, send itinerary information to header for loading on itinerary-activities page
    function getItryAct(e) {
        var itineraryID = (e.target).dataset.itineraryId;
        var itineraryName = (e.target).firstChild.innerText;
        var url = '../pages/itinerary-activities.php?itineraryID=' + itineraryID + '&itineraryName=' + itineraryName;
        window.location.replace(url);
    }
    </script>
</body>

</html>