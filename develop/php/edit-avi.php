<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: checklogin.php
    Date: 8/11/2024
    Description: PHP file to allow a user to edit their profile picture.
-->
<?php
/** 
 * Start a new session or resume the existing session .
 */
session_start();

/** 
 * Include the database connection script 
 */
include "db_connection.php";

/** 
 * Check if 'avi_url' is set in the POST request; if not, terminate the script with an error message.
 */
if (!isset($_POST['avi_url'])) {
    die("Please enter a valid image url.");
}

/** 
 * Retrieve the user ID from the session. 
 */
$userid = $_SESSION['user'][0]->id;

/** 
 * Retrieve the new avatar URL from the POST request.
 */
$updatedAvi_url = $_POST['avi_url'];

try {
    /** 
     * Check if there was an error connecting to the database.
     */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    /** 
     * Prepare an SQL statement to update the user's avatar URL in the database.
     */
    $sql = "UPDATE user SET avi_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    /** 
     * Check if there was an error preparing the statement.
     */
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    /** 
     * Bind the new avatar URL and user ID to the prepared statement.
     */
    $stmt->bind_param("si", $updatedAvi_url, $userid);

    /** 
     * Execute the prepared statement.
     */
    if ($stmt->execute()) {
        /** 
         * Output a success message and redirect to the edit profile page with a success status.
         */
        echo "User information updated successfully";
        header("Location: ../pages/edit-profile.php?status=updateAviSuccess");
        exit();
    } else {
        /** 
         * Output an error message if there was an issue executing the statement. 
         */
        die("Error updating user information: " . $stmt->error);
    }
} catch (Exception $e) {
    /** 
     * Redirect to the edit profile page with an error status if an exception is caught.
     */
    header("Location: ../pages/edit-profile.php?status=error");
    exit();
}

