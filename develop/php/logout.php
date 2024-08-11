<?php 
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: logout.php
# Date: 8/11/2024
# Description: PHP file to allow the user to logout.

session_start();
$_SESSION = array();
session_destroy();
header("Location: ../pages/index.php#search");