<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
} else if ($_SESSION['status-akun'] == 'banned' || $_SESSION['status'] != 'master') {
    session_destroy();
    header("Location: ../");
}

include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pengumuman = $_POST['isi-pengumuman'];
    $pengirim = isset($_POST['pengirim-anonim']) ? 'Anonim' : $_SESSION['email'];
    $query = "INSERT INTO pengumuman (penulis, isi) VALUES ('$pengirim', '$pengumuman')";
    $stmt = $pdo->query($query);

    $new_query = "INSERT INTO website_log (log) VALUES ('Admin ".$_SESSION['email']." telah membuat pengumuman')";
    $pdo->query($new_query);

    header("Location: ../user/master/index.php");
    exit();
}
?>