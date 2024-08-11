<?php
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
