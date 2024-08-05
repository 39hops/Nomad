<?php

session_start();

include ("db_connection.php");


$sql = "INSERT INTO itinerary (it_name, user_id) VALUES (?, ?)";

$conn_stmt = $conn->stmt_init();

if(! $conn_stmt->prepare($sql)){
    die("SQL Error (prepare): " . $conn->error);
};

if (!isset($_POST["it_name"]) || empty($_POST["it_name"])) {
    die("Error: itinerary is not set or is empty");
}

$it_name = $_POST["it_name"];
$user_id = $_SESSION["user"][0]->id;

if (!$conn_stmt->bind_param("si", $it_name, $user_id)) {
    die("SQL Error (bind_param): " . $conn_stmt->error);
}

 if ($conn_stmt->execute()){
    header("Location: ../pages/profile.php");
    exit();
 } else {
    die($conn->error . "");
 }

?>