<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: add-to-itinerary.php
    Date: 8/11/2024
    Description: PHP file to allow a user to to add an activity to an itinerary.
-->
<?php
/**
 * If activityID and itineraryID is set. Insert into associative entity to create a link between the activity and the itinerary.
 */
if (isset($_POST['activityID']) && isset($_POST['itineraryID'])) {
    /**
     * Including database script.
     */
    include "db_connection.php";
    $activitiesArray = [];
    /**
     * Query to insert into itinerary_activity
     */
    $sql = "INSERT INTO itinerary_activity (itinerary_id, activity_id)
    VALUES (?, ?)";
    $conn_stmt = $conn->stmt_init();
    if (!$conn_stmt->prepare($sql)) {
        die("SQL Error (prepare): " . $conn->error);
    }
    $activityID = $_POST['activityID'];
    $itineraryID = $_POST['itineraryID'];
    if (!$conn_stmt->bind_param("ii", $itineraryID, $activityID)) {
        die("SQL Error (bind_param): " . $conn_stmt->error);
    }
    if ($conn_stmt->execute()) {
    } else {
        die($conn->error . "");
    }
} else {
    echo "No data received";
}