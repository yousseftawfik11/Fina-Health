<?php

//set variables
$servername = "localhost";
$username = "root";
$password = "";

// Create connection to phpMyAdmin
$conn = new mysqli($servername,$username,$password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . mysqli_connect_error());
}

//Create DB
$sql = "CREATE DATABASE IF NOT EXISTS finaHealthCare";
if ($conn->query($sql) === TRUE) {

} else {
  echo "Error creating database: " . $conn->error;
}

//Make connection to the created DB
$sql = "CREATE TABLE IF NOT EXISTS user (
    userID VARCHAR(40) NOT NULL PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    UNIQUE (email),
    "



?>