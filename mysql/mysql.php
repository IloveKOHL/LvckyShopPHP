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
    password VARCHAR(250) NOT NULL,
    permissionlevel INT(6) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
    } else {
    echo "Error creating table: " . $conn->error;
    }


    $sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(35) NOT NULL,
    description VARCHAR(250) NOT NULL,
    imageURL LONGTEXT NOT NULL,
    price INT(6) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {

    } else {
      echo "Error creating table: " . $conn->error;
    }

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

function deleteUser($id) {
    global $servername, $username, $dbname, $password;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM `accounts` WHERE  `id`=" . $id . ";";

    if ($conn->query($sql) === TRUE) {
        echo "<script>console.log('Deletetion Succesfull')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function changePasswordFromUser($id, $newPassword) {
    global $servername, $username, $dbname, $password;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $hashedPassword = hash("sha256", $newPassword);

    $sql = "UPDATE `accounts` SET `password`='" . $hashedPassword . "' WHERE  `id`=" . $id .";";

    if ($conn->query($sql) === TRUE) {
        echo "<script>console.log('New record created successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function getProductList() {
    global $servername, $username, $dbname, $password;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `products` LIMIT 1000;";

    $result = $conn->query($sql);
    return $result;
    $conn->close();

}

function getUserPermissionLevelByID($id) {
    global $servername, $username, $dbname, $password;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `id`, `permissionlevel` FROM `accounts` WHERE  `id`=$id;";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            if ($row["id"] == $id) {
                return $row['permissionlevel'];
            }
        }
      } else {
        echo "0 results";
      }
    $conn->close();

}

function getIDbyHashedPassword($hashedPassword) {
    global $servername, $username, $dbname, $password;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT `id` FROM `accounts` WHERE `password`='$hashedPassword';";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            return $row['id'];
        }
      } else {
        return 0;
      }
    $conn->close();
}

function isLoginValid($loginusername, $loginpassword) {
    global $servername, $username, $dbname, $password;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `accounts` WHERE `nickname`='$loginusername' AND `password`='$loginpassword';";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            if (!empty($row["id"])) {
                return 1;
            } else {
                return 0;
            }
        }
      } else {
        return 0;
      }
    $conn->close();

}
?>