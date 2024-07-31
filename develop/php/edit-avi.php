<?php
session_start();
include("db_connection.php");


if (!isset($_SESSION['userid'])) {
    die("Must be logged in to update user information.");
}


// $defaultImageUrl = '../images/default-anouar-olh.jpg';


// function getImageUrl($img) {
//     if (isset($_POST['avi_url']) && !empty(trim($_POST['avi_url']))) {
//         $newImageUrl = trim($_POST['avi_url']);
//         return $newImageUrl;
//     }
//     return $img;
// }

// $userid = $_SESSION['userid'];
// $updatedAvi_url = getImageUrl($defaultImageUrl);

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
        header("Location: edit-profile.php?status=success");
        exit();
    } else {
        header("Location: edit-profile.php?status=error");
        exit();
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    header("Location: edit-profile.php?status=error");
    exit();
}
?>
