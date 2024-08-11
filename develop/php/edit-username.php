<?php
session_start();
include("db_connection.php");

if (!isset($_POST['username'])) {
    die("Username field is required.");
}

$userid = $_SESSION['user'][0]->id;
$updatedUsername = $_POST['username'];

try {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET u_username = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("si", $updatedUsername, $userid);

    if ($stmt->execute()) {
        echo "User information updated successfully.";
        header("Location: ../pages/edit-profile.php?status=usernameUpdateSuccess");
        exit();
    } else {
        echo "Error updating user information: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


