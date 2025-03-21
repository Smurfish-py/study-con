<?php
session_start();

include "../../logika/koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status'] != 'teacher' || $_SESSION['status-akun'] == 'banned') {
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
    <main class="inter-400" style="display: flex; align-items: center; justify-content: center;">
        <!--Main Content (Say no to chatGPT)-->
        <div class="main-content">
            <div class="options-section">
                <div class="options" style="margin-right: 10px;">
                    <div class="sub-options inter-600">
                        <a href="buat_kelas.php"><i class="fa-solid fa-chalkboard-user fa-xl"></i> <span style="margin-left: 20px;">Buat Kelas</span></a>
                    </div>
                    <div class="sub-options inter-600">
                        <a href=""><i class="fa-solid fa-gear fa-xl"></i> <span style="margin-left: 28px;">Kelola Kelas</span></a>
                    </div>
                </div>
                <div class="options" style="width: 390px; margin-top: 10px;">
                    <div class="pengumuman">
                        <div>
                            <h3>Notifikasi</h3>
                        </div>
                        <hr>
                        <div class="isi-pengumuman">
                            <?php
                            
                            ?>
                        </div>
                    </div>
                </div>
                <div class="options">
                    <div class="pengumuman" style="width: 390px; margin-top: 10px;">
                        <div>
                            <h3>Pengumuman</h3>
                        </div>
                        <hr>
                        <div class="isi-pengumuman">
                            <?php
                            $query = "SELECT * FROM pengumuman ORDER BY id DESC";
                            $hasil = $pdo->query($query);
                            if ($hasil->rowCount() > 0) {
                                while ($row = $hasil->fetch(PDO::FETCH_ASSOC)){
                                    echo "<p style='margin: 0;'><span style='color: #009DFF;'>[".$row['penulis'].",".$row['waktu']."]</span> ".$row['isi']."</p>";
                                }    
                            } else {
                                echo "Belum ada pengumuman :D";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="log-section">
                <div class="log-side" style="width: 1258px; border-radius: 18px;">
                    <h2>Kelas Anda</h2>
                    <hr>
                    <div style="overflow-y: auto; height: 190px; margin: 10px 30px 0 50px;">
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../assets/javascript/scripts.js"></script>
</body>
</html>