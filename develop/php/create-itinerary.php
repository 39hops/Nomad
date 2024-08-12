<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: create-itinerary.php
# Date: 8/11/2024
# Description: PHP file to allow the user to create an itinerary.

session_start(); # Start session to access session variables

include "db_connection.php"; # Include database connection file

# SQL query to insert a new itinerary into the database
$sql = "INSERT INTO itinerary (it_name, user_id) VALUES (?, ?)";

$conn_stmt = $conn->stmt_init(); # Initialize statement

# Prepare the SQL statement
if (! $conn_stmt->prepare($sql)) {
    die("SQL Error (prepare): " . $conn->error); # Handle SQL prepare error
}

# Check if itinerary name is set and not empty
if (!isset($_POST["it_name"]) || empty($_POST["it_name"])) {
    die("Error: itinerary is not set or is empty"); # Handle missing or empty itinerary name
}

$it_name = $_POST["it_name"]; # Get itinerary name from POST data
$user_id = $_SESSION["user"][0]->id; # Get user ID from session

# Bind parameters to the SQL statement
if (!$conn_stmt->bind_param("si", $it_name, $user_id)) {
    die("SQL Error (bind_param): " . $conn_stmt->error); # Handle SQL bind error
}

# Execute the SQL statement
if ($conn_stmt->execute()) {
    header("Location: ../pages/profile.php"); # Redirect to profile page on success
    exit();
} else {
    die($conn->error . ""); # Handle SQL execution error
}
?>
