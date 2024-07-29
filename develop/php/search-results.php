<?php
include ("db_connection.php");

session_start();

$searchResults = $_SESSION["search-results"];

$json_output = json_encode($searchResults);

$itinerariesArray = [];
$sql = "SELECT * FROM itinerary
WHERE user_id = 1
ORDER BY date_created ASC";
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
    <link rel="stylesheet" href="../css/search-results.css?v=<?php echo time(); ?>">
    <title>NOMAD | Search</title>
</head>

<body>

    <div class='search-results-container'>
        <div class='nav'>
            <a href='../php/index.php'><span id='nomad'>NOMAD</span></a>
            <a href='../pages/login.html'>LOGIN</a>
            <a href='../pages/signup.html'>SIGNUP</a>
        </div>

        <div class='viewing'>
            now viewing <span id='activity'></span> in <span id='city'></span>
        </div>

        <div id="addModal">
            <div class="close">&times;</div>
            <div class="form-wrapper">
                <form action="../php/add-to-itinerary.php" method="post" id="select-itry">
                    <p id="message">Select an itinerary:</p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    var data = <?php echo $json_output; ?>;
    const container = document.querySelector('.search-results-container');
    const results = document.createElement('div');
    const activity = document.getElementById('activity');
    const city = document.getElementById('city');
    const cityName = data[1].c_name;
    var itinerariesArray = <?php echo json_encode($itinerariesArray); ?>;
    var addModal = document.getElementById('addModal');
    var form = document.getElementById('select-itry');
    var p = document.getElementById('message');

    // below can be deleted later
    console.log(data);
    console.log(data[1]);
    console.log(data[1].a_id);

    activity.innerHTML = data[0];
    city.innerHTML = cityName;

    function loadSearch() {


        for (let i = 1; i < data.length; i++) {
            var card = document.createElement('div');
            var aName = document.createElement('div');
            var aDescription = document.createElement('div');
            var aImage = document.createElement('img');
            var addBtn = document.createElement('div');

            aImage.src = data[i].image;
            aDescription.innerHTML = data[i].a_description;
            aName.innerHTML = data[i].a_name;
            addBtn.innerHTML = '+';
            card.dataset.qry = data[i].a_id;

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

            addBtn.addEventListener('click', addItry);

            results.setAttribute('class', 'search-results');
        }
    }

    function loadModal() {
        console.log(itinerariesArray);

        if (itinerariesArray && itinerariesArray.length > 0) {
            for (i = 0; i < itinerariesArray.length; i++) {
                var radio = document.createElement('input');
                var label = document.createElement('label');
                var br = document.createElement('br');

                radio.setAttribute('type', 'radio');
                radio.setAttribute('name', 'itry');
                radio.setAttribute('value', itinerariesArray[i].id);
                label.innerHTML = itinerariesArray[i].it_name;

                form.append(radio);
                form.append(label);
                form.append(br);
            }

            var submitBtn = document.createElement('button');
            submitBtn.setAttribute('type', 'submit');
            submitBtn.classList.add('glass');
            submitBtn.innerHTML = 'ADD';

            form.append(submitBtn);

        } else {

            var proBtn = document.createElement('button');
            proBtn.setAttribute('type', 'button');

            message.innerHTML = 'No itineraries to show. Visit the profile page to create a new itinerary.';
            proBtn.innerHTML = 'GO TO PROFILE';

            proBtn.addEventListener('click', () => {
                window.location.replace('./profile.php');
            })

            form.append(proBtn);
        }
    }

    function addItry() {

    }

    loadSearch();
    loadModal();


</script>