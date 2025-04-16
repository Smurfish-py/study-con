<?php
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyCon | Study and Connect With Everyone!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="center-page" style="height: 100vh;">
    <div class="inter-300" style="background-color: white; width: 500px; height: 400px; border: solid 1px; border-color: #bebebe;">
        <div class="upper-side" style="background-color:rgb(89, 226, 112); padding: 20px 30px; color: white; font-size: 50px;">
            <p style="margin-top: 0; margin-bottom: 0;">Success<br>:D</p>
        </div>
        <div class="bottom-side font-size-xl" style="padding: 20px 30px;">
            <?php
            $link = $_GET['link'];
            $type = $_GET['type'];
            echo $_GET['message'];
            echo "<br><br>";
            echo "<a href='../../$link' style='text-decoration: none;'>$type</a>";
            ?>
        </div>
    </div>
</body>
</html>