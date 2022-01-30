<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>LS Login</title>
    <!---

        Start Server YEET
        phpserver/php.exe -S 192.168.178.20:80

    -->
</head>
<body>
    <?php
    if (empty($_POST['username']) || empty($_POST['password'])) {
        // NOT TRYING TO LOGIN
        // LOGGED OUT
        session_destroy();
    } else {
        echo "<br>";
        $username = $_POST['username'];
        $password = $_POST['password'];

        $_SESSION['username'] = $username;
        $_SESSION['password'] = hash("sha256", $password);

        header("Location: ../");
    }
    ?>
    <div class="center">
        <div class="w3-container logincontainer">
            <h1>Login</h1>
            <h2>Username</h2>

            <form action="./index.php" method="post">
            <input type="text" name="username" id="username" class="w3-input">

            <h2>Password</h2>
            <input type="password" name="password" id="password" class="w3-input">
            <br>
            <input type="submit" value="Einloggen">
            </form>
            <br>
        </div>
    </div>
</body>