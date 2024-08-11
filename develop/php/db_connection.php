<?php
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: db_connection.php
# Date: 8/11/2024
# Description: PHP file to create a connection to the database.

$username = 'root';
$password = '';
$dbname = 'nomad';
$conn = new mysqli('localhost', $username, $password, $dbname) or die("Unable to connect. ");
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}











