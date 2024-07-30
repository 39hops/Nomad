<?php

include ("db_connection.php");

$itinerariesArray = [];
$sql = "SELECT * FROM itinerary
WHERE user_id = 1
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/profile.css?v=<?php echo time(); ?>">
    <title>NOMAD | Profile</title>
</head>

<body>
    <div class="profile-container">
        <div class="nav">
            <a href="../php/index.php"><span id="nomad">NOMAD</span></a>
            <a href="../php/login.php">LOGIN</a>
            <a href="../pages/signup.html">SIGNUP</a>
        </div>

        <div class="user">
            <img id="avi" src="../images/default-anouar-olh.jpg">
            <h1 id="username">username</h1>
            <h2 id="bio">bio</h2>
        </div>

        <div class="functions">
            <a href="../pages/edit-profile.html"><img class="icon" id="edit" src="../images/edit.png"></a>
            <img class="icon" id="create" src="../images/create.png">
        </div>

        <div class="itry-container"></div>
    </div>

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
        var edit = document.getElementById('edit');
        var create = document.getElementById('create');
        var createModal = document.getElementById('createModal');
        var closeCreate = document.querySelector('.close');
        var itinerariesArray = <?php echo json_encode($itinerariesArray) ?>;
        var itryContainer = document.querySelector('.itry-container');

        edit.addEventListener('click', editProfile);
        create.addEventListener('click', openModal);
        closeCreate.addEventListener('click', closeModal);

        function editProfile() {
            console.log('this is the edit function');
        }

        function openModal() {
            createModal.style.display = "block";
        }

        function closeModal() {
            createModal.style.display = "none";
        }

        function onLoad() {

            console.log(itinerariesArray);

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

        onLoad();


        function getItryAct(e) {

            // console.log(e);
            // console.log(e.target);
            console.log((e.target).dataset.itineraryId);
            var itineraryID = (e.target).dataset.itineraryId;

            $.ajax({
                type: "POST",
                url: "./get-itinerary-activities.php",
                data: {
                    itineraryID : itineraryID
                },
                success: function (data) {

                    var result = JSON.parse(data);
                    console.log(result);
                    location.replace('./itinerary-activities.php');
                }
            });
        }



    </script>
</body>

</html>
