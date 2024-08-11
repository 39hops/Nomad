<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: checklogin.php
    Date: 8/11/2024
    Description: PHP file to allow a user to edit their password.
-->
<?php
/** 
 * Start a new session or resume the existing session 
 */
session_start();

/** 
 * Include the database connection script 
 */
include("db_connection.php");

/** 
 * Check if 'password' is set in the POST request; if not, terminate the script with an error message 
 */
if (!isset($_POST['password'])) {
    die("Password field is required.");
}

/** 
 * Retrieve the user ID from the session 
 */
$userid = $_SESSION['user'][0]->id;

/** 
 * Retrieve the new password from the POST request 
 */
$updatedPassword = $_POST['password'];

/** 
 * Hash the new password using bcrypt (PASSWORD_DEFAULT) 
 */
$updatedPasswordHash = password_hash($updatedPassword, PASSWORD_DEFAULT);

try {
    /** 
     * Check if there was an error connecting to the database 
     */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    /** 
     * Prepare an SQL statement to update the user's password in the database 
     */
    $sql = "UPDATE user SET u_password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    /** 
     * Check if there was an error preparing the statement 
     */
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    /** 
     * Bind the hashed password and user ID to the prepared statement 
     */
    $stmt->bind_param("si", $updatedPasswordHash, $userid);

    /** 
     * Execute the prepared statement 
     */
    if ($stmt->execute()) {
        /** 
         * Output a success message and redirect to the edit profile page with a success status 
         */
        echo "User information updated successfully.";
        header("Location: ../pages/edit-profile.php?status=updatePassSuccess");
        exit();
    } else {
        /** 
         * Output an error message if there was an issue executing the statement 
         */
        echo "Error updating user information: " . $stmt->error;
    }

    /** 
     * Close the prepared statement and database connection 
     */
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    /** 
     * Output an error message if an exception is caught 
     */
    echo "Error: " . $e->getMessage();
}

