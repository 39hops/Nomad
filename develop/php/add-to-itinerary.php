<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: add-to-itinerary.php
# Date: 8/11/2024
# Description: PHP file to allow a user to add an activity to an itinerary.

# Check if activityID and itineraryID are set in the POST request
if (isset($_POST['activityID']) && isset($_POST['itineraryID'])) {

    # Include database connection file
    include "db_connection.php";

    # Prepare an empty array for activities 
    $activitiesArray = [];

    # SQL query to insert a new activity into the itinerary_activity table
    $sql = "INSERT INTO itinerary_activity (itinerary_id, activity_id)
    VALUES (?, ?)";

    # Initialize the statement object
    $conn_stmt = $conn->stmt_init();

    # Prepare the SQL statement
    if (!$conn_stmt->prepare($sql)) {
        die("SQL Error (prepare): " . $conn->error);
    }

    # Get the activityID and itineraryID from the POST request
    $activityID = $_POST['activityID'];
    $itineraryID = $_POST['itineraryID'];

    # Bind the parameters to the SQL query
    if (!$conn_stmt->bind_param("ii", $itineraryID, $activityID)) {
        die("SQL Error (bind_param): " . $conn_stmt->error);
    }

    # Execute the prepared statement
    if ($conn_stmt->execute()) {
        # Execution successful, no action needed here
    } else {
        # Display SQL error if execution fails
        die($conn->error . "");
    }
} else {
    # Display message if data is not received
    echo "No data received";
}
