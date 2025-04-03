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
    <main style="height: 99.5vh; display: flex; justify-content: center;">
        <div class="tugas-nilai-container">
            <?php
            $id_tugas = $_GET['id_tugas'];
            $id_kelas = $_GET['id_kelas'];
            ?>
            <div class="tugas-penilaian-section" id="tugas-penilaian-section">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM guru_tugas WHERE id = :id AND id_kelas = :id_kelas");
                $stmt->execute(['id'=>$id_tugas, ':id_kelas'=>$id_kelas]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                ?>
                <h2 class="inter-600" style="margin: 0;"><?php echo $row['judul']?><br><span class="inter-400 font-size-l">Halaman penilaian dan komentar tugas</span></h2>
                <hr style="margin: 0;">
                <div class="tugas-penilaian-section-body">
                    <div class="tugas-penilaian-section-list-pengirim-container">
                        <div class="tugas-penilaian-list-section">
                            <?php
                            $list_pengirim = $pdo->prepare("SELECT * FROM user JOIN nilai_murid ON nilai_murid.id_murid = user.id WHERE nilai_murid.status = :status");
                            $list_pengirim->execute([':status'=>'diserahkan']);
                            echo "<hr style='margin-top: 0;'>";
                            while ($pengirim_row = $list_pengirim->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <a href="" class="tugas-penilaian-list-user">
                                    <div class="tugas-penilaian-list-pengirim-inline">
                                    <?php
                                    if ($pengirim_row['foto_profil'] == '') {
                                        echo "<i class='fa-solid fa-circle-user' style='font-size: 40px;'></i>";
                                    } else {
                                        echo "<img src='../../assets/images/user/".$pengirim_row['foto_profil']."' style='height: 40px; width: 40px; object-fit: cover; border-radius: 100px; border: 1px solid rgba(0, 0, 0, 0.3);'>";
                                    }
                                    ?>
                                    <h3 class="inter-600" style="line-height: 1; margin-left: 10px;"><?php echo $pengirim_row['username']?><br><span class="inter-400 font-size-md">NIS: <?php echo $pengirim_row['NIS']?><br>Waktu pengumpulan: <?php echo $pengirim_row['waktu']?></span></h3>
                                    </div>
                                </a>
                                <br>
                                <hr>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="tugas-penilaian-komentar-button-section">
                            <a href="" class="tugas-nilai-comment-button">
                                <div class="tugas-nilai-comment-button-label">
                                    <h3 class="inter-600">Buka komentar<span style="margin-left: 10px;"><i class="fa-solid fa-comments"></i></span></h3>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="tugas-penilaian-section-detail-tugas-container">
                        <?php
                        if (isset($_GET['id_user'])) {
                            $id_user = $_GET['id_user'];
                            ?>
                            <div class="tugas-penilaian-detail-section">
                                <?php
                                $detail = $pdo->prepare("SELECT * FROM user JOIN nilai_murid ON nilai_murid.id_murid = user.id JOIN murid_tugas ON murid_tugas.id_file = nilai_murid.id_file WHERE user.id = :id");
                                $detail->execute([':id'=>$id_user]);
                                $detail_row = $detail->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="tugas-penilaian-user-profile">
                                    <?php
                                    if ($detail_row['foto_profil'] == '') {
                                        echo "<i class='fa-solid fa-circle-user' style='font-size: 50px;'></i>";
                                    } else {
                                        ?>
                                        <img src="../../assets/images/user/<?php echo $detail_row['foto_profil']?>" alt="user-profile" style="height: 50px; width: 50px; object-fit:cover; border-radius: 100px; border: 1px solid rgba(0, 0, 0, 0.3);">
                                        <?php
                                    }
                                    ?>
                                    <h3 class="inter-600" style='margin-left: 10px;'><?php echo $detail_row['username']?><br><span class="inter-400 font-size-l">NIS: <?php echo $detail_row['NIS']?>, Waktu pengiriman: <?php echo $detail_row['waktu']?></span></h3>
                                </div>
                                <div class="tugas-penilaian-lampiran">
                                    <h3 class="inter-500">Lampiran tugas : </h3>
                                    <?php
                                    for ($i = 0; $i < $detail->rowCount(); $i++) {
                                        $clean_name = explode("_", $detail_row['nama_file']);
                                        ?>
                                        <a class="inter-400" href="../../assets/documents/user/<?php echo $detail_row['nama_file']?>" target="_blank">-> <?php echo $clean_name[2]?></a><span class="inter-400"> (<a href="../../assets/documents/user/<?php echo $detail_row['nama_file']?>" download="<?php echo $clean_name[2]?>">Download</a>)</span>
                                        <br>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="tugas-penilaian-nilai-section">
                                <form action="" method="post">
                                    <div class="tugas-penilaian-nilai-section-header">
                                        <h3 class="inter-500" style="margin: 0;">Berikan komentar atau masukkan pribadi</h3>
                                        <div class="nilai">
                                            <label for="nilai-murid" class="inter-600">Beri nilai : </label>
                                            <input class="inter-500" type="number" style="width: 50px; height: 20px;" name="nilai-murid" id="nilai-murid">
                                        </div>
                                    </div>
                                    <div class="tugas-penilaian-nilai-section-body">
                                        <textarea class="inter-400" name="masukan-pribadi" id="masukan-pribadi" style="min-height: 116px; max-height: 116px; min-width: 99.3%; max-width: 99.3%; margin-bottom: 7px;" placeholder="Masukkan komentar pribadi di sini..."></textarea>
                                    </div>
                                    <div class="tugas-penilaian-nilai-submit">
                                        <button class="tugas-penilaian-nilai-submit-button" type="submit" style="height: 40px; width: 100%;">
                                            <h2 class="inter-500" style="margin: 0;">Submit Penilaian <span style="margin-left: 10px;"><i class="fa-solid fa-check"></i></span></h2>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <?php
                        }
                        ?>
                    </div> 
                </div>  
            </div>
            <div class="tugas-komentar-section" id="tugas-komentar-section" style="display: none;">

            </div>
        </div>
    </main>
    <script src="../../assets/javascript/scripts.js"></script>
</body>
</html>