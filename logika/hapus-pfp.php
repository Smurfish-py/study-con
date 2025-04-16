<?php
session_start();

include 'koneksi.php';

$scanfile = file_exists('../assets/images/user/'.$_SESSION['foto_profil']);

if ($scanfile != false && $_SESSION['foto_profil'] != ''){
    $sql = "UPDATE user SET foto_profil = '' WHERE id=".$_SESSION['id'];

    $stmt = $pdo->query($sql);

    unlink('../assets/images/user/'.$_SESSION['foto_profil']);

    header("location: multifunction_page/success.php?message=Foto%20berhasil%20dihapus%2E&link=logika%2Flogout%2Ephp&type=Klik%20disini%20untuk%20Logout");
} else {
    header("location: multifunction_page/error.php?message=Tidak%20ada%20foto%20profil&link=user%2Fedit%2Dprofile%2Ephp&type=Klik%20disini%20untuk%20kembali");
}


?>