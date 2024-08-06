<?php
session_start();
include("db_connection.php");

if (!isset($_POST['email'])) {
    die("Email field is required.");
}

$userid = $_SESSION['user'][0]->id;
$updatedEmail = $_POST['email'];

try {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("si", $updatedEmail, $userid);

    if ($stmt->execute()) {
        echo "User information updated successfully.";
        header("Location: ../pages/edit-profile.php?status=updateEmailSuccess");
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