<?php
session_start();

include "../../logika/koneksi.php";
include "../../logika/custom_function.php";

if (!isset($_SESSION['id'])) {
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_pengguna = $_SESSION['id'];
        $id_kelas = $_GET['id_kelas'];
        $id_tugas = $_GET['id'];
        $isi_komentar = $_POST['komentar'];

        if ($isi_komentar == '') {
            ?>
            <script>
                alert("Input tidak boleh kosong!");
            </script>
            <?php
        } else {
            $komentar_stmt = $pdo->prepare("INSERT INTO komentar_tugas (id_user, id_kelas, id_tugas, isi) VALUES (:id_user, :id_kelas, :id_tugas, :isi_komentar);");
            $komentar_stmt->execute([':id_user'=>$id_pengguna, 'id_kelas'=>$id_kelas, ':id_tugas'=>$id_tugas, ':isi_komentar'=>$isi_komentar]);
            komentarTugas_logGuru($_SESSION['username'], $id_tugas, $id_kelas);
        }
    }
    ?>
    <main style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <div class="tugas-center">
            <div class="tugas-container" style="flex: 0.65;">
                <div class="tugas-header-komentar">
                    <h2 class="inter-600" style="margin: 0;">Komentar</h2>
                    <a href="kelas.php?id=<?php echo $_GET['id_kelas']?>" class="inter-400" style="text-decoration: none; color: black;">Kembali</a>
                </div>
                <hr style="border: 1px solid rgba(0, 0, 0, 1);">
                <div class="tugas-isi-komentar" id="scroll-area">
                    <?php
                    $komentar_stmt = $pdo->prepare("SELECT * FROM komentar_tugas INNER JOIN user ON user.id = komentar_tugas.id_user WHERE id_kelas = :id_kelas AND id_tugas = :id_tugas");
                    $komentar_stmt->execute([':id_kelas'=>$_GET['id_kelas'], 'id_tugas'=>$_GET['id']]);

                    if ($komentar_stmt->rowCount()>0) {
                        while ($row = $komentar_stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="tugas-isi-komentar-user">
                            <?php
                            if ($row['foto_profil'] == '') {
                                echo "<i class='fa-solid fa-circle-user' style='font-size: 40px;'></i>";
                            } else {
                                echo "<img src='../../assets/images/user/".$row['foto_profil']."' style='height: 40px; width: 40px; object-fit: cover; border-radius: 100px; border: 1px solid rgba(0, 0, 0, 0.5);'>";
                            }
                            ?>
                                <h2 class="inter-600 font-size-l" style="padding-left: 20px;"><?php 
                                if ($row['status'] == 'teacher') {
                                    echo $row['username']."<span class='inter-500 font-size-md' style='color: red;'> (Guru)</span>";
                                } else {
                                    echo $row['username'];
                                }
                                ?><br><span class="inter-400 font-size-md"><?php echo $row['isi'];?></span></h2>
                            </div>
                            <hr>
                            <?php
                        }
                    } else {
                        echo "<p class='inter-400' style='margin: 20px 50px; color: rgba(0, 0, 0, 0.5);'>Jadilah yang pertama berkomentar!</p>";
                    }
                    
                    ?>
                </div>
                <br>
                <form action="tugas.php?id_kelas=<?php echo $_GET['id_kelas']?>&id=<?php echo $_GET['id']?>" method="post" class="inter-400" style="display: flex; gap: 10px;">
                    <input class="tugas-form-komentar-input" type="text" placeholder="Tulis komentarmu disini..." style="flex: 1.85;" name="komentar">
                    <button type="submit" style="background-color: black; border: none; flex: 0.15; height: 40px; width: 40px; color: white; border-radius: 10px;"><i class="fa-regular fa-paper-plane" style="font-size: 20px;"></i></button>
                </form>
            </div>
            <div class="tugas-container" style="flex: 1.35;">
                <div class="tugas-isi">
                    <?php
                    
                    if (isset($_GET['id'])) {
                        $idTugas = $_GET['id'];
                        
                        $nilai_stmt = $pdo->prepare("SELECT * FROM nilai_murid WHERE id_murid = :id AND id_kelas = :id_kelas AND id_tugas = :id_tugas");
                        $nilai_stmt->execute([':id'=>$_SESSION['id'], 'id_kelas'=> $_GET['id_kelas'], ':id_tugas'=>$idTugas]);
                        $nilai_row = $nilai_stmt->fetch(PDO::FETCH_ASSOC);


                        $stmt = $pdo->prepare("SELECT * FROM guru_tugas WHERE id = :id");
                        $stmt->execute([':id'=>$idTugas]);
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);


                        echo "<h2 class='inter-600' style='margin: 0;'>".$row['judul']."<br><span class='inter-400 font-size-l'>Dibuat : ".$row['waktu']."</span></h2>";
                    }
                    ?>
                    <hr>
                    <div class="tugas-isi-deskripsi">
                        <?php 
                        if ($row['tipe'] == 'materi') {

                        } else if ($row['tipe'] == 'tugas') {
                            if ($nilai_row) {
                                if ($nilai_row['status'] == '') {
                                    echo "<p class='inter-400'><b>Status :</b> <span style='color: red;'>Belum dikerjakan</span></p>";
                                } else if ($nilai_row['status'] == 'diserahkan') {
                                    echo "<p class='inter-400'><b>Status :</b> <span style='color: orange;'>Menunggu penilaian</span></p>";
                                } else if ($nilai_row['status'] == 'dinilai') {
                                    echo "<p class='inter-600'><b>Nilai anda :</b> <span style='color: Green;'>".$nilai_row['nilai']."/100</span></p>";
                                    echo "<hr>";
                                }
                            } else {
                                echo "<p class='inter-400'><b>Status :</b> <span style='color: red;'>Belum dikerjakan</span></p>";
                        }
                        }
                        ?>
                        <p class="inter-400"><?php echo $row['deskripsi']?></p>
                        <br>
                        <h2 class="inter-700 font-size-l">Daftar lampiran :</h2>
                        <div class="tugas-isi-lampiran">
                            <?php
                            $new_stmt = $pdo->prepare("SELECT * FROM file_tugas_guru WHERE id_file = :id");
                            $new_stmt->execute([':id'=>$row['id_file']]);

                            while ($new_row = $new_stmt->fetch(PDO::FETCH_ASSOC)) {
                                $str = $new_row['nama_file'];
                                $parts = explode("_", $str);
                                $nama_file_baru = $parts[2];

                                echo "<a href='../../assets/documents/kelas/".$new_row['nama_file']."' class='inter-500 font-size-l' target='_blank'>-> $nama_file_baru</a> (<a href='../../assets/documents/kelas/".$new_row['nama_file']."' download='$nama_file_baru' class='inter-500 font-size-l'>Download</a>)<br>";
                            }
                            ?>
                        </div>
                        <?php 
                        if ($nilai_row) {
                            if ($nilai_row['status'] == 'diserahkan' || $nilai_row['status'] == 'dinilai') {
                                ?>
                                <br>
                                <h2 class="inter-700 font-size-l">Lampiran anda : </h2>
                                <?php
                                $stmt1 = $pdo->prepare("SELECT * FROM nilai_murid JOIN murid_tugas ON murid_tugas.id_file = nilai_murid.id_file WHERE id_murid = :id AND nilai_murid.id_tugas =".$_GET['id']);
                                $stmt1->execute([':id'=>$_SESSION['id']]);
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    $parts = explode("_", $row1['nama_file']);
                                    echo "<a href='../../assets/documents/user/".$row1['nama_file']."' class='inter-400'>-> ".$parts[2]."</a><br>";
                                }
                            }
                        } else {
                            
                        }
                        ?>
                    </div>
                </div>
                <?php
                if ($row['tipe'] == 'materi') {
                    
                } else if ($row['tipe'] == 'tugas') {
                    ?>
                    <div class="tugas-isi-action">
                    <?php
                    
                    if ($nilai_stmt->rowCount() == '0') {
                        ?>
                        <hr>
                        <form action="../../logika/kirim_tugas.php?id_kelas=<?php echo $_GET['id_kelas']?>&id_tugas=<?php echo $_GET['id']?>" method="post" enctype="multipart/form-data">
                            <div class="tugas-isi-kirim-file">
                                <label class="tugas-isi-upload-file inter-700 font-size-l" for="file-tugas" style="flex: 1;"><span style="padding-right: 20px;"><i class="fa-solid fa-arrow-up-from-bracket fa-xl"></i></span>Upload File</label>
                                <input type="file" name="file-tugas[]" id="file-tugas" required multiple>
                                <button class="inter-700 font-size-l tugas-isi-upload-file-button" type="submit"><span style="padding-right: 20px;"><i class="fa-regular fa-paper-plane fa-xl"></i></span>Kirim Tugas</button>
                            </div>
                        </form>
                        <?php
                    } else if ($nilai_row['status'] == 'diserahkan') {
                        ?>
                        <hr>
                        <form action="../../logika/kirim_tugas.php?action=batal&id_tugas=<?php echo $idTugas?>&id_kelas=<?php echo $_GET['id_kelas']?>" method="post" onsubmit="return confirm('Apakah anda yakin untuk membatalkan? \nPembatalan berarti anda harus mengupload ulang tugas anda.')" style="width: 100%; display: flex; justify-content: center; margin-top: 10px;">
                            <input type="hidden" name="status" value="belum diserahkan">
                            <button class="inter-700 font-size-xl tugas-isi-button-batal" type="submit">Batal Kirim</button> 
                        </form>
                        <?php
                    } else if ($nilai_row['status'] == 'dinilai') {
                        
                    }
                }
                    ?>
                    </div>
            </div>
        </div>
    </main>
    <script>
        const scrollArea = document.getElementById('scroll-area');
        scrollArea.scrollTop = scrollArea.scrollHeight;
    </script>
    <script src="../../assets/javascript/scripts.js"></script>
</body>
</html>