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
    u_name VARCHAR(50) NOT NULL,
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

  $query = mysqli_query($conn, "SELECT * FROM inventoryitem");
      
      $row = mysqli_fetch_array($query);
     if($row == 0){
     
      //Insert data in the form table
     
           $insert = mysqli_query($conn, "INSERT INTO inventoryitem (item_name, price, quantity, s_status, userID)
       VALUES 
        ( 
        'Gloove',
         6,
         4,
         1,
         100
         ),
         ( 
         'Bandage',
         9,
         4,
         1,
         100
         ),
         (
         'Plaster',
         12,
         8,
         1,
         100
         ),
         (
         'Ice_packs',
         15,
         10,
         1,
         100
         ),
         (
         'Cottons',
         18,
         12,
         1,
         100
         ),
         (
         'Surgical_mask',
         21,
         14,
         1,
         100
         ),
         (
         'Surgical_gown',
         27,
         5,
         1,
         100
         )
         ");
     
      if($insert){
     
      } else {
        echo 'Failed to add records due to '.mysqli_error($conn);
      }
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
  

  function uploadData($conn,$batchID,$itemNo, $quantity,$delivery_Date,$total_price)
  {
      $query = "SELECT * FROM batch WHERE batchID = '$batchID'";
      $result = $conn->query($query);
      if($result->num_rows == 0){

        $itemList=implode(",",$itemNo);
        $quantityList=implode(",",$quantity);
        $tp = floatval($total_price);
    
        
        $mainQuery = "INSERT INTO batch SET batchID='$batchID',itemList='$itemList',quantityList='$quantityList',delivery_Date='$delivery_Date',total_price='$tp'";
        $result1 = $conn->query($mainQuery) or die("Error in main Query".$conn->error);
        return $result1;

      }else{
   return false;
  }

  }
 
?>