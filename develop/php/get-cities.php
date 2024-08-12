<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: get-cities.php
# Date: 8/11/2024
# Description: PHP file to retrieve all cities in a certain country.

# Check if the countryID is provided via POST request
if (isset($_POST['countryID'])) {

    # Assign the countryID from POST data to a variable
    $countryID = $_POST['countryID'];

    # Include the database connection file
    include ("db_connection.php");

    # Initialize an empty array to store city data
    $citiesArray = [];

    # SQL query to select cities based on the countryID
    $sql = "SELECT id, c_name FROM city WHERE country_id = $countryID";

    # Execute the query and store the result
    $result = $conn->query($sql);

    # If there are cities returned, populate the $citiesArray
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $citiesArray[$row["id"]] = $row["c_name"];
        }
    }

    # Return the cities as a JSON-encoded array
    echo json_encode($citiesArray);

} else {
    # Output an error message if countryID is not received
    echo "No countryID received";
}
?>
