<?php

include ("db_connection.php");

$countriesArray = [];
$sql = "SELECT id, name FROM country";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countriesArray[$row["id"]] = $row["name"];
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
                        <div id="nullCity"><i>Please select a country.</i></div>
                    </div>
                </div>

                <div class="dropdown">
                    <input type="text" id="activity-title" readonly placeholder="ACTIVITY">
                    <div class="option" id="activity-optn">
                        <div><i>Please select a city.</i></div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>

        var dropdown = document.querySelectorAll('.dropdown');
        var countryTitle = document.getElementById('country-title');
        var cityTitle = document.getElementById('city-title');

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener('click', toggle);
        }

        function toggle() {
            this.classList.toggle('active');
        }

        function selectCountry() {
            countryTitle.value = this.innerHTML;

            showCities(this.dataset.qry);
        }

        function selectCity() {
            cityTitle.value = this.innerHTML;
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

        function showCities(id) {

            var countryID = id;

            $.ajax({
                type: "POST",
                url: "./getCities.php",
                data: { countryID: countryID },
                success: function (data) {

                    var cities = JSON.parse(data);
                    var keys = Object.keys(cities);
                    var options = document.getElementById('city-optn');
                    var nullCity = document.getElementById('nullCity');
                    var prevQry = document.getElementsByClassName('item');

                    if (nullCity !== null) {
                        nullCity.remove();
                    } else if (prevQry) {
                        for (i = 0; i < prevQry.length; i++) {
                            prevQry[i].remove();
                        }
                    }

                    for (i = 0; i < keys.length; i++) {

                        var optnDiv = document.createElement('div');
                        optnDiv.innerHTML = cities[keys[i]];
                        optnDiv.dataset.qry = keys[i];
                        optnDiv.classList.add('glass');
                        optnDiv.classList.add('item');
                        options.append(optnDiv);
                        optnDiv.addEventListener('click', selectCity);
                    }
                }
            });

        }

        function showActivities() {
            console.log('under construction');
        }

    </script>

</body>

</html>