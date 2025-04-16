<?php
session_start();

include "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status'] != 'teacher' || $_SESSION['status-akun'] == 'banned') {
    session_destroy();
    header("Location: ../../");
}

$id_user = $_SESSION['id'];
$id_tugas = $_GET['id_tugas'];
$id_kelas = $_GET['id_kelas'];
$isi = $_POST['komentar-guru'];

$stmt = $pdo->prepare("INSERT INTO komentar_tugas (id_user, id_kelas, id_tugas, isi) VALUES (:id_user, :id_kelas, :id_tugas, :isi)");
$stmt->execute([':id_user'=>$id_user, ':id_kelas'=>$id_kelas, ':id_tugas'=>$id_tugas, ':isi'=>$isi]);
header("Location:../user/teacher/penilaian.php?id_tugas=".$id_tugas."&id_kelas=".$id_kelas);