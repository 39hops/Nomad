<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: edit-username.php
# Date: 8/11/2024
# Description: PHP file to allow the user to change their username.

session_start(); # Start the session
include("db_connection.php"); # Include the database connection

# Check if the username is provided
if (!isset($_POST['username'])) {
    die("Username field is required.");
}

$userid = $_SESSION['user'][0]->id; # Get the user ID from the session
$updatedUsername = $_POST['username']; # Get the new username from POST data

try {

    # Check if there's a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    # Prepare the SQL statement to update the username
    $sql = "UPDATE user SET u_username = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    # Check if the statement preparation failed
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    # Bind parameters to the SQL statement
    $stmt->bind_param("si", $updatedUsername, $userid);

    # Execute the statement and check if it was successful
    if ($stmt->execute()) {
        echo "User information updated successfully.";
        header("Location: ../pages/edit-profile.php?status=usernameUpdateSuccess"); # Redirect on success
        exit();
    } else {
        echo "Error updating user information: " . $stmt->error;
    }

    $stmt->close(); # Close the statement
    $conn->close(); # Close the database connection
} catch (Exception $e) {
    echo "Error: " . $e->getMessage(); # Handle any exceptions
}
?>
