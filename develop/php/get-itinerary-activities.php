<?php
if (isset($_POST['itineraryID']) && isset($_POST['itineraryName'])) {

    $itineraryID = $_POST['itineraryID'];
    $itineraryName = $_POST['itineraryName'];

    include ("db_connection.php");

    $itryActArray = [];

    $sql = "SELECT *
    FROM itinerary_activity
    JOIN activity ON itinerary_activity.activity_id = activity.a_id
    JOIN itinerary ON itinerary_activity.itinerary_id = itinerary.id
    WHERE itinerary_activity.itinerary_id = $itineraryID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $itryActArray[] = (object) $row;
        }
    }

    array_unshift($itryActArray, $itineraryName);

    session_start();
    $_SESSION['itinerary-activities']=$itryActArray;

    // i think this can be deleted later ??
    echo json_encode($itryActArray);

} else {
    echo "No data received";
}
?>