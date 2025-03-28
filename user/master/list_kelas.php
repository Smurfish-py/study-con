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
    <?php 
    if (isset($_GET['id'])) {
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
                document.getElementById("pop-up-kelas").style.display = 'flex';
            })
        </script>
        <?php
    } else {
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
                document.getElementById("pop-up-kelas").style.display = 'none';
            })
        </script>
        <?php
    }
    ?>

    <div class="pop-up-kelas" id="pop-up-kelas">
        <div class="pop-up-kelas-container">
            <?php
            $idKelas = $_GET['id'];

            $stmt = $pdo->prepare("SELECT * FROM kelas WHERE id = :id");
            $stmt->execute([':id'=>$idKelas]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt_guru = $pdo->prepare("SELECT * FROM user WHERE id = :id_guru");
            $stmt_guru->execute([':id_guru'=>$row['id_guru']]);

            $row_guru = $stmt_guru->fetch(PDO::FETCH_ASSOC);

            $stmt_tugas = $pdo->prepare("SELECT * FROM guru_tugas WHERE id_guru = :id");
            $stmt_tugas->execute([':id'=>$row_guru['id']]);
            $row_tugas = $stmt_tugas->rowCount();

            $stmt_anggota = $pdo->prepare("SELECT * FROM anggota_kelas WHERE id_kelas = :id");
            $stmt_anggota->execute([':id'=>$idKelas]);
            $row_anggota = $stmt_anggota->rowCount();
            ?>
            <div class="pop-up-kelas-header" style="background-image: url('../../assets/images/kelas/<?php
            if ($row['gambar_header_kelas'] == '') {
                echo "default.jpg";
            } else {
                echo $row['gambar_header_kelas'];
            }
            ?>');">
            <h1 class="inter-600 font-size-xl" style="position: absolute;"><?php echo $row['nama_kelas']?><br><span class="inter-400 font-size-l"><?php echo $row_guru['email']?></span></h1>
            </div>
            <div class="guru-section">
                <?php 
                if ($row_guru['foto_profil'] == '') {
                    ?>
                    <span style="height: 100px; width: 100px;font-size: 100px;"><i class="fa-solid fa-circle-user"></i></span>
                    <?php
                } else {
                    ?>
                    <img src="../../assets/images/user/<?php echo $row_guru['foto_profil']?>" alt="Foto Profil Guru" style="width: 100px; height: 100px; object-fit: cover; border-radius: 100px;">
                    <?php
                }
                ?>
                <h2 class="inter-600 font-size-l" style="margin-left: 20px;">ID Guru : <span class="inter-400"><?php echo $row_guru['id']?></span><br>Dibuat oleh : <span class="inter-400"><?php echo $row_guru['email']?></span></h2>
            </div>
            <hr style="margin: 20px 30px;">
            <div class="pop-up-kelas-data">
                <h2 class="inter-600 font-size-l">Waktu dibuat : <span class="inter-400"> <?php echo $row['waktu_dibuat']?></span></h2>
                <h2 class="inter-600 font-size-l">Jumlah tugas dan Materi : <span class="inter-400"> <?php echo $row_tugas?></span></h2>
                <h2 class="inter-600 font-size-l">Jumlah anggota : <span class="inter-400"> <?php echo $row_anggota?></span></h2>
                <h2 class="inter-600 font-size-l">Status kelas : <?php
                if ($row['status_kelas'] == 'active') {
                    echo "<span class='inter-400' style='color: green;'>".$row['status_kelas']."</span> ";
                } else {
                    echo "<span class='inter-400' style='color: red;'>".$row['status_kelas']."</span> ";
                }
                ?></h2>
            </div>
            <hr>
            <a class="inter-400" href="list_kelas.php" style="display: inline-block; width: 100%; text-decoration: none; color: rgba(0, 0, 0, 0.7); text-align: center; margin: 10px 0 20px 0">kembali</a>
        </div>
    </div>
    <main style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <div class="inter-400 list-pengguna-container">
            <div class="inter-300" style="margin: 0; display: flex; justify-content: space-between; align-items: center;">
                <h2 class="inter-500" >List Kelas</h2>
                <a href="index.php" style="color: #009DFF; text-decoration: none;">Kembali ke Master Page</a>
            </div>
            <hr>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM kelas ORDER BY nama_kelas ASC");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <a href="list_kelas.php?id=<?php echo $row['id']?>" class="class-list-admin" style="background-image: url('../../assets/images/kelas/<?php
                if ($row['gambar_header_kelas'] != '') {
                    echo $row['gambar_header_kelas'];
                } else {
                    echo "default.jpg";
                }
                
                ?>');">
                    <div class="header-class-admin">
                        <h2 class="inter-600" style="position: absolute;"><?php echo $row['nama_kelas']?><br><span class="inter-400 font-size-l">Id Kelas: <?php echo $row['id']?></span></h2>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </main>
    <script src="../../assets/javascript/scripts.js"></script>
</body>
</html>