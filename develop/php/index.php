<?php

include ("db_connection.php");

$countriesArray = [];
$sql = "SELECT id, cr_name FROM country";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countriesArray[$row["id"]] = $row["cr_name"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <title>NOMAD</title>
</head>

<body>
    <div class="main">

        <div class="container" id="start">
            <a href="#search">
                <header>NOMAD</header>
            </a>
        </div>

        <div class="container" id="search">

            <div class="nav">
                <span id="nomad">NOMAD</span>
                <a href="../pages/login.html">LOGIN</a>
                <a href="../pages/signup.html">SIGNUP</a>
            </div>

            <h1 id="discover">discover.</h1>

            <div class="search-bar glass">

                <div class="dropdown">
                    <input type="text" id="country-title" readonly placeholder="COUNTRY">
                    <div class="option" id="country-optn">
                    </div>
                </div>

                <div class="dropdown">
                    <input type="text" id="city-title" readonly placeholder="CITY">
                    <div class="option" id="city-optn">
                        <div class="city-item"><i>Please select a country.</i></div>
                    </div>
                </div>

                <div class="dropdown">
                    <input type="text" id="activity-title" readonly placeholder="ACTIVITY">
                    <div class="option" id="activity-optn">
                        <div id="nullAct"><i>Please select a city.</i></div>
                    </div>
                </div>

                <div>
                    <img class="glass" src="../images/search.png" id="search-btn">
                </div>

            </div>

        </div>

    </div>

    <script>

        var dropdown = document.querySelectorAll('.dropdown');
        var countryTitle = document.getElementById('country-title');
        var cityTitle = document.getElementById('city-title');
        var actTitle = document.getElementById('activity-title');
        var searchBtn = document.getElementById('search-btn');

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener('click', toggle);
        }

        searchBtn.addEventListener('click', search);

        function toggle() {

            for (i = 0; i < dropdown.length; i++) {
                if (dropdown[i] !== this) {
                    if ((dropdown[i].classList.value).includes('active')) {
                        dropdown[i].classList.toggle('active');
                    }
                }
            }

            this.classList.toggle('active');
        }

        function selectCountry() {
            cityTitle.value = '';
            actTitle.value = '';
            countryTitle.value = this.innerHTML;
            countryTitle.dataset.qry = this.dataset.qry;
            getCities(this.dataset.qry);
        }

        function selectCity() {
            actTitle.value = '';
            cityTitle.value = this.innerHTML;
            cityTitle.dataset.qry = this.dataset.qry;
            showActivities();
        }

        function selectActivity() {
            actTitle.value = this.innerHTML;
            actTitle.dataset.qry = this.dataset.qry;
        }

        function showCountries() {

            var countries = <?php echo json_encode($countriesArray); ?>;
            var keys = Object.keys(countries);
            var options = document.getElementById('country-optn');

            for (i = 0; i < keys.length; i++) {

                var optnDiv = document.createElement('div');
                optnDiv.innerHTML = countries[keys[i]];
                optnDiv.dataset.qry = keys[i];
                optnDiv.classList.add('glass');
                options.append(optnDiv);
                optnDiv.addEventListener('click', selectCountry);
            }
        }

        showCountries();

        function getCities(id) {

            $.ajax({
                type: "POST",
                url: "./getCities.php",
                data: { countryID: id },
                success: function (data) {

                    var cities = JSON.parse(data);
                    var keys = Object.keys(cities);
                    var options = document.getElementById('city-optn');
                    prevQry = document.getElementsByClassName('city-item');
                    var staticArr = Array.from(prevQry);

                    for (i = 0; i < staticArr.length; i++) {
                        staticArr[i].remove();
                    }

                    for (i = 0; i < keys.length; i++) {
                        var optnDiv = document.createElement('div');
                        optnDiv.innerHTML = cities[keys[i]];
                        optnDiv.dataset.qry = keys[i];
                        optnDiv.classList.add('glass');
                        optnDiv.classList.add('city-item');
                        options.append(optnDiv);
                        optnDiv.addEventListener('click', selectCity);
                    }

                }
            });

        }

        function showActivities() {

            var options = document.getElementById('activity-optn');
            var nullAct = document.getElementById('nullAct');
            const activities = ['Architecture', 'Nature', 'Museum', 'Restaurant'];

            if (nullAct) {

                nullAct.remove();

                for (i = 0; i < activities.length; i++) {

                    var optnDiv = document.createElement('div');
                    optnDiv.innerHTML = activities[i];
                    optnDiv.classList.add('glass');
                    options.append(optnDiv);
                    optnDiv.addEventListener('click', selectActivity);

                }
            }

        }

        function search() {

            console.log('searching . . .');

            console.log(cityTitle.value);
            console.log(actTitle.value);

            //this should be turned into real client side validation later
            
            if (actTitle.value == '' || cityTitle.value == '') {
                console.log('Please select a country, city, and activity');
            }

            $.ajax({
                type: "POST",
                url: "./get-activities.php",
                data: {
                    activity: (actTitle.value).toLowerCase(),
                    cityID : cityTitle.dataset.qry
                },
                success: function (data) {

                    var result = JSON.parse(data);
                    console.log(result);
                    location.replace('./search-results.php');
                }
            });

        }

    </script>

</body>

</html>