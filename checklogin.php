<?php 
session_start();
include "db_connection.php";



if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname =  $_POST['username'];
    $pass = $_POST['password']; 
 
    if (empty($uname)) {
        header("login.php?error=Username is required");
    exit();
    } else if (empty($pass)) {
        header("login.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT id, u_username, first_name, u_password 
                FROM user
                WHERE u_username='$uname' AND u_password='$pass'";
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['u_password'])){
                $_SESSION['user_name'] = $row['u_username'];
                $_SESSION['name'] = $row['first_name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['loggedin'] = 1;
                header("./index.php");
                exit();
            } else {
                header("login.php?error=Incorrect username or password");
                exit();
            } 
        } else {
                header("login.php?error=Incorrect username or password");
                exit();
        }
    } 
} else {
    header("login.php");
    exit();
}