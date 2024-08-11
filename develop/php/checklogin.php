<?php 
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: checklogin.php
# Date: 8/11/2024
# Description: PHP file to check to see if a user's login information is correct. 
session_start();
include "db_connection.php";
if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname =  $_POST['username'];
    $pass = $_POST['password']; 
    if (empty($uname)) {
        header("Location: ../pages/login.php?error=Please enter username or password. ");
        exit();
    } else if (empty($pass)) {
        header("Location: ../pages/login.php?error=Please enter username or password. ");
        exit();
    } else {
        try {
            $sql = "SELECT *
                FROM user
                WHERE u_username='$uname'";
            $result = $conn->query($sql);
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                var_dump($row);
                if (password_verify($pass, $row["u_password"])){

                    $userObj[] = (object) $row;
                    $_SESSION['user'] = $userObj;
                    $_SESSION['loggedIn'] = true;
                    
                    header("Location: ../pages/index.php");
                    exit();
                } 
            } else {
                header("Location: ../pages/login.php?error=Incorrect username or password. ");
                exit();
            }   
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}
$conn->close();
    

       