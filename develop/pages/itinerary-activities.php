<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: itinerary-activities.php
# Date: 8/11/2024
# Description: PHP page to allow the user to edit their itineraries.
session_start();

# Get activities associated with the itinerary data sent through GET header
if (isset($_SESSION["user"])) {
    $userObj = $_SESSION["user"];
}

$itineraryID = $_GET['itineraryID'];

include ("../php/db_connection.php");

$itryActArray = [];

$sql = "SELECT *
FROM itinerary_activity
JOIN activity ON itinerary_activity.activity_id = activity.a_id
JOIN itinerary ON itinerary_activity.itinerary_id = itinerary.id
WHERE itinerary_activity.itinerary_id = $itineraryID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $itryActArray[] = (object) $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<body>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Page to allow the user to edit their itineraries.">
        <meta name="keywords"
            content="Nomad, edit, Itinerary, Kenya, Bangladesh, USA, Museum, Architecture, Nature, Restaurant">
        <meta name="author" content="Artin Azizi, Mohamed Dualeh, Raisa Rahman">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/itinerary-activities.css?v=<?php echo time(); ?>">
        <title>NOMAD | Itinerary Activities</title>
    </head>

    <div class="activity-container">

        <div class='nav'>
            <a href='../pages/index.php'><span id='nomad'>NOMAD</span></a>
            <p id='topName'></p>
            <a href='../pages/profile.php'>PROFILE</a>
            <a href='../php/logout.php'>LOGOUT</a>
        </div>

        <!-- divs to be dynamically loaded through javascript -->
        <h1 id="itry-name"></h1>
        <div class="delete-wrapper"><img class="glass" id="delete-itry" src="../images/trash.png"></div>
        <div class="activity-wrapper"></div>

    </div>

    <script>
        var itryActArray = <?php echo json_encode($itryActArray) ?>;
        var wrapper = document.querySelector('.activity-wrapper');
        var span = document.getElementById('itry-name');
        span.innerHTML = <?php echo json_encode($_GET['itineraryName']) ?>;
        var topName = document.getElementById('topName');
        var delItryBtn = document.getElementById('delete-itry');

        delItryBtn.addEventListener('click', deleteItry);
        topName.innerText = <?php echo json_encode($userObj[0]->u_username); ?>;

        // Conditionally display and dynamically load activities associated with itinerary
        if (itryActArray && itryActArray.length > 0) {
            for (i = 0; i < itryActArray.length; i++) {
                var card = document.createElement('div');
                var imgWrapper = document.createElement('div');
                var img = document.createElement('img');
                var content = document.createElement('div');
                var title = document.createElement('p');
                var address = document.createElement('p');
                var desc = document.createElement('p');
                var iconWrapper = document.createElement('div');
                var icon = document.createElement('img');

                card.classList.add('card');
                card.classList.add('glass');
                card.dataset.itineraryId = itryActArray[i].itinerary_id;
                card.dataset.activityId = itryActArray[i].activity_id;
                imgWrapper.classList.add('imgWrapper');
                title.classList.add('title');
                content.classList.add('content');
                desc.classList.add('desc');
                icon.classList.add('icon');
                icon.classList.add('glass');

                icon.addEventListener('click', deleteActivity);

                img.src = itryActArray[i].image;
                title.innerText = itryActArray[i].a_name;
                address.innerText = itryActArray[i].address;
                desc.innerText = itryActArray[i].a_description;
                icon.src = '../images/trash.png';

                content.append(title);
                content.append(address);
                content.append(desc);
                imgWrapper.append(img);
                card.append(imgWrapper);
                card.append(content);
                card.append(icon);
                wrapper.append(card);

            }
        } else {
            var empty = document.createElement('p');
            empty.innerHTML = 'No activities to show';
            empty.setAttribute('id', 'empty');
            wrapper.append(empty);
        }

        // Delete itinerary activity from itinerary, reload page upon deletion
        function deleteActivity(e) {

            var itineraryID = (e.target).parentNode.dataset.itineraryId;
            var activityID = (e.target).parentNode.dataset.activityId;

            $.ajax({
                type: "POST",
                url: "../php/delete-itinerary-activity.php",
                data: {
                    itineraryID: itineraryID,
                    activityID: activityID
                },
                success: function (data) {

                    window.location.reload();
                }
            });
        }

        // Delete itinerary function, redirect user to profile page upon success
        function deleteItry() {

            var itineraryID = <?php echo json_encode($_GET['itineraryID']) ?>;
            console.log(itineraryID);

            $.ajax({
                type: "POST",
                url: "../php/delete-itinerary.php",
                data: {
                    itineraryID: itineraryID,
                },
                success: function (data) {

                    window.location.replace('../pages/profile.php');
                }
            });
        }
    </script>
</body>

</html>