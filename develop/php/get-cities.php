<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: get-cities.php
# Date: 8/11/2024
# Description: PHP file to retrieve all cities in a certain country.
if (isset($_POST['countryID'])) {

    $countryID = $_POST['countryID'];

    include ("db_connection.php");

    $citiesArray = [];
    $sql = "SELECT id, c_name FROM city WHERE country_id = $countryID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $citiesArray[$row["id"]] = $row["c_name"];
        }
    }

    echo json_encode($citiesArray);

} else {
    echo "No cityID received";
}
