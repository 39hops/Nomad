<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: signup.php
# Date: 8/11/2024
# Description: PHP file to insert the user's signup information into the database.

# Include database connection file
include "db_connection.php";

# SQL query to insert user information into the user table
$sql = "INSERT INTO user (first_name, last_name, u_username, email, `u_password`)
VALUES (?, ?, ?, ?, ?) ";

# Initialize the statement object
$conn_stmt = $conn->stmt_init();

# Prepare the SQL statement
if (! $conn_stmt->prepare($sql)) {
    die("SQL Error: " . $conn->error);
}

# Get the password from POST request and hash it
$password = $_POST['password'];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

# Bind parameters to the SQL query
$conn_stmt->bind_param("sssss",
    $_POST["fname"],
    $_POST['lname'],
    $_POST['username'],
    $_POST['email'],
    $passwordHash
);

# Execute the prepared statement
if ($conn_stmt->execute()) {
    # Redirect to login page on successful execution
    header("Location: ../pages/login.php");
} else {
    # Display SQL error if execution fails
    die($conn->error . " ");
}

# Close the database connection
$conn->close();
