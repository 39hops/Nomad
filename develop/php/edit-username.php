<?php

session_start();
include ("db_connection.php");

if(!isset($_SESSION['user_id'])){
    die("Must be logged in to update user information.");
}

$user_id = $_SESSION['user_id'];

$updatedUsername = $_POST['username'];

$sql = "UPDATE users SET username = :username  WHERE id = :user_id";


$stmt->bindParam(':username', $updatedUsername, PDO::PARAM_STR);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "User information updated successfully.";
} else {
    echo "Error updating user information.";
}

$stmt->closeCursor();
$pdo = null;