<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: checklogin.php
    Date: 8/11/2024
    Description: PHP file to allow a user to logout.
-->
<?php 
/** 
 * Start a new session or resume the existing session 
 */
session_start();

/** 
 * Clear all session variables 
 */
$_SESSION = array();

/** 
 * Destroy the session 
 */
session_destroy();

/** 
 * Redirect to the index page.
 */
header("Location: ../pages/index.php#search");
exit(); 

