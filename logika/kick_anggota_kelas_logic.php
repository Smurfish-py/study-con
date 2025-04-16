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

try {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM anggota_kelas WHERE id_murid = :id AND id_kelas = :id_kelas");
    $stmt->execute([':id'=>$id, ':id_kelas'=>$_GET['id_kelas']]);
    header("Location: ../user/teacher/kelola.php?id=".$_GET['id_kelas']);
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
} finally {
    $pdo = null;
}