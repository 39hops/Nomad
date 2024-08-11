<!--Names: Artin Azizi (041131883), Mohamed Dualeh (041137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: signup.php
    Date: 8/11/2024
    Description: PHP file to send signup user data into database.
-->
<?php

/** 
 * Include the database connection script 
 */
include "db_connection.php";

/** 
 * Define the SQL query to insert a new user into the 'user' table 
 */
$sql = "INSERT INTO user (first_name, last_name, u_username, email, `u_password`)
VALUES (?, ?, ?, ?, ?)";

/** 
 * Initialize a statement object for the prepared statement 
 */
$conn_stmt = $conn->stmt_init();

/** 
 * Prepare the SQL statement 
 */
if (!$conn_stmt->prepare($sql)) {
    /** 
     * If preparation fails, terminate the script and display the error 
     */
    die("SQL Error: " . $conn->error);
}

/** 
 * Retrieve and hash the password from the POST request 
 */
$password = $_POST['password'];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

/** 
 * Bind parameters to the prepared statement 
 */
$conn_stmt->bind_param(
    "sssss", 
    $_POST["fname"], 
    $_POST['lname'], 
    $_POST['username'], 
    $_POST['email'], 
    $passwordHash
);

/** 
 * Execute the prepared statement 
 */
if ($conn_stmt->execute()) {
    /** 
     * On successful execution, redirect to the login page 
     */
    header("Location: ../pages/login.php");
    exit(); 
} else {
    /** 
     * If execution fails, terminate the script and display the error 
     */
    die($conn->error . " ");
}

