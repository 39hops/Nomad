<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: delete-itinerary-activity.php
# Date: 8/11/2024
# Description: PHP file to allow user to remove an actity from an itinerary.

if (isset($_POST['itineraryID']) && isset($_POST['activityID'])) {

    $itineraryID = $_POST['itineraryID'];
    $activityID = $_POST['activityID'];

    include ("db_connection.php");

    $sql = "DELETE
    FROM itinerary_activity
    WHERE itinerary_activity.itinerary_id = $itineraryID
    AND itinerary_activity.activity_id = $activityID";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }


} else {
    echo "No data received";
}
