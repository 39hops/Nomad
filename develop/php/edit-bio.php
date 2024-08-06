<?php
session_start();
include("db_connection.php");

if (!isset($_POST['bio'])) {
    die("Bio field is required.");
}

$userid = $_SESSION['user'][0]->id;
$updatedBio = $_POST['bio'];

try {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET bio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("si", $updatedBio, $userid);

    if ($stmt->execute()) {
        echo "User information updated successfully.";
        header("Location: ../pages/edit-profile.php?status=updateBioSuccess");
        exit();
    } else {
        echo "Error updating user information: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}