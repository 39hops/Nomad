<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: signup.php
# Date: 8/11/2024
# Description: PHP file to insert the user's signup information into the database.
include "db_connection.php";


$sql = "INSERT INTO user (first_name, last_name, u_username, email, `u_password`)
VALUES (?, ?, ?, ?, ?) ";

$conn_stmt = $conn->stmt_init();

if(! $conn_stmt->prepare($sql)){
    die("SQL Error: " . $conn->error);
};
$password = $_POST['password'];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$conn_stmt->bind_param("sssss",
$_POST["fname"],
$_POST['lname'],
$_POST['username'],
$_POST['email'],
$passwordHash);


 if ($conn_stmt->execute()){
    header("Location: ../pages/login.php");
 } else {
    die($conn->error . " ");
 }

$conn->close();