<?php 
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: logout.php
# Date: 8/11/2024
# Description: PHP file to allow the user to logout.

# Start the session
session_start();

# Clear all session variables
$_SESSION = array();

# Destroy the session
session_destroy();

# Redirect to the homepage with the search section
header("Location: ../pages/index.php#search");
?>
