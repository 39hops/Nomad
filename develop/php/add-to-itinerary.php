<?php
if (isset($_POST['activityID']) && isset($_POST['itineraryID'])) {

    include ("db_connection.php");

    $activitiesArray = [];
    $sql = "INSERT INTO itinerary_activity (itinerary_id, activity_id)
    VALUES (?, ?)";

    $conn_stmt = $conn->stmt_init();

    if (!$conn_stmt->prepare($sql)) {
        die("SQL Error (prepare): " . $conn->error);
    }
    ;

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

?>