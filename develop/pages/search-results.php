<?php
include("../php/db_connection.php");

session_start();

if (isset($_SESSION["user"])) {
    $userObj = $_SESSION["user"];
    $userID = $userObj[0]->id;

    $itinerariesArray = [];
    $sql = "SELECT * FROM itinerary
    WHERE user_id = $userID
    ORDER BY date_created ASC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $itinerariesArray[] = (object) $row;
        }
    }
}

$cityID = $_GET['cityID'];
$activity = $_GET['activity'];

$activitiesArray = [];
$sql = "SELECT *
FROM $activity
JOIN activity
ON $activity.activity_id = activity.a_id
JOIN city
ON activity.city_id = city.id
WHERE city.id = $cityID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $activitiesArray[] = (object) $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/search-results.css?v=<?php echo time(); ?>">
    <title>NOMAD | Search</title>
</head>

<body>

    <div class='search-results-container'>


        <?php

        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            echo "<div class='nav'>
            <a href='../pages/index.php'><span id='nomad'>NOMAD</span></a>
            <p id='topName'></p>
            <a href='../pages/profile.php'>PROFILE</a>
            <a href='../php/logout.php'>LOGOUT</a>
            </div>";
        } else {
            echo "<div class='nav'>
            <a href='../pages/index.php'><span id='nomad'>NOMAD</span></a>
            <a href='../pages/login.php'>LOGIN</a>
            <a href='../pages/signup.html'>SIGNUP</a>
            </div>";
        }

        ?>

        <div class='viewing'>
            now viewing <span id='activity'></span> in <span id='city'></span>
        </div>

        <div class="modal-bg">
            <div class="glass" id="addModal">
                <div class="close">&times;</div>
                <div class="form-wrapper">
                    <form id="select-itry">
                    </form>
                    <p class="success">Successfully added to itinerary</p>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

<script>
    var activitiesArray = <?php echo json_encode($activitiesArray); ?>;
    const container = document.querySelector('.search-results-container');
    const results = document.createElement('div');
    const activity = document.getElementById('activity');
    const city = document.getElementById('city');
    const cityName = <?php echo json_encode($_GET['cityName']) ?>;
    var itinerariesArray = <?php
                            if ((isset($_SESSION['user']))) {
                                echo json_encode($itinerariesArray);
                            } else {
                                echo "0";
                            } ?>;
    var modalBG = document.querySelector('.modal-bg');
    var addModal = document.getElementById('addModal');
    var close = document.querySelector('.close');
    var form = document.getElementById('select-itry');
    var p = document.getElementById('message');
    var message = document.querySelector('.success');
    var topName = document.getElementById('topName');
    var username = <?php
                    if ((isset($_SESSION['user']))) {
                        echo json_encode($userObj[0]->u_username);
                    } else {
                        echo "0";
                    }
                    ?>;

    if (topName !== null) {
        topName.innerHTML = username;
    }

    console.log(activitiesArray);

    activity.innerHTML = <?php echo json_encode($_GET['activity']); ?>;
    city.innerHTML = cityName;

    close.addEventListener('click', closeModal);


    function loadSearch() {


        for (let i = 0; i < activitiesArray.length; i++) {
            var card = document.createElement('div');
            var aName = document.createElement('div');
            var aDescription = document.createElement('div');
            var aImage = document.createElement('img');
            var addBtn = document.createElement('div');

            aImage.src = activitiesArray[i].image;
            aDescription.innerHTML = activitiesArray[i].a_description;
            aName.innerHTML = activitiesArray[i].a_name;
            addBtn.innerHTML = '+';
            card.dataset.qry = activitiesArray[i].a_id;

            card.classList.add('card');
            card.classList.add('glass');
            aName.setAttribute('class', 'activity-name');
            aDescription.setAttribute('class', 'description');
            addBtn.classList.add('add-btn');
            addBtn.classList.add('glass');

            card.appendChild(aName);
            card.appendChild(aImage);
            card.appendChild(aDescription);
            card.append(addBtn);
            results.append(card);
            container.append(results);

            addBtn.addEventListener('click', openModal);

            results.setAttribute('class', 'search-results');
        }
    }

    function loadModal() {
        console.log(itinerariesArray);

        if (itinerariesArray && itinerariesArray.length > 0) {

            var select = document.createElement('p');
            select.setAttribute('id', 'message');
            select.innerHTML = 'Select an itinerary: ';
            form.append(select);

            for (i = 0; i < itinerariesArray.length; i++) {
                var field = document.createElement('input');
                var br = document.createElement('br');

                field.setAttribute('type', 'text');
                field.setAttribute('name', 'itry');
                field.readOnly = true;
                field.setAttribute('value', itinerariesArray[i].it_name);
                field.dataset.itineraryId = itinerariesArray[i].id;
                field.addEventListener('click', (e) => {
                    itineraryID = (e.target).dataset.itineraryId;
                    addModal.dataset.itineraryId = itineraryID;
                })

                form.append(field);
                form.append(br);
            }

            var addBtn = document.createElement('button');
            addBtn.setAttribute('type', 'button');
            addBtn.innerHTML = 'ADD';
            addBtn.addEventListener('click', addItry);

            form.append(addBtn);

        } else if (itinerariesArray.length == 0) {
            var select = document.createElement('p');
            var redirect = document.createElement('p');

            select.setAttribute('id', 'message');
            redirect.setAttribute('id', 'alternate');

            select.innerHTML = 'No itineraries to show';
            redirect.innerHTML = '<a href="../pages/profile.php" id="redirect">GO TO PROFILE</a> to create an itinerary'

            form.append(select);
            form.append(redirect);
        } else {

            var select = document.createElement('p');
            var redirect = document.createElement('p');

            select.setAttribute('id', 'message');
            redirect.setAttribute('id', 'alternate');

            select.innerHTML = 'No itineraries to show';
            redirect.innerHTML = '<a href="../pages/login.php" id="redirect">LOGIN</a> to create an itinerary'
            form.append(select);
            form.append(redirect);
        }
    }

    function openModal(e) {
        modalBG.style.display = "block";
        addModal.style.display = "block";

        var activityID = (e.target).parentNode.dataset.qry;
        addModal.dataset.activityId = activityID;
    }

    function closeModal() {
        modalBG.style.display = "none";
        addModal.style.display = "none";
    }

    function addItry() {

        activityID = addModal.dataset.activityId;
        itineraryID = addModal.dataset.itineraryId;

        if (!activityID || !itineraryID) {
            console.log('Please an activity to add to your itinerary');
        }

        $.ajax({
            type: "POST",
            url: "../php/add-to-itinerary.php",
            data: {
                activityID: activityID,
                itineraryID: itineraryID
            },
            success: function(data) {

                message.style.display = "block";

                setTimeout(function() {
                    location.reload();
                }, 3000);

            }
        });

    }

    loadSearch();
    loadModal();
</script>