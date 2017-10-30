<?php
    $dbHost = "localhost";
    $dbName = "final_project";
    $dbUser = "WebService";
    $dbPass = "Harry&Anna1F0rever!";
    
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";