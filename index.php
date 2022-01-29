<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Lvcky Shop</title>
</head>
<body>
    <div class="w3-row shoptextcontainer">
        <div class="w3-col" style="width:20%">
            <h2 class="shoptext">LvckyShop</h2>
        </div>
    </div>
    <?php
    include("mysql/mysql.php");

    ?>

<div class="w3-row-padding w3-section w3-stretch">
    <?php
        // <div class="w3-col s4">
        //     <img src="img_nature_wide.jpg" style="width:100%">
        // </div>
        $result = getProductList();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $productname = $row["productname"];
                $description = $row["description"];
                $price = $row["price"];
                $imageURL = $row["imageURL"];
                echo "<div class=\"w3-col s4\">";
                echo "<div class=\"w3-card-4 w3-margin w3-grey\">";
                echo "<img src=\"" . $imageURL . "\" alt=\"Nature\" style=\"width:100%\">";
                echo "<div class=\"w3-container\">";
                echo "<h3>$productname</h3>";
                echo "<p>$description</p>";
                echo "<p>$price</p>";
                echo "<p>";
                echo "<button class=\"w3-button w3-block w3-theme-l4\">Buy</button>";
                echo "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            
            }
        } else {
            echo "Es wurden noch keine Produkte erstellt. Oder in der Datenbank gefunden.";
        }
    ?>

</div>
</body>
</html>