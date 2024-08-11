<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: edit-avi.php
# Date: 8/11/2024
# Description: PHP file to allow the user to edit their profile picture.
session_start();
include("db_connection.php");

if (!isset($_POST['avi_url'])) {
    die("Please enter a valid image url.");
}

$userid = $_SESSION['user'][0]->id;
$updatedAvi_url = $_POST['avi_url'];

try {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET avi_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("si", $updatedAvi_url, $userid);

    if ($stmt->execute()) {
        echo "User information updated successfully";
        header("Location: ../pages/edit-profile.php?status=updateAviSuccess");
        exit();
    } else {
        die("Error updating user information: " . $stmt->error);
    }
} catch (Exception $e) {
    header("Location: ../pages/edit-profile.php?status=error");
    exit();
}