<?php
$servername = "127.0.0.1";
$username = "lvckyshop";
$dbname = "lvckyshop";
$password = "pwlvckyshop";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS accounts (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nickname VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "<script>console.log('MySQL table created')</script>";
} else {
  echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(35) NOT NULL,
    description VARCHAR(250) NOT NULL,
    price INT(6) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "<script>console.log('MySQL table created')</script>";
    } else {
      echo "Error creating table: " . $conn->error;
    }


    $sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(35) NOT NULL,
    description VARCHAR(250) NOT NULL,
    price INT(6) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "<script>console.log('MySQL table created')</script>";
    } else {
      echo "Error creating table: " . $conn->error;
    }

    // $sql = "INSERT INTO `accounts` (`nickname`, `password`) VALUES ('lwroot', 'lwnewuser');";
        
    //     if ($conn->query($sql) === TRUE) {
    //       echo "<script>console.log('MySQL table created')</script>";
    //     } else {
    //       echo "Error creating table: " . $conn->error;
    //     }

$conn->close();

function createNewDataBaseUser($nickname, $rawPassword) {
    global $servername, $username, $dbname, $password;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $hashedPassword = hash("sha256", $rawPassword);

    $sql = "INSERT INTO accounts (nickname, password)
    VALUES ('$nickname', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>console.log('New record created successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>