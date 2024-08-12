<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: edit-avi.php
# Date: 8/11/2024
# Description: PHP file to allow the user to edit their profile picture.

session_start(); # Start the session
include("db_connection.php"); # Include the database connection

# Check if the image URL is provided
if (!isset($_POST['avi_url'])) {
    die("Please enter a valid image url.");
}

$userid = $_SESSION['user'][0]->id; # Get the user ID from the session
$updatedAvi_url = $_POST['avi_url']; # Get the new profile picture URL from POST data

try {
    # Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    # Prepare the SQL statement to update the profile picture URL
    $sql = "UPDATE user SET avi_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    # Check if the statement preparation failed
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    # Bind parameters to the SQL statement
    $stmt->bind_param("si", $updatedAvi_url, $userid);

    # Execute the statement and check if it was successful
    if ($stmt->execute()) {
        echo "User information updated successfully";
        header("Location: ../pages/edit-profile.php?status=updateAviSuccess"); # Redirect on success
        exit();
    } else {
        die("Error updating user information: " . $stmt->error);
    }
} catch (Exception $e) {
    header("Location: ../pages/edit-profile.php?status=error"); # Redirect on exception
    exit();
}
?>
