<?php
session_start();

include "../../logika/koneksi.php";
include "../../logika/custom_function.php";

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
    <main style="height: 99vh; border: solid; display: flex; align-items: center; justify-content: center;">
        <div class="kelola-kelas-container" style="padding: 0; border-radius: 13px;">
            <?php
            $id = $_GET['id'];
            $stmt = $pdo->prepare("SELECT * FROM kelas WHERE id = :id");
            $stmt->execute([':id'=>$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="kelola-kelas-header kelola-kelas-header-edit" style="background-image: url('../../assets/images/kelas/<?php
            if ($row['gambar_header_kelas'] == '') {
                echo "default.jpg";
            } else {
                echo $row['gambar_header_kelas'];
            }?>');">
                <div class="kelola-kelas-header-title">
                    <div style="flex: 1; height: 100%; display: flex; align-items: center; margin: 0 20px;">
                        <h2 class="inter-500" style="max-width: 300px; margin: 0; color: white; position: absolute;">File header saat ini : <br> <span class="inter-400 font-size-l"><?php
                        $nama_file = explode("_", $row['gambar_header_kelas']);

                        if ($row['gambar_header_kelas'] == '') {
                            echo "Kelas ini menggunakan header bawaan";
                        } else {
                            echo $nama_file[1];
                        }
                        
                        ?></span>
                        </h2>
                    </div>
                    <div style="flex: 1; display: flex; align-items: center; justify-content: right; margin: 0 20px; height: 100%;">
                        <a href="kelas.php?id=<?php echo $_GET['id']?>" class="inter-400" style="text-decoration: none; color: white; position: absolute;">Kembali ke halaman kelas</a>
                    </div>
                </div>
            </div>
            <div class="kelola-kelas-body" style="flex-direction: row;">
                <div class="kelola-kelas-body-left">
                    <h2 class="inter-500" style="margin: 0;">Detail Kelas</h2>
                    <hr>
                    <form action="../../logika/kelola_kelas_logic.php?id=<?php echo $id ?>" method="post" class="kelola-kelas-input-container" enctype="multipart/form-data" >
                        <div class="kelola-kelas-input-text">
                            <label for="nama-kelas" class="inter-600 font-size-l" >Nama Kelas</label><br>
                            <input class="inter-400" type="text" name="nama-kelas" id="nama-kelas" style="height: 25px; width: 405px; border: 1px solid; border-radius: 5px; padding-left: 10px;" placeholder="Masukkan nama baru untuk kelas anda..." value="<?php echo $row['nama_kelas']?>">
                        </div>

                        <div class="kelola-kelas-input-text">
                            <label for="password-kelas" class="inter-600 font-size-l">Password Kelas</label><br>
                            <input class="inter-400" type="text" name="password-kelas" id="password-kelas" style="height: 25px; width: 405px; border: 1px solid; border-radius: 5px; padding-left: 10px;" placeholder="Masukkan password baru untuk kelas anda..." value="<?php echo $row['password']?>">
                        </div>
                        <div class="kelola-kelas-input-text">
                            <label class="inter-600 font-size-l" for="deskripsi-kelas">Deskripsi Kelas</label><br>
                            <textarea class="inter-400" name="deskripsi-kelas" id="deskripsi-kelas" style="min-width: 397px; max-width: 390px; min-height: 50px; max-height: 45px; overflow-y: auto; padding: 5px 10px; border-radius: 5px;" placeholder="Masukkan deskripsi baru untuk kelas anda..."><?php echo $row['deskripsi_kelas']?></textarea>
                        </div>
                            <div class="kelola-kelas-input-text">
                            <label for="header-kelas"  class="inter-400 font-size-l header-kelas-picture">Upload gambar header baru <span style="margin-left: 20px;"><i class="fa-solid fa-arrow-up-from-bracket fa-xl"></i></span></label>
                            <input type="file" name="header-kelas" id="header-kelas" accept=".jpg, .png, image/jpeg, image/png" >
                        </div>
                        <input type="submit" value="Konfirmasi Perubahan" class="inter-500 font-size-l kelola-kelas-submit">
                    </form>
                </div>
                <div class="kelola-kelas-body-right">
                    <h2 class="inter-500" style="margin: 0;">Anggota Kelas <span class="inter-400 font-size-l" style="color: red;"> (Kick Anggota)</span></h2>
                    <hr>
                    <div class="kelola-kelas-list-pengguna">
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM user JOIN anggota_kelas ON anggota_kelas.id_murid = user.id WHERE anggota_kelas.id_kelas = :id_kelas");
                        $stmt->execute([':id_kelas'=>$_GET['id']]);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="kelola-kelas-list-anggota">
                                <div style="display: flex; align-items: center;">
                                    <?php
                                    if ($row['foto_profil'] == '') {
                                        echo "<i class='fa-solid fa-circle-user' style='font-size: 40px; margin-left: 10px;'></i>";
                                    } else {
                                        ?>
                                        <img src="../../assets/images/user/<?php echo $row['foto_profil']?>" alt="foto_profil user" style="height: 40px; width: 40px; object-fit: cover; border: 1px solid rgba(0, 0, 0, 0.3); border-radius: 100px; margin-left: 10px;"><?php
                                    }
                                    ?>
                                    <h4 class="inter-600" style="margin-left: 10px;"><?php echo $row['username']?><br><span class="inter-400"><?php echo $row['email']?></span></h4>
                                </div>
                                <a href="../../logika/kick_anggota_kelas_logic.php?id=<?php echo $row['id_murid']?>&id_kelas=<?php echo $_GET['id']?>" style="color:rgb(221, 18, 18); margin-right: 10px;"><i class="fa-solid fa-user-slash fa-xl" onclick="return confirm('Apakah anda yakin untuk kick <?php echo $row['username'] ?>?')"></i></a>
                            </div>
                            <hr style="margin: 5px 0;">
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../assets/javascript/scripts.js"></script>
    </body>
    </html>