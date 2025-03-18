<?php
session_start();

include "../../logika/koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status'] != 'master' || $_SESSION['status-akun'] == 'banned') {
    session_destroy();
    header("Location: ../../");
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <header class="inter-400 header-dark" style="display: flex; justify-content: space-between; padding: 0 50px; align-items: center;">
        <div class="left-side" style="display: flex;">
            <?php
            $path = "../../assets/images/user/".$_SESSION['foto_profil'];
            if(file_exists($path) != false && $_SESSION['foto_profil'] != ''){
                echo "<div>";
                echo "<img src='$path' style='width: 60px; height: 60px; object-fit: cover; border-radius: 100px; margin-right: 30px; margin-top: 12px;'>";
                echo "</div>";
                echo "<div>";
                echo "<h3 class='inter-500'>".$_SESSION['username']."<br><span class='inter-300 font-size-l'>".$_SESSION['status']." account</span></h3>";
                echo "</div>";
            } else {
                echo "<div style='display: flex; align-items: center; text-align: center; margin-right: 30px'><i class='fa-solid fa-circle-user fa-2xl' style='font-size: 60px' ;></i></div>";
                echo "<div>";
                echo "<h3 class='inter-500'>".$_SESSION['username']."<br><span class='inter-300 font-size-l'>".$_SESSION['status']." account</span></h3>";
                echo "</div>";
            }
            ?>
        </div>
        <a id="user-menu">
            <i class="fa-solid fa-address-card fa-2xl"></i>
        </a>
    </header>
    <div class="inter-400 user-card" id="user-card" style="display: none; justify-content: center; ">
        <p class="inter-500 font-size-l">Profile Card<br><span class="inter-200 font-size-md"><?php echo $_SESSION['username'];?></span></p>
        <hr>
        <br>
        <div style="text-align: center;">
            <?php
            if(file_exists($path) != false && $_SESSION['foto_profil'] != ''){
                echo "<img src='$path' style='width: 150px; height: 150px; object-fit: cover; border-radius: 100px; border: 1px solid rgba(0, 0, 0, 0.3);'>";
                echo "<p class='font-size-l'>My Profile<br><span class='inter-300 font-size-md'><a href='../edit-profile.php' style='text-decoration: none; color: rgba(0, 0, 0, 0.8);'>Customize your profile</a></span></p>";
            } else {
                ?>
                <div style="display: flex; align-items: center; justify-content: center; width: 220px; height: 150px; text-align: center; ">
                    <i class='fa-solid fa-circle-user fa-2xl' style='font-size: 150px'></i>
                </div>
                    
            <?php
                echo "<p class='font-size-l'>My Profile<br><span class='inter-300 font-size-md'><a href='../edit-profile.php' style='text-decoration: none; color: rgba(0, 0, 0, 0.8);'>Customize your profile</a></span></p>";
            }
                
            ?>
            <hr>
            <a href="../../logika/logout.php" class='font-size-md' style='text-decoration: none; color: #C00F0C;'>Logout from this device</a>
        </div>
    </div>
    <div class="inter-400 user-info-container" id="user-request-container">
        <div class="user-info-popup">
            <?php
            if (isset($_GET['id'])){
                $userId = $_GET['id'];
            ?>
            <script>
                const infoContainer = document.getElementById('user-request-container');

                document.addEventListener('DOMContentLoaded', function(){
                    infoContainer.style.display = 'flex';
                });
            </script> 
            <?php
            $query = "SELECT * FROM user WHERE id=".$userId;
            $hasil = $pdo->query($query);
            $row = $hasil->fetch(PDO::FETCH_ASSOC);
            $path = "../../assets/images/user/".$row['foto_profil'];

            echo "<br>";
            echo "<div style='display: flex; align-items: center;'>";
            if (file_exists($path) == true && $row['foto_profil'] != '') {
                echo "<img src='$path' style='height: 90px; width: 90px; object-fit: cover; border-radius: 100px; border-color: rgb(0, 0, 0, 0.3);'>";
            } else {
                echo "<i class='fa-solid fa-circle-user fa-2xl' style='display: flex; align-items: center; height: 90px; width: 90px; font-size: 90px;'></i>";
            }
            echo "<div style='margin-left: 20px;'>";
            echo "<p class='inter-500 font-size-xl'>".$row['username']."<br><span class='inter-500 font-size-md'>".$row['fullname']."</span></p>";
            echo "</div>";
            echo "</div>";
            echo "<hr>";
            echo "<div style='display: flex; justify-content: center;'>";
            echo "<h2 class='inter-500 font-size-xl' style='margin: 0;'>Keterangan Request</h2>";
            echo "</div>";
            echo "<hr>";
            $sql = "SELECT * FROM request_status WHERE id_pengguna=".$userId;
            $hasil = $pdo->query($sql);
            $req_row = $hasil->fetch(PDO::FETCH_ASSOC);
            echo "<span class='inter-600'>ID Pengguna : </span>".$req_row['id_pengguna']."<br>";
            echo "<span class='inter-600'>ID Pengguna : </span>".$req_row['email']."<br>";
            echo "<span class='inter-600'>Request menjadi : </span>".$req_row['status_req']."<br><br>";
            echo "<p class='inter-600' style='margin: 0;'>Alasan: </p>";
            echo $req_row['alasan'];
            echo "<hr>";
            ?>
            <div class="pilihan-request" style="display: flex; justify-content: center;">
                <div style="display: flex; justify-content: space-between; width: 250px;">
                    <?php
                    echo "<a href='../../logika/req_status_logic.php?req=tolak&req_id=".$req_row['id']."' style='text-decoration: none; color: rgb(233, 0, 0);'>Tolak</a>";
                    echo "<a href='list_request.php' style='text-decoration: none; color:rgb(0, 0, 0);'>Pikirkan nanti</a>";
                    echo "<a href='../../logika/req_status_logic.php?req=setuju&action=".$req_row['status_req']."&id=".$userId."&req_id=".$req_row['id']."' style='text-decoration: none; color:rgb(0, 233, 50);'>Setuju</a>";
                    ?>
                </div>
            </div>
            <?php
            } 

            ?>
        </div>
    </div>
    <main style="display: flex; align-items: center; justify-content: center; height: 85vh;">
        <div class="inter-400 list-pengguna-container">
            <div class="inter-300" style="margin: 0; display: flex; justify-content: space-between; align-items: center;">
                <h2 class="inter-500" >Daftar Request</h2>
                <a href="index.php" style="color: #009DFF; text-decoration: none;">Kembali ke Master Page</a>
            </div>
            <hr>
            <?php
            $query = "SELECT * FROM request_status";
            $stmt = $pdo->query($query);
            $path = "../../assets/images/user/";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sql = "SELECT * FROM user WHERE id=".$row['id_pengguna'];
                $new_stmt = $pdo->query($sql);
                $new_row = $new_stmt->fetch(PDO::FETCH_ASSOC);
                echo "<div style='height: 50px; padding: 0 40px; display: flex; align-items: center; justify-content: space-between;'>";
                echo "<div style='display: flex; align-items: center;'>";
                if (file_exists($path.$new_row['foto_profil']) == true && $new_row['foto_profil'] != '') {
                    echo "<img src='$path".$new_row['foto_profil']."' style='height: 50px; width: 50px; object-fit: cover; border-radius: 100px;'>";
                } else {
                    echo "<div style='display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; text-align: center; '>
                    <i class='fa-solid fa-circle-user fa-2xl' style='font-size: 50px;'></i>
                    </div>";
                }

                echo "<h2 class='inter-400 font-size-l' style='margin-left: 20px;'>".$row['email']." ( Requesting status : ".$row['status_req']." )</h2>";
                echo "</div>";
                echo "<div style='display: flex; justify-content: space-between; align-items: center; width: 60px;'>";
                echo "<a href='../../logika/req_status_logic.php?req=tolak&req_id=".$row['id']."'><i class='fa-solid fa-xmark fa-xl' style='color: rgb(255, 0, 0)'></i></a>";
                echo "<a href='list_request.php?&id=".$row['id_pengguna']."'><i class='fa-solid fa-circle-info fa-xl' style='color:rgb(0, 0, 0);'></i></a>";
                echo "</div>";
                echo "</div>";
                echo "<hr>";
                
            }
            ?>
        </div>
    </main>
    <script src="../../assets/javascript/scripts.js"></script>
</body>
</html>