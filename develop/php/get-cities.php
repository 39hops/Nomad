<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: checklogin.php
    Date: 8/11/2024
    Description: PHP file to retrieve all cities in a country.
-->
<?php
/** 
 * Check if 'countryID' is set in the POST request 
 */
if (isset($_POST['countryID'])) {

    /** 
     * Retrieve the value of 'countryID' from the POST request 
     */
    $countryID = $_POST['countryID'];

    /** 
     * Include the database connection script 
     */
    include "db_connection.php";

    /** 
     * Initialize an empty array to store cities 
     */
    $citiesArray = [];

    /** 
     * Create the SQL query to select city IDs and names based on the country ID 
     */
    $sql = "SELECT id, c_name FROM city WHERE country_id = $countryID";

    /** 
     * Execute the SQL query 
     */
    $result = $conn->query($sql);

    /** 
     * Check if the query returned any rows 
     */
    if ($result->num_rows > 0) {
        /** 
         * Fetch each row and populate the citiesArray with city IDs and names 
         */
        while ($row = $result->fetch_assoc()) {
            $citiesArray[$row["id"]] = $row["c_name"];
        }
    }

    /** 
     * Encode the citiesArray as a JSON object and output it 
     */
    echo json_encode($citiesArray);

} else {
    /** 
     * Output an error message if 'countryID' was not received in the POST request 
     */
    echo "No countryID received";
}

