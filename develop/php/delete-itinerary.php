<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: delete-itinerary.php
# Date: 8/11/2024
# Description: PHP file to allow user to delete an itinerary.
if (isset($_POST['itineraryID'])) {

    $itineraryID = $_POST['itineraryID'];

    include ("db_connection.php");

    $sql = "DELETE
    FROM itinerary
    WHERE itinerary.id = $itineraryID";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }


} else {
    echo "No data received";
}
