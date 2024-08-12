<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: edit-email.php
# Date: 8/11/2024
# Description: PHP file to allow the user to change their email.

session_start(); # Start the session
include("db_connection.php"); # Include the database connection

# Check if the email is provided
if (!isset($_POST['email'])) {
    die("Email field is required.");
}

$userid = $_SESSION['user'][0]->id; # Get the user ID from the session
$updatedEmail = $_POST['email']; # Get the new email from POST data

try {

    # Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    # Prepare the SQL statement to update the email
    $sql = "UPDATE user SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    # Check if the statement preparation failed
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    # Bind parameters to the SQL statement
    $stmt->bind_param("si", $updatedEmail, $userid);

    # Execute the statement and check if it was successful
    if ($stmt->execute()) {
        echo "User information updated successfully.";
        header("Location: ../pages/edit-profile.php?status=updateEmailSuccess"); # Redirect on success
        exit();
    } else {
        echo "Error updating user information: " . $stmt->error;
    }

    $stmt->close(); # Close the statement
    $conn->close(); # Close the database connection
} catch (Exception $e) {
    echo "Error: " . $e->getMessage(); # Handle exceptions
}
?>
