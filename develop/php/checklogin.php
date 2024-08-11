<!--Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
    Professor: Alemeseged Legesse
    File Name: checklogin.php
    Date: 8/11/2024
    Description: PHP file to check to see if a user's login information is correct. 
-->
<?php 
/**
 * Starting session to log user information if their login is correct.
 */
session_start();
/**
 * Including database connection script.
 */
include "db_connection.php";
/**
 * Checking to see if username and password were set in the login form.
 */
if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname =  $_POST['username'];
    $pass = $_POST['password']; 
    /**
     * Returning error message if username is empty.
     */
    if (empty($uname)) {
        header("Location: ../pages/login.php?error=Please enter username or password. ");
        exit();
    /**
     * Returning error message if password is empty.
     */
    } else if (empty($pass)) {
        header("Location: ../pages/login.php?error=Please enter username or password. ");
        exit();
    } else {
        /**
         * If username and password are not empty, query the database to find the correct user.
         */
        try {
            $sql = "SELECT *
                FROM user
                WHERE u_username='$uname'";
            $result = $conn->query($sql);
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                var_dump($row);
                if (password_verify($pass, $row["u_password"])){
                    /**
                     * If user information is correct, log all user information.
                     */
                    $userObj[] = (object) $row;
                    $_SESSION['user'] = $userObj;
                    $_SESSION['loggedIn'] = true;
                    /**
                     * Redirect to index if user is now logged in.
                     */
                    header("Location: ../pages/index.php");
                    exit();
                } 
            } else {
                /**
                 * If file parsed to here, their information was not correct, so redirect to login page with correct error message.
                 */
                header("Location: ../pages/login.php?error=Incorrect username or password. ");
                exit();
            }   
        /**
         * Catching exception.
         */
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}
/**
 * Closing connection.
 */
$conn->close();
    

       