<?php

include ("db_connection.php");


$sql = "INSERT INTO user (first_name, last_name, username, email, `password`)
VALUES (?, ?, ?, ?, ?) ";

$conn_stmt = $conn->stmt_init();

if(! $conn_stmt->prepare($sql)){
    die("SQL Error: " . $conn->error);
};
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$conn_stmt->bind_param("sssss",
$_POST["fname"],
$_POST['lname'],
$_POST['username'],
$_POST['email'],
$password);


 if ($conn_stmt->execute()){
    echo "Signup Success!"; 
    header("./index.php");
 } else {
    die($conn->error . "");
 }

$conn->close();
