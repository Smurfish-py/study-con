<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status'] != 'teacher' || $_SESSION['status-akun'] == 'banned') {
    session_destroy();
    header("Location: ../../");
}

include "koneksi.php";
include "custom_function.php";

if (isset($_POST)) {
    $id_guru = $_SESSION['id'];
    $id_kelas = generateIdKelas($pdo);
    $nama_kelas = $_POST['nama-kelas'];
    $password_kelas = $_POST['password-kelas'];
    $desc_kelas = $_POST['deskripsi-kelas'];
    $header_kelas_nama = $_FILES['header-kelas']['name'];
    $header_kelas_file = $_FILES['header-kelas']['tmp_name'];
    $nama_header_baru = $id_kelas."_".$header_kelas_nama;
    $path = "../assets/images/kelas/";

    if (!empty($header_kelas_file)) {
        $sql = "INSERT INTO kelas (id, id_guru, nama_kelas, password, deskripsi_kelas, gambar_header_kelas) VALUES (:id, :id_guru, :nama_kelas, :password, :deskripsi_kelas, :gambar_header_kelas)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id'=>$id_kelas,'id_guru'=>$id_guru, 'nama_kelas'=>$nama_kelas, 'password'=>$password_kelas, 'deskripsi_kelas'=>$desc_kelas, 'gambar_header_kelas'=>$nama_header_baru]);

        move_uploaded_file($header_kelas_file, $path.$nama_header_baru);

        header("location: multifunction_page/success.php?message=Berhasil%20membuat%20kelas%20dengan%20nama%20$nama_kelas%2E&link=user%2Fteacher%2F&type=Kembali%20ke%20dashboard");
    } else {
        $sql = "INSERT INTO kelas (id, id_guru, nama_kelas, password, deskripsi_kelas) VALUES (:id, :id_guru, :nama_kelas, :password, :deskripsi_kelas)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id'=>$id_kelas,'id_guru'=>$id_guru, 'nama_kelas'=>$nama_kelas, 'password'=>$password_kelas, 'deskripsi_kelas'=>$desc_kelas]);

        header("location: multifunction_page/success.php?message=Berhasil%20membuat%20kelas%20dengan%20nama%20$nama_kelas%2E&link=user%2Fteacher%2F&type=Kembali%20ke%20dashboard");
    }
    
} else {
    header("location: multifunction_page/error.php?message=Gagal%20membuat%20kelas%2E&link=user%2Fteacher%2F&type=Kembali");
}
?>