<?php 
# Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
# Professor: Alemeseged Legesse
# File Name: checklogin.php
# Date: 8/11/2024
# Description: PHP file to check to see if a user's login information is correct. 

# Start a new session
session_start();

# Include database connection file
include "db_connection.php";

# Check if username and password are set in the POST request
if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname =  $_POST['username'];  # Get username from POST request
    $pass = $_POST['password'];  # Get password from POST request
    
    # Check if username or password is empty
    if (empty($uname)) {
        # Redirect to login page with error if username is empty
        header("Location: ../pages/login.php?error=Please enter username or password. ");
        exit();
    } else if (empty($pass)) {
        # Redirect to login page with error if password is empty
        header("Location: ../pages/login.php?error=Please enter username or password. ");
        exit();
    } else {
        try {
            # SQL query to select user by username
            $sql = "SELECT *
                FROM user
                WHERE u_username='$uname'";
            
            # Execute the query
            $result = $conn->query($sql);

            # Check if exactly one user is found
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();  # Fetch user data
                var_dump($row);  # Debug: output user data

                # Verify password against the hashed password stored in the database
                if (password_verify($pass, $row["u_password"])) {

                    # Create a user object and store it in the session
                    $userObj[] = (object) $row;
                    $_SESSION['user'] = $userObj;
                    $_SESSION['loggedIn'] = true;
                    
                    # Redirect to index page on successful login
                    header("Location: ../pages/index.php");
                    exit();
                } 
            } else {
                # Redirect to login page with error if username or password is incorrect
                header("Location: ../pages/login.php?error=Incorrect username or password. ");
                exit();
            }   
        } catch (PDOException $e) {
            # Display database error if an exception occurs
            die("DB ERROR: " . $e->getMessage());
        }
    }
}

# Close the database connection
$conn->close();  
