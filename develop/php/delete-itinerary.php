<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: checklogin.php
    Date: 8/11/2024
    Description: PHP file to allow a user to delete an itinerary.
<?php
/** 
 * Check if the 'itineraryID' field is present in the POST request 
 */
if (isset($_POST['itineraryID'])) {

    /** 
     * Retrieve the value of 'itineraryID' from the POST request 
     */
    $itineraryID = $_POST['itineraryID'];

    /** 
     * Including database connection script.
     */
    include ("db_connection.php");

    /** 
     * Create the SQL query to delete a record from the 'itinerary' table where the ID matches 
     * Note: This query is susceptible to SQL injection; using prepared statements is recommended 
     */
    $sql = 
        "DELETE FROM itinerary 
        WHERE itinerary.id = $itineraryID";
    /** 
     * Execute the SQL query 
     */
    $result = $conn->query($sql);

    /** 
     * Check if the query execution was successful 
     */
    if ($result === TRUE) {
        /** 
         * Output a success message if the record was deleted successfully 
         */
        echo "Record deleted successfully";
    } else {
        /** 
         * Output an error message if there was a problem with the query 
         */
        echo "Error deleting record: " . $conn->error;
    }
} else {
    /** 
     * Output a message if 'itineraryID' was not received in the POST request 
     */
    echo "No data received";
}
?>
