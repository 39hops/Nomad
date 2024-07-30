<?php 
session_start();
include ("db_connection.php");



if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname =  $_POST['username'];
    $pass = $_POST['password']; 
    if (empty($uname)) {
        header("Location: login.php?error=Please enter username or password. ");
        exit();
    } else if (empty($pass)) {
        header("Location: login.php?error=Please enter username or password. ");
        exit();
    } else {
        try {
            $sql = "SELECT id, first_name, u_password 
                FROM user
                WHERE u_username='$uname'";
            $result = $conn->query($sql);
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                var_dump($row);
                if (password_verify($pass, $row["u_password"])){
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['firstname'] = $row['first_name'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['loggedIn'] = true;
                    header("Location: index.php");
                    exit();
                } 
            } else {
                header("Location: login.php?error=Incorrect username or password. ");
                exit();
            }   
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }
}
$conn->close();
    

       