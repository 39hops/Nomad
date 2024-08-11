<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: checklogin.php
    Date: 8/11/2024
    Description: PHP file to create a connection to the database.
-->
<?php
$username = 'root';
$password = '';
$dbname = 'nomad';
/**
 * New connection.
 */
$conn = new mysqli('localhost', $username, $password, $dbname) or die("Unable to connect. ");
/**
 * If connection fails, return error message.
 */
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}











