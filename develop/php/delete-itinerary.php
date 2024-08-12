<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: delete-itinerary.php
# Date: 8/11/2024
# Description: PHP file to allow user to delete an itinerary.

# Check if the itineraryID is provided in POST data
if (isset($_POST['itineraryID'])) {

    $itineraryID = $_POST['itineraryID']; # Get the itinerary ID from POST data

    include ("db_connection.php"); # Include the database connection

    # Prepare SQL statement to delete the itinerary
    $sql = "DELETE FROM itinerary WHERE id = $itineraryID";

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
