<?php
session_start();

include "koneksi.php";

if (isset($_POST)) {
    $tipe = $_POST['pilihan'];
    $email = $_POST['email'];
    $isi = $_POST['isi-keluhan'];

    $stmt = $pdo->prepare("INSERT INTO masukan (tipe, pengirim, isi) VALUES (:tipe, :pengirim, :isi)");
    $stmt->execute([':tipe'=>$tipe, ':pengirim'=>$email, ':isi'=>$isi]);
    
    $pesan = '';
    if ($tipe == 'pesan') {
        $pesan = "Pesan anda telah dikirim, admin akan segera membaca pesan anda.";
    } else if ($tipe == 'keluhan') {
        $pesan = "Keluhan anda telah dikirim, admin akan segera membaca pesan anda. Terima kasih telah memberikan keluhan agar website ini menjadi lebih baik.";
    } else if ($tipe == 'saran') {
        $pesan = "Saran anda telah dikirim, admin akan segera membaca saran anda. Terima kasih telah memberikan saran, saran anda sangat berarti bagi kami :)";
    }

    $redirect = isset($_SESSION['id']) ? "../user/".$_SESSION['status']."/" : "../";

    echo "<script>
        alert('$pesan');
        window.location.href = '$redirect';
    </script>";
}

?>