<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: index.php
# Date: 8/11/2024
# Description: PHP page to provide the user with the home page, allowing them to search for activities in a certain country, login, and signup.

session_start();

if (isset($_SESSION["user"])) {
    $userObj = $_SESSION["user"];
}

include ("../php/db_connection.php");

# Load countries from database for search bar drop down menu used in javascript
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
    <meta name="description" content="Page to provide the user with the home page, allowing them to search for activities in a certain country, login, and signup.">
    <meta name="keywords" content="Nomad, index, Kenya, Bangladesh, USA, Museum, Architecture, Nature, Restaurant">
    <meta name="author" content="Artin Azizi, Mohamed Dualeh, Raisa Rahman">
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
            <!-- Display a conditional header based on user logged in status -->
            <?php
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                echo "<div class='nav'>
                <span id='nomad'>NOMAD</span>
                <p id='topName'></p>
                <a href='../pages/profile.php'>PROFILE</a>
                <a href='../php/logout.php'>LOGOUT</a>
                </div>";
            } else {
                echo "<div class='nav'>
                <span id='nomad'>NOMAD</span>
                <a href='../pages/login.php'>LOGIN</a>
                <a href='../pages/signup.html'>SIGNUP</a>
                </div>";
            }
            ?>
            <h1 id="discover">discover.</h1>

            <!-- Search bar dropdown selection -->
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

                <div class="btn-container">
                    <i class="glass fa-solid fa-magnifying-glass" id="search-btn"></i>
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
    var topName = document.getElementById('topName');

    // Display username in the nav bar if user is logged in
    var username = <?php 
        if (isset($_SESSION['user'])) {
            echo json_encode($userObj[0]->u_username); 
        } else {
            echo "0";
        }
        
        ?>;
    if (topName !== null) {
        topName.innerHTML = username;
    }

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener('click', toggle);
    }
    searchBtn.addEventListener('click', search);

    // Dropdown menu to display entries
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

    // Set up input values for search form submission
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

    // Load countries for dropdown menu
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
    
    // Populate countries dropdown menu upon page load
    showCountries();

    // Populate city dropdown menu upon selecting a country
    function getCities(id) {
        $.ajax({
            type: "POST",
            url: "../php/get-cities.php",
            data: {
                countryID: id
            },
            success: function(data) {
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

    // Populate activities dropdown menu upon city selection
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

    // Send form input values to header for use in search-results page upon search
    function search() {
        var cityName = cityTitle.value;
        var cityID = cityTitle.dataset.qry;
        var activity = (actTitle.value).toLowerCase();
        if (cityID && activity) {
            var url = '../pages/search-results.php?cityName=' + cityName + '&cityID=' + cityID + '&activity=' +
                activity;
            window.location.replace(url);
        } else {
            console.log('error: empty field');
        }
    }
    </script>

</body>

</html>