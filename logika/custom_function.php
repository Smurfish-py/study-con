<?php
function login_log($new_email, $new_username){
    include "koneksi.php";
    $query = "INSERT INTO website_log (log) VALUES (:log)";
    $stmt = $pdo->prepare($query);
    $log_message = htmlspecialchars("$new_email telah membuat akun dengan nama $new_username", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':log' => $log_message]);
}

function ubahStatus_log($pelaku, $diubah, $status){
    include "koneksi.php";
    $query = "INSERT INTO website_log (log) VALUES (:log)";
    $stmt = $pdo->prepare($query);
    $log_message = htmlspecialchars("$pelaku telah mengubah status $diubah menjadi $status", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':log' => $log_message]);
}

function buatKelas_log($pelaku, $id_kelas){
    include "koneksi.php";
    $query = "INSERT INTO website_log (log) VALUES (:log)";
    $stmt = $pdo->prepare($query);
    $log_message = htmlspecialchars("$pelaku telah membuat kelas dengan id: $id_kelas", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':log' => $log_message]);
}

function generateIdKelas($pdo) {
    do {
        $randomNumber = random_int(1000, 99999);

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM kelas WHERE id = ?");
        $stmt->execute([$randomNumber]);
        $exists = $stmt->fetchColumn();
    } while ($exists > 0);

    return $randomNumber;
}

function generateIdFile($pdo, $nama_tabel) {
    do {
        $randomNumber = random_int(1000, 99999);

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM $nama_tabel WHERE id_file = ?");
        $stmt->execute([$randomNumber]);
        $exists = $stmt->fetchColumn();
    } while ($exists > 0);

    return $randomNumber;
}

function buatTugas_log($pelaku, $id_kelas, $judul_subjek){
    include "koneksi.php";
    $query = "INSERT INTO website_log (log) VALUES (:log)";
    $stmt = $pdo->prepare($query);
    $log_message = htmlspecialchars("$pelaku telah membuat subjek baru dengan judul $judul_subjek di id kelas : $id_kelas", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':log' => $log_message]);
}

function joinKelas_log($pelaku, $id_kelas){
    include "koneksi.php";
    $query = "INSERT INTO website_log (log) VALUES (:log)";
    $stmt = $pdo->prepare($query);
    $log_message = htmlspecialchars("$pelaku bergabung kedalam kelas dengan id kelas : $id_kelas", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':log' => $log_message]);
}

function joinKelas_logGuru($pelaku, $id_kelas, $id_guru){
    include "koneksi.php";
    $query = "INSERT INTO teacher_log (id_guru, log) VALUES (:id, :log)";
    $stmt = $pdo->prepare($query);
    $log_message = htmlspecialchars("$pelaku bergabung kedalam kelas anda, id kelas : $id_kelas", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':id'=>$id_guru,':log' => $log_message]);
}

function komentarTugas_logGuru($pelaku, $id_tugas, $id_kelas){
    include "koneksi.php";
    $tugas_stmt = $pdo->prepare("SELECT * FROM guru_tugas WHERE id = :id");
    $tugas_stmt->execute([':id'=>$id_tugas]);
    $row = $tugas_stmt->fetch(PDO::FETCH_ASSOC);
    
    $query = "INSERT INTO teacher_log (id_guru, log) VALUES (:id, :log)";
    $stmt = $pdo->prepare($query);

    $log_message = htmlspecialchars("$pelaku berkomentar di tugas ".$row['judul'].", id kelas : $id_kelas", ENT_QUOTES, 'UTF-8');
    $stmt->execute([':id'=>$row['id_guru'],':log' => $log_message]);
}
?>