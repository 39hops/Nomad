<?php
$username = 'root';
$password = '';
$dbname = 'nomad';
$conn = new mysqli('localhost', $username, $password, $dbname) or die("Unable to connect. ");
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}











