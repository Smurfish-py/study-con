<?php
session_start();
include "../logika/koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil | StudyCon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="profile-body" style="background-color: #F7F7F7;">
    <div>
        <header class="header-dark" style="display: flex; align-items: center; position: fixed; left: 0; top: 0; width: 100vw;">
            <h1 class="inter-500 font-size-header" style="margin-top: 10px; margin-left: 40px;">Hello,<br>Let's edit your profile.</h1>
        </header>
        <div class="inter-400 user-info-container" id="user-request-container" style="display: none; height: 100vh;">
            <div class="inter-400 user-info-popup">
                <form class="form-request" action="edit-profile.php" method="post">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h1 class="inter-500 font-size-header">Form Request Status Akun</h1>
                        <p id="close-request" class="close-request">Tutup</p>
                    </div>
                    
                    <hr>
                    <br>
                    <label for="status">Pilih Status</label>
                    <select name="pilih-status" id="pilih-status" style="width: 469px; height: 35px; border-radius: 18px; appearance: none; -webkit-appearance: none;-moz-appearance: none;">
                        <option value="teacher" style="text-align: center;">Teacher</option>
                        <option value="master" style="text-align: center;">Master</option>
                    </select>
                    <br>
                    <br>
                    <label for="alasan-request">Alasan request: </label><br>
                    <textarea class='inter-400 alasan-request' name="alasan-request" id="alasan-request" placeholder="Masukkan alasan yang jelas..." required></textarea>
                    <br>
                    <br>
                    <input class="inter-600 font-size-l" type="submit" value="Kirim Request!">
                </form>
            </div>
        </div>
        <form action="../logika/edit-profile_logic.php" method="post" enctype="multipart/form-data" style="margin-top: 100px; ">
            <main style="margin: 20px; margin-left: 40px; margin-right: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 0;">
                <section class="left-section" style="height: 455px; width: 430px; text-align: center; padding: 30px; position: fixed; background-color: white; z-index: 1;">
                    
                    <?php
                    $path = "../assets/images/user/".$_SESSION['foto_profil'];
                    if(file_exists($path) != false && $_SESSION['foto_profil'] != ''){
                        echo "<img src='../assets/images/user/".$_SESSION['foto_profil']."' style='width: 400px; height: 400px; object-fit: cover;'>";
                    } else {
                        echo "<div style='display: flex; align-items: center; justify-content: center; text-align: center; height: 360px; width: 425px; border: 1px solid rgba(0, 0, 0, 0.3); background-color: rgba(0, 0, 0, 0.1);'><i class='fa-solid fa-user fa-2xl' style='font-size: 300px; color: rgba(0, 0, 0, 0.3);'></i></div>";
                    }
                    ?>

                    <br>
                    <br>

                    <?php

                    echo "<a href='../logika/hapus-pfp.php' class='inter-400 btn-pfp' style='text-decoration: none; background-color: #E25555;'>Delete Picture</a>"?>
                    <span class="inter-400" style="margin: 0px 15px; ">or</span>
                    <label for="foto-profil" class="inter-400 btn-pfp" style="background-color: #6AE097;">Upload New Picture</label>
                    <input type="file" name="foto-profil" accept=".jpg, .png, image/jpeg, image/png" id="foto-profil" >
                </section>

                <section class="right-section" style="margin-left: 580px; width: 670px; height: fit-content; padding: 10px; background-color: white;">
                    
                    <div class="inner-form">
                        <div class="inter-400" style="display: flex; justify-content: space-between; align-items: center;">
                            <h1 class="inter-300 font-size-title">My Information</h1>
                            <?php
                            echo "<a href='".$_SESSION['status']."/' style='text-decoration: none; color: black;'>Kembali ke dashboard</a>";
                            ?>
                        </div>
                        
                        <hr>
                        <br>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="email">E-mail (Tak bisa diubah)</label>
                            <div class="unchangeable-input text-profile-edit" id="email" style='padding-left: 10px; overflow-y: auto;'>
                                <?php echo "<p style='margin-top: 0;'>".$_SESSION['email']."</p>";?>
                            </div>
                        </div>
                        <br>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="fullname">Nama Lengkap</label>
                            <?php echo "<input name='fullname' type='text' value='".$_SESSION['fullname']."' id='fullname' class='inter-300 font-size-xl text-profile-edit' style='padding-left: 10px;' placeholder='Masukkan nama anda..'>";?>
                        </div>
                        <br>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="username">Username</label>
                            <?php echo "<input name='username' type='text' value='".$_SESSION['username']."' id='username' class='inter-300 font-size-xl text-profile-edit' style='padding-left: 10px;' placeholder='Masukkan username anda..'>";?>
                        </div>
                        <br>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <?php echo "<input name='tgl-lahir' type='text' value='".$_SESSION['tgl_lahir']."' id='tgl_lahir' class='inter-300 font-size-xl text-profile-edit' style='padding-left: 10px;' placeholder='cth: 19 Agustus 2007'>";?>
                        </div>
                        <br>
                        <?php
                        if ($_SESSION['status'] == 'default') {?>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="tgl_lahir">Sekolah</label>
                            <?php echo "<input name='sekolah' type='text' value='".$_SESSION['sekolah']."' id='sekolah' class='inter-300 font-size-xl text-profile-edit' style='padding-left: 10px;' placeholder='cth: SMK Negeri 1 Cimahi'>";?>
                        </div>
                        <br>
                        <div class='input-field inter-300 font-size-header' style='display: flex; justify-content: space-between; align-items: center;'>
                        <label for='nis'>NIS (jika ada)</label>
                        <?php
                        echo "<input name='nis' type='text' value='".$_SESSION['nis']."' id='nis' class='inter-300 font-size-xl text-profile-edit' style='padding-left: 10px;' placeholder='cth: 123456'>"?>
                        </div>
                        <br>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="kelas">Kelas</label>
                            <?php echo "<input name='kelas' type='text' value='".$_SESSION['kelas']."' id='kelas' class='inter-300 font-size-xl text-profile-edit' style='padding-left: 10px;' placeholder='cth: XI SIJA A atau 11 SIJA A'>";?>
                        </div>
                        <br>
                        <?php
                        } else if ($_SESSION['status'] == 'teacher') {
                        ?>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="tmpt_mengajar">Tempat Mengajar</label>
                            <?php echo "<input name='tmpt_mengajar' type='text' value='".$_SESSION['guru_tmpt_mengajar']."' id='tmpt_mengajar' class='inter-300 font-size-xl text-profile-edit' style='padding-left: 10px;' placeholder='cth: SMK Negeri 1 Cimahi, ...'>";?>
                        </div>
                        <br>    
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="guru_mapel">Mengajar Mapel</label>
                            <?php echo "<input name='guru_mapel' type='text' value='".$_SESSION['guru_mapel']."' id='guru_mapel' class='inter-300 font-size-xl text-profile-edit' style='padding-left: 10px;' placeholder='cth: IPA, IPS, Matematika, etc..'>";?>
                        </div>
                        <br>    
                        <?php
                        }
                        ?>
                        <h1 class="inter-300 font-size-title">Bagian Akun</h1>
                        <hr>
                        <br>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="account-status">Status Akun</label>
                            <div class="unchangeable-input text-profile-edit" id="account-status" style='padding-left: 10px;'>
                                <?php echo "<p style='margin-top: 0;'>".$_SESSION['status-akun']."</p>";?>
                            </div>
                        </div>
                        <br>
                        <div class="input-field inter-300 font-size-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="status">Status Pengguna</label>
                            <div class="unchangeable-input text-profile-edit" id="status" style='padding-left: 10px;'>
                                <?php echo "<p style='margin-top: 0;'>".$_SESSION['status']."</p>";?>
                            </div>
                        </div>
                        <br>
                        <?php
                        if ($_SESSION['status'] == 'teacher' || $_SESSION['status'] == 'default') {
                            echo "<p id='request' class='inter-600 font-size-l request'>UBAH USER STATUS (Request)</p><br>";
                        } else {
                            echo "<br>";
                        }
                        ?>
                        <button type="submit" style="width: 610px; height: 40px; color: white; background-color: #6AE097; border: none; text-align: center;" class="inter-600 font-size-l">SIMPAN</button>
                    </div>
                </section>
            </main>
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $req_email = $_SESSION['email'];
        $req_fullname = $_SESSION['fullname'];
        $req_id = $_SESSION['id'];
        $req_status = $_POST['pilih-status'];
        $req_alasan = $_POST['alasan-request'];

        $query = "SELECT * FROM request_status WHERE id_pengguna=".$_SESSION['id'];
        $hasil = $pdo->query($query);
        if ($hasil->rowCount()>0) {
            echo "<script> alert('Anda sudah mengirim request sebelumnya, tunggu beberapa saat untuk mengirim lagi!')</script>";
        } else {
            $sql = "INSERT INTO request_status (id_pengguna, nama_lengkap, email, status_req, alasan) VALUES (:id, :nama_lengkap, :email, :status_req, :alasan)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $req_id, 'nama_lengkap' => $req_fullname, 'email' => $req_email, 'status_req' => $req_status, 'alasan' => $req_alasan]);
            
            if ($stmt) {
                echo "<script> alert('Request telah dikirim!')</script>";
            }
        }
    }
    
    ?>
    <script>
        document.getElementById("request").addEventListener("click", function() {
        document.getElementById("user-request-container").style.display = "flex";
            });
        document.getElementById("close-request").addEventListener("click", function() {
        document.getElementById("user-request-container").style.display = "none";
            });
    </script>
    <script src="../assets/javascript/scripts.js"></script>
</body>
</html>