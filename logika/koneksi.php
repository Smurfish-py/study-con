<?php
    $host = "localhost";
    $dbname = "studycon";
    $username = "studycon";
    $password = "EXPhantom0729";
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $result = $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Koneksi Gagal: ".$e->getMessage();
    }
?>