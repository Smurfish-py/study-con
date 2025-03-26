<?php
session_start();

include "../../logika/koneksi.php";

if (!isset($_SESSION['id'])) {
    session_destroy();
    header("Location: ../../login.php");
    exit();
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
                echo "<p class='font-size-l'>My Profile<br><span class='inter-300 font-size-md'><a href='edit-profile.php' style='text-decoration: none; color: rgba(0, 0, 0, 0.8);'>Customize your profile</a></span></p>";
            } else {
                ?>
                <div style="display: flex; align-items: center; justify-content: center; width: 220px; height: 150px; text-align: center; ">
                    <i class='fa-solid fa-circle-user fa-2xl' style='font-size: 150px'></i>
                </div>
                    
            <?php
                echo "<p class='font-size-l'>My Profile<br><span class='inter-300 font-size-md'><a href='edit-profile.php' style='text-decoration: none; color: rgba(0, 0, 0, 0.8);'>Customize your profile</a></span></p>";
            }
                
            ?>
            <hr>
            <a href="../../logika/logout.php" class='font-size-md' style='text-decoration: none; color: #C00F0C;'>Logout from this device</a>
        </div>
    </div>
    <main style="display: flex; align-items: center; justify-content: center; padding-top: 105px; flex: 1;">
        <div class="class-container" style="display: flex; flex-direction: column;">
            <?php
            if (isset($_GET['id'])) {
                $idKelas = $_GET['id'];
                $stmt = $pdo->prepare("SELECT * FROM kelas WHERE id=:id");
                $stmt->execute(['id'=>$idKelas]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $new_stmt = $pdo->prepare("SELECT * FROM user WHERE id=:id");
                $new_stmt->execute(['id'=>$row['id_guru']]);
                $new_row = $new_stmt->fetch(PDO::FETCH_ASSOC);

                if ($row['gambar_header_kelas'] != '') {
                    $gambarHeader = $row['gambar_header_kelas'];
                } else {
                    $gambarHeader = "default.jpg";
                }
                echo "<div class='class-header' style='display: flex; align-items: center; justify-content: space-between; background-image: url(\"../../assets/images/kelas/".$gambarHeader."\"); height: 160px; width: 100%; border-radius: 18px 18px 0 0; position: relative; background-repeat: no-repeat; background-size: cover; background-position: center;'>";
                echo "<div style='display: flex;align-items: center; height: 100%; flex: 1;'>";

                if ($new_row['fullname'] == '') {
                    $teacher_fullname = '';
                } else {
                    $teacher_fullname = "(".$row['fullname'].")";
                }
                echo "<h1 class='inter-600' style='position: absolute; margin-left: 50px; color: white;'>".$row['nama_kelas']."<br><span class='inter-400' style='font-size: 20px; margin: 0;'>".$new_row['email']." ".$teacher_fullname."</span></h1>";
                echo "</div>";
                echo "<div style='height: 100%; flex: 1; display: flex; align-items: center; justify-content: right;'>";
                echo "<a class='inter-400' href='index.php' style='color: white; position: absolute; text-decoration: none; margin-right: 50px;'>Kembali ke dashboard</a>";
                echo "</div>";
                echo "</div>";
            }

            
            ?>
            <div class="class-body" style="display: flex; flex: 1; width: 100%; height: 100%; justify-content: center;">
                <div class="pilihan-container" style="display: flex; gap: 15px; border: none;">
                    <div class="pilihan-container" style="margin: 0; flex: 0.7;">
                        <div class="tugas-body" id="tugas-dan-materi">
                            <h2 class="inter-500" style="margin: 0;">Anggota Kelas</h2>
                            <hr style="border: 1px solid;">
                            <hr>
                            <?php
                            try {
                                $stmt = $pdo->prepare("SELECT * FROM user JOIN anggota_kelas ON user.id = anggota_kelas.id_murid WHERE anggota_kelas.id_kelas = :id ORDER BY username ASC");
                                $stmt->execute([':id'=>$idKelas]);

                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<div class='inter-400 anggota-kelas' style='height: 40px;'>";
                                    if ($row['foto_profil'] == '') {
                                        echo "<span style='font-size: 30px;'><i class='fa-solid fa-circle-user'></i></span>";
                                    } else {
                                        echo "<img src='../../assets/images/user/".$row['foto_profil']."' alt='Foto Profil User' style='height: 30px; width: 30px; object-fit: cover; border-radius: 100px;'>";;
                                    }
                                    echo "<h2 class='inter-400 font-size-l'>".$row['username']."<br><span class='font-size-md'>".$row['email']."</span><h2>";
                                    echo "</div>";
                                    echo "<hr style='margin: 10px 0;'>";
                                }  
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                            
                            ?>
                        </div>
                    </div>
                    <div class="pilihan-container" style="margin: 0; flex: 1.3;">
                        <div class="tugas-body" id="tugas-dan-materi">
                            <h2 class="inter-500" style="margin: 0;">Tugas dan Materi</h2>
                            <hr>
                            <?php
                            $stmt = $pdo->prepare("SELECT * FROM guru_tugas WHERE id_kelas=:id_kelas");
                            $stmt->execute(['id_kelas'=>$idKelas]);
                            
                            if ($stmt->rowCount()>0) {
                                echo "<hr style=''>";
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <a href="" class="inter-400 tugas">
                                        <div class="link-tugas">
                                    <?php
                                    if ($row['tipe'] == 'tugas') {
                                        echo "<i class='fa-solid fa-flask fa-2xl'></i>";
                                    } else if  ($row['tipe'] == 'materi') {
                                        echo "<i class='fa-solid fa-bookmark fa-2xl'></i>";
                                    }
                                    ?>
                                    <h2 class="font-size-l"><?php echo $row['judul']?><br><span class="inter-300">Diunggah pada <?php echo $row['waktu']?></span></h2>
	                                    </div>
                                    </a>
                                    <hr>
                                    <?php
                                }   
                            } else {
                                echo "<p class='inter-400'>Belum ada tugas ataupun materi :)<p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/javascript/scripts.js"></script>
</body>
</html>