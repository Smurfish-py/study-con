<?php
session_start();

include "koneksi.php";
include "custom_function.php";

try {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->execute(['email' => $email]);

    if($stmt->rowCount() > 0){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($password == $user['password']){
            session_unset();

            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['tgl_lahir'] = $user['tgl_lahir'];
            $_SESSION['sekolah'] = $user['sekolah'];
            $_SESSION['nis'] = $user['NIS'];
            $_SESSION['kelas'] = $user['kelas'];
            $_SESSION['guru_tmpt_mengajar'] = $user['guru_tmpt_mengajar'];
            $_SESSION['guru_mapel'] = $user['guru_mapel'];
            $_SESSION['status'] = $user['status'];
            $_SESSION['status-akun'] = $user['status_akun'];
            $_SESSION['foto_profil'] = $user['foto_profil'];

            header("Location: ../user/".$_SESSION['status']."/index.php");
            exit;
        } else {
            header("location: multifunction_page/error.php?message=Password%20salah%2C%20silahkan%20coba%20lagi%2E&link=login%2Ephp&type=Login%20page");
        }
    } else {
        header("location: multifunction_page/error.php?message=Pengguna%20tidak%20ditemukan%20di%20database%2E%20Jika%20anda%20belum%20mendaftar%2C%20silahkan%20daftar%20terlebih%20dahulu%2E&link=register%2Ephp&type=Register%20page");
    }
} catch(PDOException $e){
    echo "Error: ".$e->getMessage();
} finally {
    $pdo = null;
}
?>