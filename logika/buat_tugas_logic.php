<?php
session_start();

include "koneksi.php";
include "custom_function.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status'] != 'teacher' || $_SESSION['status-akun'] == 'banned') {
    session_destroy();
    header("Location: ../../");
}

if (isset($_POST)) {
    $id = generateIdKelas($pdo);
    $idKelas = $_POST['id-kelas'];
    $idGuru = $_SESSION['id'];
    $judul = $_POST['judul-subjek'];
    $tipe = $_POST['tipe-subjek'];
    $deskripsi = $_POST['deskripsi-subjek'];
    $total_file = count($_FILES['file-subjek']['name']);

    $path = "../assets/documents/kelas/";

    $stmt = $pdo->prepare("INSERT INTO guru_tugas (id_guru, id_kelas, judul, deskripsi, tipe, id_file) VALUES (:id_guru, :id_kelas, :judul, :deskripsi, :tipe, :id_file)");

    $stmt->execute([ 'id_guru'=>$idGuru, 'id_kelas'=>$idKelas, 'judul'=>$judul, 'deskripsi'=>$deskripsi, 'tipe'=>$tipe, 'id_file'=>$id]);
    buatTugas_log($_SESSION['email'], $idKelas, $judul);

    if ($total_file > 0) {
        for ($i = 0; $i < $total_file; $i++) {
            $nama_file = $_FILES['file-subjek']['name'][$i];
            $nama_file_baru = $idKelas."_".$id."_".$nama_file;
            $file_tmp = $_FILES['file-subjek']['tmp_name'][$i];
            
            $stmt = $pdo->prepare("INSERT INTO file_tugas_guru (id, id_kelas, id_guru, nama_file) VALUES (:id, :id_kelas, :id_guru, :nama_file)");
            $stmt->execute(['id'=>$id, 'id_kelas'=>$idKelas, 'id_guru'=>$idGuru, 'nama_file'=>$nama_file_baru]);
            move_uploaded_file($file_tmp, $path.$nama_file_baru);
        }
    } 
    header ("location: multifunction_page/success.php?message=$tipe%20telah%20berhasil%20dibuat%21&link=user%2Fteacher%2Fkelas%2Ephp%3Fid%3D$idKelas&type=Kembali%20ke%20halaman%20kelas");
}


?>