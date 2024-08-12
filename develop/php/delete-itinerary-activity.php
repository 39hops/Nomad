<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: delete-itinerary-activity.php
# Date: 8/11/2024
# Description: PHP file to allow user to remove an activity from an itinerary.

# Check if both itineraryID and activityID are provided in POST data
if (isset($_POST['itineraryID']) && isset($_POST['activityID'])) {

    $itineraryID = $_POST['itineraryID']; # Get the itinerary ID from POST data
    $activityID = $_POST['activityID'];   # Get the activity ID from POST data

    include ("db_connection.php"); # Include the database connection

    # Prepare SQL statement to delete the specific activity from the itinerary
    $sql = "DELETE FROM itinerary_activity
            WHERE itinerary_id = $itineraryID
            AND activity_id = $activityID";

    $result = $conn->query($sql); # Execute the SQL statement

    # Check if the deletion was successful
    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error; # Output error if any
    }

} else {
    echo "No data received"; # Output message if no data is received
}
?>
