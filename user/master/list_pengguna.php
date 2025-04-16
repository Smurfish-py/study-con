<?php
session_start();

include "../../logika/koneksi.php";
include "../../logika/custom_function.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status'] != 'master' || $_SESSION['status-akun'] == 'banned') {
    session_destroy();
    header("Location: ../../");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status_akun'];
    $sql = "UPDATE user SET status='$status' WHERE id=".$_GET['id'];
    $stmt = $pdo->query($sql);

    $new_sql = "SELECT * FROM user WHERE id=".$_GET['id'];
    $stmt = $pdo->query($new_sql);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    ubahStatus_log($_SESSION['email'], $row['email'], $status);
    header("Location: list_pengguna.php");
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
    <div class="inter-400 user-card" id="user-card" style="display: none; justify-content: center; align-items">
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
    <div class="inter-400 user-info-container" id="user-info-container">
        <div class="user-info-popup">
            <?php
            if (isset($_GET['id'])){
                $userId = $_GET['id'];
            ?>
            <script>
                const infoContainer = document.getElementById('user-info-container');

                document.addEventListener('DOMContentLoaded', function(){
                    infoContainer.style.display = 'flex';
                });
            </script>    
            <?php
            $query = "SELECT * FROM user WHERE id=$userId";
            $hasil = $pdo->query($query);
            $row = $hasil->fetch(PDO::FETCH_ASSOC);
            $path = "../../assets/images/user/".$row['foto_profil'];
            echo "<div style='display: flex; align-items: center;'>";

            if(file_exists($path) == true && $row['foto_profil'] != '') {
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
            echo "<h2 class='inter-500 font-size-xl' style='margin: 0;'>Data Pengguna</h2>";
            echo "</div>";
            echo "<hr>";
            echo "<span class='inter-600'>ID Pengguna : </span>".$row['id']."<br>";
            echo "<span class='inter-600'>E-mail : </span>".$row['email']."<br>";
            echo "<span class='inter-600'>Nama Lengkap : </span>".$row['fullname']."<br>";
            echo "<span class='inter-600'>Tanggal Lahir : </span>".$row['tgl_lahir']."<br>";
            if ($row['status'] == 'default') {
                echo "<span class='inter-600'>Sekolah : </span>".$row['sekolah']."<br>";
                echo "<span class='inter-600'>NIS : </span>".$row['NIS']."<br>";
                echo "<span class='inter-600'>Kelas : </span>".$row['kelas']."<br>";
                echo "<hr>";
            } else if ($row['status'] == 'teacher') {
                echo "<span class='inter-600'>Tempat Mengajar : </span>".$row['guru_tmpt_mengajar']."<br>";
                echo "<span class='inter-600'>Mengajar Mapel : </span>".$row['guru_mapel']."<br>";
                echo "<hr>";
            } else {
                echo "<hr>";
            }
            
            echo "<div style='display: flex; justify-content: center;'>";
            echo "<h2 class='inter-500 font-size-xl' style='margin: 0;'>Informasi Akun</h2>";
            echo "</div>";
            echo "<hr>";
            if ($row['status_akun'] == 'active') {
                echo "<span class='inter-600'>Status Akun : </span><span style='color: green;'>".$row['status_akun']."</span><br>";
            } else {
                echo "<span class='inter-600'>Status Akun : </span><span style='color: #E25555;'>".$row['status_akun']."</span><br>";
            }
            if ($_SESSION['id'] == $row['id']) {
                echo "<span class='inter-600'>Status Pengguna : </span>".$row['status']."<br>";
            } else {
                echo "<form action='list_pengguna.php?id=".$row['id']."' method='post'>";
                echo "<label for 'status_akun' class='inter-600'>Status Pengguna : </label>";
                echo "<select name='status_akun' class='inter-400'>";
                    if ($row['status'] == 'default') {
                        echo "<option value='default' selected>Default</option>";
                        echo "<option value='teacher'>Teacher</option>";
                        echo "<option value='master'>Master</option>";
                    } else if ($row['status'] == 'teacher') {
                        echo "<option value='default'>Default</option>";
                        echo "<option value='teacher' selected>Teacher</option>";
                        echo "<option value='master'>Master</option>";
                    } else {
                        echo "<option value='default'>Default</option>";
                        echo "<option value='teacher'>Teacher</option>";
                        echo "<option value='master' selected>Master</option>";
                    }
                    echo "</select><input type='submit' value='Ubah Status'><br>";
                    echo "</form>";
                }
            }
            
            ?>
            <hr>
            <br>
            <div style="display: flex; justify-content: center;">
                <a href="list_pengguna.php" style="text-decoration: none; color: rgba(0, 0, 0, 0.5);">Tutup</a>
            </div>
        </div>
    </div>
    <main style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <div class="inter-400 list-pengguna-container">
            <div class="inter-300" style="margin: 0; display: flex; justify-content: space-between; align-items: center;">
                <h2 class="inter-500" >List Pengguna</h2>
                <a href="index.php" style="color: #009DFF; text-decoration: none;">Kembali ke Master Page</a>
            </div>
            <hr>
            <?php
            $query = "SELECT * FROM user;";
            $stmt = $pdo->query($query);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $path = "../../assets/images/user/";
                echo "<div style='height: 50px; padding: 0 40px; display: flex; align-items: center; justify-content: space-between;'>";
                echo "<div style='display: flex; align-items: center;'>";
                if(file_exists($path.$row['foto_profil']) == true && $row['foto_profil'] != ''){
                    echo "<img src='$path".$row['foto_profil']."' style='height: 50px; width: 50px; object-fit: cover; border-radius: 100px;'>";
                } else {
                    echo "<div style='display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; text-align: center; '>
                    <i class='fa-solid fa-circle-user fa-2xl' style='font-size: 50px;'></i>
                    </div>";
                }

                if ($row['status'] == 'master') {
                    echo "<h2 class='inter-400 font-size-l' style='margin-left: 20px;'>".$row['username']." <span style='color: red; font-style: italic;'>(".$row['status'].")</span>"."</h2>";
                } else {
                    echo "<h2 class='inter-400 font-size-l' style='margin-left: 20px;'>".$row['username']."</h2>";
                }
                echo "</div>";
                echo "<a href='list_pengguna.php?id=".$row['id']."'><i class='fa-solid fa-address-card fa-xl' style='color: #009DFF;'></i></a>";
                echo "</div>";
                echo "<hr>";
            }
            ?>
        </div>
    </main>
    <script src="../../assets/javascript/scripts.js"></script>
</body>
</html>