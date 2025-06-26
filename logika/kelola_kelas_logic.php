<?php
session_start();

include "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status-akun'] == 'banned' || $_SESSION['status'] != 'teacher') {
    session_destroy();
    header("Location: ../");
}


$id_kelas = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM kelas WHERE id = :id");
$stmt->execute([':id'=>$id_kelas]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST)) {
    $nama_kelas = $_POST['nama-kelas'];
    $password_kelas = $_POST['password-kelas'];
    $deskripsi_kelas = $_POST['deskripsi-kelas'];
    $nama_file = $_FILES['header-kelas']['name'];
    $tmp_file = $_FILES['header-kelas']['tmp_name'];
    $nama_file_baru = $id_kelas."_".$nama_file;
    if (!empty($tmp_file)) {
        if (file_exists("../assets/images/kelas/".$row['gambar_header_kelas'])) {
            unlink("../assets/images/kelas/".$row['gambar_header_kelas']);
        }

        move_uploaded_file($tmp_file, "../assets/images/kelas/".$nama_file_baru);

        $stmt = $pdo->prepare("UPDATE kelas SET nama_kelas=:nama_kelas, password=:password, deskripsi_kelas=:deskripsi_kelas, gambar_header_kelas=:gambar_header WHERE id = :id");
        $stmt->execute([
            ':nama_kelas'=>$nama_kelas, ':password'=>$password_kelas, ':deskripsi_kelas'=>$deskripsi_kelas, ':gambar_header'=>$nama_file_baru,
            ':id'=>$id_kelas
        ]);
    } else {
        $stmt = $pdo->prepare("UPDATE kelas SET nama_kelas=:nama_kelas, password=:password, deskripsi_kelas=:deskripsi_kelas WHERE id = :id");
        $stmt->execute([
            ':nama_kelas'=>$nama_kelas, ':password'=>$password_kelas, ':deskripsi_kelas'=>$deskripsi_kelas, ':id'=>$id_kelas
        ]);
    }
    header("location: multifunction_page/success.php?message=Perubahan%20berhasil%20dibuat%2E&link=user%2Fteacher%2Fkelola%2Ephp%3Fid%3D$id_kelas&type=Kembali");
}