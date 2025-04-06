<?php
session_start();

include "koneksi.php";
include "custom_function.php";

$id_kelas = $_GET['id_kelas'];
$id_tugas = $_GET['id_tugas'];

if (isset($_GET['action'])) {
    try {
        $stmt1 = $pdo->prepare("SELECT * FROM nilai_murid JOIN murid_tugas ON murid_tugas.id_file = nilai_murid.id_file WHERE nilai_murid.id_murid = :id");
        $stmt1->execute([':id'=>$_SESSION['id']]);
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

        $stmt2 = $pdo->prepare("DELETE FROM murid_tugas WHERE id_file = :id_file");
        $stmt2->execute([":id_file"=>$row1['id_file']]);

        $stmt3 = $pdo->prepare("DELETE FROM nilai_murid WHERE id_file = :id_file");
        $stmt3->execute([":id_file"=>$row1['id_file']]);
        
        unlink("../assets/documents/user/".$row1['nama_file']);
        header("Location:../user/default/tugas.php?id_kelas=$id_kelas&id=$id_tugas");
    } catch (PDOException $e) {
        echo $e->getMessage();
    } finally {
        $pdo = null;
    }
    

} else {
    $id_pengguna = $_SESSION['id'];
    $id_file = generateIdFile($pdo, "murid_tugas");
    $path = "../assets/documents/user/";
    $total_file = count($_FILES['file-tugas']['name']);

    if ($total_file > 0) {
        for ($i = 0; $i < $total_file; $i++){
            $nama_file = $_FILES['file-tugas']['name'][$i];

            if (!empty($_FILES['file-tugas']['name'][$i])) {
                $nama_file_baru = $id_kelas."_".$id_tugas."_".$nama_file;
            }

            $file_tmp = $_FILES['file-tugas']['tmp_name'][$i];

            $stmt = $pdo->prepare("INSERT INTO murid_tugas (id_file, nama_file) VALUES (:id_file, :nama_file)");
            $stmt->execute([':id_file'=>$id_file, ':nama_file'=>$nama_file_baru]);
            move_uploaded_file($file_tmp, $path.$nama_file_baru);
        }
        
        $stmt = $pdo->prepare("INSERT INTO nilai_murid (id_murid, id_kelas, id_tugas, id_file, status, waktu) VALUES (:id_murid, :id_kelas, :id_tugas, :id_file, :status, NOW())");
        $stmt->execute([':id_murid'=>$id_pengguna, ':id_kelas'=>$id_kelas,
        ':id_tugas'=>$id_tugas, ':id_file'=>$id_file, ':status'=>'diserahkan']);
        header ("location: multifunction_page/success.php?message=Tugas%20berhasil%20dikirim%2E&link=user%2Fdefault%2Ftugas%2Ephp%3Fid%5Fkelas%3D$id_kelas%26id%3D$id_tugas&type=Kembali");
    }
}
?>