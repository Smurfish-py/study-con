<?php
session_start();
include "koneksi.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_fullname = $_POST['fullname'];
        $new_username = $_POST['username'];
        $new_tgl_lahir = $_POST['tgl-lahir'];
        $new_sekolah = $_POST['sekolah'];
        $new_nis = $_POST['nis'];
        $new_kelas = $_POST['kelas'];
        $new_tempat_mengajar = $_POST['tmpt_mengajar'];
        $new_guru_mapel = $_POST['guru_mapel'];
        $nama_foto = $_FILES['foto-profil']['name'];
        $tmp = $_FILES['foto-profil']['tmp_name'];
        $nama_foto_baru = $_SESSION['id'].'_'.$nama_foto;
        
        $path = "../assets/images/user/";
    
        if (!empty($tmp)){
            if (!empty($_SESSION['foto_profil']) && file_exists($path . $_SESSION['foto_profil'])) {
                unlink($path . $_SESSION['foto_profil']);
            }
            move_uploaded_file($tmp, $path.$nama_foto_baru);
            $query = $pdo->query("UPDATE user SET fullname='$new_fullname', username='$new_username', tgl_lahir='$new_tgl_lahir', sekolah='$new_sekolah', nis='$new_nis', kelas='$new_kelas', foto_profil = '$nama_foto_baru', guru_tmpt_mengajar='$new_tempat_mengajar', guru_mapel='$guru_mapel' WHERE id=".$_SESSION['id']);

        } else {
            $query = $pdo->query("UPDATE user SET fullname='$new_fullname', username='$new_username', tgl_lahir='$new_tgl_lahir', sekolah='$new_sekolah', nis='$new_nis', kelas='$new_kelas', guru_tmpt_mengajar='$new_tempat_mengajar', guru_mapel='$new_guru_mapel' WHERE id=".$_SESSION['id']);
        }
        header("location: multifunction_page/success.php?message=Perubahan%20berhasil%2C%20silahkan%20logout%20dan%20login%20kembali%20untuk%20melihat%20perubahan%2E&link=logika%2Flogout%2Ephp&type=Logout");
    } 
} catch (PDOException $e) {
    echo "Gagal: ".$e->getMessage();
} finally {
    $pdo = null;
}
?>