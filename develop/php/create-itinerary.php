<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: create-itinerary.php
    Date: 8/11/2024
    Description: PHP file allow the user to create an itinerary.
-->
<?php
/**
 * Starting session to retrieve user information.
 */
session_start();
/**
 * Including database connection script.
 */
include  "db_connection.php";
/**
 * Query to create a new itinerary.
 */
$sql = "INSERT INTO itinerary (it_name, user_id) VALUES (?, ?)";
/**
 * Initializing connection statement.
 */
$conn_stmt = $conn->stmt_init();
/**
 * Checking to see if query is prepared. If not return error message.
 */
if(! $conn_stmt->prepare($sql)){
    die("SQL Error (prepare): " . $conn->error);
};
/**
 * If itinerary name is empty or not set, provide error message.
 */
if (!isset($_POST["it_name"]) || empty($_POST["it_name"])) {
    die("Error: itinerary is not set or is empty");
}
/**
 * Getting itinerary name and user information.
 */
$it_name = $_POST["it_name"];
$user_id = $_SESSION["user"][0]->id;
/**
 * Binding values to query.
 */
if (!$conn_stmt->bind_param("si", $it_name, $user_id)) {
    die("SQL Error (bind_param): " . $conn_stmt->error);
}
/**
 * If the query executes, redirect to profile.php
 */
 if ($conn_stmt->execute()){
    header("Location: ../pages/profile.php");
    exit();
 } else {
    die($conn->error . "");
 }

