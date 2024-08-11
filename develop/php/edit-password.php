<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: edit-password.php
# Date: 8/11/2024
# Description: PHP file to allow the user their change their password.
session_start();
include("db_connection.php");

if (!isset($_POST['password'])) {
    die("Password field is required.");
}

$userid = $_SESSION['user'][0]->id;
$updatedPassword = $_POST['password'];

$updatedPasswordHash = password_hash($updatedPassword, PASSWORD_DEFAULT);

try {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET u_password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("si", $updatedPasswordHash, $userid);

    if ($stmt->execute()) {
        echo "User information updated successfully.";
        header("Location: ../pages/edit-profile.php?status=updatePassSuccess");
        exit();
    } else {
        echo "Error updating user information: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
``
