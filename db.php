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
$conn = new mysqli($servername,$username,$password,"finaHealthCare");

//Create user table 
$sql = "CREATE TABLE IF NOT EXISTS user (
    userID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    UNIQUE (email),
    password_hash VARCHAR(100) NOT NULL,
    userRole INT(11) NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
         // Do nothing if table created
    } else {
      echo "Error creating table: " . $conn->error;
    }
//set auto increment


$sql = "ALTER TABLE user AUTO_INCREMENT=100";
if ($conn->query($sql) === TRUE) {
    // Do nothing if table created
} else {
 echo "Error: " . $conn->error;
}


// Create the inventoryItem table 
$sql = "CREATE TABLE IF NOT EXISTS inventoryItem (
    itemID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    item_name VARCHAR(100) NOT NULL, 
    price DOUBLE PRECISION(100,2) NOT NULL,
    quantity INT(100) NOT NULL, 
    s_status INT(40) NOT NULL,
    userID INT NOT NULL, 
    FOREIGN KEY (userID) REFERENCES user(userID)
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created 
  } else {
    echo "Error creating table: " . $conn->error;
  }


// Create the batch table 
$sql = "CREATE TABLE IF NOT EXISTS batch (
    batchID VARCHAR(40) NOT NULL PRIMARY KEY, 
    itemList VARCHAR(1000) NOT NULL, 
    quantityList VARCHAR(1000) NOT NULL, 
    delivery_Date VARCHAR(40) NOT NULL,
    total_price DOUBLE PRECISION(100,2) NOT NULL
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created 
  } else {
    echo "Error creating table: " . $conn->error;
  }



// Create the report table 
$sql = "CREATE TABLE IF NOT EXISTS report (
    reportID VARCHAR(40) NOT NULL PRIMARY KEY, 
    title VARCHAR(100) NOT NULL, 
    batchID VARCHAR(40) NOT NULL, 
    FOREIGN KEY (batchID) REFERENCES batch(batchID),
    userID INT NOT NULL, 
    FOREIGN KEY (userID) REFERENCES user(userID),
    gen_Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created 
  } else {
    echo "Error creating table: " . $conn->error;
  }
  


 
?>