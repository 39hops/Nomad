<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: checklogin.php
    Date: 8/11/2024
    Description: PHP file to allow a user to delete an activity from an itinerary.
-->
<?php
/**
 * If itineraryid and activityID is set, then delete from the database.
 */
if (isset($_POST['itineraryID']) && isset($_POST['activityID'])) {
    $itineraryID = $_POST['itineraryID'];
    $activityID = $_POST['activityID'];
    /**
     * Including database connection script.
     */
    include "db_connection.php";
    /**
     * Query to delete from itinerary_activity table.
     */
    $sql = "DELETE
    FROM itinerary_activity
    WHERE itinerary_activity.itinerary_id = $itineraryID
    AND itinerary_activity.activity_id = $activityID";
    /**
     * Deleting row.
     */
    $result = $conn->query($sql);
    /**
     * If record was deleted echo error message, else provide error message.
     */
    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No data received";
}
