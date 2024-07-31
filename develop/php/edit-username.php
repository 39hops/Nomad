<?php
session_start();
include("db_connection.php");

// don't necessarily need this, if you're not logged in you can't access this page
if (!isset($_SESSION['userid'])) {
    die("Must be logged in to update user information.");
}

if (!isset($_POST['username'])) {
    die("Username field is required.");
}

$userid = $_SESSION['userid'];
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
        header("Location: ../pages/edit-profile.html");
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
