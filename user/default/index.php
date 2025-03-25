<?php
session_start();

include "../../logika/koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status-akun'] == 'banned') {
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
    <main class="inter-400" style="display: flex; align-items: center; justify-content: center; padding-top: 90px;">
        <div class="main-content" style="width: 100%;">
            <div style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                <h2>Joined Class</h2>
                <form action="../../logika/join_kelas_logic.php?action=join" method="post">
                    <span>
                        <label class="inter-600 font-size-l" for="join-kelas">Join ke kelas</label> <br>
                        <input class="inter-400 input-kelas font-size-l" type="number" style="width: 300px; height: 35px; border-right: 1px solid rgba(0, 0, 0, 0.4);" placeholder="Masukan kode kelas, contoh: 12345" id="join-kelas" name="join-kelas">
                    </span>
                    <button type="submit" style=" color: rgba(0, 0, 0, 0.6); height: 40px; width: 40px; background-color: #45474B; border-radius: 7px; color: white;"><i class="fa-solid fa-arrow-right-to-bracket fa-xl"></i></button>
                </form>
            </div>
            <hr>
            <div class="class-list">
            <?php
            try {
                $stmt = $pdo->prepare("SELECT * FROM kelas JOIN anggota_kelas ON kelas.id = anggota_kelas.id_kelas WHERE anggota_kelas.id_murid = :id");
                $stmt->execute(['id'=>$_SESSION['id']]);
                if ($stmt->rowCount()>0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <a class="class-list-header" style="position: relative; display: inline-block; background-color: white; height: 350px; width: 300px; border: 1px solid rgba(0, 0, 0, 0.4); border-radius: 13px; background-image: url(../../assets/images/kelas/<?php 
                        if ($row['gambar_header_kelas'] == '') {
                            echo "default.jpg";
                        } else {
                            echo $row['gambar_header_kelas'];
                        }
    
                        ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div style="height: 95%; width: 85%; display: flex; justify-content: end; margin: 0 15px; overflow-y: auto; position: absolute; flex-direction: column;">
                                <h2 class="inter-600 font-size-xl" style="color: white;"><?php echo $row['nama_kelas']?></h2>
                                <p style="color: white;"><?php echo $row['deskripsi_kelas']?></p>
                            </div>
                            
                        </a>
                        <?php
                    }
                } else {
                    echo "Anda belum mengikuti kelas manapun :( <br> Minta pengajar anda untuk membagikan id kelas beserta passwordnya (Jika ada), kemudian bergabung ke kelas untuk terhubung dimana saja dan kapan saja :D";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            } finally {
                $pdo = null;
            }
            
            ?>
            </div>
            <hr>

        </div>
    </main>
    <script src="../../assets/javascript/scripts.js"></script>
</body>
</html>