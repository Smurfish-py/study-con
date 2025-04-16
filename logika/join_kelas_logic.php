<?php
session_start();
include "koneksi.php";
include "custom_function.php";

if ($_GET['action'] == "join") {
    $id_kelas = $_POST['join-kelas'];
    $stmt = $pdo->prepare("SELECT * FROM kelas WHERE id=:id_kelas");
    $stmt->execute(['id_kelas'=>$id_kelas]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount()>0) {
        $new_stmt = $pdo->prepare("SELECT * FROM anggota_kelas WHERE id_murid = :id AND id_kelas = :id_kelas");
        $new_stmt->execute(['id'=>$_SESSION['id'], 'id_kelas'=>$id_kelas]);

        if ($new_stmt->rowCount() > 0) {
            header("location: multifunction_page/error.php?message=Anda%20sudah%20bergabung%20ke%20kelas%20ini&link=user%2Fdefault%2F&type=Kembali");
        } else {
            if ($row['password'] != '') {
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
                    <link rel="stylesheet" href="../assets/css/style.css">
                </head>
                <body>
                    <main style="height: 95vh; width: 90vw;display: flex; align-items: center; justify-content: center;" class="inter-400">
                        <fieldset style="width: 300px; background-color: white;">
                            <legend><h1 class="inter-400" style="margin: 0;">Autentikasi</h1></legend>
                            <p>Kelas ini menggunakan password untuk autentikasi</p>
                            <?php
                            echo "<form action='join_kelas_logic.php?action=auth&id=$id_kelas' method='post'>"
                            ?>
                                <label for="password-kelas">Masukkan Password</label><br>
                                <input type="password" name="password-kelas" id="password-kelas">
                                <button type="submit">Kirim</button>
                            </form>
                        </fieldset>
                    </main>
                </body>
                </html>
                <?php
            } else {
                $stmt = $pdo->prepare("INSERT INTO anggota_kelas (id_kelas, id_murid) VALUES (:id_kelas, :id_murid)");
                $stmt->execute(['id_kelas'=>$id_kelas, 'id_murid'=>$_SESSION['id']]);
                joinKelas_log($_SESSION['email'], $id_kelas);
                joinKelas_logGuru($_SESSION['email'], $id_kelas, $row['id_guru']);
                header("location: multifunction_page/success.php?message=Berhasil%20bergabung%20kedalam%20kelas%20".$row['nama_kelas']."&link=user%2Fdefault%2F&type=Kembali");
                exit();
            }
        }
    } else {
        header("location: multifunction_page/error.php?message=Kelas%20tidak%20ditemukan%20&link=user%2Fdefault%2F&type=Kembali");
        exit();
    }
} else if ($_GET['action'] == 'auth') {
    $id_kelas = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM kelas WHERE id=:id_kelas");
    $stmt->execute(['id_kelas'=>$id_kelas]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($_POST['password-kelas'] == $row['password']) {
        $stmt = $pdo->prepare("INSERT INTO anggota_kelas (id_kelas, id_murid) VALUES (:id_kelas, :id_murid)");
        $stmt->execute(['id_kelas'=>$id_kelas, 'id_murid'=>$_SESSION['id']]);
        joinKelas_log($_SESSION['email'], $id_kelas);
        joinKelas_logGuru($_SESSION['email'], $id_kelas, $row['id_guru']);
        header("location: multifunction_page/success.php?message=Berhasil%20bergabung%20kedalam%20kelas%20".$row['nama_kelas']."&link=user%2Fdefault%2F&type=Kembali");
        exit();
    } else {
        header("location: multifunction_page/error.php?message=Password%20salah&link=user%2Fdefault%2F&type=Kembali");
        exit();
    }
}

?>