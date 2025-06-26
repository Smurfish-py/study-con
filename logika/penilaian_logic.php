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

$id_tugas = $_GET['id_tugas'];
$id_kelas = $_GET['id_kelas'];

if (isset($_GET['action'])) {
    if ($_GET['action'] =='kirim_komentar') {
        $isi = $_POST['isi'];
        if ($isi == '') {
            ?>
            <script>
                alert("Input tidak boleh kosong!");
                window.location.href = "../user/teacher/penilaian.php?id_tugas=<?php echo $_GET['id_tugas']?>&id_kelas=<?php echo $_GET['id_kelas']?>&action=komentar";
            </script>
            <?php
        } else {
            $stmt = $pdo->prepare("INSERT INTO komentar_tugas (id_user, id_kelas, id_tugas, isi) VALUES (:id_user, :id_kelas, :id_tugas, :isi)");
            $stmt->execute([':id_user'=>$_SESSION['id'], ':id_kelas'=>$id_kelas, ':id_tugas'=>$id_tugas, ':isi'=>$isi]);
        
            header("Location:../user/teacher/penilaian.php?id_tugas=".$_GET['id_tugas']."&id_kelas=".$_GET['id_kelas']."&action=komentar");
        }
    }
} else {
    $id_murid = $_GET['id'];
    $deskripsi = $_POST['masukan-pribadi'];
    $nilai = $_POST['nilai-murid'];
    
    if ($nilai != '' || $deskripsi != '') {
        $status = 'dinilai';
    } else {
        $status = 'diserahkan';
    }
    
    $stmt = $pdo->prepare("SELECT * FROM nilai_murid WHERE id_murid = :id AND id_tugas = :id_tugas");
    $stmt->execute([':id'=>$id_murid, ':id_tugas'=>$id_tugas]);

    try {
        if ($stmt->rowCount()>0) {
            $stmt = $pdo->prepare("UPDATE nilai_murid SET status = :status, nilai = :nilai, deskripsi = :deskripsi WHERE id_murid = :id_murid");
            $stmt->execute([':status'=>$status, ':deskripsi'=>$deskripsi, ':nilai'=>$nilai, ':id_murid'=>$id_murid]);
            
            header ("location: multifunction_page/success.php?message=Submit%20nilai%20berhasil%21&link=user%2Fteacher%2Fpenilaian%2Ephp%3Fid%5Ftugas%3D".$id_tugas."%26id%5Fkelas%3D".$id_kelas."&type=kembali");
        } else {
            ?>
            <script>
                alert("Gagal submit nilai, tugas tidak ada atau telah dihapus");
                window.location.href = "../user/teacher/penilaian.php?id_tugas=<?php echo $_GET['id_tugas']?>&id_kelas=<?php echo $_GET['id_kelas']?>";
            </script>
            <?php
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    } finally {
        $pdo = null;
    }
}