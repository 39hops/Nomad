<?php
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
?>