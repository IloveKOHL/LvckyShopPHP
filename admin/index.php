<?php

// Start the session
session_name('lwshop');
session_start();
?>
<?php
    // Vorerst Config abschnitt in PHP
    // UND include Path
    include("../mysql/mysql.php");
?>

<?php
    if (empty($_SESSION['username']) || empty($_SESSION['password'])) {
            // NOT LOGGED IN
            
            session_destroy();

            header("Location: ../");
        } else {
            if (isLoginValid($_SESSION['username'], $_SESSION['password'])) {
                $permissionLevel = getUserPermissionLevelByID(getIDbyHashedPassword($_SESSION['password']));
                if ($permissionLevel == 5) {
                    echo '
                    LOGGED IN AS ADMIN
                    ';
                } else {
                    
                session_destroy();
                header("Location: ../");

                }
            } else {
                // Login is not valid
                session_destroy();
                header("Location: ../");


            }
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>LS Admin</title>

</head>
<body>

</body>